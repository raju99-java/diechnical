<?php

namespace Modules\Admin\Http\Controllers;

use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Validator;
use PDF;

use URL;
use App\Model\QuestionAnswer;
use App\Model\Settings;
use App\Model\Exam;
use App\Model\Course;
use App\Model\Franchise;
use App\Model\UserMaster;
use App\Model\AssignCourse;

class FranchiseExamController extends AdminController {
    
    public function datatables() {
        
        $datas = Exam::select('exams.*')->join('user_master','user_master.id','=','exams.user_id')->where('user_master.franchise_id', '<>', '0')->where('exams.course_id','<>','0')->orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('user_id', function ($model) {
                            $user=UserMaster::where('id',$model->user_id)->first();
                            return $user->full_name;
                        })
                        ->editColumn('course_id', function ($model) {
                            $course=Course::where('id',$model->course_id)->first();
                            return $model->course->name;
                        })
                        ->editColumn('franchise_name', function ($model) {
                            $user=UserMaster::where('id',$model->user_id)->first();
                            $franchise=Franchise::where('id',$user->franchise_id)->first();
                            return (!empty($franchise->name))? strtoupper($franchise->name) : 'NA';
                        })
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Pursuing</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Pass</span>';
                            }
                            return $status;
                        })
                        ->addColumn('action', function ($model) {
                            if($model->status == '1'){
                                
                                if($model->admin_marks_submit == '1'){
                                    
                                    if($model->course->exam_status == '0'){
                                        
                                        if($model->certificate_delivered == '0'){
                                            return
                                            '<a href="' . Route("franchise-student-exam-get-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Editt</a>' .
                                            '<a href="' . Route("franchise-exam-certificate-down", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-file"></i> Certificate</a>'.
                                            '<a href="' . Route("franchise-exam-result-down", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-download"></i> Result</a>'.
                                            '<a href="' . Route("franchise-student-exam-certificate-delivered", [$model->id]) . '" class="btn btn-xs btn-primary pull-left" style="background-color:red;"><i class="fa fa-close"></i> Pending</a>';
                                        }else{
                                            return
                                            '<a href="' . Route("franchise-student-exam-get-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Editt</a>' .
                                            '<a href="' . Route("franchise-exam-certificate-down", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-file"></i> Certificate</a>'.
                                            '<a href="' . Route("franchise-exam-result-down", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-download"></i> Result</a>'.
                                            '<a href="' . Route("franchise-student-exam-certificate-delivered", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-check"></i> Delivered</a>';
                                        }
                                        
                                    }else{
                                        
                                        if($model->certificate_delivered == '0'){
                                            return
                                            '<a href="' . Route("franchise-student-exam-get-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                            '<a href="' . Route("franchise-student-exam-get-view", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Question & Answer</a>'.
                                            '<a href="' . Route("franchise-exam-certificate-down", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-file"></i> Certificate</a>'.
                                            '<a href="' . Route("franchise-exam-result-down", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-download"></i> Result</a>'.
                                            '<a href="' . Route("franchise-student-exam-certificate-delivered", [$model->id]) . '" class="btn btn-xs btn-primary pull-left" style="background-color:red;"><i class="fa fa-close"></i> Pending</a>';
                                        }else{
                                            return
                                            '<a href="' . Route("franchise-student-exam-get-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                            '<a href="' . Route("franchise-student-exam-get-view", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Question & Answer</a>'.
                                            '<a href="' . Route("franchise-exam-certificate-down", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-file"></i> Certificate</a>'.
                                            '<a href="' . Route("franchise-exam-result-down", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-download"></i> Result</a>'.
                                            '<a href="' . Route("franchise-student-exam-certificate-delivered", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-check"></i> Delivered</a>';
                                        }
                                        
                                    }
                                    
                                }else{
                                    
                                    if($model->course->exam_status == '0'){
                                        return
                                        '<a href="' . Route("franchise-student-exam-get-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>';
                                    }else{
                                        return
                                        '<a href="' . Route("franchise-student-exam-get-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                        '<a href="' . Route("franchise-student-exam-get-view", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Question & Answer</a>';
                                    } 
                                    
                                }
                                
                            }else{
                            return
                                    '<a href="' . Route("franchise-student-exam-get-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="' . Route("franchise-student-exam-get-view", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Question & Answer</a>';    
                            }
                        })
                        ->rawColumns(['franchise_name','status', 'action'])
                        ->toJson(); //--- Returning Json Data To Client Side
    }
    
    //*** GET Request
    public function index() {
        return view('admin::franchiseexam.list');
    }
    
    //*** GET Request
    public function view($id) {
        $model=Exam::where('id',$id)->first();
        return view('admin::franchiseexam.view', compact('id','model'));
    }
    
    
    public function get_edit($id) {
        $data = [];
        
        $data['model'] = $model = Exam::where('id', '=', $id)->first();
        if (!$model) {
            return redirect()->back()->with('error_msg', 'Invalid Link!');
        }
        $data['id'] = $id;
        return view('admin::franchiseexam.exam_edit', $data);
    }
    
    
    public function post_edit(Request $request,$id){
        $validator = Validator::make($request->all(), [
                    
        ]);
        $validator->after(function ($validator) use ($request) {
            $checkExam = Exam::where('id', $request->input('id'))->first();
            if($checkExam->status=='0'){
                if($request->input('supply_exam_fees')==''){
                    $validator->errors()->add('supply_exam_fees', 'This feild is required!');
                }
            }else{
                
                if($checkExam->course->exam_status == '0'){
                    
                    if($request->input('lang')=='1'){
                        if($request->input('language')==''){
                            $validator->errors()->add('language', 'This field is required!');
                        }
                        if($request->input('speed')==''){
                            $validator->errors()->add('speed', 'This field is required!');
                        }
                        if($request->input('accuracy')==''){
                            $validator->errors()->add('accuracy', 'This field is required!');
                        }
                        if($request->input('time_taken')==''){
                            $validator->errors()->add('time_taken', 'This field is required!');
                        }
                    }
                    
                     if($request->input('lang')=='2'){
                        if($request->input('language')==''){
                            $validator->errors()->add('language', 'This field is required!');
                        }
                        if($request->input('speed')==''){
                            $validator->errors()->add('speed', 'This field is required!');
                        }
                        if($request->input('accuracy')==''){
                            $validator->errors()->add('accuracy', 'This field is required!');
                        }
                        if($request->input('time_taken')==''){
                            $validator->errors()->add('time_taken', 'This field is required!');
                        }
                        if($request->input('language2')==''){
                            $validator->errors()->add('language2', 'This field is required!');
                        }
                        if($request->input('speed2')==''){
                            $validator->errors()->add('speed2', 'This field is required!');
                        }
                        if($request->input('accuracy2')==''){
                            $validator->errors()->add('accuracy2', 'This field is required!');
                        }
                        if($request->input('time_taken2')==''){
                            $validator->errors()->add('time_taken2', 'This field is required!');
                        }
                    }
                    
                }else{
                    if($request->input('theory')==''){
                        $validator->errors()->add('theory', 'This field is required!');
                    }
                    if($request->input('practical')==''){
                        $validator->errors()->add('practical', 'This field is required!');
                    }
                    if($request->input('viva')==''){
                        $validator->errors()->add('viva', 'This field is required!');
                    }
                }
                
            }
            
            
        });
        if ($validator->passes()) {
            $model = Exam::where('id', '=', $id)->first();
            $input = $request->all();
            //   if($model->status=='1'){
            //   	$input['admin_marks_submit']='1';
            //   }
            $model->update($input);
          	if($model->status=='1'){
          	    
          	    if($model->course->exam_status == '0'){
          	        
          	        if($request->input('lang')=='1'){
          	        
              	         //Send Mail
                            $email_setting = $this->get_email_data('pass_lang_one_exam', array('NAME' => $model->user->full_name, 'EMAIL' => $model->user->email, 'COURSENAME' => $model->course->name, 'LANG' => strtoupper($model->language), 'SPEED' => $model->speed, 'ACCURACY' => $model->accuracy,'TIME' => $model->time_taken));
                            $email_data = [
                                'to' => $model->user->email,
                                'subject' => 'DI Technical '.$model->course->name.' Course Cleared',
                                'template' => 'signup',
                                'data' => ['message' => $email_setting['body']]
                            ];
                           $this->SendMail($email_data);  
            			//Admin send mail
                          $admin_model = UserMaster::where('type_id', '1')->first();
                          $email_setting = $this->get_email_data('admin_pass_lang_one_exam', array('STUDENT_NAME' => $model->user->full_name, 'COURSENAME' => $model->course->name, 'LANG' => strtoupper($model->language), 'SPEED' => $model->speed, 'ACCURACY' => $model->accuracy,'TIME' => $model->time_taken));
                            $email_data = [
                                'to' => $admin_model->email,
                                'subject' => 'DI Technical '.$model->course->name.' Course Cleared',
                                'template' => 'signup',
                                'data' => ['message' => $email_setting['body']]
                            ];
                           $this->SendMail($email_data);
          	        }
          	        if($request->input('lang')=='2'){
          	        
              	         //Send Mail
                            $email_setting = $this->get_email_data('pass_lang_two_exam', array('NAME' => $model->user->full_name, 'EMAIL' => $model->user->email, 'COURSENAME' => $model->course->name, 'LANG' => strtoupper($model->language), 'SPEED' => $model->speed, 'ACCURACY' => $model->accuracy,'TIME' => $model->time_taken,  'LANG2' => strtoupper($model->language2), 'SPEED2' => $model->speed2, 'ACCURACY2' => $model->accuracy2,'TIME2' => $model->time_taken2));
                            $email_data = [
                                'to' => $model->user->email,
                                'subject' => 'DI Technical '.$model->course->name.' Course Cleared',
                                'template' => 'signup',
                                'data' => ['message' => $email_setting['body']]
                            ];
                           $this->SendMail($email_data);  
            			//Admin send mail
                          $admin_model = UserMaster::where('type_id', '1')->first();
                          $email_setting = $this->get_email_data('admin_pass_lang_two_exam', array('STUDENT_NAME' => $model->user->full_name, 'COURSENAME' => $model->course->name, 'LANG' => strtoupper($model->language), 'SPEED' => $model->speed, 'ACCURACY' => $model->accuracy,'TIME' => $model->time_taken,  'LANG2' => strtoupper($model->language2), 'SPEED2' => $model->speed2, 'ACCURACY2' => $model->accuracy2,'TIME2' => $model->time_taken2));
                            $email_data = [
                                'to' => $admin_model->email,
                                'subject' => 'DI Technical '.$model->course->name.' Course Cleared',
                                'template' => 'signup',
                                'data' => ['message' => $email_setting['body']]
                            ];
                           $this->SendMail($email_data);
          	        }
          	        
                }else{
                
                    //Send Mail
                        $email_setting = $this->get_email_data('pass_exam', array('NAME' => $model->user->full_name, 'EMAIL' => $model->user->email, 'COURSENAME' => $model->course->name, 'THEORY' => $model->theory, 'PRACTICAL' => $model->practical, 'VIVA' => $model->viva));
                        $email_data = [
                            'to' => $model->user->email,
                            'subject' => 'DI Technical '.$model->course->name.' Course Cleared',
                            'template' => 'signup',
                            'data' => ['message' => $email_setting['body']]
                        ];
                       $this->SendMail($email_data);  
        			//Admin send mail
                      $admin_model = UserMaster::where('type_id', '1')->first();
                      $email_setting = $this->get_email_data('admin_pass_exam', array('STUDENT_NAME' => $model->user->full_name, 'COURSENAME' => $model->course->name, 'THEORY' => $model->theory, 'PRACTICAL' => $model->practical, 'VIVA' => $model->viva));
                        $email_data = [
                            'to' => $admin_model->email,
                            'subject' => 'DI Technical '.$model->course->name.' Course Cleared',
                            'template' => 'signup',
                            'data' => ['message' => $email_setting['body']]
                        ];
                       $this->SendMail($email_data);
                }
               
            }
            return redirect()->route('franchise-student-exams')->with('success_msg', 'Updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }
    
    
    
    public function exam_certificate_download(Request $request,$id) {
        $data = [];
        $checkExam = Exam::where('id', $id)->first();
        if($checkExam->status=='0'){
           return redirect()->back()->with('error_msg', 'Something went wrong!.');
        }
        $user_id = $checkExam->user_id;
        $data['model'] = $checkExam;
        
        $data['assigncourse']= $assigncourse = AssignCourse::where('user_id', $user_id)->where('course_id', $checkExam->course_id)->first();
        $link = Route('verify-certificate-verification').'?certificate_no='.$assigncourse->certificate_no;
        \QrCode::size(200)
            ->format('png')
            ->generate("Certificate Verification: $link", public_path('/frontend/qrcode/'.$assigncourse->user->full_name.'qrcode.png'));
        $data['qrcode']= URL::asset('public/frontend/qrcode/'.$assigncourse->user->full_name.'qrcode.png');
        

        $pdf = PDF::loadView('mail.exam_certificate', $data);
        return $pdf->download($assigncourse->enrollment_id.'certificate.pdf');
        // return $pdf->stream();
        exit;
        // return redirect()->back();
    }
    public function exam_result_download(Request $request,$id) {
        $data = [];
        $checkExam = Exam::where('id', $id)->first();
        if($checkExam->status=='0'){
           return redirect()->back()->with('error_msg', 'Something went wrong!.');
        }
        $user_id = $checkExam->user_id;
        $data['model'] = $checkExam;
        
        $data['assigncourse']= $assigncourse = AssignCourse::where('user_id', $user_id)->where('course_id', $checkExam->course_id)->first();
        
        $link = Route('verify-certificate-verification').'?certificate_no='.$assigncourse->certificate_no;
        \QrCode::size(200)
            ->format('png')
            ->generate("Certificate Verification: $link", public_path('/frontend/qrcode/'.$assigncourse->user->full_name.'qrcode.png'));
        $data['qrcode']= URL::asset('public/frontend/qrcode/'.$assigncourse->user->full_name.'qrcode.png');
        

        $pdf = PDF::loadView('mail.exam_result', $data);
        return $pdf->download($assigncourse->enrollment_id.'result.pdf');
        // return $pdf->stream();
        exit;
        // return redirect()->back();
    }
    
    public function exam_certificate_delivered($id){
        $model=Exam::where('id',$id)->first();
        return view('admin::franchiseexam.certificate_delivered', compact('id','model'));
    }
    
    public function post_exam_certificate_delivered(Request $request,$id){
        $validator = Validator::make($request->all(), [
            
            'certificate_delivered' => 'required',
            'delivered_date' => 'required|date|after:yesterday',
            
                ]
        );
        
        if ($validator->passes()) {
            
            $data = Exam::findOrFail($id);
            $input = $request->all();
            
            $data->update($input);
                 
            return redirect()->route('franchise-student-exams')->with('success_msg', 'Exam Certificate Delivered.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    
}
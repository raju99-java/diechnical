<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Yajra\Datatables\Datatables;
use Validator;
use URL;
use Modules\Franchise\Http\Requests\RegisterRequest;
use Modules\Franchise\Http\Requests\PaymentRequest;
use PDF;
/* * ************Models************* */
use App\Model\UserMaster;
use App\Model\Course;
use App\Model\AssignCourse;
use App\Model\Exam;
use App\Model\Settings;
use App\Model\Franchise;

class FranchiseStudentController extends AdminController {

    protected $appid, $secret;

    public function get_user_list() {


        return view('admin::franchisestudent.list');
    }

    public function get_user_list_datatable() {
        $user_list = UserMaster::orderBy('id', 'desc')->where('type_id', '2')->where('franchise_id','<>','0')->where('status', '<>', '3')->get();
        return Datatables::of($user_list)
                        ->addIndexColumn()
                        ->editColumn('image', function ($model) {
                            if (isset($model->image)) {
                                $path = URL::asset('public/uploads/user/' . $model->image);
                            } else {
                                $path = URL::asset('public/backend/no-image.png');
                            }
                            return '<img height="50" width="50" src="' . $path . '"/>';
                        })
                        ->editColumn('full_name', function ($model) {
                            return $model->full_name;
                        })
                        
                        ->editColumn('email', function ($model) {
                            return $model->email;
                        })
                        ->editColumn('franchise_name', function ($model) {
                            $fran_id = $model->franchise_id;
                            $data = Franchise::where('id',$fran_id)->first();
                            return $data->owner_name;
                        })
                        /*->editColumn('course_name', function ($model) {
                            $course_id = $model->running_course;
                            if(!empty($course_id)){
                                $data = Course::where('id',$course_id)->first();
                                $course_name = $data->name;
                            }else{
                                $course_name = 'NA';
                            }
                            
                            return $course_name;
                        })*/
                        ->editColumn('created_at', function ($model) {
                            return !empty($model->created_at) ? date('jS M Y, g:i A', strtotime($model->created_at)) : '';
                        })
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Active</span>';
                            }
                            return $status;
                        })
                        ->editColumn('payment_status', function ($model) {
                            if ($model->payment_status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Not Paid</span>';
                            } else if ($model->payment_status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Paid</span>';
                            }
                            return $status;
                        })
                        ->addColumn('action', function ($model) {
                            return
                            '<a href="' . Route("franchise_student-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                            '<a href="' . Route("franchise-student-assign_course-list", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Assigned Course List</a>' .
                            '<a href="' . Route("franchise-student_exam-list", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-book"></i> Exam Data</a>' .
                            '<a href="javascript:;" onclick="deleteFranchiseStudent(this);" data-href="' . Route("franchise_student-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['image','franchise_name','payment_status','status', 'action'])
                        ->make(true);
    }

    

    public function get_edit_user($id) {
        $data['user'] = $user = UserMaster::where('id', '=', $id)->first();
        if (!$user) {
            return redirect()->route('franchise-student-list')->with('error_msg', 'Invalid Link!');
        }
        $data['id'] = $id;
        return view('admin::franchisestudent.edit', $data);
    }

    public function post_edit_user(Request $request, $id) {
        $validator = Validator::make($request->all(), [
                    'full_name' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'gurdian_name' => 'required',
                    'father_name' => 'required',
                    'mother_name' => 'nullable',
                    'dob' => 'required',
                    'gender' => 'required',
                    'category' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'address' => 'required',
                    'state' => 'required',
                    'district' => 'required',
                    'last_qualification' => 'required',
                    'specialization' => 'required',
                    'year_of_passing' => 'required',
                    'school_college_name' => 'required',
                    'marks' => 'required',
                    'image' => 'nullable|mimes:png,jpeg,jpg,JPEG,gif',
                    'id_proof' => 'nullable|mimes:jpeg,jpg,png|max:10000',
        ]);
        $validator->after(function ($validator) use ($request) {
            $checkUser = UserMaster::where('id', '<>', $request->input('id'))->where('email', $request->input('email'))->first();

            if (!empty($checkUser))
                $validator->errors()->add('email', 'Email already in use.');
            $checkUserPhone = UserMaster::where('id', '<>', $request->input('id'))->where('phone', $request->input('phone'))->count();
            if ($checkUserPhone > 0) {
                $validator->errors()->add('phone', 'Phone number already in use.');
            }
        });
        if ($validator->passes()) {
            $model = UserMaster::where('id', '=', $id)->first();
            $model->full_name = strtoupper($request->input('full_name'));
            $model->gurdian_name = strtoupper($request->input('gurdian_name'));
            $model->father_name = strtoupper($request->input('father_name'));
            $model->mother_name = strtoupper($request->input('mother_name'));
            $model->dob = $request->input('dob');
            $model->category = strtoupper($request->input('category'));
            $model->gender = strtoupper($request->input('gender'));
            $model->email = $request->input('email');
            $model->phone = $request->input('phone');
            $model->address = strtoupper($request->input('address'));
            $model->state = strtoupper($request->input('state'));
            $model->district = strtoupper($request->input('district'));
            $model->last_qualification = strtoupper($request->input('last_qualification'));
            $model->year_of_passing = $request->input('year_of_passing');
            $model->specialization = strtoupper($request->input('specialization'));
            $model->school_college_name = strtoupper($request->input('school_college_name'));
            $model->marks = $request->input('marks');
            $model->type_id = 2;
            $model->status = $request->input('status');
            $model->payment_status = $request->input('payment_status');
            
            if ($request->hasFile('image')) {
                $sample_image = $request->file('image');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $model->image = $imagename;
            }
            if ($request->hasFile('id_proof')) {
                $sample_image = $request->file('id_proof');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $model->id_proof = $imagename;
            }
            $model->save();
            return redirect()->route('franchise-student-list')->with('success_msg', 'Student updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function delete(Request $request, $id) {
        if ($request->ajax()) {
            $data = [];
            $model = UserMaster::findorFail($id);
            if (!empty($model)) {
                $model->status = '3';
                $model->updated_at = date('Y-m-d H:i:s');
                $model->save();
                $data['status'] = 200;
                $data['msg'] = 'Franchise Student deleted successfully.';
            } else {
                $data['msg'] = 'Sorry ! No student details found.';
            }
            return response()->json($data);
        }
    }

    public function uploadimage($request) {
        $sample_image = $request->file('image');
        $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
        $destinationPath = public_path('uploads/user');
        $sample_image->move($destinationPath, $imagename);
        return $imagename;
    }
  

    public function assign_course_list_datatables($id) {
        $datas = AssignCourse::where('user_id', $id)->orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Persuing</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Pass</span>';
                            }
                            return $status;
                        })
                        ->editColumn('course_id', function ($model) {
                            return $model->course->name;
                        })
                        ->editColumn('franchise_name', function ($model) {
                            $datas = UserMaster::where('id',$model->user_id)->first();
                            $data = Franchise::where('id',$datas->franchise_id)->first();
                            return $data->name;
                        })
                        ->editColumn('created_at', function ($model) {
                            return (!empty($model->created_at)) ? \Carbon\Carbon::parse($model->created_at)->format('d-m-Y H:i A') : 'Not Found';
                        })
                        ->addColumn('action', function ($model) {
                             
                                return
                                        '<a href="' . Route("franchise-student-i-card", ['id' => base64_encode($model->id)])  . '" target="_blank"><button type="button" class="btn btn-success">Download I-Card</button></a>';
                             
                        })
                        ->rawColumns(['franchise_name', 'status','action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function assign_course_list($id) {
        $user = UserMaster::where('id', '=', $id)->first();
        return view('admin::franchisestudent.assign_course_list', compact('id', 'user'));
    }
    
    public function download_i_card($id) {
        $data = [];
        $data['assigncourse']= $assigncourse = AssignCourse::where('id', base64_decode($id))->first();
        
        $pdf = PDF::loadView('mail.i_card', $data);
        return $pdf->download($assigncourse->enrollment_id.'i-card.pdf');
        // return $pdf->stream($assigncourse->enrollment_id.'i-card.pdf');
        exit;
        // return redirect()->back();
    }
    
    
     public function get_student_exam_list_datatable($id) {
        $datas = Exam::where('user_id', $id)->orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('user_id', function ($model) {
                            return $model->user->full_name;
                        })
                        ->editColumn('course_id', function ($model) {
                            return $model->course->name;
                        })
                        
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Persuing</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Pass</span>';
                            }
                            return $status;
                        })
                        
                        ->addColumn('action', function ($model) {
                            if($model->status == '1'){
                                
                                if($model->admin_marks_submit == '1'){
                                    
                                    if($model->course->exam_status == '0'){
                                        return
                                        '<a href="' . Route("franchise-student_exam-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                        '<a href="' . Route("franchise-student_exam-certificate-download", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-file"></i> Certificate</a>'.
                                        '<a href="' . Route("franchise-student_exam-result-download", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-download"></i> Result</a>';
                                    }else{
                                        return
                                        '<a href="' . Route("franchise-student_exam-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                        '<a href="' . Route("franchise-student_exam-view", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Question & Answer</a>'.
                                        '<a href="' . Route("franchise-student_exam-certificate-download", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-file"></i> Certificate</a>'.
                                        '<a href="' . Route("franchise-student_exam-result-download", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-download"></i> Result</a>';
                                    }
                                    
                                }else{
                                    
                                    if($model->course->exam_status == '0'){
                                        return
                                        '<a href="' . Route("franchise-student_exam-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>';
                                    }else{
                                        return
                                        '<a href="' . Route("franchise-student_exam-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                        '<a href="' . Route("franchise-student_exam-view", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Question & Answer</a>';
                                    }
                                    
                                }
                                
                            }else{
                                    return
                                    '<a href="' . Route("franchise-student_exam-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="' . Route("franchise-student_exam-view", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Question & Answer</a>' ;    
                            }
                        })
                        ->rawColumns(['user_id','course_id', 'status','action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function get_student_exam_list($id) {
        $user = UserMaster::where('id', '=', $id)->first();
        return view('admin::franchisestudent.exam_list', compact('id', 'user'));
    }
    
    
    public function get_student_exam_edit($id) {
        $data = [];
        
        $data['model'] = $model = Exam::where('id', '=', $id)->first();
        if (!$model) {
            return redirect()->back()->with('error_msg', 'Invalid Link!');
        }
        $data['id'] = $id;
        return view('admin::franchisestudent.exam_edit', $data);
    }
    
    // public function post_student_exam_edit(Request $request,$id) {
    //     $validator = Validator::make($request->all(), [
    //                 'theory' => 'nullable|numeric',
    //                 'practical' => 'nullable|numeric',
    //                 'viva' => 'nullable|numeric',
                    
    //     ]);
        
    //     if ($validator->passes()) {
    //         $model = Exam::where('id', '=', $id)->first();
    //         $model->theory = $request->input('theory');
    //         $model->practical = $request->input('practical');
    //         $model->viva = $request->input('viva');
           
    //         $model->save();
    //         return redirect()->route('franchise-student_exam-list',['id'=>$model->user_id])->with('success_msg', 'Exam Data Updated Successfully.');
    //     } else {
    //         return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
    //     }
    // }
    
    public function post_student_exam_edit(Request $request,$id){
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
          	if($model->status=='1'){
          	    $input['admin_marks_submit']='1';
          	}
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
            return redirect()->route('franchise-student_exam-list',['id'=>$model->user_id])->with('success_msg', 'Updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }
    
    
    public function get_student_exam_view($id) {
        $model=Exam::where('id',$id)->first();
        return view('admin::franchisestudent.exam_view', compact('id','model'));
    }
    
    public function get_student_exam_certificate_download(Request $request,$id) {
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
    public function get_student_exam_result_download(Request $request,$id) {
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

}

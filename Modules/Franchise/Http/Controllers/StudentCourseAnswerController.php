<?php

namespace Modules\Franchise\Http\Controllers;

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
use App\Model\WalletHistory;
use App\Model\UserMaster;
use App\Model\AssignCourse;
use App\Model\Plan;
use Modules\Franchise\Http\Requests\ExamFeeRequest;

class StudentCourseAnswerController extends FranchiseController {
    
    public function CertificateCommission($id,$amount){
        $hist = [];
        $sub_hist = [];
        $parent_hist = [];
        $franchise = Franchise::where('id',$id)->first();
        
        if($franchise->joining_by_alc != ''){
            
            // Child
            $plan = Plan::where('id', $franchise->plan_id)->first();
            $com = ($amount * $plan->commission / 100);
            
            $franchise->wallet_amount = $franchise->wallet_amount + $com;
            $franchise->save();
            
            $hist['franchise_id'] = $id;
            $hist['wallet_in'] = $com;
            $hist['description'] = "Added Commission to Wallet for Student Certification.";
            $hist['balance'] = $franchise->wallet_amount;
            
            $wallet_hist = WalletHistory::create($hist);
            
            // Sub Parent
            $sub_parent_id = $franchise->joining_by_alc;
            $sub_parent = Franchise::where('id',$sub_parent_id)->first();
            $sub_parent_plan = Plan::where('id', $sub_parent->plan_id)->first();
            $sub_parent_com = ($com * $sub_parent_plan->commission / 100);
            
            $sub_parent->wallet_amount = $sub_parent->wallet_amount + $sub_parent_com;
            $sub_parent->save();
            
            
            $sub_hist['franchise_id'] = $sub_parent_id;
            $sub_hist['wallet_in'] = $sub_parent_com;
            $sub_hist['description'] = "Added Commission to Wallet for Student Certification by ".$franchise->owner_name;
            $sub_hist['balance'] = $sub_parent->wallet_amount;
            
            $sub_wallet_hist = WalletHistory::create($sub_hist);
            
            // Parent
            
            if($sub_parent->joining_by_alc != ''){
                $parent_id = $sub_parent->joining_by_alc;
                $parent = Franchise::where('id',$parent_id)->first();
                $parent_plan = Plan::where('id', $parent->plan_id)->first();
                $parent_com = ($sub_parent_com * $parent_plan->commission / 100);
                
                $parent->wallet_amount = $parent->wallet_amount + $parent_com;
                $parent->save();
                
                $parent_hist['franchise_id'] = $parent_id;
                $parent_hist['wallet_in'] = $parent_com;
                $parent_hist['description'] = "Added Commission to Wallet for Student Certification by ".$franchise->owner_name;
                $parent_hist['balance'] = $parent->wallet_amount;
                
                $parent_wallet_hist = WalletHistory::create($parent_hist);
                
                return 1;
            }else{
                return 1;
            }
            
            
        }else{
            
            $plan = Plan::where('id', $franchise->plan_id)->first();
            $com = ($amount * $plan->commission / 100);
            
            $franchise->wallet_amount = $franchise->wallet_amount + $com;
            $franchise->save();
            
            $hist['franchise_id'] = $id;
            $hist['wallet_in'] = $com;
            $hist['description'] = "Added Commission to Wallet for Student Certification.";
            $hist['balance'] = $franchise->wallet_amount;
            
            $wallet_hist = WalletHistory::create($hist);
            
            return 1;
            
        }
    }
    
    public function SupplyCommission($id,$amount){
        $hist = [];
        $sub_hist = [];
        $parent_hist = [];
        $franchise = Franchise::where('id',$id)->first();
        
        if($franchise->joining_by_alc != ''){
            
            // Child
            $plan = Plan::where('id', $franchise->plan_id)->first();
            $com = ($amount * $plan->commission / 100);
            
            $franchise->wallet_amount = $franchise->wallet_amount + $com;
            $franchise->save();
            
            $hist['franchise_id'] = $id;
            $hist['wallet_in'] = $com;
            $hist['description'] = "Added Commission to Wallet for Exam Supply Fee.";
            $hist['balance'] = $franchise->wallet_amount;
            
            $wallet_hist = WalletHistory::create($hist);
            
            // Sub Parent
            $sub_parent_id = $franchise->joining_by_alc;
            $sub_parent = Franchise::where('id',$sub_parent_id)->first();
            $sub_parent_plan = Plan::where('id', $sub_parent->plan_id)->first();
            $sub_parent_com = ($com * $sub_parent_plan->commission / 100);
            
            $sub_parent->wallet_amount = $sub_parent->wallet_amount + $sub_parent_com;
            $sub_parent->save();
            
            
            $sub_hist['franchise_id'] = $sub_parent_id;
            $sub_hist['wallet_in'] = $sub_parent_com;
            $sub_hist['description'] = "Added Commission to Wallet for Exam Supply Fee by ".$franchise->owner_name;
            $sub_hist['balance'] = $sub_parent->wallet_amount;
            
            $sub_wallet_hist = WalletHistory::create($sub_hist);
            
            // Parent
            
            if($sub_parent->joining_by_alc != ''){
                $parent_id = $sub_parent->joining_by_alc;
                $parent = Franchise::where('id',$parent_id)->first();
                $parent_plan = Plan::where('id', $parent->plan_id)->first();
                $parent_com = ($sub_parent_com * $parent_plan->commission / 100);
                
                $parent->wallet_amount = $parent->wallet_amount + $parent_com;
                $parent->save();
                
                $parent_hist['franchise_id'] = $parent_id;
                $parent_hist['wallet_in'] = $parent_com;
                $parent_hist['description'] = "Added Commission to Wallet for Exam Supply Fee by ".$franchise->owner_name;
                $parent_hist['balance'] = $parent->wallet_amount;
                
                $parent_wallet_hist = WalletHistory::create($parent_hist);
                
                return 1;
            }else{
                return 1;
            }
            
            
        }else{
            
            $plan = Plan::where('id', $franchise->plan_id)->first();
            $com = ($amount * $plan->commission / 100);
            
            $franchise->wallet_amount = $franchise->wallet_amount + $com;
            $franchise->save();
            
            $hist['franchise_id'] = $id;
            $hist['wallet_in'] = $com;
            $hist['description'] = "Added Commission to Wallet for Exam Supply Fee.";
            $hist['balance'] = $franchise->wallet_amount;
            
            $wallet_hist = WalletHistory::create($hist);
            
            return 1;
            
        }
    }

    //*** JSON Request
    public function datatables() {
        $id=Auth()->guard('franchise')->user()->id;
        $datas = Exam::select('exams.*')->join('user_master','user_master.id','=','exams.user_id')->where('user_master.franchise_id', '=', $id)->where('exams.course_id','<>','0')->orderBy('id', 'desc')->get();
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
                                            '<a href="' . Route("franchise-student-exam-answer-getedit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                            '<a href="' . Route("franchise-exam-certificate-download", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-file"></i> Certificate</a>'.
                                            '<a href="' . Route("franchise-exam-result-download", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-download"></i> Result</a>'.
                                            '<a href="' . Route("franch-student-exam-certificate-delivered", [$model->id]) . '" class="btn btn-xs btn-primary pull-left" style="background-color:red;"><i class="fa fa-close"></i> Pending</a>';
                                        }else{
                                            return
                                            '<a href="' . Route("franchise-student-exam-answer-getedit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                            '<a href="' . Route("franchise-exam-certificate-download", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-file"></i> Certificate</a>'.
                                            '<a href="' . Route("franchise-exam-result-download", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-download"></i> Result</a>'.
                                            '<a href="' . Route("franch-student-exam-certificate-delivered", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-check"></i> Delivered</a>';
                                        }
                                        
                                    }else{
                                        
                                        if($model->certificate_delivered == '0'){
                                            return
                                            '<a href="' . Route("franchise-student-exam-answer-getedit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                            '<a href="' . Route("franchise-student-exam-answer-view", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Question & Answer</a>'.
                                            '<a href="' . Route("franchise-exam-certificate-download", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-file"></i> Certificate</a>'.
                                            '<a href="' . Route("franchise-exam-result-download", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-download"></i> Result</a>'.
                                            '<a href="' . Route("franch-student-exam-certificate-delivered", [$model->id]) . '" class="btn btn-xs btn-primary pull-left" style="background-color:red;"><i class="fa fa-close"></i> Pending</a>';
                                        }else{
                                            return
                                            '<a href="' . Route("franchise-student-exam-answer-getedit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                            '<a href="' . Route("franchise-student-exam-answer-view", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Question & Answer</a>'.
                                            '<a href="' . Route("franchise-exam-certificate-download", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-file"></i> Certificate</a>'.
                                            '<a href="' . Route("franchise-exam-result-download", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-download"></i> Result</a>'.
                                            '<a href="' . Route("franch-student-exam-certificate-delivered", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-check"></i> Delivered</a>';
                                        }
                                        
                                    }
                                    
                                }else{
                                    
                                    if($model->course->exam_status == '0'){
                                        return
                                        '<a href="' . Route("franchise-student-exam-answer-getedit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>';
                                    }else{
                                        return
                                        '<a href="' . Route("franchise-student-exam-answer-getedit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                        '<a href="' . Route("franchise-student-exam-answer-view", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Question & Answer</a>';
                                    } 
                                    
                                }
                                
                            }else{
                            return
                                    '<a href="' . Route("franchise-student-exam-answer-getedit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="' . Route("franchise-student-exam-answer-view", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Question & Answer</a>' ;    
                            }
                        })
                        ->rawColumns(['status', 'action'])
                        ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index() {
        return view('franchise::exam.list');
    }

    

    //*** GET Request
    public function view($id) {
        $model=Exam::where('id',$id)->first();
        return view('franchise::exam.view', compact('id','model'));
    }
    public function get_edit($id) {
        $data = [];
        
        $MERCHANT_KEY = Settings::where('slug', 'merchant_key')->first();
        $data['MERCHANT_KEY'] = $MERCHANT_KEY->value;
        $SALT = Settings::where('slug', 'salt')->first();
        $data['SALT'] = $SALT->value;
        // echo "<pre>";print_r($data);exit;
        
        $supply_fees = Settings::where('slug', 'supply_exam_fees')->first();
        $data['supply_fees'] = $supply_fees->value;
        
        $check_test_mode = Settings::where('slug', 'test_mode')->first();
        if ($check_test_mode->value == 1) {
            $data['BASE_URL'] = 'https://sandboxsecure.payu.in'; //sandbox
        } else {
            $data['BASE_URL'] = 'https://secure.payu.in'; //production
        }
        
        $data['model'] = $model = Exam::where('id', '=', $id)->first();
        $data['course'] = $course = Course::where('id', '=', $model['course_id'])->first();
        
        $plan_id=Auth()->guard('franchise')->user()->plan_id;
        $amt = Plan::where('id', $plan_id)->first();
        $data['certificate_fees'] =  $amt->certificate_fee;
        
        // echo "<pre>";print_r($data['course']);exit;
        if (!$model) {
            return redirect()->back()->with('error_msg', 'Invalid Link!');
        }
        $data['id'] = $id;
        return view('franchise::exam.edit', $data);
    }

//     public function post_edit(Request $request, $id) {
//         $validator = Validator::make($request->all(), [
                    
//         ]);
//         $validator->after(function ($validator) use ($request) {
//             $checkExam = Exam::where('id', $request->input('id'))->first();
//             if($checkExam->status=='0'){
//                 if($request->input('supply_exam_fees')==''){
//                     $validator->errors()->add('supply_exam_fees', 'This feild is required!');
//                 }
//             }else{
//                 if($request->input('theory')==''){
//                     $validator->errors()->add('theory', 'This field is required!');
//                 }
//                 if($request->input('practical')==''){
//                     $validator->errors()->add('practical', 'This field is required!');
//                 }
//                 if($request->input('viva')==''){
//                     $validator->errors()->add('viva', 'This field is required!');
//                 }
//             }
            
            
//         });
//         if ($validator->passes()) {
//             $model = Exam::where('id', '=', $id)->first();
//             $input = $request->all();
//           	if($model->status=='1'){
//           	    $input['admin_marks_submit']='1';
//           	}
//             $model->update($input);
//           	if($model->status=='1'){
//             //Send Mail
//                 $email_setting = $this->get_email_data('pass_exam', array('NAME' => $model->user->full_name, 'EMAIL' => $model->user->email, 'COURSENAME' => $model->course->name, 'THEORY' => $model->theory, 'PRACTICAL' => $model->practical, 'VIVA' => $model->viva));
//                 $email_data = [
//                     'to' => $model->user->email,
//                     'subject' => 'DI Technical '.$model->course->name.' Course Cleared',
//                     'template' => 'signup',
//                     'data' => ['message' => $email_setting['body']]
//                 ];
//               $this->SendMail($email_data);  
// 			//Admin send mail
//               $admin_model = UserMaster::where('type_id', '1')->first();
//               $email_setting = $this->get_email_data('admin_pass_exam', array('STUDENT_NAME' => $model->user->full_name, 'COURSENAME' => $model->course->name, 'THEORY' => $model->theory, 'PRACTICAL' => $model->practical, 'VIVA' => $model->viva));
//                 $email_data = [
//                     'to' => $admin_model->email,
//                     'subject' => 'DI Technical '.$model->course->name.' Course Cleared',
//                     'template' => 'signup',
//                     'data' => ['message' => $email_setting['body']]
//                 ];
//               $this->SendMail($email_data);
//             }
//             return redirect()->route('franchise-student-exam-answer-index')->with('success_msg', 'Updated successfully.');
//         } else {
//             return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
//         }
//     }
    
    public function post_edit(ExamFeeRequest $request, $id){
        
        if ($request->ajax()) {
            
            $data_msg = [];
            $data = [];
            $model = Exam::where('id', '=', $id)->first();
            $fid=Auth()->guard('franchise')->user()->id;
            $franchise = Franchise::where('id', '=', $fid)->first();
            $user = UserMaster::where('id', '=', $model->user_id)->first();
            $course = Course::where('id', '=', $model->course_id)->first();
            
            $input = $request->all();
            $amnt = 0;
            
            if($model->status=='1'){
                
                if($model->admin_marks_submit == '0'){
                    
                    if($model->course->exam_status == '0'){
                        if($input['lang'] == '1'){
                            $data['lang'] = $input['lang'];
                            $data['language'] = $input['language'];
                            $data['speed'] = $input['speed'];
                            $data['accuracy'] = $input['accuracy'];
                            $data['time_taken'] = $input['time_taken'];
                        }
                        if($input['lang'] == '2'){
                            $data['lang'] = $input['lang'];
                            $data['language'] = $input['language'];
                            $data['speed'] = $input['speed'];
                            $data['accuracy'] = $input['accuracy'];
                            $data['time_taken'] = $input['time_taken'];
                            $data['language2'] = $input['language2'];
                            $data['speed2'] = $input['speed2'];
                            $data['accuracy2'] = $input['accuracy2'];
                            $data['time_taken2'] = $input['time_taken2'];
                        }
                    }else{
                        $data['theory'] = $input['theory'];
                        $data['practical'] = $input['practical'];
                        $data['viva'] = $input['viva'];
                    }
                    
                    $data['id'] = $input['id'];
                    $data['admin_marks_submit']='0';
                    $amnt = $input['certificate_fees'];
                    
                        if($input['wallet'] == '1'){
                            
                            $hist = [];
                            
                            if($model->course->exam_status == '0'){
                                if($input['lang'] == '1'){
                                    $model->lang = $input['lang'];
                                    $model->language = $input['language'];
                                    $model->speed = $input['speed'];
                                    $model->accuracy = $input['accuracy'];
                                    $model->time_taken = $input['time_taken'];
                                }
                                if($input['lang'] == '2'){
                                    $model->lang = $input['lang'];
                                    $model->language = $input['language'];
                                    $model->speed = $input['speed'];
                                    $model->accuracy = $input['accuracy'];
                                    $model->time_taken = $input['time_taken'];
                                    $model->language2 = $input['language2'];
                                    $model->speed2 = $input['speed2'];
                                    $model->accuracy2 = $input['accuracy2'];
                                    $model->time_taken2 = $input['time_taken2'];
                                }
                            }else{
                                $model->theory = $input['theory'];
                                $model->practical = $input['practical'];
                                $model->viva = $input['viva'];
                            }
                            
                            $model->admin_marks_submit = '0';
                            // save updated data
                            $model->save();
                            
                            $franchise->wallet_amount = $franchise->wallet_amount - $amnt;
                            $franchise->save();
                            
                            $hist['franchise_id'] = $franchise->id;
                            $hist['wallet_out'] = $amnt;
                            $hist['description'] = "Deducted Amount from Wallet for Submit the Exam Data.";
                            $hist['balance'] = $franchise->wallet_amount;
                            
                            $wallet_hist = WalletHistory::create($hist);
                            
                            $res = $this->CertificateCommission($fid,$amnt);
                            
                            if($model->course->exam_status == '0'){
                                
                                if($input['lang'] == '1'){
                                    
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
                                if($input['lang'] == '2'){
                                    
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
                                    $email_setting = $this->get_email_data('pass_exam', array('NAME' => $user->full_name, 'EMAIL' => $user->email, 'COURSENAME' => $course->name, 'THEORY' => $model->theory, 'PRACTICAL' => $model->practical, 'VIVA' => $model->viva));
                                    $email_data = [
                                        'to' => $user->email,
                                        'subject' => 'DI Technical '.$course->name.' Course Cleared',
                                        'template' => 'signup',
                                        'data' => ['message' => $email_setting['body']]
                                    ];
                                    $this->SendMail($email_data);  
                		        //Admin send mail
                                  $admin_model = UserMaster::where('type_id', '1')->first();
                                  $email_setting = $this->get_email_data('admin_pass_exam', array('STUDENT_NAME' => $user->full_name, 'COURSENAME' => $course->name, 'THEORY' => $model->theory, 'PRACTICAL' => $model->practical, 'VIVA' => $model->viva));
                                    $email_data = [
                                        'to' => $admin_model->email,
                                        'subject' => 'DI Technical '.$course->name.' Course Cleared',
                                        'template' => 'signup',
                                        'data' => ['message' => $email_setting['body']]
                                    ];
                                  $this->SendMail($email_data);
                            }
                            
                              $data_msg['submit'] = '0';
                              $data_msg['url'] = route('franchise-student-exam-answer-index');
                              $data_msg['msg'] = "Student exam data submitted successfully.";
                              return response()->json($data_msg);
                            
                        }else{
                            Session::push('data', $data);
                            Session::push('amount', $amnt);
                        }
                    
                }else{
                    
                    // **** update section ***//
                    
                    if($model->course->exam_status == '0'){
                        if($input['lang'] == '1'){
                            $model->lang = $input['lang'];
                            $model->language = $input['language'];
                            $model->speed = $input['speed'];
                            $model->accuracy = $input['accuracy'];
                            $model->time_taken = $input['time_taken'];
                        }
                        if($input['lang'] == '2'){
                            $model->lang = $input['lang'];
                            $model->language = $input['language'];
                            $model->speed = $input['speed'];
                            $model->accuracy = $input['accuracy'];
                            $model->time_taken = $input['time_taken'];
                            $model->language2 = $input['language2'];
                            $model->speed2 = $input['speed2'];
                            $model->accuracy2 = $input['accuracy2'];
                            $model->time_taken2 = $input['time_taken2'];
                        }
                    }else{
                        $model->theory = $input['theory'];
                        $model->practical = $input['practical'];
                        $model->viva = $input['viva'];
                    }
                    
                    // save updated data
                    $model->save();
                    
                    if($model->course->exam_status == '0'){
                        
                                if($input['lang'] == '1'){
                                    
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
                                if($input['lang'] == '2'){
                                    
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
                            $email_setting = $this->get_email_data('pass_exam', array('NAME' => $user->full_name, 'EMAIL' => $user->email, 'COURSENAME' => $course->name, 'THEORY' => $model->theory, 'PRACTICAL' => $model->practical, 'VIVA' => $model->viva));
                            $email_data = [
                                'to' => $user->email,
                                'subject' => 'DI Technical '.$course->name.' Course Cleared',
                                'template' => 'signup',
                                'data' => ['message' => $email_setting['body']]
                            ];
                            $this->SendMail($email_data);  
        		        //Admin send mail
                          $admin_model = UserMaster::where('type_id', '1')->first();
                          $email_setting = $this->get_email_data('admin_pass_exam', array('STUDENT_NAME' => $user->full_name, 'COURSENAME' => $course->name, 'THEORY' => $model->theory, 'PRACTICAL' => $model->practical, 'VIVA' => $model->viva));
                            $email_data = [
                                'to' => $admin_model->email,
                                'subject' => 'DI Technical '.$course->name.' Course Cleared',
                                'template' => 'signup',
                                'data' => ['message' => $email_setting['body']]
                            ];
                          $this->SendMail($email_data);
                          
                    }
                    
                      $data_msg['submit'] = '1';
                      $data_msg['url'] = route('franchise-student-exam-answer-index');
                      $data_msg['msg'] = "Updated successfully.";
                      return response()->json($data_msg);
                }
          	    
          	}else{
          	    
          	    if($model->supply_exam_fees == '0'){
          	        
          	        $data['id'] = $input['id'];
          	        $data['supply_exam_fees'] = $input['supply_exam_fees'];
          	        // $data['status'] = '1';
          	        $amnt = $input['supply_fees'];
          	        
          	        if($input['wallet'] == '1'){
          	            
          	            $hist = [];
          	            
          	            $model->supply_exam_fees = $input['supply_exam_fees'];
          	            $model->save();
                            
                        $franchise->wallet_amount = $franchise->wallet_amount - $amnt;
                        $franchise->save();
                        
                        $hist['franchise_id'] = $franchise->id;
                        $hist['wallet_out'] = $amnt;
                        $hist['description'] = "Deducted Amount from Wallet for Paying Exam Supply Fee.";
                        $hist['balance'] = $franchise->wallet_amount;
                        
                        $wallet_hist = WalletHistory::create($hist);
                        
                        $res = $this->SupplyCommission($fid,$amnt);
                        
                        //Send Mail
                                $email_setting = $this->get_email_data('supply_fees', array('NAME' => $user->full_name, 'EMAIL' => $user->email, 'COURSENAME' => $course->name));
                                $email_data = [
                                    'to' => $user->email,
                                    'subject' => 'DI Technical '.$course->name.' Supply Fees',
                                    'template' => 'signup',
                                    'data' => ['message' => $email_setting['body']]
                                ];
                              $this->SendMail($email_data);  
                		//Admin send mail
                              $admin_model = UserMaster::where('type_id', '1')->first();
                              $email_setting = $this->get_email_data('admin_supply_fees', array('STUDENT_NAME' => $user->full_name, 'COURSENAME' => $course->name));
                                $email_data = [
                                    'to' => $admin_model->email,
                                    'subject' => 'DI Technical '.$course->name.' Supply Fees',
                                    'template' => 'signup',
                                    'data' => ['message' => $email_setting['body']]
                                ];
                              $this->SendMail($email_data);
                              
                          $data_msg['submit'] = '0';
                          $data_msg['url'] = route('franchise-student-exam-answer-index');
                          $data_msg['msg'] = "Payment successfull.";
                          return response()->json($data_msg);
          	            
          	        }else{
          	            Session::push('data', $data);
          	            Session::push('amount', $amnt);
          	        }
          	        
          	    }
          	    
          	}
          	
          	
          	$slink = Route('success-exam-fees');
            $flink = Route('cancel-exam-fees');
            
            $key = Settings::where('slug', 'merchant_key')->first();
            $MERCHANT_KEY = $key->value;
            $salt = Settings::where('slug', 'salt')->first();
            $SALT = $salt->value;
            $amount = $amnt;
            $txnid = 'ditechnical_' . substr(hash('sha256', mt_rand() . microtime()), 0, 10);
            $posted = array();
            $posted = array(
                'key' => $MERCHANT_KEY,
                'txnid' => $txnid,
                'amount' => $amount,
                'firstname' => $user->full_name,
                'email' => $user->email,
                'productinfo' => 'Exam fee',
                'surl' => $slink,
                'furl' => $flink,
                'service_provider' => 'payu_paisa',
            );

            if (empty($posted['txnid'])) {
                $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
            } else {
                $txnid = $posted['txnid'];
            }
            $hash = '';
            $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
            if (empty($posted['hash']) && sizeof($posted) > 0) {
                $hashVarsSeq = explode('|', $hashSequence);
                $hash_string = '';
                foreach ($hashVarsSeq as $hash_var) {
                    $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                    $hash_string .= '|';
                }
                $hash_string .= $SALT;
                $hash = strtolower(hash('sha512', $hash_string));
            } elseif (!empty($posted['hash'])) {
                $hash = $posted['hash'];
            }

            $data_msg['submit'] = '2';
            $data_msg['msg'] = "Go for payment.";
            $data_msg['surl'] = $slink;
            $data_msg['furl'] = $flink;
            $data_msg['txnid'] = $txnid;
            $data_msg['amount'] = $amount;
            $data_msg['hash'] = $hash;
            $data_msg['firstname'] = $user->full_name;
            $data_msg['email'] = $user->email;
            $data_msg['phone'] = $user->phone;
          	
            return response()->json($data_msg);
        }
        
    }
    
    public function post_success_exam_fees(Request $request){
        $fid = Auth()->guard('franchise')->user()->id;
        $data = Session::get('data');
        $data = $data[0];
        $amt = Session::get('amount');
        $amount = $amt[0];
        
        $model = Exam::where('id', '=', $data['id'])->first();
        $user = UserMaster::where('id', '=', $model->user_id)->first();
        $course = Course::where('id', '=', $model->course_id)->first();
        
        unset($data['id']);
        
        // print_r($data);
        // print_r($model);
        
        if($model->status == '1'){
            
                if($model->course->exam_status == '0'){
                    if($data['lang'] == '1'){
                        $model->lang = $data['lang'];
                        $model->language = $data['language'];
                        $model->speed = $data['speed'];
                        $model->accuracy = $data['accuracy'];
                        $model->time_taken = $data['time_taken'];
                    }
                    if($data['lang'] == '2'){
                        $model->lang = $data['lang'];
                        $model->language = $data['language'];
                        $model->speed = $data['speed'];
                        $model->accuracy = $data['accuracy'];
                        $model->time_taken = $data['time_taken'];
                        $model->language2 = $data['language2'];
                        $model->speed2 = $data['speed2'];
                        $model->accuracy2 = $data['accuracy2'];
                        $model->time_taken2 = $data['time_taken2'];
                    }
                }else{
                    $model->theory = $data['theory'];
                    $model->practical = $data['practical'];
                    $model->viva = $data['viva'];
                }
            
            $model->admin_marks_submit ='0';
            
            $res = $this->CertificateCommission($fid,$amount);
            
        }else{
            $model->supply_exam_fees = $data['supply_exam_fees'];
            
            $res = $this->SupplyCommission($fid,$amount);
        }
        
        $model->save();
        
        if($model->status == '1'){
            
            if($model->course->exam_status == '0'){
                
                 if($data['lang'] == '1'){
                                    
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
                if($data['lang'] == '2'){
                    
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
                        $email_setting = $this->get_email_data('pass_exam', array('NAME' => $user->full_name, 'EMAIL' => $user->email, 'COURSENAME' => $course->name, 'THEORY' => $model->theory, 'PRACTICAL' => $model->practical, 'VIVA' => $model->viva));
                        $email_data = [
                            'to' => $user->email,
                            'subject' => 'DI Technical '.$course->name.' Course Cleared',
                            'template' => 'signup',
                            'data' => ['message' => $email_setting['body']]
                        ];
                      $this->SendMail($email_data);  
        		//Admin send mail
                      $admin_model = UserMaster::where('type_id', '1')->first();
                      $email_setting = $this->get_email_data('admin_pass_exam', array('STUDENT_NAME' => $user->full_name, 'COURSENAME' => $course->name, 'THEORY' => $model->theory, 'PRACTICAL' => $model->practical, 'VIVA' => $model->viva));
                        $email_data = [
                            'to' => $admin_model->email,
                            'subject' => 'DI Technical '.$course->name.' Course Cleared',
                            'template' => 'signup',
                            'data' => ['message' => $email_setting['body']]
                        ];
                      $this->SendMail($email_data);
                      
            }     
                  
        }else{
            //Send Mail
                    $email_setting = $this->get_email_data('supply_fees', array('NAME' => $user->full_name, 'EMAIL' => $user->email, 'COURSENAME' => $course->name));
                    $email_data = [
                        'to' => $user->email,
                        'subject' => 'DI Technical '.$course->name.' Supply Fees',
                        'template' => 'signup',
                        'data' => ['message' => $email_setting['body']]
                    ];
                  $this->SendMail($email_data);  
    		//Admin send mail
                  $admin_model = UserMaster::where('type_id', '1')->first();
                  $email_setting = $this->get_email_data('admin_supply_fees', array('STUDENT_NAME' => $user->full_name, 'COURSENAME' => $course->name));
                    $email_data = [
                        'to' => $admin_model->email,
                        'subject' => 'DI Technical '.$course->name.' Supply Fees',
                        'template' => 'signup',
                        'data' => ['message' => $email_setting['body']]
                    ];
                  $this->SendMail($email_data);
        }
        
        Session::forget('data');
        Session::forget('amount');
        return redirect()->route('franchise-student-exam-answer-index')->with('success_msg', 'Student exam data submitted successfully.');
    }
    
    public function post_cancel_exam_fees(Request $request){
        Session::forget('data');
        Session::forget('amount');
        return redirect()->route('franchise-student-exam-answer-index')->with('error_msg', 'Payment Failed.');
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
        return view('franchise::exam.certificate_delivered', compact('id','model'));
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
                 
            return redirect()->route('franchise-student-exam-answer-index')->with('success_msg', 'Exam Certificate Delivered.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

}

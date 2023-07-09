<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;
use Intervention\Image\ImageManagerStatic as Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use File;
use Validator;
use Carbon\Carbon;
use App\Helpers\CalenderApi;
use PDF;
/* * ************Request***************** */
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditprofileRequest;
/* * ****************Model*********************** */
use URL;
use DB;
use Artisan;
use App\Model\UserMaster;
use App\Model\QuestionAnswer;
use App\Model\Exam;
use App\Model\Settings;
use App\Model\AssignCourse;
use App\Model\Course;
use App\Model\LiveClass;
use App\Model\CourseModule;
use App\Model\ModuleViewVideo;

class UserController extends Controller {

    public function dashboard() {
        $id = Auth::guard('frontend')->user()->id;

        $data = [];

        $data['model'] = UserMaster::find(Auth()->guard('frontend')->user()->id);
        return view('user.dashboard', $data);
    }

    public function get_profile() {
        $model = UserMaster::find(Auth()->guard('frontend')->user()->id);
        return view('user.edit_profile', ['model' => $model]);
    }

    public function post_profile(EditprofileRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $model = UserMaster::find(Auth()->guard('frontend')->user()->id);
            $input = $request->all();
            if ($request->hasFile('image')) {
                $sample_image = $request->file('image');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $input['image'] = $imagename;
            }
            if ($request->hasFile('id_proof')) {
                $sample_image = $request->file('id_proof');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $input['id_proof'] = $imagename;
            }
            $model->update($input);
            $request->session()->flash('success_msg', 'Profile updated successfully.');
            $request->session()->flash('success', 'Profile updated successfully.');
            $data_msg['msg'] = 'Profile updated successfully.';
            $data_msg['link'] = Route('my-profile');

            return response()->json($data_msg);
        }
    }

    public function reset_password(ChangePasswordRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $model = UserMaster::findOrFail(Auth::guard('frontend')->user()->id);
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $model->update($input);
            $data_msg['msg'] = 'Your password changed successfully.';
            return response()->json($data_msg);
        }
    }

    public function course() {
        $model = AssignCourse::where('user_id', Auth()->guard('frontend')->user()->id)->get();
        return view('user.user_course', ['model' => $model]);
    }
    public function study_material($id) {
        $data = [];
        $data['course_detail'] = $details = Course::findOrFail(base64_decode($id));
        if (!$details) {
            return redirect()->route('user-course')->with('error_msg', 'Something went wrong please check your input!');
        }
        $data['course_modules'] = CourseModule::where('course_id', base64_decode($id))->where('status', '1')->get();
        return view('user.study_material', $data);
    }
    public function view_study_material(Request $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            $check=ModuleViewVideo::where('user_id',Auth()->guard('frontend')->user()->id)->where('video_id',$input['id'])->first();
            if(empty($check)){
            $data = new ModuleViewVideo();
            $study=[];
            $study['user_id']=Auth()->guard('frontend')->user()->id;
            $study['video_id']=$input['id'];
            $data->fill($study)->save();
            }
            return response()->json($data_msg);
        }
    }

    public function course_datatable() {
        $courses = AssignCourse::where('user_id', Auth()->guard('frontend')->user()->id)->orderBy('id', 'DESC')->get();
        return Datatables::of($courses)
                        ->addIndexColumn()
                        ->editColumn('course_id', function ($model) {
                            $course = Course::where('id', $model->course_id)->first();
                            return (!empty($course->name)) ? $course->name : 'Not available';
                        })
                        ->editColumn('amount_paid', function ($model) {
                            return '₹' . $model->amount_paid;
                        })
                        ->editColumn('created_at', function ($model) {
                            return (!empty($model->created_at)) ? \Carbon\Carbon::parse($model->created_at)->format('d-F-Y') : 'Not Found';
                        })
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Pursuing</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Completed</span>';
                            }
                            return $status;
                        })
                        ->addColumn('action', function ($model) {
                            if ($model->status == '0') {
                                if (Auth()->guard('frontend')->user()->student_type == 'offline') {
                                    return
                                            '<a href="' . Route("exam", ['id' => base64_encode($model->course_id)]) . '"><button type="button" class="btn btn-primary">Give Exam</button></a>'.
                                            '<a href="' . Route("exam-i-card", ['id' => base64_encode($model->course_id)])  . '" target="_blank"><button type="button" class="btn btn-success">Download I-Card</button></a>';
                                } else {
                                    $study_material = isset($model->course->study_material) ? URL::asset('public/uploads/course/' . $model->course->study_material) : 'javascript:void(0);';
                                    return
                                            '<a href="' . Route("exam", ['id' => base64_encode($model->course_id)]) . '"><button type="button" class="btn btn-primary">Give Exam</button></a>' .
                                            '<a href="' . Route("study-material", ['id' => base64_encode($model->course_id)]) . '"><button type="button" class="btn btn-success">Watch Videos</button></a>'.
                                            '<a href="' . Route("exam-i-card", ['id' => base64_encode($model->course_id)])  . '" target="_blank"><button type="button" class="btn btn-primary">Download I-Card</button></a>';
                                }
                            }else{
                                $user_id = Auth()->guard('frontend')->user()->id;
                                $exam=Exam::where('user_id', $user_id)->where('course_id', $model->course_id)->first();
                                if($exam['admin_marks_submit'] == '1'){
                                    if (Auth()->guard('frontend')->user()->student_type == 'offline') {
                                        return
                                        '<a href="' . Route("exam-certificate", ['id' => base64_encode($model->course_id)]) . '"><button type="button" class="btn btn-primary">Download Certificate</button></a>' .
                                        '<a href="' . Route("exam-result", ['id' => base64_encode($model->course_id)])  . '" target="_blank"><button type="button" class="btn btn-success">Download Marksheet</button></a>';
                                
                                    }else{
                                        return
                                        '<a href="' . Route("study-material", ['id' => base64_encode($model->course_id)]) . '"><button type="button" class="btn btn-success">Watch Videos</button></a>'.
                                        '<a href="' . Route("exam-certificate", ['id' => base64_encode($model->course_id)]) . '"><button type="button" class="btn btn-primary">Download Certificate</button></a>' .
                                        '<a href="' . Route("exam-result", ['id' => base64_encode($model->course_id)])  . '" target="_blank"><button type="button" class="btn btn-success">Download Marksheet</button></a>';
                                    }
                                }else{
                                return '<p>Wait For Final Result</p>';
                                }
                            }
                        })
                        ->rawColumns(['course_id', 'status', 'action'])
                        ->make(true);
    }
    public function exam_i_card($id) {
        $data = [];
        $user_id = Auth()->guard('frontend')->user()->id;
        $data['assigncourse']= $assigncourse = AssignCourse::where('user_id', $user_id)->where('course_id', base64_decode($id))->first();
        $pdf = PDF::loadView('mail.i_card', $data);
        return $pdf->download($assigncourse->enrollment_id.'i-card.pdf');
        //return $pdf->stream();
        exit;
        // return redirect()->back();
    }
	public function exam_certificate($id) {
        $data = [];
        $user_id = Auth()->guard('frontend')->user()->id;
        $data['model'] = Exam::where('user_id', $user_id)->where('course_id', base64_decode($id))->first();
        $data['assigncourse']= $assigncourse = AssignCourse::where('user_id', $user_id)->where('course_id', base64_decode($id))->first();
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
    public function exam_result($id) {
        $data = [];
        $user_id = Auth()->guard('frontend')->user()->id;
        $data['model'] = Exam::where('user_id', $user_id)->where('course_id', base64_decode($id))->first();
        $data['assigncourse']= $assigncourse = AssignCourse::where('user_id', $user_id)->where('course_id', base64_decode($id))->first();
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

    public function exam($id) {
        $data = [];
        $data['id'] = base64_decode($id);
        $data['exam_disclaimer'] = Settings::where('slug', 'exam_disclaimer')->first();
        $user_id = Auth()->guard('frontend')->user()->id;
        $check = AssignCourse::where('course_id', base64_decode($id))->where('user_id', $user_id)->first();
        if (empty($check)) {
            return redirect()->route('dashboard')->with('error', 'Oops! Something went wrong in this url.');
        }
        $data['model'] = Exam::where('user_id', $user_id)->where('course_id', base64_decode($id))->first();
        if (Auth()->guard('frontend')->user()->type_id != '2') {
            return redirect()->route('/')->with('error', 'Oops! Something went wrong in this url.');
        }
        $price = settings::where('slug', 'supply_exam_fees')->first();
        $data['razorpay'] = Settings::where('slug', 'razorpay_key')->first();
        $MERCHANT_KEY = Settings::where('slug', 'merchant_key')->first();
        $data['MERCHANT_KEY'] = $MERCHANT_KEY->value;
        $SALT = Settings::where('slug', 'salt')->first();
        $data['SALT'] = $SALT->value;
        $check_test_mode = Settings::where('slug', 'test_mode')->first();
        if ($check_test_mode->value == 1) {
            $data['BASE_URL'] = 'https://sandboxsecure.payu.in'; //sandbox
        } else {
            $data['BASE_URL'] = 'https://secure.payu.in'; //production
        }
        
        $data['totalprice'] = $price->value;
        return view('user.exam', $data);
    }

    public function give_exam(Request $request, $id) {
        // $useragent=$_SERVER['HTTP_USER_AGENT'];
        // if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
        // {
        //     return redirect()->route('user-course')->with('error', 'Mobile device ar not allowed');
        // }
        $data = [];
        $data['id'] = $id = base64_decode($id);
        $user_id = Auth()->guard('frontend')->user()->id;
        $running_course = $id;
        $model = Exam::where('user_id', $user_id)->where('course_id', $id)->first();
        if (!empty($model)) {
            $todayDate = date('Y-m-d');
            $futureDate = $model->next_exam_date;
            if ($todayDate < $futureDate || $model->supply_exam_fees == '0') {
                $request->session()->flash('success', 'Something went wrong!');
                return '<script type="text/javascript">
        window.close();
        window.onunload = function(){
            window.opener.location.reload();
         };
         </script>';
                exit;
            }else{
               $course = Course::where('id', $running_course)->first();
            $input = [];
            $input['user_id'] = $user_id;
            
            $input['course_id'] = $running_course;
            $input['status'] = '0';
            $nextexamtime = Settings::where('slug', 'supply_exam_duration')->first();
            $input['next_exam_date'] = date('Y-m-d', strtotime('+' . $nextexamtime->value . 'days'));
            $input['supply_exam_fees']='1';
            // $data['model'] = Exam::create($input);
            $model->update($input);
            $data['question_answers'] = QuestionAnswer::where('course', $running_course)->where('status', '1')->take('35')->inRandomOrder()->get();
            $data['time'] = Settings::where('slug', 'exam_time')->first();
            return view('user.give_exam', $data); 
            }
        } else {


            $course = Course::where('id', $running_course)->first();
            $input = [];
            $input['user_id'] = $user_id;
            
            $input['course_id'] = $running_course;
            $input['status'] = '0';
            $nextexamtime = Settings::where('slug', 'supply_exam_duration')->first();
            $input['next_exam_date'] = date('Y-m-d', strtotime('+' . $nextexamtime->value . 'days'));
            
            $data['model'] = Exam::create($input);
            $data['question_answers'] = QuestionAnswer::where('course', $running_course)->where('status', '1')->take('35')->inRandomOrder()->get();
            $data['time'] = Settings::where('slug', 'exam_time')->first();
            return view('user.give_exam', $data);
        }
    }

    public function pay_supply_fee(Request $request, $id) {
        $data = [];
        $user_id = Auth()->guard('frontend')->user()->id;
        $model = Exam::where('user_id', $user_id)->where('course_id',$id)->first();
        
        $input = $request->all();
        $update=[];
        $update['supply_exam_fees']='1';
        $model->update($update);
        $data_msg['u_id'] = $model->id;
        $data_msg['msg'] = "Supply Exam Fee Paid Successfully.";
        // $request->session()->flash('success', 'Supply Exam Fee Paid Successfully');
        return redirect()->route('user-course')->with('success', 'Supply Exam Fee Paid Successfully');
    }
    public function cancel_supply_payment(Request $request) {

        return redirect()->route('user-course')->with('error', 'Payment Failed.');
    }

    public function post_give_exam(Request $request,$id) {
        if ($request->ajax()) {
            
            $data_msg = [];
            $user_id = Auth()->guard('frontend')->user()->id;
            $model = Exam::where('user_id', $user_id)->where('course_id',$id)->first();
            $input = $request->all();

            $model->update($input);

            $total_number = 0;
            for ($i = 1; $i <= 35; $i++) {
                $question = 'q' . $i . '_id';
                $answer = 'q' . $i . '_answer';
                $q = $model->$question;
                $a = $model->$answer;
                if (isset($q) && isset($a)) {
                    $question_answer = QuestionAnswer::where('id', $q)->first();
                    if (!empty($question_answer)) {
                        if ($question_answer->answer == $a) {
                            $total_number = $total_number + 1;
                        }
                    }
                }
            }
            $theory=$total_number*2;
//            $percentage = ($total_number / 100) * 100;
            $passing_per = Settings::where('slug', 'pass_marks')->first();
            if ($theory >= $passing_per->value) {
                $model->next_exam_date = NULL;
                $model->status = '1';
                $model->theory = $theory;
                $model->updated_at = Carbon::now()->toDateTimeString();
                $model->save();
                $assign_course = AssignCourse::where('user_id', $user_id)->where('course_id', $id)->first();
                $assign_course->status = '1';
                $assign_course->save();
//                $user = UserMaster::where('id', $model->user_id)->first();
//                $user->course_status = '0';
//                $user->save();

                //Send Mail
//                $email_setting = $this->get_email_data('member_pass_exam', array('NAME' => $user->first_name, 'EMAIL' => $user->email));
//                $email_data = [
//                    'to' => $user->email,
//                    'subject' => $email_setting['subject'],
//                    'template' => 'signup',
//                    'data' => ['message' => $email_setting['body']]
//                ];
//                $this->PassExam($email_data);
                $request->session()->flash('success', 'You are successfully cleared the Exam.');
            } else {
                $model->theory = $theory;
                $model->updated_at = Carbon::now()->toDateTimeString();
                $model->save();
                $request->session()->flash('success', 'Sorry! You are unable to clear the exam.');
            }





            $data_msg['u_id'] = $model->id;
            $data_msg['msg'] = "Exam finished.";
            return response()->json($data_msg);
        }
    }
    
    
    
    
    public function live_class_datatable() {
        
        $id = Auth()->guard('frontend')->user()->id;
        
        $user = UserMaster::findOrFail($id);
        
        //$liveclass =  LiveClass::select('live_class.*')->join('assign_course','assign_course.course_id','=','live_class.course_id')->
        //where('assign_course.user_id', '=', $id)->
        //where('assign_course.status', '<>', '1')->orderBy('id', 'DESC')->get();
        
        $liveclass =  LiveClass::select('live_class.*')->join('assign_course','assign_course.course_id','=','live_class.course_id')->
        where('live_class.franchise_id', '=', $user->franchise_id)->where('assign_course.user_id', '=', $id)->
        where('assign_course.status', '<>', '1')->orderBy('id', 'DESC')->get();
       
        //  $liveclass =  LiveClass::orderBy('id', 'desc')->get();
        return Datatables::of($liveclass)
                        ->addIndexColumn()
                        ->editColumn('name', function($data) {
                            $course = Course::where('id',$data->course_id)->first();
                            return $course->name;
                        })
                        ->editColumn('subject', function($data) {
                            return $data->subject;
                        })
                        ->editColumn('date', function($data) {
                            
                            return !empty($data->date) ? date('jS M Y', strtotime($data->date)) : '';
                        })
                        ->editColumn('time', function($data) {
                            return $data->time;
                            return !empty($data->time) ? date('g:i A', strtotime($data->time)) : '';
                        })
                        ->addColumn('action', function ($data) {
                            return
                                    '<a href="'.$data->link.'" target="_blank"><button type="button" class="btn btn-primary"> Link</button></a>';
                        })
                        ->rawColumns(['name','subject','date','time', 'action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }
    
    public function live_class() {
        // $model = AssignCourse::where('user_id', Auth()->guard('frontend')->user()->id)->get();
        return view('user.live_class_list');
    }

}

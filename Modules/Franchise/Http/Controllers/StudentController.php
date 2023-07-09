<?php

namespace Modules\Franchise\Http\Controllers;

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
use App\Model\Franchise;
use App\Model\WalletHistory;
use App\Model\Course;
use App\Model\Exam;
use App\Model\AssignCourse;
use App\Model\Settings;
use App\Model\Plan;

class StudentController extends FranchiseController {

    protected $appid, $secret;
    
    public function RegisCommission($id,$amount){
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
            $hist['description'] = "Added Commission to Wallet for New Student Registration.";
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
            $sub_hist['description'] = "Added Commission to Wallet for New Student Registration by ".$franchise->owner_name;
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
                $parent_hist['description'] = "Added Commission to Wallet for New Student Registration by ".$franchise->owner_name;
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
            $hist['description'] = "Added Commission to Wallet for New Student Registration.";
            $hist['balance'] = $franchise->wallet_amount;
            
            $wallet_hist = WalletHistory::create($hist);
            
            return 1;
            
        }
    }
    
    public function CourseAssignCommission($id,$amount){
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
            $hist['description'] = "Added Commission to Wallet for Assigning a Course.";
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
            $sub_hist['description'] = "Added Commission to Wallet for Assigning a Course by ".$franchise->owner_name;
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
                $parent_hist['description'] = "Added Commission to Wallet for Assigning a Course by ".$franchise->owner_name;
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
            $hist['description'] = "Added Commission to Wallet for Assigning a Course.";
            $hist['balance'] = $franchise->wallet_amount;
            
            $wallet_hist = WalletHistory::create($hist);
            
            return 1;
            
        }
    }

    public function get_user_list() {


        return view('franchise::student.list');
    }

    public function get_user_list_datatable() {
        $id=Auth()->guard('franchise')->user()->id;
        $user_list = UserMaster::orderBy('id', 'desc')->where('type_id', '2')->where('franchise_id',$id)->where('status', '<>', '3')->get();
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
                            '<a href="' . Route("franchise-student-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                            '<a href="' . Route("franchise-student-choose-assign-course", [$model->id]). '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Assign Course</a>' .
                            '<a href="' . Route("franchise-student-assign-course-list", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Assigned Course List</a>';
                            // '<a href="javascript:;" onclick="deleteStudent(this);" data-href="' . Route("franchise-student-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['image','payment_status','status', 'action'])
                        ->make(true);
    }

    public function get_add_user() {
        $plan_id=Auth()->guard('franchise')->user()->plan_id;
        $data = [];
        $MERCHANT_KEY = Settings::where('slug', 'merchant_key')->first();
        $data['MERCHANT_KEY'] = $MERCHANT_KEY->value;
        $SALT = Settings::where('slug', 'salt')->first();
        $data['SALT'] = $SALT->value;
        $amt = Plan::where('id', $plan_id)->first();
        $data['amount'] =  $amt->registration_fee;
        // echo "<pre>";print_r($data);exit;
        $check_test_mode = Settings::where('slug', 'test_mode')->first();
        if ($check_test_mode->value == 1) {
            $data['BASE_URL'] = 'https://sandboxsecure.payu.in'; //sandbox
        } else {
            $data['BASE_URL'] = 'https://secure.payu.in'; //production
        }
        return view('franchise::student.add', $data);
    }

    public function post_add_user(RegisterRequest $request) {
        
        $plan_id=Auth()->guard('franchise')->user()->plan_id;
        
        if ($request->ajax()) {
            $data_msg = [];
            $data = [];
            $input = $request->all();
            $data['full_name']= strtoupper($input['full_name']);
            $data['gurdian_name']= strtoupper($input['gurdian_name']);
            $data['father_name']= strtoupper($input['father_name']);
            $data['mother_name']= strtoupper($input['mother_name']);
            $data['dob']= strtoupper($input['dob']);
            $data['gender']= strtoupper($input['gender']);
            $data['category']= strtoupper($input['category']);
            $data['email']= strtoupper($input['email']);
            $data['phone']= strtoupper($input['phone']);
            $data['address']= strtoupper($input['address']);
            $data['state']= strtoupper($input['state']);
            $data['district']= strtoupper($input['district']);
            $data['last_qualification']= strtoupper($input['last_qualification']);
            $data['specialization']= strtoupper($input['specialization']);
            $data['year_of_passing']= strtoupper($input['year_of_passing']);
            $data['school_college_name']= strtoupper($input['school_college_name']);
            $data['marks']= strtoupper($input['marks']);
            
            if ($request->hasFile('image')) {
                $sample_image = $request->file('image');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $data['image'] = $imagename;
            }
            if ($request->hasFile('id_proof')) {
                $sample_image = $request->file('id_proof');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $data['id_proof'] = $imagename;
            }
            $password = $this->rand_string(8);
            $data['password'] = Hash::make($password);
            $data['type_id'] = '2';
            $data['student_type'] = 'offline';
            $data['franchise_id'] = Auth()->guard('franchise')->user()->id;
            $data['status'] = $input['status'];
            $data['payment_status'] = '1';
            $totaluser = UserMaster::where('type_id', '2')->count();
            $data['registration_id'] = 'DITECH/' . str_pad($totaluser + 1, 4, '0', STR_PAD_LEFT);
            $amt = Plan::where('id', $plan_id)->first();
            $amount =  $amt->registration_fee;
            
            
            
            if($input['wallet'] == '1'){
                
                $hist = [];
                
                $fid = Auth()->guard('franchise')->user()->id;
                $model = Franchise::where('id',$fid)->where('status','=','1')->first();
                
                
                $model->wallet_amount = $model->wallet_amount - $amount;
                $model->save();
                
                $user = UserMaster::create($data);
                
                $hist['franchise_id'] = $fid;
                $hist['wallet_out'] = $amount;
                $hist['description'] = "Deducted Amount from Wallet for New Student Registration.";
                $hist['balance'] = $model->wallet_amount;
                
                $wallet_hist = WalletHistory::create($hist);
                
                $res = $this->RegisCommission($fid,$amount);
                
                $url = route("login");
                $email_setting = $this->get_email_data('new_account_create_for_student', array('NAME' => $user->full_name, 'EMAIL' => $user->email, 'PASSWORD' => $password, 'URL' => $url ,'REGISTRATIONID' =>$user->registration_id));
                    $email_data = [
                        'to' => $user->email,
                        'subject' => $email_setting['subject'],
                        'template' => 'create_customer',
                        'data' => ['message' => $email_setting['body']]
                    ];
                $send_mail = $this->SendMail($email_data); 
                
                
                
                $data_msg['wallet'] = '1';
                $data_msg['msg'] = "Student account created successfully.";
                $data_msg['url'] = route('franchise-students');
                return response()->json($data_msg);
                
                
            }else{
                
                Session::push('data', $data);
                Session::push('password', $password);
                Session::push('amount', $amount);
                
                
                $slink = Route('success-student-add');
                $flink = Route('cancel-student-add');
                // $productInfo = "RegistrationFee" . substr(hash('sha256', mt_rand() . microtime()), 0, 10);
                $key = Settings::where('slug', 'merchant_key')->first();
                $MERCHANT_KEY = $key->value;
                $salt = Settings::where('slug', 'salt')->first();
                $SALT = $salt->value;
                
                $txnid = 'ditechnical_' . substr(hash('sha256', mt_rand() . microtime()), 0, 10);
                $posted = array();
                $posted = array(
                    'key' => $MERCHANT_KEY,
                    'txnid' => $txnid,
                    'amount' => $amount,
                    'firstname' => $data['full_name'],
                    'email' => $data['email'],
                    'productinfo' => 'Registration fee',
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
    
                $data_msg['wallet'] = '0';
                $data_msg['msg'] = "Go for payment.";
                $data_msg['surl'] = $slink;
                $data_msg['furl'] = $flink;
                $data_msg['txnid'] = $txnid;
                $data_msg['amount'] = $amount;
                $data_msg['hash'] = $hash;
                $data_msg['firstname'] = $data['full_name'];
                $data_msg['email'] = $data['email'];
                $data_msg['phone'] = $data['phone'];
                // $request->session()->flash('success', 'You are successfully registered.');
                return response()->json($data_msg);
            }
            
        }
    }
    
    public function post_success_student_add(Request $request){
        
        $fid = Auth()->guard('franchise')->user()->id;
        $data = Session::get('data');
        $password = Session::get('password');
        $amt = Session::get('amount');
        $amount = $amt[0];
        
        // print_r($data[0]);print_r($password[0]);exit;
        
        $model = UserMaster::create($data[0]);
        
        $res = $this->RegisCommission($fid,$amount);
        
        $url = route("login");
        $email_setting = $this->get_email_data('new_account_create_for_student', array('NAME' => $model->full_name, 'EMAIL' => $model->email, 'PASSWORD' => $password[0], 'URL' => $url ,'REGISTRATIONID' =>$model->registration_id));
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'create_customer',
                'data' => ['message' => $email_setting['body']]
            ];
        $this->SendMail($email_data);
        
        Session::forget('data');
        Session::forget('password');
        Session::forget('amount');
        
        return redirect()->route('franchise-students')->with('success_msg', 'Student account created successfully.');
    }
    
    public function post_cancel_student_add(Request $request){
        Session::forget('data');
        Session::forget('password');
        Session::forget('amount');
        return redirect()->route('franchise-student-add')->with('error_msg', 'Payment Failed.');
    }

    public function get_edit_user($id) {
        $data['user'] = $user = UserMaster::where('id', '=', $id)->first();
        if (!$user) {
            return redirect()->route('franchise-students')->with('error_msg', 'Invalid Link!');
        }
        $data['id'] = $id;
        return view('franchise::student.edit', $data);
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
                    'status' => 'required'
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
            // $model->payment_status = $request->input('payment_status');
            
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
            return redirect()->route('franchise-students')->with('success_msg', 'Student updated successfully.');
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
                $data['msg'] = 'Student deleted successfully.';
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
    
    public function get_choose_assign_course($id){
        $data=[];
        $data['id'] = $id;
        $data['user'] = $user = UserMaster::where('id', '=', $id)->first();
        return view('franchise::student.choose_course', $data);
    }
    
    public function post_choose_assign_course(Request $request, $id){
        $id = $request->input('id');
        $course = $request->input('course');
        return $this->get_edit_assign_course($id,$course);
    }

    public function get_edit_assign_course($id,$course) {
        $data = [];
        
        $MERCHANT_KEY = Settings::where('slug', 'merchant_key')->first();
        $data['MERCHANT_KEY'] = $MERCHANT_KEY->value;
        $SALT = Settings::where('slug', 'salt')->first();
        $data['SALT'] = $SALT->value;
        // echo "<pre>";print_r($data);exit;
        $check_test_mode = Settings::where('slug', 'test_mode')->first();
        if ($check_test_mode->value == 1) {
            $data['BASE_URL'] = 'https://sandboxsecure.payu.in'; //sandbox
        } else {
            $data['BASE_URL'] = 'https://secure.payu.in'; //production
        }
        
        $data['user'] = $user = UserMaster::where('id', '=', $id)->first();
        if (!$user) {
            return redirect()->route('franchise-students')->with('error_msg', 'Invalid Link!');
        }
        //        if($user->course_status=='1')
        //        {
        //            return redirect()->route('franchise-students')->with('error_msg', 'Sorry! student already persuing a course.');
        //        }
        $data['id'] = $id;
        $data['course'] = $course;
        //print_r($data['course']);
        $franchise_id=Auth()->guard('franchise')->user()->id;
        
        $plan_id=Auth()->guard('franchise')->user()->plan_id;
        $amt = Plan::where('id', $plan_id)->first();
        $data['amount'] =  $amt->course_assign_fee;
        
        $data['courses'] = Course::where('status', '1')->where('live', '1')->where('franchise_paid_price', '<>', 'null')->where('created_by', '=', '0')->get();
        $data['franchise_courses'] = Course::where('status', '1')->where('live', '1')->where('franchise_paid_price', '<>', 'null')->where('created_by', $franchise_id)->get();
        // echo "<pre>";print_r($data['courses']);exit;
        return view('franchise::student.assign_course', $data);
    }
    
    // public function post_edit_assign_course(Request $request, $id) {
    //     $validator = Validator::make($request->all(), [
    //                 'running_course' => 'required',
    //                  'created_at' => 'required',
    //     ]);
    //     $validator->after(function ($validator) use ($request, $id) {
    //         $check = AssignCourse::where('user_id', $id)->where('course_id', $request->input('running_course'))->first();
    //         if (!empty($check)) {
    //             $validator->errors()->add('running_course', 'This user have already purchase this course.');
    //         }
    //     });
    //     if ($validator->passes()) {
    //         $model = UserMaster::where('id', '=', $id)->first();
    //         $model->running_course = $request->input('running_course');
    //         $model->course_status = '1';
    //         // $model->save();
    //         $course = Course::where('id', $request->input('running_course'))->first();
    //         $total=AssignCourse::count();
    //         $assigncourse = new AssignCourse;
    //         $assigncourse->enrollment_id = $this->rand_number(8);
    //         $assigncourse->certificate_no = 'DITECH' . str_pad($total + 1, 4, '0', STR_PAD_LEFT);
    //         $assigncourse->user_id = $id;
    //         $assigncourse->course_id = $request->input('running_course');
    //         $assigncourse->created_at = $request->input('created_at');
    //         $assigncourse->amount_paid = $course->franchise_paid_price;
    //         // $assigncourse->save();

            
    //         $title = 'Ditechnical';
    //         //user mail
    //         $email_setting = $this->get_email_data('purchase_course', array('NAME' => $model->full_name, 'TITLE' => $title, 'COURSENAME' => $course->name));

    //         $email_data = [
    //             'to' => $model->email,
    //             'subject' => "Course purchase",
    //             'template' => 'signup',
    //             'data' => ['message' => $email_setting['body']]
    //         ];

    //         $this->SendMail($email_data);
    //         //admin mail
    //         $admin_model = UserMaster::where('type_id', '1')->first();
    //         $email_setting = $this->get_email_data('purchase_course_admin', array('NAME' => $admin_model->name, 'TITLE' => $title, 'TOTALAMOUNT' => $course->price));
    //         $emails = array("$admin_model->email", "");
    //         $email_data = [
    //             'to' => $admin_model->email,
    //             'subject' => "Course purchase",
    //             'template' => 'signup',
    //             'data' => ['message' => $email_setting['body']]
    //         ];
    //         $this->SendMail($email_data);
            
            
    //         $slink = Route('success-student-assign-course', ['id' => $id]);
    //         $flink = Route('cancel-student-assign-course', ['id' => $id]);
    //         // $productInfo = "RegistrationFee" . substr(hash('sha256', mt_rand() . microtime()), 0, 10);
    //         $key = Settings::where('slug', 'merchant_key')->first();
    //         $MERCHANT_KEY = $key->value;
    //         $salt = Settings::where('slug', 'salt')->first();
    //         $SALT = $salt->value;
    //         $amount = '100';
    //         $txnid = 'ditechnical_' . substr(hash('sha256', mt_rand() . microtime()), 0, 10);
    //         $posted = array();
    //         $posted = array(
    //             'key' => $MERCHANT_KEY,
    //             'txnid' => $txnid,
    //             'amount' => 100,
    //             'firstname' => $model->full_name,
    //             'email' => $model->email,
    //             'productinfo' => 'Registration fee',
    //             'surl' => $slink,
    //             'furl' => $flink,
    //             'service_provider' => 'payu_paisa',
    //         );

    //         if (empty($posted['txnid'])) {
    //             $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    //         } else {
    //             $txnid = $posted['txnid'];
    //         }
    //         $hash = '';
    //         $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
    //         if (empty($posted['hash']) && sizeof($posted) > 0) {
    //             $hashVarsSeq = explode('|', $hashSequence);
    //             $hash_string = '';
    //             foreach ($hashVarsSeq as $hash_var) {
    //                 $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
    //                 $hash_string .= '|';
    //             }
    //             $hash_string .= $SALT;
    //             $hash = strtolower(hash('sha512', $hash_string));
    //         } elseif (!empty($posted['hash'])) {
    //             $hash = $posted['hash'];
    //         }


    //         $data_msg['msg'] = "Go for payment.";
    //         $data_msg['surl'] = $slink;
    //         $data_msg['furl'] = $flink;
    //         $data_msg['txnid'] = $txnid;
    //         $data_msg['hash'] = $hash;
    //         $data_msg['firstname'] = $model->full_name;
    //         $data_msg['email'] = $model->email;
    //         $data_msg['phone'] = $model->phone;
            
    //         return redirect()->route('franchise-students')->with('success_msg', 'Assign course for student successfully.');
    //     } else {
    //         return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
    //     }
    // }

    public function post_edit_assign_course(PaymentRequest $request, $id) {
        
        
        if ($request->ajax()) {
            
            $data_msg = [];
            $data = [];
            $franid = Auth()->guard('franchise')->user()->id; 
            
            $plan_id=Auth()->guard('franchise')->user()->plan_id;
            $amt = Plan::where('id', $plan_id)->first();
            $pay_amount =  $amt->course_assign_fee;
            
            $input = $request->all();
            // print_r($input);exit;
            
            $model = UserMaster::where('id', '=', $id)->first();
            // echo "<pre>";print_r($model);exit;
            $model->running_course = $request->input('running_course');
            $model->course_status = '1';
            $model->save();
            
            $course = Course::where('id', $request->input('running_course'))->first();
            $total=AssignCourse::count();
            
            $data['enrollment_id'] = $this->rand_number(8);
            $data['certificate_no'] = 'DITECH' . str_pad($total + 1, 4, '0', STR_PAD_LEFT);
            $data['user_id'] = $id;
            $data['course_id'] = $request->input('running_course');
            $data['franchise_id'] = $franid; 
            $data['created_at'] = $request->input('created_at');
            $data['amount_paid'] = $pay_amount; //$course->franchise_paid_price;
            
            if($course->exam_status == '0'){
                $data['status'] = '1';
            }else{
                $data['status'] = '0';
            }
            
            
            
            if($request->input('wallet') == '1'){
                
                $data_msg['wallet'] = '1';
                $data_msg['code'] = '';
                $fid = Auth()->guard('franchise')->user()->id;
                $franchise = Franchise::where('id',$fid)->where('status','=','1')->first();
                if(empty($franchise)){
                    $data_msg['msg'] = "Franchise Not Found !";
                }else{    
                    if($franchise->wallet_amount < $data['amount_paid']){
                        $data_msg['msg'] = "Wallet Amount Insufficient !";
                    }else{
                        
                        $hist = [];
                        
                        $franchise->wallet_amount = $franchise->wallet_amount - $data['amount_paid'];
                        $franchise->save();
                        
                        $assign_course = AssignCourse::create($data);
                        $course = Course::where('id', '=', $assign_course->course_id)->first();
                        
                        if($course->exam_status == '0'){
                            $exam = new Exam();
                            $exam->user_id = $assign_course->user_id;
                            $exam->course_id = $course->id;
                            $exam->status = '1';
                            $exam->save();
                        }
                        
                        $hist['franchise_id'] = $franchise->id;
                        $hist['wallet_out'] = $data['amount_paid'];
                        $hist['description'] = "Deducted Amount from Wallet for Assigning a Course.";
                        $hist['balance'] = $franchise->wallet_amount;
                        
                        $wallet_hist = WalletHistory::create($hist);
                        
                        $res = $this->CourseAssignCommission($franid,$pay_amount);
                        
                            $title = 'Ditechnical';
                            //user mail
                            $email_setting = $this->get_email_data('purchase_course', array('NAME' => $model->full_name, 'TITLE' => $title, 'COURSENAME' => $course->name));
                
                            $email_data = [
                                'to' => $model->email,
                                'subject' => "Course purchase",
                                'template' => 'signup',
                                'data' => ['message' => $email_setting['body']]
                            ];
                
                            $this->SendMail($email_data);
                            //admin mail
                            $admin_model = UserMaster::where('type_id', '1')->first();
                            $email_setting = $this->get_email_data('purchase_course_admin', array('NAME' => $admin_model->name, 'TITLE' => $title, 'TOTALAMOUNT' => $pay_amount));
                            $emails = array("$admin_model->email", "");
                            $email_data = [
                                'to' => $admin_model->email,
                                'subject' => "Course purchase",
                                'template' => 'signup',
                                'data' => ['message' => $email_setting['body']]
                            ];
                            $this->SendMail($email_data);
                        
                            $data_msg['code'] = '200';
                            $data_msg['msg'] = "Assign course for student successfully.";
                            $data_msg['url'] = route('franchise-students');
                            return response()->json($data_msg);
                        
                    }
                }
                
                return response()->json($data_msg);
            }else{
                
                Session::push('data', $data);
                Session::push('amount', $pay_amount);
            
                $slink = Route('success-student-assign-course', ['user_id'=> $model->id]);
                $flink = Route('cancel-student-assign-course');
                // $productInfo = "RegistrationFee" . substr(hash('sha256', mt_rand() . microtime()), 0, 10);
                $key = Settings::where('slug', 'merchant_key')->first();
                $MERCHANT_KEY = $key->value;
                $salt = Settings::where('slug', 'salt')->first();
                $SALT = $salt->value;
                $amount = $pay_amount;
                $txnid = 'ditechnical_' . substr(hash('sha256', mt_rand() . microtime()), 0, 10);
                $posted = array();
                $posted = array(
                    'key' => $MERCHANT_KEY,
                    'txnid' => $txnid,
                    'amount' => $amount,
                    'firstname' => $model->full_name,
                    'email' => $model->email,
                    'productinfo' => 'Course fee',
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
    
                $data_msg['wallet'] = '0';
                $data_msg['msg'] = "Go for payment.";
                $data_msg['surl'] = $slink;
                $data_msg['furl'] = $flink;
                $data_msg['txnid'] = $txnid;
                $data_msg['amount'] = $amount;
                $data_msg['hash'] = $hash;
                $data_msg['firstname'] = $model->full_name;
                $data_msg['email'] = $model->email;
                $data_msg['phone'] = $model->phone;
                
                return response()->json($data_msg);
                
            }
        }
    }
    
    public function post_success_student_assign(Request $request, $user_id){
        $fid = Auth()->guard('franchise')->user()->id;
        $model = UserMaster::where('id', '=', $user_id)->first();
        $data = Session::get('data');
        $amt = Session::get('amount');
        $amount = $amt[0];
        // print_r($data[0]);exit;
        $assign_course = AssignCourse::create($data[0]);
        $course = Course::where('id', '=', $assign_course->course_id)->first();
        
        if($course->exam_status == '0'){
            $exam = new Exam();
            $exam->user_id = $assign_course->user_id;
            $exam->course_id = $course->id;
            $exam->status = '1';
            $exam->save();
        }
        
        $res = $this->CourseAssignCommission($fid,$amount);
        
            $title = 'Ditechnical';
            //user mail
            $email_setting = $this->get_email_data('purchase_course', array('NAME' => $model->full_name, 'TITLE' => $title, 'COURSENAME' => $course->name));

            $email_data = [
                'to' => $model->email,
                'subject' => "Course purchase",
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];

            $this->SendMail($email_data);
            //admin mail
            $admin_model = UserMaster::where('type_id', '1')->first();
            $email_setting = $this->get_email_data('purchase_course_admin', array('NAME' => $admin_model->name, 'TITLE' => $title, 'TOTALAMOUNT' => $amount));
            $emails = array("$admin_model->email", "");
            $email_data = [
                'to' => $admin_model->email,
                'subject' => "Course purchase",
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
        
        Session::forget('data');
        Session::forget('amount');
        return redirect()->route('franchise-students')->with('success_msg', 'Assign course for student successfully.');
    }
    
    public function post_cancel_student_assign(Request $request){
        // $assign_user = AssignCourse::find($id);
        // $assign_user->delete();
        Session::forget('data');
        Session::forget('amount');
        return redirect()->route('franchise-students')->with('error_msg', 'Payment Failed.');
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
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Completed</span>';
                            }
                            return $status;
                        })
                        ->editColumn('course_id', function ($model) {
                            return (!empty($model->course->name))? $model->course->name : 'NA';
                        })
                        ->editColumn('created_at', function ($model) {
                            return (!empty($model->created_at)) ? \Carbon\Carbon::parse($model->created_at)->format('d-m-Y H:i A') : 'Not Found';
                        })
                        ->addColumn('action', function ($model) {
                              return
                                        '<a href="' . Route("student-i-card", ['id' => base64_encode($model->id)])  . '" target="_blank"><button type="button" class="btn btn-success">Download I-Card</button></a>';
                              
                        })
                        ->rawColumns(['course_id','created_at', 'status','action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function assign_course_list($id) {
        $user = UserMaster::where('id', '=', $id)->first();
        return view('franchise::student.assign_course_list', compact('id', 'user'));
    }
    
    public function download_i_card($id) {
        $data = [];
        $data['assigncourse']= $assigncourse = AssignCourse::where('id', base64_decode($id))->first();
        
        $pdf = PDF::loadView('mail.i_card', $data);
        //return $pdf->download($assigncourse->enrollment_id.'i-card.pdf');
        return $pdf->stream($assigncourse->enrollment_id.'i-card.pdf');
        exit;
        // return redirect()->back();
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\Thankyou;
use Craftsys\Msg91\Facade\Msg91;
use Craftsys\Msg91\Client;
use PDF;
use Illuminate\Support\Facades\Input;

/* * ************Request***************** */
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\ResetRequest;
use App\Http\Requests\ContactUsRequest;
use App\Http\Requests\ApplyOnlineRequest;
use App\Http\Requests\EnquiryRequest;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\DownloadICardRequest;
use App\Http\Requests\DownloadResultRequest;
use App\Http\Requests\SubscribersRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/* * ****************Model*********************** */
use URL;
use DB;
use Artisan;
use App\Model\UserMaster;
use App\Model\FranchiseRequest;
use App\Model\Franchise;
use App\Model\WalletHistory;
use App\Model\Plan;
use App\Model\Contactus;
use App\Model\Enquiry;
use App\Model\StaticPage;
use App\Model\Settings;
use App\Model\Slider;
use App\Model\Course;
use App\Model\CourseModule;
use App\Model\CourseModuleVideo;
use App\Model\AssignCourse;
use App\Model\Exam;
use App\Model\Subscriber;
use App\Model\Gallery;
use App\Model\Wishlist;
use App\Model\Cart;
use App\Model\Banner;
use App\Model\FAQ;
use App\Model\Menu;


class SiteController extends Controller {

    public function index() {

        $data = [];
        $data['sliders'] = Slider::where('status', '1')->get();
        $data['featured_courses'] = Course::where('featured', '1')->where('status', '1')->get();
        $data['all_courses'] = Course::where('status', '1')->get();
        $data['gallries'] = Gallery::where('status', '1')->take(8)->orderBy('id', 'desc')->get();
        $data['counters'] = Settings::where('module','=','Counter')->get();
        $data['supports'] = Settings::where('module','=','Help & Support')->get();
        $data['faqs'] = FAQ::where('status', '1')->orderBy('id', 'desc')->get();
        
        return view('site.index', $data);
    }

    public function get_signup() {
        $data = [];
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
        return view('site.signup', $data);
    }

    public function post_signup(RegisterRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            $input['full_name']= strtoupper($input['full_name']);
            // $input['gurdian_name']= strtoupper($input['gurdian_name']);
            $input['father_name']= strtoupper($input['father_name']);
            $input['mother_name']= strtoupper($input['mother_name']);
            // $input['gender']= strtoupper($input['gender']);
            // $input['category']= strtoupper($input['category']);
            // $input['address']= strtoupper($input['address']);
            $input['state']= strtoupper($input['state']);
            // $input['district']= strtoupper($input['district']);
            // $input['last_qualification']= strtoupper($input['last_qualification']);
            // $input['specialization']= strtoupper($input['specialization']);
            // $input['school_college_name']= strtoupper($input['school_college_name']);
            
            if ($request->hasFile('image')) {
                $sample_image = $request->file('image');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $input['image'] = $imagename;
            }
            // if ($request->hasFile('id_proof')) {
            //     $sample_image = $request->file('id_proof');
            //     $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
            //     $destinationPath = public_path('uploads/user');
            //     $sample_image->move($destinationPath, $imagename);
            //     $input['id_proof'] = $imagename;
            // }
            $input['password'] = Hash::make($input['password']);
            $input['type_id'] = '2';
            $input['student_type'] = 'online';
            $input['activation_token'] = $this->rand_string(20);
            $totaluser = UserMaster::where('type_id', '2')->count();
            $input['registration_id'] = 'DITECH/' . str_pad($totaluser + 1, 4, '0', STR_PAD_LEFT);
            $model = UserMaster::create($input);
            $slink = Route('success-signup', ['id' => $model->id]);
            $flink = Route('cancel-signup', ['id' => $model->id]);
//            $productInfo = "RegistrationFee" . substr(hash('sha256', mt_rand() . microtime()), 0, 10);
            $key = Settings::where('slug', 'merchant_key')->first();
            $MERCHANT_KEY = $key->value;
            $salt = Settings::where('slug', 'salt')->first();
            $SALT = $salt->value;
            $amt = Settings::where('slug', 'online_stud_regis_fee')->first();
            $amount = $amt->value;
            $txnid = 'ditechnical_' . substr(hash('sha256', mt_rand() . microtime()), 0, 10);
            $posted = array();
            $posted = array(
                'key' => $MERCHANT_KEY,
                'txnid' => $txnid,
                'amount' => $amount,
                'firstname' => $model->full_name,
                'email' => $model->email,
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


            $data_msg['msg'] = "Go for payment.";
            $data_msg['surl'] = $slink;
            $data_msg['furl'] = $flink;
            $data_msg['txnid'] = $txnid;
            $data_msg['amount'] = $amount;
            $data_msg['hash'] = $hash;
            $data_msg['firstname'] = $model->full_name;
            $data_msg['email'] = $model->email;
            $data_msg['phone'] = $model->phone;
            // $request->session()->flash('success', 'You are successfully registered.');
            return response()->json($data_msg);
        }
    }

    public function post_success_signup(Request $request, $id) {

        $data_msg = [];
        $input = $request->all();

        $model = UserMaster::where('id', '=', $id)->first();
        $model->activation_token = $this->rand_string(20);
        $model->payment_status = '1';
        $model->save();
        $link = Route('active-account', ['id' => base64_encode($model->id), 'token' => $model->activation_token]);

        $email_setting = $this->get_email_data('user_registration', array('NAME' => $model->full_name, 'EMAIL' => $model->email, 'LINK' => $link ,'REGISTRATIONID' =>$model->registration_id));
        $email_data = [
            'to' => $model->email,
            'subject' => $email_setting['subject'],
            'template' => 'signup',
            'data' => ['message' => $email_setting['body']]
        ];
        $this->SendMail($email_data);

        return redirect()->route('/')->with('success', 'You are successfully registered.Verify Your Email.');
    }

    public function cancel_signup(Request $request, $id) {
        $user = UserMaster::find($id);
        $user->delete();
        return redirect()->route('signup')->with('error', 'Payment Failed.');
    }

    public function get_active_account(Request $request, $id, $token) {
        if ($id == "" && $token == "") {
            return redirect()->route('/')->with('error', 'Oops! Something went wrong in this url.');
        }
        $id = base64_decode($id);

        $model = UserMaster::where('id', $id)->where('activation_token', $token)->first();
        if (empty($model))
            return redirect()->route('/')->with('error', 'Requested url is no longer valid. Please try again.');
        else {
//            Auth::guard('frontend')->login($model);
//            $model->email_verified_at = Carbon::now()->toDateTimeString();
            $model->activation_token = NULL;
            $model->status = '1';
            $model->last_login = Carbon::now()->toDateTimeString();
            $model->save();

//            Mail::to($model->email)->send(new Thankyou($model));
            return redirect()->route('login')->with('success', 'Your account has been activated successfully.');
        }
    }

    function imageUpload($image) {
        $name = $this->rand_string(15) . time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('uploads/users/');
        $image->move($destinationPath, $name);
        return $name;
    }

    public function get_login() {
        $data = [];
        return view('site.login', $data);
    }

    public function post_login(LoginRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            $model = UserMaster::where('email', '=', $input['email'])->first();
            if (!empty($request->input('rememberMe'))) {
                $expire = time() + 172800;
                setcookie('email', $request->input('email'), $expire, '/');
                setcookie('password', $request->input('password'), $expire, '/');
            } else {
                $expire = time() - 172800;
                setcookie('email', '', $expire, '/');
                setcookie('password', '', $expire, '/');
            }
            Auth::guard('frontend')->login($model);
            $model->last_login = Carbon::now()->toDateTimeString();
            $model->save();
            $data_msg['link'] = Route('my-profile');

            $request->session()->flash('success', 'You are successfully logged in.');
            return response()->json($data_msg);
        }
    }

    public function get_forgot_password() {
        return view('site.forgot-one');
    }

    public function post_forgot_password(ForgotRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            $input['reset_password_token'] = $this->rand_string(20);
            $model = UserMaster::where('email', '=', $input['email'])->first();
            $model->update($input);

            $link = Route('reset-password', ['id' => base64_encode($model->id), 'token' => $model->reset_password_token]);

            $email_setting = $this->get_email_data('forgot_password', array('NAME' => $model->first_name, 'EMAIL' => $input['email'], 'LINK' => $link));

            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'forgot_password',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
            $data_msg['msg'] = 'Your reset password link has been sent to your email.';
            return response()->json($data_msg);
        }
    }

    public function get_reset_password($id, $token) {
        if ($id === "" && $token === "") {
            return redirect()->route('/')->with('error', 'oops! Something went wrong in this url.');
        }
        $id = base64_decode($id);
        $model = UserMaster::where('id', $id)->where('reset_password_token', $token)->first();
        if (empty($model))
            return redirect()->route('/')->with('error', 'oops! Something went wrong in this url.');
        else {
            Session::put('user_id', $id);
            Session::put('forgot_token', $token);
            $data = [];
            return view('site.forgot-two', $data);
        }
    }

    public function post_reset_password(ResetRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();

            $input['password'] = Hash::make($input['password']);

            $input['reset_password_token'] = NULL;
            $user_id = Session::get('user_id');
            $model = UserMaster::findOrFail($user_id);
            $model->update($input);
            Session::remove('user_id');
            Session::remove('forgot_token');
            $data_msg['link'] = Route('/');

            $request->session()->flash('success', 'Your password changed successfully.');
            return response()->json($data_msg);
        }
    }

    public function get_static_page(Request $request) {
        $data = [];
        if ($request->route()->named('privacy-policy')) {
            $data['model'] = StaticPage::where('slug', '=', 'privacy_policy')->first();
            return view('site.static_page', $data);
        } else if ($request->route()->named('return-refund-policy')) {
            $data['model'] = StaticPage::where('slug', '=', 'return_refund')->first();
            return view('site.static_page', $data);
        } else if ($request->route()->named('terms-condition')) {
            $data['model'] = StaticPage::where('slug', '=', 'terms_conditions')->first();
            return view('site.static_page', $data);
        } else if ($request->route()->named('faq-page')) {
            $data['model'] = Faq::where('status', '=', '1')->get();
            return view('site.faq', $data);
        } else {
            return redirect()->route('/');
        }
    }

    public function logout() {
        Auth::guard('frontend')->logout();
        return redirect('/')->with('success', 'You are successfully logged out.');
    }

    public function contact_us() {
        return view('site.contact_us');
    }

    public function post_contact(ContactUsRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $admin_email = UserMaster::where('type_id', '=', '1')->first();
            $input = $request->all();
            $contact = Contactus::create($input);

            if (!empty($admin_email)):
                $email_setting = $this->get_email_data('contact_us', array('ADMIN' => "Admin", 'SERVICE' => $contact->services, 'NAME' => $contact->name, 'EMAIL' => $contact->email, 'SUBJECT' => $contact->subject,
                    'PHONE' => ($contact->phone != "") ? $contact->phone : 'Not Provided', 'MESSAGE' => $contact->message));
                $email_data = [
                    'to' => $admin_email->email,
                    'subject' => $email_setting['subject'],
                    'template' => 'signup',
                    'data' => ['message' => $email_setting['body']]
                ];
                $this->SendMail($email_data);
            endif;

            $data_msg['msg'] = 'Thank you for contacting us. We will Contact you soon.';
            return response()->json($data_msg);
        }
    }

    public function post_apply_online(ApplyOnlineRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            
            $history = [];
            
            $input = $request->all();
            
            
            //$input['reset_password_token'] = $this->rand_string(20);
            
            if ($request->hasFile('image')) {
                $sample_image = $request->file('image');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $input['image'] = $imagename;
            }
            if ($request->hasFile('owner_image')) {
                $sample_image = $request->file('owner_image');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $input['owner_image'] = $imagename;
            }
            if ($request->hasFile('id_proof')) {
                $sample_image = $request->file('id_proof');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $input['id_proof'] = $imagename;
            }
            
            //$input['owner_sign'] = "default_center.png";
            
            $password = $input['password'];
            $input['password'] = Hash::make($password);
            
            $totaluser = Franchise::where('type_id', '3')->count();
            $input['registration_id'] = 'DITECH/ALC/' . str_pad($totaluser + 1, 4, '0', STR_PAD_LEFT);
            
            $plan = Plan::where('id', '=', $input['plan_id'])->first();
            
            $amount = $plan->price;
            
            if($amount == ''){
                
                $input['days_left'] = $plan->validity;
                $input['payment_status'] = '0';
                if($plan->free_wallet != ''){
                    $input['wallet_amount'] = $plan->free_wallet;
                }
                if($plan->referral_status == '1'){
                    $input['referral_code'] = $this->rand_string(16);
                }else{
                    $input['referral_code'] = null;
                }
                
                $franchise = Franchise::create($input);
                
                if($plan->free_wallet != ''){
                    $history['franchise_id'] = $franchise->id;
                    $history['wallet_in'] = $plan->free_wallet;
                    $history['description'] = "Add Joining Wallet Amount.";
                    
                    $wallet_history = WalletHistory::create($history);
                }
                
                //$link = Route('active-franchise-account', ['id' => base64_encode($franchise->id), 'token' => $franchise->reset_password_token]);

                $email_setting = $this->get_email_data('franchise_registration', array('NAME' => $franchise->owner_name, 'EMAIL' => $franchise->email, 'REGISTRATIONID' => $franchise->registration_id));
                $email_data = [
                    'to' => $franchise->email,
                    'subject' => $email_setting['subject'],
                    'template' => 'signup',
                    'data' => ['message' => $email_setting['body']]
                ];
                $this->SendMail($email_data);
                
                $admin_email = UserMaster::where('type_id', '=', '1')->first();
                
                if (!empty($admin_email)):
                    $email_setting = $this->get_email_data('admin_franchise_signup', array('ADMIN' => "Admin", 'NAME' => $franchise->owner_name, 'EMAIL' => $franchise->email,
                        'PHONE' => $franchise->phone , 'ADDRESS' => $franchise->address));
                    $email_data = [
                        'to' => $admin_email->email,
                        'subject' => $email_setting['subject'],
                        'template' => 'signup',
                        'data' => ['message' => $email_setting['body']]
                    ];
                    $this->SendMail($email_data);
                endif;
                
                $data_msg['free'] = '1';
                $data_msg['msg'] = 'Thank you for Joining us. We will Contact you soon.';
                return response()->json($data_msg);
                
            } else {
                
                    // if($input['plan_id'] == '2'){
                    //     $input['days_left'] = $plan->validity;
                    //     $input['payment_status'] = '1';
                    // } else if($input['plan_id'] == '3'){
                    //     $input['days_left'] = $plan->validity;
                    //     $input['wallet_amount'] = $plan->free_wallet;
                    //     if($plan->referral_status == '1'){
                    //         $input['referral_code'] = $this->rand_string(16);
                    //     }
                    //     $input['payment_status'] = '1';
                        
                    // } else if($input['plan_id'] == '4'){
                    
                    $input['days_left'] = $plan->validity;
                    $input['payment_status'] = '1';
                    if($plan->free_wallet != ''){
                        $input['wallet_amount'] = $plan->free_wallet;
                        
                        $history['wallet_in'] = $plan->free_wallet;
                        $history['description'] = "Joining Wallet Amount.";
                    }
                    if($plan->referral_status == '1'){
                        $input['referral_code'] = $this->rand_string(16);
                    }else{
                        $input['referral_code'] = null;
                    }
                    
                    
                    Session::push('input', $input);
                    Session::push('history', $history);
                    
                    $slink = Route('success-apply-online');
                    $flink = Route('cancel-apply-online');
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
                        'firstname' => $input['owner_name'],
                        'email' => $input['email'],
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
        
                    $data_msg['free'] = '0';
                    $data_msg['msg'] = "Go for payment.";
                    $data_msg['surl'] = $slink;
                    $data_msg['furl'] = $flink;
                    $data_msg['txnid'] = $txnid;
                    $data_msg['amount'] = $amount;
                    $data_msg['hash'] = $hash;
                    $data_msg['firstname'] = $input['owner_name'];
                    $data_msg['email'] = $input['email'];
                    $data_msg['phone'] = $input['phone'];
                    
                    
                    return response()->json($data_msg);
                    
            }
         
            
        }
    }
    
    public function post_success_apply(Request $request){
        $input = Session::get('input');
        $history = Session::get('history');
        
        $franchise = Franchise::create($input[0]);
        
        if(!empty($history[0])){
            $history[0]['franchise_id'] = $franchise->id;
            $wallet_history = WalletHistory::create($history[0]);
        }
        
        //$link = Route('active-franchise-account', ['id' => base64_encode($franchise->id), 'token' => $franchise->reset_password_token]);

        $email_setting = $this->get_email_data('franchise_registration', array('NAME' => $franchise->owner_name, 'EMAIL' => $franchise->email,'REGISTRATIONID' => $franchise->registration_id));
        $email_data = [
            'to' => $franchise->email,
            'subject' => $email_setting['subject'],
            'template' => 'signup',
            'data' => ['message' => $email_setting['body']]
        ];
        $this->SendMail($email_data);
        
        $admin_email = UserMaster::where('type_id', '=', '1')->first();
        
        if (!empty($admin_email)):
            $email_setting = $this->get_email_data('admin_franchise_signup', array('ADMIN' => "Admin", 'NAME' => $franchise->owner_name, 'EMAIL' => $franchise->email,
                'PHONE' => $franchise->phone , 'ADDRESS' => $franchise->address));
            $email_data = [
                'to' => $admin_email->email,
                'subject' => $email_setting['subject'],
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
        endif;
        
        Session::forget('input');
        Session::forget('history');
        
        return redirect()->route('apply-online')->with('success', 'Thank you for Joining us. We will Contact you soon.');
    }
    
    public function post_cancel_apply(Request $request){
        Session::forget('input');
        Session::forget('history');
        return redirect()->route('apply-online')->with('error', 'Payment Failed.');
    }
    
    public function get_active_franchise_account(Request $request, $id, $token) {
        if ($id == "" && $token == "") {
            return redirect()->route('/')->with('error', 'Oops! Something went wrong in this url.');
        }
        $id = base64_decode($id);

        $model = Franchise::where('id', $id)->where('reset_password_token', $token)->first();
        if (empty($model))
            return redirect()->route('/')->with('error', 'Requested url is no longer valid. Please try again.');
        else {
//            Auth::guard('frontend')->login($model);
//            $model->email_verified_at = Carbon::now()->toDateTimeString();
            $model->reset_password_token = NULL;
            $model->status = '1';
            // $model->last_login = Carbon::now()->toDateTimeString();
            $model->save();

//            Mail::to($model->email)->send(new Thankyou($model));
            return redirect()->route('franchise-login')->with('success', 'Your account has been activated successfully.');
        }
    }
    

    public function post_enquiry(EnquiryRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $admin_email = UserMaster::where('type_id', '=', '1')->first();
            $input = $request->all();
            $contact = Enquiry::create($input);

            if (!empty($admin_email)):
                $email_setting = $this->get_email_data('enquiry', array('ADMIN' => "Admin",'SERVICE' => $contact->services, 'NAME' => $contact->name, 'EMAIL' => $contact->email,
                    'PHONE' => ($contact->phone != "") ? $contact->phone : 'Not Provided', 'ADDRESS' => $contact->address, 'MESSAGE' => $contact->message));
                $email_data = [
                    'to' => $admin_email->email,
                    'subject' => $email_setting['subject'],
                    'template' => 'signup',
                    'data' => ['message' => $email_setting['body']]
                ];
                $this->SendMail($email_data);
            endif;

            $data_msg['msg'] = 'Thank you for contacting us. We will Contact you soon.';
            return response()->json($data_msg);
        }
    }
    
    public function post_center_query(Request $request) {
         $validator = Validator::make($request->all(), [
                    'name' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'center_name' => 'nullable|regex:/^[a-zA-Z\s]+$/',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'address' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'district' => 'required',
                    'message' => 'required'
        ]);
        
        if ($validator->passes()) {
            
            $input = $request->all();
            $contact = Enquiry::create($input);
            
            $admin_email = UserMaster::where('type_id', '=', '1')->first();

            if (!empty($admin_email)):
                $email_setting = $this->get_email_data('enquiry', array('ADMIN' => "Admin",'SERVICE' => $contact->services, 'NAME' => $contact->name, 'EMAIL' => $contact->email,
                    'PHONE' => ($contact->phone != "") ? $contact->phone : 'Not Provided', 'ADDRESS' => $contact->address, 'MESSAGE' => $contact->message));
                $email_data = [
                    'to' => $admin_email->email,
                    'subject' => $email_setting['subject'],
                    'template' => 'signup',
                    'data' => ['message' => $email_setting['body']]
                ];
                $this->SendMail($email_data);
            endif;
            
            return redirect()->route('/')->with('success_msg', 'Thank you for contacting us. We will Contact you soon.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function search_user() {
        $data = [];
        return view('site.search', $data);
    }

    public function about_us() {
        $data = [];
        return view('site.about_us', $data);
    }

    public function i_card() {
        $data = [];
        return view('site.i_card', $data);
    }

    public function download_i_card(DownloadICardRequest $request) {
        $data = [];
        $input = $request->all();
        $data['assigncourse'] = $assigncourse = AssignCourse::where('enrollment_id', $input['enrollment_id'])->first();
        $pdf = PDF::loadView('mail.i_card', $data);
        $path = public_path('pdf/');
        $filename = $assigncourse->enrollment_id . 'i-card.pdf';
        $pdf->save($path . '/' . $filename);
        $pdf = URL::asset('public/pdf/' . $filename);
        // $pdf->download($assigncourse->enrollment_id.'i-card.pdf');
        //return $pdf->stream();
        $data_msg['msg'] = 'I-Card downloaded successfully.';
        $data_msg['file'] = $pdf;
        return response()->json($data_msg);
        // return redirect()->back();
    }

    public function affiliation_center() {
        $data = [];
        return view('site.affiliation_center', $data);
    }
    
    public function search_center(Request $request){
        $data = [];
        
        
        
        $validator = Validator::make($request->all(), [
                    'state' => 'required'
        ]);
        
        if ($validator->passes()) {
            
            $input = $request->all();
            
            if($input['state'] == 'all'){
                $data['franchises'] = $franchises =  Franchise::where('status', '=', '1')->get();
                
                foreach($franchises as $franchise){
                    
                    $franchise['total_student'] = UserMaster::where('franchise_id', '=', $franchise['id'])->where('status','=','1')->count();
                    $franchise['pass_student'] = Exam::select('exams.*')->join('user_master','exams.user_id', '=', 'user_master.id')
                                                    ->where('user_master.franchise_id', '=', $franchise['id'])->where('exams.status','=','1')->count();
                }
                 
                
            }else{
                $data['franchises'] = $franchises =  Franchise::where('state', '=', $input['state'])->where('status', '=', '1')->get();
                
                foreach($franchises as $franchise){
                    
                    $franchise['total_student'] = UserMaster::where('franchise_id', '=', $franchise['id'])->where('status','=','1')->count();
                    $franchise['pass_student'] = Exam::select('exams.*')->join('user_master','exams.user_id', '=', 'user_master.id')
                                                    ->where('user_master.franchise_id', '=', $franchise['id'])->where('exams.status','=','1')->count();
                }
            }
            
            if($input['state'] == 'all'){
                $franchise = Franchise::where('status', '=', '1')->count();
                
                if($franchise > 0){
                    $data['success'] = $franchise." Center Found.";
                    $data['status'] = '1';
                }else{
                    $data['error'] = "No Center Found !";
                    $data['status'] = '0';
                }
                
            }else{
                $franchise = Franchise::where('state','=', $input['state'])->where('status', '=', '1')->count();
                
                if($franchise > 0){
                    $data['success'] = $franchise." Center Found in ".$input['state'];
                    $data['status'] = 1;
                }else{
                    $data['error'] = "No Center Found in ".$input['state']." !";
                    $data['status'] = 0;
                }
                
            }
            
            return view('site.affiliation_center', $data);
            
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function affiliation_process() {
        $data = [];
        $data['plans']= Plan::where('status','=','1')->get();
        return view('site.affiliation_process', $data);
    }

    public function apply_online() {
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
        
        $data['plans']= Plan::where('status','=','1')->get();
        return view('site.apply_online', $data);
    }

    public function certificate_verification() {
        $data = [];

        return view('site.certificate_verification', $data);
    }

    public function verify_certificate_verification(Request $request) {
        $data = [];

        $certificate_no = $request->certificate_no;
        $data['status'] = '1';
        $data['assigncourse'] = $assigncourse = AssignCourse::where('certificate_no', $certificate_no)->where('status','1')->first();
        if (!empty($assigncourse)) {
            $data['model'] = Exam::where('user_id', $assigncourse->user_id)->where('course_id', $assigncourse->course_id)->first();
        }
        if(!empty($assigncourse)){
            $data['success'] = "Verification Successfully";
            $data['msg_status'] = '1';
        }else{
             $data['error'] = "Verification Faild";
              $data['msg_status'] = '0';
        }

        return view('site.certificate_verification', $data);
    }

    public function courses() {
        $data = [];
        $data['all_courses'] = Course::where('status', '1')->where('live', '1')->get();
        return view('site.courses', $data);
    }

    public function get_course_details($id) {
        $data = [];
        $data['course_detail'] = $details = Course::findOrFail(base64_decode($id));

        if (!$details) {
            return redirect()->route('/')->with('error', 'Something went wrong please check your input!');
        }
        $data['course_modules'] = CourseModule::where('course_id', base64_decode($id))->where('status', '1')->get();
        $data['total_lessons'] = CourseModuleVideo::where('course_id', base64_decode($id))->where('status', '1')->count();
        $totaltime = CourseModuleVideo::where('course_id', base64_decode($id))->where('status', '1')->sum('time');
        $hours = floor($totaltime / 60);
        $minutes = ($totaltime % 60);
        $data['hour_minute'] = $hours . ' hr ' . $minutes . ' min';
//        print_r($data['hour_minute']);
//        exit;
        return view('site.course_detail', $data);
    }

    public function director_message() {
        $data = [];
        $data['banner'] = Banner::where('slug','=','director')->where('status','<>','0')->first();
        return view('site.director_message', $data);
    }

    public function evaluation() {
        $data = [];
        return view('site.evaluation', $data);
    }

    public function examination_process() {
        $data = [];
        return view('site.examination_process', $data);
    }

    public function gallery() {
        $data = [];
        $data['gallries'] = Gallery::where('status', '1')->orderBy('id', 'desc')->get();
        return view('site.gallery', $data);
    }
    
    public function useful_links() {
        $data = [];
        $data['menus'] = Menu::where('status', '1')->orderBy('id', 'desc')->get();
        return view('site.useful_links', $data);
    }

    public function iso_certification() {
        $data = [];
        return view('site.iso_certification', $data);
    }

    public function mca() {
        $data = [];
        return view('site.mca', $data);
    }

    public function mission_and_vision() {
        $data = [];
        return view('site.mission_and_vision', $data);
    }

    public function msme_registeration() {
        $data = [];
        return view('site.msme_registeration', $data);
    }

    public function quality_policy() {
        $data = [];
        return view('site.quality_policy', $data);
    }

    public function registered_students(Request $request) {
        $data = [];
        if(isset($request->registration_id)){
        $registration_id = $request->registration_id;
        $data['status'] = '1';
        $data['user']  = UserMaster::where('registration_id', $registration_id)->first();
        
        }
        return view('site.registered_students', $data);
    }
    public function students_facilities() {
        $data = [];
        return view('site.students_facilities', $data);
    }
    public function prospectus() {
        $data = [];
        $data['banner'] = Banner::where('slug','=','prospectus')->where('status','<>','0')->first();
        return view('site.prospectus', $data);
    }
    public function franchise_affiliation_form() {
        $data = [];
        return view('site.franchise_affiliation_form', $data);
    }
    public function student_registration_form() {
        $data = [];
        $data['banner'] = Banner::where('slug','=','admission_form')->where('status','<>','0')->first();
        return view('site.student_registration_form', $data);
    }
    public function registration_process() {
        $data = [];
        return view('site.registration_process', $data);
    }

    public function result() {
        $data = [];
        return view('site.result', $data);
    }

    public function download_result(DownloadResultRequest $request) {
        $data = [];
        $input = $request->all();
        $data['assigncourse'] = $assigncourse = AssignCourse::where('enrollment_id', $input['enrollment_id'])->first();
        $data['model']= $model = Exam::where('user_id', $assigncourse->user_id)->where('course_id', $assigncourse->course_id)->first();
        $link = Route('verify-certificate-verification').'?certificate_no='.$assigncourse->certificate_no;
        \QrCode::size(200)
            ->format('png')
            ->generate("Certificate Verification: $link", public_path('/frontend/qrcode/'.$assigncourse->user->full_name.'qrcode.png'));
        $data['qrcode'] = URL::asset('public/frontend/qrcode/' . $assigncourse->user->full_name . 'qrcode.png');
        $pdf = PDF::loadView('mail.exam_certificate', $data);
        $path = public_path('pdf/');
        $filename = $assigncourse->enrollment_id . 'certificate.pdf';
        $pdf->save($path . '/' . $filename);
        $pdf = URL::asset('public/pdf/' . $filename);
        $data_msg['content'] = view('site.download_result', compact('assigncourse','pdf','model'))->render();
        // $pdf->download($assigncourse->enrollment_id.'i-card.pdf');
        // return $pdf->stream();
        
        $data_msg['msg'] = 'your search is appear.';
        $data_msg['file'] = $pdf;
        return response()->json($data_msg);
        // return redirect()->back();
    }

    public function toppers_talk() {
        $data = [];
        return view('site.toppers_talk', $data);
    }

    public function why_ditech() {
        $data = [];
        return view('site.why_ditech', $data);
    }

    public function wishlist() {
        if (Auth()->guard('frontend')->guest()) {
            return redirect()->route('login')->with('error', 'Please login to your account!');
        } else {
            $data = [];
            $id = Auth()->guard('frontend')->user()->id;
            $data['wishlists'] = Wishlist::where('user_id', $id)->where('status', '1')->get();
            $data['total'] = sizeof($data['wishlists']);

            return view('site.wishlist', $data);
        }
    }

    public function add_to_wishlist(Request $request) {
        if ($request->ajax()) {
            $data = [];
            $input = [];
            $id = $request->input('id');
            if (Auth()->guard('frontend')->guest()) {
                $data['status'] = 'failure';
                $data['type'] = 'notlogin';
                $data['link'] = Route('login');
                $request->session()->flash('error', 'Please login to your account!');
            } else {
                $user_id = Auth()->guard('frontend')->user()->id;

                $check = Wishlist::where('user_id', $user_id)->where('course_id', $id)->where('status', '1')->first();
                if (!empty($check)) {
                    $data['status'] = 'failure';
                    $data['msg'] = "This course already in your wishlist.";
                } else {
                    $input['user_id'] = $user_id;
                    $input['course_id'] = $id;
                    $input['status'] = '1';
                    Wishlist::create($input);
                    $data['type'] = 1;
                    $data['status'] = 'success';
                    $data['count'] = Wishlist::where('user_id', $user_id)->whereStatus('1')->count();
                    $data['msg'] = "Successfully added to the wishlist.";
                }
            }

            return response()->json($data);
        }
    }

    public function remove_from_wishlist(Request $request) {
        if ($request->ajax()) {
            $data = [];
            $input = [];

            $user_id = Auth()->guard('frontend')->user()->id;

            $id = $request->input('id');
            $check = Wishlist::where('id', $id)->where('status', '1')->first();
            if (!empty($check)) {
                $check->delete();
                $courses = Wishlist::where('user_id', $user_id)->where('status', '1')->count();

                $data['count'] = $courses;
                if ($courses == 0) {
                    $data['content'] = 'Your wishlist is empty';
                }
                $data['msg'] = "Successfully removed from wishlist.";
                $data['type'] = 1;
            } else {
                $data['type'] = 2;
                $data['msg'] = "Oops!something went wrong.";
            }
            return response()->json($data);
        }
    }

    public function cart() {
        if (Auth()->guard('frontend')->guest()) {
            return redirect()->route('login')->with('error', 'Please login to your account!');
        } else {
            $data = [];
            $id = Auth()->guard('frontend')->user()->id;
            $data['carts'] = Cart::where('user_id', $id)->where('status', '1')->get();
            return view('site.cart', $data);
        }
    }

    public function add_to_cart(Request $request) {
        if ($request->ajax()) {
            $data = [];
            $input = [];
            $id = $request->input('id');

            if (Auth()->guard('frontend')->guest()) {
                $data['status'] = 'failure';
                $data['type'] = 'notlogin';
                $data['link'] = Route('login');
                $request->session()->flash('error', 'Please login to your account!');
            } else {

                $user_id = Auth()->guard('frontend')->user()->id;
                $assign_course = AssignCourse::where('user_id', $user_id)->where('course_id', $id)->first();
                
                if (!empty($assign_course)) {
                    $data['status'] = 'failure';
                    $data['msg'] = "You have already purchased this course.";
                } else {
                    $check = Cart::where('user_id', $user_id)->where('course_id', $id)->where('status', '1')->first();
                    if (!empty($check)) {
                        $data['status'] = 'failure';
                        $data['msg'] = "This course already in your cart.";
                    } else {

                        $input['user_id'] = $user_id;
                        $input['course_id'] = $id;
                        $input['status'] = '1';
                        Cart::create($input);
                        $data['type'] = 1;
                        $data['status'] = 'success';
                        $data['count'] = Cart::where('user_id', $user_id)->whereStatus('1')->count();
                        $data['msg'] = "Successfully added to the cart.";
                    }
                }
            }

            return response()->json($data);
        }
    }

    public function remove_from_cart(Request $request) {
        if ($request->ajax()) {
            $data = [];
            $input = [];

            $user_id = Auth()->guard('frontend')->user()->id;

            $id = $request->input('id');
            $check = Cart::where('id', $id)->where('status', '1')->first();
            if (!empty($check)) {
                $check->delete();
                $courses = Cart::where('user_id', $user_id)->where('status', '1')->count();

                $data['count'] = $courses;
                if ($courses == 0) {
                    $data['content'] = 'Your Cart is empty';
                }
                $data['msg'] = "Successfully removed from Cart.";
                $data['type'] = 1;
            } else {
                $data['type'] = 2;
                $data['msg'] = "Oops!something went wrong.";
            }
            return response()->json($data);
        }
    }
    public function buy_now(Request $request) {
        if ($request->ajax()) {
            $data = [];
            $input = [];
            $id = $request->input('id');

            if (Auth()->guard('frontend')->guest()) {
                $data['status'] = 'failure';
                $data['type'] = 'notlogin';
                $data['link'] = Route('signup');
                $request->session()->flash('error', 'Please signup to continue!');
            } else {

                $user_id = Auth()->guard('frontend')->user()->id;
                $assign_course = AssignCourse::where('user_id', $user_id)->where('course_id', $id)->first();
                
                if (!empty($assign_course)) {
                    $data['status'] = 'failure';
                    $data['msg'] = "You have already purchased this course.";
                } else {
                    $check = Cart::where('user_id', $user_id)->where('course_id', $id)->where('status', '1')->first();
                    if (!empty($check)) {
                        $data['status'] = 'failure';
                        $data['msg'] = "This course already in your cart.";
                    } else {

                        $input['user_id'] = $user_id;
                        $input['course_id'] = $id;
                        $input['status'] = '1';
                        Cart::create($input);
                        $data['type'] = 1;
                        $data['status'] = 'success';
                        $data['link'] = Route('cart');
                        $data['count'] = Cart::where('user_id', $user_id)->whereStatus('1')->count();
                        $data['msg'] = "Successfully added to the cart.";
                    }
                }
            }

            return response()->json($data);
        }
    }

    public function checkout() {
        if (Auth()->guard('frontend')->guest()) {
            return redirect()->route('login')->with('error', 'Please login to your account!');
        } else {
            $data = [];
            
            $user_id = Auth()->guard('frontend')->user()->id;
            $data['carts'] = $carts = Cart::where(['user_id' => $user_id, 'status' => '1'])->get();
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
            if (!sizeof($carts) > 0) {
                return redirect()->route('cart')->with('error', 'No product added to cart!');
            }
            $total = 0;
            foreach ($carts as $cart) {
                $total += ($cart->course->price);
            }
            $data['totalprice'] = $total;
            // print_r('5');exit;
            return view('site.checkout', $data);
        }
    }

    public function post_checkout(CheckoutRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            $amount = 0;

            $data_msg['amount'] = '00';

            $data_msg['msg'] = "purschase Course.";
            return response()->json($data_msg);
        }
    }

    public function apply_coupon(CouponRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            $amount = 0;

            $details = Package::findOrFail($input['package_id']);
            $detailsprice = $this->convertprice($details->price);
            $coupon = Coupon::where('coupon_id', $input['coupon_code'])->where('status', '1')->first();
            $couponamount = $this->convertprice($coupon->amount);
            $price = $detailsprice - $couponamount;

            $data_msg['amount'] = $price;
            $data_msg['coupon'] = $coupon->coupon_id;

            $data_msg['msg'] = "Coupon applied successfully.";
            return response()->json($data_msg);
        }
    }

    public function post_subscribers(SubscribersRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $admin_email = UserMaster::where('type_id', '=', '1')->first();
            $input = [];
            $input['email'] = $request->input('subscribe_email');
            $contact = Subscriber::create($input);

            // if (!empty($admin_email)):
            //     $email_setting = $this->get_email_data('contact_us', array('ADMIN' => "Admin", 'NAME' => $contact->name, 'EMAIL' => $contact->email, 'SUBJECT' => $contact->subject,
            //         'PHONE' => ($contact->phone != "") ? $contact->phone : 'Not Provided', 'MESSAGE' => $contact->message));
            //     $email_data = [
            //         'to' => $admin_email->email,
            //         'subject' => $email_setting['subject'],
            //         'template' => 'signup',
            //         'data' => ['message' => $email_setting['body']]
            //     ];
            //     $this->SendMail($email_data);
            // endif;

            $data_msg['msg'] = 'Thank you for subscribe us. We will Contact you soon.';
            return response()->json($data_msg);
        }
    }
    public function delete_examdata_cron(Request $request) {
        $data = [];
        $model=Exam::where('course_id','0')->delete();
        print_r($model.' data deleted');
        exit;
    }

}

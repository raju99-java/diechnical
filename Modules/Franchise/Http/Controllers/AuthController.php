<?php

namespace Modules\Franchise\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Model\UserMaster;
use App\Model\Franchise;
use App\Model\Settings;
use App\Model\UserType;
use App\Model\LoginHistory;

class AuthController extends FranchiseController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function get_login() {
        $data = [];

        return view('franchise::auth.login', $data);
    }

    public function post_login(Request $request) {
        

        $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'password' => 'required|min:6'
        ]);

        if ($validator->passes()) {
            $model = Franchise::where('email', $request->input('email'))->first();


            if ($model) {
                
                if($model->status == '1'){
                    if (Hash::check($request->password, $model->password)) {
                        Auth::guard('franchise')->login($model);
    
                        $ip = $this->get_user_ip();
    
                     
    
    
                        return redirect()->route('franchise-dashboard')->with('success_msg', 'You have successfully login');
                    } else {
                        return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Login Failed!! Please check your credentials');
                    }
                } else if($model->status == '0'){
                    return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Your account inactive, contact to Admin !');
                } else if($model->status == '2'){
                    return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Your account temporary block !');
                } else if($model->status == '3'){
                    return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Your account will be deleted !');
                }
                
            } else {
                return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Login Failed!! Please check your credentials');
            }
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Login Failed!! Please check the below error');
        }
    }

    public function logout() {
        $ip = $this->get_user_ip();
        $login = new LoginHistory();
        $login->user_master_id = Auth()->guard('franchise')->user()->id;
        $login->type = 'logout';
        $login->ip = $ip;
        $login->created_at = date('Y-m-d H:i:s');
        $login->save();
        Auth::guard('franchise')->logout();
        return redirect('franchise/franchise-login')->with('success_msg', 'You have been successfully logout !!');
    }

    /* public function logout() {
      if (isset($_GET['type']) && $_GET['type'] == "lock") {
      $user = Auth()->guard('backend')->user();
      $expire = time() + 3600;
      setcookie('admin_email_lock', $user->email, $expire);
      Auth::guard('backend')->logout();
      return redirect('franchise/franchise-lockscreen');
      } else {
      Auth::guard('backend')->logout();
      return redirect('franchise/franchise-login')->with('success', 'You are successfully logged out.');
      }
      } */

    // public function post_forgot_passwords(Request $request) {
    //     if ($request->ajax()) {
    //         $data_msg = [];
    //         $validator = Validator::make($request->all(), [
    //                     'email' => 'required|email',
    //         ]);
    //         $validator->after(function($validator)use ($request) {
    //             $checkUser = UserMaster::where('type_id', '=', '1')->where('email', '=', $request->input('email'))->where('status', '=', '1')->first();
    //             if (count($checkUser) == 0) {
    //                 $validator->errors()->add('email', 'We could not find the email that you are looking for.');
    //             }
    //         });
    //         if ($validator->passes()) {
    //             $model = UserMaster::where('type_id', '=', '1')->where('email', '=', $request->input('email'))->where('status', '=', '1')->first();
    //             $password = $this->rand_string(8);
    //             $name = $model->first_name . ' ' . $model->last_name;
    //             $model->password = Hash::make($password);
    //             $model->save();
    //             $email_setting = $this->get_email_data('admin_forgot_password', array('NAME' => $name, 'NEW_PASSWORD' => $password));
    //             $email_data = [
    //                 'to' => $model->email,
    //                 'subject' => $email_setting['subject'],
    //                 'template' => 'admin_forgot_password',
    //                 'data' => ['message' => $email_setting['body']]
    //             ];
    //             $this->SendMail($email_data);
    //             $request->session()->flash('success', 'We have sent a new password to your email. Please check it.');
    //             $data_msg['type'] = 'success';
    //         } else {
    //             $error_arr = $validator->errors()->getMessages();
    //             foreach ($error_arr as $key => $val) {
    //                 if (isset($val[0]) && $val[0] != "") {
    //                     $data_msg['error'][$key] = $val[0];
    //                 }
    //             }
    //             $data_msg['type'] = "failure";
    //         }
    //         return response()->json($data_msg);
    //     }
    // }
    public function get_forgot_password() {
        $data = [];
        return view('franchise::auth.forgot-one', $data);
    }

    public function post_forgot_password(Request $request) {
        $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
        ]);

        if ($validator->passes()) {
            $model = Franchise::where('email', $request->input('email'))
                    ->where('status', '1')
                    ->first();

            if ($model) {

                $input = [];
                $input['reset_password_token'] = $this->rand_string(20);
                $model->update($input);
    
                $link = Route('franchise-reset-password', ['id' => base64_encode($model->id), 'token' => $model->reset_password_token]);
    
                $email_setting = $this->get_email_data('forgot_password', array('NAME' => $model->name, 'EMAIL' => $request->input('email'), 'LINK' => $link));
    
                $email_data = [
                    'to' => $model->email,
                    'subject' => $email_setting['subject'],
                    'template' => 'signup',
                    'data' => ['message' => $email_setting['body']]
                ];
                $this->SendMail($email_data);

                 


                    return redirect()->back()->with('success_msg', 'Your reset password link has been sent to your email.'); 
            } else {
                return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'We could not find the email that you are looking for.');
            }
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong!!.');
        }
        
    }

    public function get_reset_password($id, $token) {
        if ($id === "" && $token === "") {
            return redirect()->route('/')->with('error', 'oops! Something went wrong in this url.');
        }
        $id = base64_decode($id);
        $model = Franchise::where('id', $id)->where('reset_password_token', $token)->first();
        if (empty($model))
            return redirect()->route('/')->with('error', 'oops! Something went wrong in this url.');
        else {
            Session::put('franchise_id', $id);
            Session::put('franchise_forgot_token', $token);
            $data = [];
            return view('franchise::auth.forgot-two', $data);
        }
    }

    public function post_reset_password(Request $request) {
        $validator = Validator::make($request->all(), [
                    'password' => 'required|min:6',
                    'retype_password' => 'required|same:password',
        ]);

        if ($validator->passes()) {
            $user_id = Session::get('franchise_id');
            $forgot_token = Session::get('franchise_forgot_token');
            $model = Franchise::where([['id', '=', $user_id], ['reset_password_token', '=', $forgot_token]])->first();
            
            if ($model) {

                $input = [];
    
                $input['password'] = Hash::make($request->input('password'));
    
                $input['reset_password_token'] = NULL;
                $model->update($input);
                Session::remove('franchise_id');
                Session::remove('franchise_forgot_token');
                
                return redirect()->route('franchise-login')->with('success_msg', 'Your password changed successfully.'); 
            } else {
                return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Franchise Not Found.');
            }
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong!!.');
        }
        
    }

    public function get_lockscreen() {
        if (!Auth()->guard('backend')->guest()) {
            return redirect('franchise/franchise-dashboard');
        }
        if (isset($_COOKIE['admin_email_lock']) && $_COOKIE['admin_email_lock'] != "") {
            $model = UserMaster::where('email', $_COOKIE['admin_email_lock'])
                    ->where('type_id', '1')
                    ->where('status', '1')
                    ->first();
            return view('franchise::auth.lock_screen', ['admin_model' => $model]);
        } else {
            return redirect('franchise/franchise-login');
        }
    }

    public function post_lockscreen(Request $request) {
        $validator = Validator::make($request->all(), [
                    'password' => 'required'
        ]);
        if ($request->input('password') != "") {
            $model = UserMaster::where('email', $_COOKIE['admin_email_lock'])
                    ->where('type_id', '1')
                    ->where('status', '1')
                    ->first();
            if (!Hash::check($request->input('password'), $model->password)) {
                $validator->after(function($validator) {
                    $validator->errors()->add('password', 'Incorrect Password!');
                });
            }
        }
        if ($validator->passes()) {
            Auth::guard('backend')->login($model);
            $expire = time() - 3600;
            setcookie('admin_email_lock', '', $expire);
            return redirect('franchise/franchise-dashboard')->with('success', 'You are successfully unlocked.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('danger', 'Incorrect Password!');
        }
    }

}

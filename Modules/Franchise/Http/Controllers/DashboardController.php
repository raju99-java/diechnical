<?php

namespace Modules\Franchise\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use Validator;
use App\Model\UserMaster;
use App\Model\Franchise;
use App\Model\Exam;
use App\Model\AssignCourse;
use App\Model\Course;
use App\Model\Plan;
use App\Model\WalletHistory;
use Hash;

class DashboardController extends FranchiseController {

    public function index() {
        $data_msg = [];
        $id=Auth()->guard('franchise')->user()->id;
        
        $data_msg['total_student'] = UserMaster::where('type_id', '2')->where('franchise_id',$id)->where('status','<>','3')->count();
        $data_msg['total_course_purchase'] = AssignCourse::count();
        $data_msg['total_certificate_generate'] = Franchise::where('id',$id)->where('status', '1')->count();
        $data_msg['total_exam_data'] = Exam::join('user_master','user_master.id','=','exams.user_id')->where('user_master.franchise_id', '=', $id)->where('exams.course_id','<>','0')->count();
        $data_msg['total_course'] = Course::where('created_by',$id)->count();
        $data_msg['franchise'] = Franchise::where('id',$id)->where('status', '1')->first();
        $data_msg['plans'] = Plan::where('status', '1')->get();
        $data_msg['total_wallet_history'] = WalletHistory::where('franchise_id',$id)->count();
        
        return view('franchise::dashboard.dashboard', $data_msg);
    }

    public function get_profile() {
        $model = Franchise::find(Auth()->guard('franchise')->user()->id);
        
        return view('franchise::dashboard.profile', ['model' => $model]);
    }

    public function post_profile(Request $request) {
        $validator = Validator::make($request->all(), [
                    'owner_name' => 'required',
                    'email' => 'required|email',
        ]);
        $validator->after(function($validator)use ($request) {
            $other_user = Franchise::where('email', $request->input('email'))->where('status', '1')->where('id', '<>', Auth()->guard('franchise')->user()->id)->get();
            if ($other_user && count($other_user) > 0) {
                $validator->errors()->add('email', 'Email id already in use.');
            }
        });
        if ($validator->passes()) {
            $model = Franchise::find(Auth()->guard('franchise')->user()->id);
            $model->owner_name = $request->input('owner_name');
            $model->email = $request->input('email');
            $model->save();
            $request->session()->flash('success_msg', 'Profile updated successfully.');
        }
        return redirect()->route('franchise-profile')->withErrors($validator)->withInput();
    }

    public function get_change_password() {
        $model = Franchise::find(Auth()->guard('franchise')->user()->id);
        
        return view('franchise::dashboard.change_password', ['model' => $model]);
    }

    public function post_change_password(Request $request) {
        $validator = Validator::make($request->all(), [
                    'current_password' => 'required',
                    'password' => 'required|min:6|max:16|regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
                    'confirm_password' => 'required|same:password',
                        ], [
                    'password.regex' => 'Password must contain at-least 1 capital letter, 1 small letter and 1 number.'
        ]);
        $validator->after(function($validator)use ($request) {
            $other_user = Franchise::where('id', Auth()->guard('franchise')->user()->id)->first();
            if (Hash::check($request->input('current_password'), $other_user->password) == false) {
                $validator->errors()->add('current_password', 'Your current password does not match.');
            }
        });
        if ($validator->passes()) {
            $model = Franchise::find(Auth()->guard('franchise')->user()->id);
            $model->password = Hash::make($request->input('password'));
            $model->save();
            $request->session()->flash('success_msg', 'Password updated successfully.');
        }
        return redirect()->route('franchise-change-password')->withErrors($validator)->withInput();
    }

    public function get_change_image() {
        
        $model = Franchise::where('id', Auth::guard('franchise')->id())->first();
        return view('franchise::dashboard.change_image', ['model' => $model]);
    }

    public function post_change_image(Request $request) {
        $validator = Validator::make($request->all(), [
                    'owner_image' => 'required|mimes:png,jpeg,jpg,JPEG,gif'
        ]);
        if ($validator->passes()) {
            $model = Franchise::where('id', Auth::guard('franchise')->id())->first();
            if ($request->hasFile('owner_image')) {
                $sample_image = $request->file('owner_image');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $model->owner_image = $imagename;
            }
            $model->save();
            return redirect()->route('franchise-user-change-image')->with('success_msg', 'Profile image updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }
    
    
    public function get_sign_image() {
        
        $model = Franchise::where('id', Auth::guard('franchise')->id())->first();
        return view('franchise::dashboard.sign_image', ['model' => $model]);
    }
    
    public function post_sign_image(Request $request) {
        $validator = Validator::make($request->all(), [
                    'owner_sign' => 'required|mimes:png,jpeg,jpg,JPEG,gif'
        ]);
        if ($validator->passes()) {
            $model = Franchise::where('id', Auth::guard('franchise')->id())->first();
            if ($request->hasFile('owner_sign')) {
                $sample_image = $request->file('owner_sign');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/sign');
                $sample_image->move($destinationPath, $imagename);
                $model->owner_sign = $imagename;
            }
            $model->save();
            return redirect()->route('franchise-user-sign-image')->with('success_msg', 'Signature uploaded successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

}

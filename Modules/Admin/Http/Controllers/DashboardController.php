<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Model\UserMaster;
use App\Model\Exam;
use App\Model\AssignCourse;
use App\Model\Course;
use App\Model\Enquiry;
use App\Model\Franchise;
use App\Model\WalletHistory;
use Hash;

class DashboardController extends AdminController {

    public function index() {
        $data_msg = [];
        $data_msg['total_student'] = UserMaster::where('type_id', '2')->where('status','<>','3')->where('franchise_id','=','0')->count();
        $data_msg['total_course_purchase'] = AssignCourse::count();
        $data_msg['total_certificate_generate'] = Exam::where('status', '1')->where('admin_marks_submit','1')->count();
        $data_msg['total_exam_data'] = Exam::count();
        $data_msg['total_franchise'] = Franchise::where('status','<>','3')->count();
        $data_msg['total_course'] = Course::where('created_by','=','0')->count();
        $data_msg['total_franchise_course'] = Course::where('created_by','<>','0')->count();
        $data_msg['total_franchise_student'] = UserMaster::where('type_id', '2')->where('status','<>','3')->where('franchise_id','<>','0')->count();
        $data_msg['franchise_exam_data'] = Exam::select('exams.*')->join('user_master','user_master.id','=','exams.user_id')->where('user_master.franchise_id', '<>', '0')->where('exams.course_id','<>','0')->count();
        $data_msg['total_enquiry'] = Enquiry::count();
        $data_msg['total_wallet_history'] = WalletHistory::count();
        return view('admin::dashboard.dashboard', $data_msg);
    }

    public function get_profile() {
        $model = UserMaster::find(Auth()->guard('backend')->user()->id);
        return view('admin::dashboard.profile', ['model' => $model]);
    }

    public function post_profile(Request $request) {
        $validator = Validator::make($request->all(), [
                    'full_name' => 'required',
                    'email' => 'required|email',
        ]);
        $validator->after(function($validator)use ($request) {
            $other_user = UserMaster::where('email', $request->input('email'))->where('status', '<>', 3)->where('id', '<>', Auth()->guard('backend')->user()->id)->get();
            if ($other_user && count($other_user) > 0) {
                $validator->errors()->add('email', 'Email id already in use.');
            }
        });
        if ($validator->passes()) {
            $model = UserMaster::find(Auth()->guard('backend')->user()->id);
            $model->full_name = $request->input('full_name');
            $model->email = $request->input('email');
            $model->save();
            $request->session()->flash('success_msg', 'Profile updated successfully.');
        }
        return redirect()->route('admin-profile')->withErrors($validator)->withInput();
    }

    public function get_change_password() {
        $model = UserMaster::find(Auth()->guard('backend')->user()->id);
        return view('admin::dashboard.change_password', ['model' => $model]);
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
            $other_user = UserMaster::where('id', Auth()->guard('backend')->user()->id)->first();
            if (Hash::check($request->input('current_password'), $other_user->password) == false) {
                $validator->errors()->add('current_password', 'Your current password does not match.');
            }
        });
        if ($validator->passes()) {
            $model = UserMaster::find(Auth()->guard('backend')->user()->id);
            $model->password = Hash::make($request->input('password'));
            $model->save();
            $request->session()->flash('success_msg', 'Password updated successfully.');
        }
        return redirect()->route('admin-change-password')->withErrors($validator)->withInput();
    }

    public function get_change_image() {
        $model = UserMaster::where('id', Auth::guard('backend')->id())->first();
        return view('admin::dashboard.change_image', ['model' => $model]);
    }

    public function post_change_image(Request $request) {
        $validator = Validator::make($request->all(), [
                    'image' => 'required|mimes:png,jpeg,jpg,JPEG,gif'
        ]);
        if ($validator->passes()) {
            $model = UserMaster::where('id', Auth::guard('backend')->id())->first();
            if ($request->hasFile('image')) {
                $sample_image = $request->file('image');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $model->image = $imagename;
            }
            $model->save();
            return redirect()->route('user-change-image')->with('success_msg', 'Profile image updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }
    
    public function get_center_incharge_image() {
        $model = UserMaster::where('id', Auth::guard('backend')->id())->first();
        return view('admin::dashboard.center_image', ['model' => $model]);
    }
    
     public function post_center_incharge_image(Request $request) {
        $validator = Validator::make($request->all(), [
                    'center_incharge_image' => 'required|mimes:png,jpeg,jpg,JPEG,gif'
        ]);
        if ($validator->passes()) {
            $model = UserMaster::where('id', Auth::guard('backend')->id())->first();
            if ($request->hasFile('center_incharge_image')) {
                $sample_image = $request->file('center_incharge_image');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/sign');
                $sample_image->move($destinationPath, $imagename);
                $model->center_incharge_image = $imagename;
            }
            $model->save();
            return redirect()->route('center-incharge-image')->with('success_msg', 'Center Incharge image uploaded successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

}

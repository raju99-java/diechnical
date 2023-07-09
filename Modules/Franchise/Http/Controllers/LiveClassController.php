<?php

namespace Modules\Franchise\Http\Controllers;

use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Validator;
use URL;
use Carbon\Carbon;
use App\Model\QuestionAnswer;
use App\Model\CourseModule;
use App\Model\Course;
use App\Model\LiveClass;
use App\Model\CourseModuleVideo;
use App\Model\AssignCourse;
use App\Model\UserMaster;
use App\Model\Settings;

class LiveClassController extends FranchiseController {

    //*** JSON Request
    public function datatable() {
        $fid=Auth()->guard('franchise')->user()->id;
        $datas = LiveClass::select('live_class.*')->join('courses','courses.id','=','live_class.course_id')->where('courses.created_by','=','0')->where('live_class.franchise_id',$fid)->orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('course_name', function($model) {
                            $name = $model->course->name;
                            return $name;
                        })
                        ->editColumn('subject', function ($model) {
                            
                            return $model->subject;
                        })
                        ->editColumn('date_time', function ($model) {
                            return !empty($model->date) || !empty($model->time) ? date('jS M Y', strtotime($model->date))."-".date('g:i A', strtotime($model->time)) : '';
                        })
                        ->addColumn('action', function ($model) {
                            return
                                    '<a href="javascript:;" onclick="deleteLiveClassLink(this);" data-href="' . Route("course-live-class-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['course_name','subject','date_time', 'action'])
                        ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function live_class() {
        return view('franchise::live_class.list');
    }

    //*** GET Request
    public function get_add_live_class() {
        $data = [];
        $data['courses'] = Course::where('created_by','=','0')->where('status','=','1')->get();
        return view('franchise::live_class.add',$data);
    }

    //*** POST Request
    public function store(Request $request) {
         $validator = Validator::make($request->all(), [
                    'course_id' => 'required',
                    'subject' => 'required',
                    'link' => 'required',
                    'time' => 'required',
                    'date' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Logic Section
            $fid=Auth()->guard('franchise')->user()->id;
            $data = new LiveClass();
            $input = $request->all();
            // print_r($input);
            $input['franchise_id'] = $fid;
            $data->fill($input)->save();
            
            $course = Course::findOrFail($data->course_id);
            $users = UserMaster::select('user_master.*')->join('assign_course','assign_course.user_id','=','user_master.id')->where('assign_course.course_id',$data->course_id)->where('assign_course.status','<>','1')->get();
            
            
            // foreach($users as $user){
            //       $email_setting = $this->get_email_data('live_class', array('NAME' => $user->full_name, 'COURSE' => $course->name, 'DATE'=>$data->date,'TIME'=>$data->time,'LINK'=> $data->link));
            //         $email_data = [
            //             'to' => $user->email,
            //             'subject' => $email_setting['subject'],
            //             'template' => 'signup',
            //             'data' => ['message' => $email_setting['body']]
            //         ];
            //         $this->SendMail($email_data);
            // }
            
            return redirect()->route('course-live-class-list')->with('success_msg', 'Create Successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

   
    
    public function destroy($id) {
        $data = [];
        $model = LiveClass::findOrFail($id);
        
        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }

}
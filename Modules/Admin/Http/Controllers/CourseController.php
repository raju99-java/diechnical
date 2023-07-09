<?php

namespace Modules\Admin\Http\Controllers;

use Datatables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Validator;
use URL;
use Carbon\Carbon;
use App\Model\QuestionAnswer;
use App\Model\CourseModule;
use App\Model\CourseModuleVideo;
use App\Model\LiveClass;
use App\Model\Course;
use App\Model\AssignCourse;
use App\Model\UserMaster;
use App\Model\Settings;

class CourseController extends AdminController {

    //*** JSON Request
    public function datatables() {
        $datas = Course::orderBy('id', 'desc')->where('created_by','=','0')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('image', function(Course $data) {
                            $photo = isset($data->image)? URL::asset('public/uploads/course/' . $data->image) : URL::asset('public/backend/no-image.png');
                            return '<img src="' . $photo . '" alt="Image" height="60" width="60">';
                        })
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Active</span>';
                            } else if ($model->status == '3') {
                                $status = '<span class="badge badge-danger"><i class="icofont-close"></i>Delete</span>';
                            }
                            return $status;
                        })
                        ->editColumn('featured', function ($model) {
                            if ($model->featured == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>No</span>';
                            } else if ($model->featured == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Yes</span>';
                            }
                            return $status;
                        })
                        ->addColumn('action', function ($model) {
                            return
                                    '<a href="' . Route("admin-course-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteCourse(this);" data-href="' . Route("admin-course-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>'.
                                    '<a href="' . Route("admin-course-question-answer", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Question & Answer</a>'.
                                    '<a href="' . Route("admin-course-module", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Modules</a>'.
                                    '<a href="' . Route("admin-course-live-class-list", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="icofont-video"></i> Live Class</a>';
                        })
                        ->rawColumns(['image','featured','status', 'action'])
                        ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index() {
        return view('admin::course.list');
    }

    //*** GET Request
    public function create() {
        return view('admin::course.add');
    }

    //*** POST Request
    public function store(Request $request) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'no_of_reviews' => 'required',
                    'students_enrolled' => 'required',
                    'time' => 'required',
                    'image' => 'required|mimes:jpeg,jpg,png,svg',
                    'video' => 'required|mimes:mp4,mov,ogg',
                    'price' => 'required|numeric',
                    'short_description' => 'required',
                    'long_description' => 'required',
                    'exam_status'=> 'required',
                    'featured' => 'required',
                    'live' => 'required',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });

        if ($validator->passes()) {
            $data = new Course();
            $input = $request->all();
            if ($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/course');
                $file->move($destinationPath, $name);
                $input['image'] = $name;
            }
            if ($file = $request->file('video')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/course');
                $file->move($destinationPath, $name);
                $input['video'] = $name;
            }
            
            $data->fill($input)->save();

            return redirect()->route('admin-course-index')->with('success_msg', 'Course created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    //*** GET Request
    public function edit($id) {
        $data = Course::findOrFail($id);
        return view('admin::course.edit', compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'no_of_reviews' => 'required',
                    'students_enrolled' => 'required',
                    'time' => 'required',
                    'image' => 'nullable|mimes:jpeg,jpg,png,svg',
                    'video' => 'nullable|mimes:mp4,mov,ogg',
                    'price' => 'required|numeric',
                    'short_description' => 'required',
                    'long_description' => 'required',
                    'exam_status'=> 'required',
                    'featured' => 'required',
                    'live' => 'required',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Logic Section
            $data = Course::findOrFail($id);
            $input = $request->all();
            if ($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/course');
                $file->move($destinationPath, $name);
                $input['image'] = $name;
            }
            if ($file = $request->file('video')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/course');
                $file->move($destinationPath, $name);
                $input['video'] = $name;
            }

            $data->update($input);
            
            return redirect()->route('admin-course-index')->with('success_msg', 'Course updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends
    }

    //*** GET Request Status
    public function status($id1, $id2) {
        $data = Course::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }

    //*** GET Request Delete
    public function destroy($id) {
        $data = [];
        $model = Course::findOrFail($id);
        
        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }
    public function question_answer_datatables($id) {
        $datas = QuestionAnswer::where('course',$id)->orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('question', function(QuestionAnswer $data) {
                            return strip_tags($data->question);
                        })
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Active</span>';
                            } else if ($model->status == '3') {
                                $status = '<span class="badge badge-danger"><i class="icofont-close"></i>Delete</span>';
                            }
                            return $status;
                        })
                        ->editColumn('course', function ($model) {
                            $course= Course::where('id',$model->course)->first();
                            
                            
                            return !empty($course)?$course->name:'Not Available';
                        })
                        ->editColumn('created_at', function ($model) {
                                return (!empty($model->created_at)) ? \Carbon\Carbon::parse($model->created_at)->format('d-m-Y H:i A') : 'Not Found';
                        })
                        ->addColumn('action', function ($model) {
                            return
                                    '<a href="' . Route("admin-question-answer-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteQuestionAnswer(this);" data-href="' . Route("admin-question-answer-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['photo', 'status', 'action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function question_answer($id) {
        return view('admin::course.question_answer_list', compact('id'));
    }
    public function module_datatables($id) {
        $datas = CourseModule::where('course_id',$id)->orderBy('id', 'asc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('name', function($data) {
                            return $data->name;
                        })
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Active</span>';
                            } else if ($model->status == '3') {
                                $status = '<span class="badge badge-danger"><i class="icofont-close"></i>Delete</span>';
                            }
                            return $status;
                        })
                        ->editColumn('created_at', function ($model) {
                                return (!empty($model->created_at)) ? \Carbon\Carbon::parse($model->created_at)->format('d-m-Y H:i A') : 'Not Found';
                        })
                        ->addColumn('action', function ($model) {
                            return
                                    '<a href="' . Route("admin-course-module-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="' . Route("admin-course-module-video", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Videos</a>' .
                                    '<a href="javascript:;" onclick="deleteCourseModule(this);" data-href="' . Route("admin-course-module-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['status', 'action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function module($id) {
        $course= Course::where('id', $id)->first();
        return view('admin::course.course_module_list', compact('id','course'));
    }
    public function module_add($id) {
        $course= Course::where('id', $id)->first();
        return view('admin::course.module_add', compact('id','course'));
    }
    public function post_module_add(Request $request,$id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });

        if ($validator->passes()) {
            $data = new CourseModule();
            $input = $request->all();
            $input['course_id']=$id;
            
            $data->fill($input)->save();
            $model = Course::where('id', $id)->first();
            $model->updated_at = Carbon::now()->toDateTimeString();
            $model->save();

            return redirect()->route('admin-course-module', [$id])->with('success_msg', 'Course module created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }
    //*** GET Request
    public function module_edit($id) {
        $data = CourseModule::findOrFail($id);
        return view('admin::course.module_edit', compact('data'));
    }

    //*** POST Request
    public function post_module_edit(Request $request, $id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Logic Section
            $data = CourseModule::findOrFail($id);
            $input = $request->all();
            

            $data->update($input);
            $model = Course::where('id', $data->course_id)->first();
            $model->updated_at = Carbon::now()->toDateTimeString();
            $model->save();
            
            return redirect()->route('admin-course-module', [$data->course_id])->with('success_msg', 'Course module updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends
    }
    public function module_delete($id) {
        $data = [];
        $model = CourseModule::findOrFail($id);
        
        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }
    
    //Module videos
    
    public function module_video_datatables($id) {
        $datas = CourseModuleVideo::where('module_id',$id)->orderBy('id', 'asc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('name', function($data) {
                            return $data->name;
                        })
                        ->editColumn('time', function($data) {
                            return $data->time;
                        })
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Active</span>';
                            } else if ($model->status == '3') {
                                $status = '<span class="badge badge-danger"><i class="icofont-close"></i>Delete</span>';
                            }
                            return $status;
                        })
                        ->editColumn('created_at', function ($model) {
                                return (!empty($model->created_at)) ? \Carbon\Carbon::parse($model->created_at)->format('d-m-Y H:i A') : 'Not Found';
                        })
                        ->addColumn('action', function ($model) {
                            return
                                    '<a href="' . Route("admin-course-module-video-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteCourseModuleVideo(this);" data-href="' . Route("admin-course-module-video-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['status', 'action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function module_video($id) {
        $coursemodule= CourseModule::where('id', $id)->first();
        return view('admin::course.course_module_video_list', compact('id','coursemodule'));
    }
    public function module_video_add($id) {
        $coursemodule= CourseModule::where('id', $id)->first();
        return view('admin::course.module_video_add', compact('id','coursemodule'));
    }
    public function post_module_video_add(Request $request,$id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'time' => 'required',
                    'video' => 'required|mimes:mp4,mov,ogg',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });

        if ($validator->passes()) {
            $data = new CourseModuleVideo();
            $input = $request->all();
            $input['module_id']=$id;
            if ($file = $request->file('video')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/course/video');
                $file->move($destinationPath, $name);
                $input['video'] = $name;
            }
            $data->fill($input)->save();
            $model = Course::where('id', $id)->first();
            $model->updated_at = Carbon::now()->toDateTimeString();
            $model->save();

            return redirect()->route('admin-course-module-video', [$id])->with('success_msg', 'Course module video created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }
    //*** GET Request
    public function module_video_edit($id) {
        $data = CourseModuleVideo::findOrFail($id);
        return view('admin::course.module_video_edit', compact('data'));
    }

    //*** POST Request
    public function post_module_video_edit(Request $request, $id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'time' => 'required',
                    'video' => 'nullable|mimes:mp4,mov,ogg',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Logic Section
            $data = CourseModuleVideo::findOrFail($id);
            $input = $request->all();
            if ($file = $request->file('video')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/course/video');
                $file->move($destinationPath, $name);
                $input['video'] = $name;
            }

            $data->update($input);
            $model = Course::where('id', $data->course_id)->first();
            $model->updated_at = Carbon::now()->toDateTimeString();
            $model->save();
            
            return redirect()->route('admin-course-module-video', [$data->module_id])->with('success_msg', 'Course module video updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends
    }
    public function module_video_delete($id) {
        $data = [];
        $model = CourseModuleVideo::findOrFail($id);
        //If Photo Doesn't Exist
        if ($model->video == null) {
            $model->delete();
            //--- Redirect Section     
            $data['status'] = 200;
            $data['msg'] = 'Data Deleted Successfully.';
            return response()->json($data);
            //--- Redirect Section Ends     
        }
        //If Photo Exist
        if (isset($model->video))
            if (file_exists(public_path('uploads/course/video' . $model->video))) {
                unlink(public_path('uploads/course/video' . $model->video));
            }
        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }
    
    public function live_class_data($id){
        
        $datas = LiveClass::where('franchise_id','=','0')->where('course_id',$id)->orderBy('id', 'asc')->get();
        // print_r($datas);
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('subject', function($data) {
                            return $data->subject;
                        })
                        ->editColumn('link', function($data) {
                            return $data->link;
                        })
                        ->editColumn('date', function($data) {
                            return $data->date;
                        })
                        ->editColumn('time', function($data) {
                            return $data->time;
                        })
                        ->addColumn('action', function ($model) {
                            return
                                    '<a href="javascript:;" onclick="deleteAdminLiveClass(this);" data-href="' . Route("admin-course-live-class-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['subject', 'link','date','time','action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }
    
    public function live_class_list($id){
        $data = Course::findOrFail($id);
        return view('admin::course.live_class_list', compact('data','id'));
    }
    
    public function get_live_class(Request $request, $id){
        $data = Course::findOrFail($id);
        return view('admin::course.live_class', compact('data'));
    }
    
    public function post_live_class(Request $request, $id){
        $validator = Validator::make($request->all(), [
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
            $data = new LiveClass();
            $input = $request->all();
            // print_r($input);
            $input['franchise_id'] = '0';
            $data->fill($input)->save();
            
            $course = Course::findOrFail($data->course_id);
            $users = UserMaster::select('user_master.*')->join('assign_course','assign_course.user_id','=','user_master.id')->where('assign_course.course_id',$data->course_id)->where('assign_course.status','<>','1')->get();
            
            
            foreach($users as $user){
                  $email_setting = $this->get_email_data('live_class', array('NAME' => $user->full_name, 'COURSE' => $course->name, 'DATE'=>$data->date,'TIME'=>$data->time,'LINK'=> $data->link));
                    $email_data = [
                        'to' => $user->email,
                        'subject' => $email_setting['subject'],
                        'template' => 'signup',
                        'data' => ['message' => $email_setting['body']]
                    ];
                    $this->SendMail($email_data);
            }
            
            return redirect()->route('admin-course-live-class-list',$id)->with('success_msg', 'Create Successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }
    
    public function delete_live_class($id) {
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

<?php

namespace Modules\Admin\Http\Controllers;

use Datatables;
use App\Model\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use URL;
use Carbon\Carbon;
use App\Model\QuestionAnswer;
use App\Model\CourseModule;
use App\Model\CourseModuleVideo;
use App\Model\Franchise;
class FranchiseCourseController extends AdminController {

    //*** JSON Request
    public function datatables() {
        
        $datas = Course::orderBy('id', 'desc')->where('created_by','<>','0')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('image', function(Course $data) {
                            $photo = isset($data->image)? URL::asset('public/uploads/course/' . $data->image) : URL::asset('public/backend/no-image.png');
                            return '<img src="' . $photo . '" alt="Image" height="60" width="60">';
                        })
                        ->editColumn('live', function ($model) {
                            if ($model->live == '0') {
                                $live = '<span class="badge badge-danger"><i class="icofont-close"></i> Not Live</span>';
                            } else {
                                $live = '<span class="badge badge-success"><i class="icofont-check"></i> Live</span>';
                            }
                            return $live;
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
                        ->editColumn('created_by', function ($model) {
                             $franchise = Franchise::where('id',$model->created_by)->first();
                             return $franchise->name;
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
                                    '<a href="' . Route("franchise-course-list-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteFranchiseCourse(this);" data-href="' . Route("franchise-course-list-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>'.
                                    '<a href="' . Route("franchise-course-ques-ans", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Question & Answer</a>'.
                                    '<a href="' . Route("franchise-course-module-list", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Modules</a>';
                        })
                        ->rawColumns(['image','created_by','featured','live','status', 'action'])
                        ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index() {
        return view('admin::franchisecourse.list');
    }

   

    //*** GET Request
    public function edit($id) {
        $data = Course::findOrFail($id);
        return view('admin::franchisecourse.edit', compact('data'));
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
                    'featured' => 'required',
                    'exam_status' => 'required',
                    'live' => 'required',
                    'status' => 'required'
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Logic Section
            $data = Course::findOrFail($id);
            $input = $request->all();
            // $input['status'] = '0';
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
            
            return redirect()->route('franchise-course-list-index')->with('success_msg', 'Course updated successfully.');
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
        $data['msg'] = 'Franchise Course Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }
  //****** end of course ******  
    
    
    
  // ******** start course question answer
  
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
                                    '<a href="' . Route("franchise-course-ques-ans-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteFranchiseQuestionAnswer(this);" data-href="' . Route("franchise-course-ques-ans-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['photo', 'status', 'action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function question_answer($id) {
        return view('admin::franchisecourse.question_answer_list', compact('id'));
    }
    
    
    
    //*** GET Request
    public function edit_question($id) {
        $datas=[];
        $datas['data'] = $ques = QuestionAnswer::findOrFail($id);
        $datas['course'] = Course::where('id',$ques->course)->first();
        return view('admin::franchisecourse.question_answer_edit', $datas);
    }

    //*** POST Request
    public function update_question(Request $request, $id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'course' => 'required',
                    'question' => 'required',
                    'option1' => 'required',
                    'option2' => 'required',
                    'option3' => 'required',
                    'option4' => 'required',
                    'answer' => 'required',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Validation Section Ends
            //--- Logic Section
            $data = QuestionAnswer::findOrFail($id);
            $input = $request->all();
            
            $data->update($input);
            
            // echo "<pre>";print_r($input);exit;
            //--- Logic Section Ends
            //--- Redirect Section     
            return redirect()->route('franchise-course-list-index')->with('success_msg', 'Franchise Course Question Answer Updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends            
    }

    //*** GET Request Delete
    public function destroy_question($id) {
        $data = [];
        $model = QuestionAnswer::findOrFail($id);
        
        
        $model->delete();
        //--- Redirect Section     
        $data['status'] = 200;
        $data['msg'] = 'Deleted Franchise Course Question Answer Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends     
    }
    
    
    
    //**** end course question answer ***********************************************************
    
    
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
                                    '<a href="' . Route("franchise-course-module-list-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="' . Route("franchise-course-module-video-list", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Videos</a>' .
                                    '<a href="javascript:;" onclick="deleteFranchiseCourseModule(this);" data-href="' . Route("franchise-course-module-list-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['status', 'action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function module($id) {
        $course= Course::where('id', $id)->first();
        return view('admin::franchisecourse.course_module_list', compact('id','course'));
    }
    
    //*** GET Request
    public function module_edit($id) {
        $data = CourseModule::findOrFail($id);
        return view('admin::franchisecourse.module_edit', compact('data'));
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
            
            
            return redirect()->route('franchise-course-module-list', [$data->course_id])->with('success_msg', 'Franchise Course module updated successfully.');
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
        $data['msg'] = 'Franchise Course Module Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }
    
    
    //******* end of franchise course module section *********************************
    
    
    
    
    
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
                                    '<a href="' . Route("franchise-course-module-video-list-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteFranchiseCourseModuleVideo(this);" data-href="' . Route("franchise-course-module-video-list-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['status', 'action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function module_video($id) {
        $coursemodule= CourseModule::where('id', $id)->first();
        return view('admin::franchisecourse.course_module_video_list', compact('id','coursemodule'));
    }
    
    
    
    //*** GET Request
    public function module_video_edit($id) {
        $data = CourseModuleVideo::findOrFail($id);
        return view('admin::franchisecourse.module_video_edit', compact('data'));
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
            // echo "<pre>";print_r($input);exit;
            $data->update($input);
            $model = Course::where('id', $data->course_id)->first();
            $model->updated_at = Carbon::now()->toDateTimeString();
            $model->save();
            
            
            
            return redirect()->route('franchise-course-module-video-list', [$data->module_id])->with('success_msg', 'Franchise Course module video updated successfully.');
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
            $data['msg'] = 'Franchise Course module video Deleted Successfully.';
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
        $data['msg'] = 'Franchise Course module video Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }

}

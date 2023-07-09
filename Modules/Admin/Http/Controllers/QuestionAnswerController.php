<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Yajra\Datatables\Datatables;
use Validator;
use URL;
use Response;
use Carbon\Carbon;
use App\Model\QuestionAnswer;
use App\Model\Course;

class QuestionAnswerController extends AdminController {

    //*** JSON Request
    public function datatables() {
        // $datas = QuestionAnswer::orderBy('id', 'desc')->get();
        $datas = QuestionAnswer::select('questions_answers.*')->join('courses','courses.id','=','questions_answers.course')->where('courses.created_by', '=', '0')->orderBy('questions_answers.id', 'desc')->get();
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
    public function index() {
        
        return view('admin::question-answer.list');
    }

    //*** GET Request
    public function create() {
        $data=[];
        $data['course_id']=$course_id = request('id');
        // $data['courses']=Course::where('status','1')->get();
        $data['course']=Course::where('id',$course_id)->first();
        return view('admin::question-answer.add',$data);
    }

    //*** POST Request
    public function store(Request $request) {
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
            $data = new QuestionAnswer();
            $input = $request->all();
            


            $data->fill($input)->save();
            //--- Logic Section Ends
            //--- Redirect Section        
            return redirect()->route('admin-course-question-answer', [$data->course])->with('success_msg', 'Question Answer Created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends    
    }

    //*** GET Request
    public function edit($id) {
        
        $datas=[];
        $datas['data'] = QuestionAnswer::findOrFail($id);
        $datas['courses']=Course::where('status','1')->get();
        return view('admin::question-answer.edit', $datas);
    }

    //*** POST Request
    public function update(Request $request, $id) {
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
            //--- Logic Section Ends
            //--- Redirect Section     
            return redirect()->route('admin-course-question-answer', [$data->course])->with('success_msg', 'Question Answer Updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends            
    }

    //*** GET Request Delete
    public function destroy($id) {
        $data = [];
        $model = QuestionAnswer::findOrFail($id);
        
        
        $model->delete();
        //--- Redirect Section     
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends     
    }

}

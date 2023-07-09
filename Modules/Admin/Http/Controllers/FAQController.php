<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\FAQ;
use Yajra\Datatables\Datatables;
use Validator;

class FAQController extends AdminController {

    public function index(Request $request) {
        return view('admin::faq.index');
    }

    public function get_list() {
        $faq = FAQ::orderBy('id', 'desc')->get();
        return Datatables::of($faq)
                        ->addIndexColumn()
                        ->editColumn('question', function(FAQ $model) {
                            return strip_tags($model->question);
                        })
                        ->editColumn('answer', function(FAQ $model) {
                            return strip_tags($model->answer);
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
                        ->addColumn('action', function ($model) {
                            return '<a href="' . Route("faq-edit", ["id" => $model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>'.
                                   '<a href="javascript:;" onclick="deleteFaq(this);" data-href="' . Route("faq-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['created_at','status', 'action'])
                        ->make(true);
    }
    
    public function get_add() {
        $data = [];
        return view('admin::faq.add', $data);
    }
    
    
    public function post_add(Request $request) {
        $data = [];
        $validator = Validator::make($request->all(), [
                    'question' => 'required',
                    'answer' => 'required',
                    'status' => 'required',
        ]);
        
        if ($validator->passes()) {
            
            $model = new FAQ;
            $model->question = $request->input('question');
            $model->answer = $request->input('answer');
            $model->status = $request->input('status');
            
            $model->save();
            
            return redirect()->route('faq')->with('success_msg', 'FAQ created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        
    }
    
    
    public function get_edit($id) {
        $data['faq'] = $faq = FAQ::where('id', '=', $id)->first();
        if (!$faq) {
            return redirect()->route('faq')->with('error_msg', 'Invalid Link!');
        }
        $data['id'] = $id;
        return view('admin::faq.edit', $data);
    }
    
    public function post_edit(Request $request, $id) {
        $data = [];
        $validator = Validator::make($request->all(), [
                    'question' => 'required',
                    'answer' => 'required',
                    'status' => 'required',
        ]);
        
        if ($validator->passes()) {
            $model = FAQ::where('id', '=', $id)->first();
            $model->question = $request->input('question');
            $model->answer = $request->input('answer');
            $model->status = $request->input('status');
           
            $model->save();
            return redirect()->route('faq')->with('success_msg', 'FAQ updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }
    
    
    public function delete($id) {
        $data = [];
        $model = FAQ::findOrFail($id);
        
        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }
    
    
    
}
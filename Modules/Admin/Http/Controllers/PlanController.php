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
/* * ************Models************* */
use App\Model\Plan;


class PlanController extends AdminController {

    protected $appid, $secret;

    public function index() {


        return view('admin::plan.list');
    }

    public function datatables() {
        $plans = Plan::get();
        return Datatables::of($plans)
                        ->addIndexColumn()
                        
                        ->editColumn('price', function ($model) {
                            if($model->price != ''){
                                return $model->price;
                            }else{
                                return 'Free';
                            }
                            
                        })
                        
                        ->editColumn('free_wallet', function ($model) {
                            if($model->free_wallet != ''){
                                return $model->free_wallet;
                            }else{
                                return 'NA';
                            }
                            
                        })
                        
                        ->editColumn('joining_wallet', function ($model) {
                            if($model->joining_wallet != ''){
                                return $model->joining_wallet;
                            }else{
                                return 'NA';
                            }
                            
                        })
                        
                        ->editColumn('referral_status', function ($model) {
                            if ($model->referral_status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Can not Referred</span>';
                            } else if ($model->referral_status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Referred</span>';
                            }
                            return $status;
                        })
                        
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Active</span>';
                            }
                            return $status;
                        })
                        
                        ->editColumn('created_at', function ($model) {
                            return !empty($model->created_at) ? date('jS M Y, g:i A', strtotime($model->created_at)) : '';
                        })
                        ->addColumn('action', function ($model) {
                            return
                            '<a href="' . Route("affiliation-plan-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                            '<a href="javascript:;" onclick="deletePlan(this);" data-href="' . Route("affiliation-plan-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['price','free_wallet','joining_wallet','referral_status','status', 'action'])
                        ->make(true);
    }
    
    
    public function get_add() {

        return view('admin::plan.add');
    } 
    
    
    public function post_add(Request $request) {

        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'price' => 'nullable|numeric',
                    'validity' => 'required|numeric',
                    'free_wallet' => 'nullable|numeric',
                    'joining_wallet' => 'nullable|numeric',
                    'registration_fee' => 'required|numeric',
                    'course_assign_fee' => 'required|numeric',
                    'certificate_fee' => 'required|numeric',
                    'commission' => 'required|numeric|min:0|max:100',
                    'details' => 'required',
                    'referral_status' => 'required',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });

        if ($validator->passes()) {
            $data = new Plan();
            $input = $request->all();
            
            $data->fill($input)->save();

            return redirect()->route('affiliation-plan')->with('success_msg', 'Plan created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        
    }
    
    
    public function get_edit($id) {
        $data = Plan::where('id',$id)->first();
        return view('admin::plan.edit',["data"=>$data]);
    }
    
    
    public function post_edit(Request $request, $id) {
         $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'price' => 'nullable|numeric',
                    'validity' => 'required|numeric',
                    'free_wallet' => 'nullable|numeric',
                    'joining_wallet' => 'nullable|numeric',
                    'registration_fee' => 'required|numeric',
                    'course_assign_fee' => 'required|numeric',
                    'certificate_fee' => 'required|numeric',
                    'commission' => 'required|numeric|min:0|max:100',
                    'details' => 'required',
                    'referral_status' => 'required',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        
        if ($validator->passes()) {
            //--- Logic Section
            $data = Plan::findOrFail($id);
            $input = $request->all();
            
            $data->update($input);
            
            return redirect()->route('affiliation-plan')->with('success_msg', 'Plan updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        
    }
    
    
    public function delete($id) {
        $data = [];
        $model = Plan::findOrFail($id);
        
        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Plan Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }



}
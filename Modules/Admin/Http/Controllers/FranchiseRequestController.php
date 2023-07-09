<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Franchise;
use App\Model\Course;
use App\Model\Banner;
use App\Model\Plan;
use App\Model\UserMaster;
use App\Model\WalletHistory;
use Yajra\Datatables\Datatables;
use URL;
use Validator;

class FranchiseRequestController extends AdminController {

    public function index(Request $request) {
        return view('admin::franchiserequest.index');
    }

    public function get_list() {
        $email = Franchise::orderBy('id', 'desc')->where('status','<>','3')->get();
        return Datatables::of($email)
                        ->addIndexColumn()
                        ->editColumn('image', function ($model) {
                            if (isset($model->image)) {
                                $path = URL::asset('public/uploads/user/' . $model->image);
                            } else {
                                $path = URL::asset('public/backend/no-image.png');
                            }
                            return '<img height="50" width="50" src="' . $path . '"/>';
                        })
                        ->editColumn('wallet_amount', function ($model) {
                            if ($model->wallet_amount == '') {
                                $wallet_amount = 'Rs.0';
                            } else {
                                $wallet_amount = "Rs.".$model->wallet_amount;
                            } 
                            return $wallet_amount;
                        })
                        ->editColumn('alc_name', function ($model) {
                            if ($model->joining_by_alc == '') {
                                $alc_name = 'NA';
                            } else {
                                $franchise = Franchise::where('id','=',$model->joining_by_alc)->first();
                                $alc_name = strtoupper($franchise->name);
                            } 
                            return $alc_name;
                        })
                        ->editColumn('name', function ($model) {
                            if ($model->name == '') {
                                $name = 'NA';
                            } else {
                                $name = strtoupper($model->name);
                            } 
                            return $name;
                        })
                        ->editColumn('owner_name', function ($model) {
                            if ($model->owner_name == '') {
                                $owner_name = 'NA';
                            } else {
                                $owner_name = strtoupper($model->owner_name);
                            } 
                            return $owner_name;
                        })
                        ->editColumn('plan', function ($model) {
                            if ($model->plan_id == '') {
                                $alc_name = 'NA';
                            } else {
                                $plan = Plan::where('id','=',$model->plan_id)->first();
                                $plan_name = $plan->name;
                            } 
                            return $plan_name;
                        })
                        ->editColumn('created_at', function ($model) {
                            return !empty($model->created_at) ? date('jS M Y, g:i A', strtotime($model->created_at)) : '';
                        })
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i> Inactive</span>';
                            } else if($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i> Active</span>';
                            } else if($model->status == '2') {
                                $status = '<span class="badge badge-danger"><i class="icofont-ui-block"></i> Block</span>';
                            }
                            return $status;
                        })
                        ->addColumn('action', function ($model) {
                            return '<a href="' . Route("franchise-request-edit", ["id" => $model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>'.
                                   '<a href="javascript:;" onclick="deleteFranchise(this);" data-href="' . Route("franchise-request-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>'.
                                   '<a href="' . Route("view-franchise-student-list", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Student List</a>'.
                                   '<a href="' . Route("view-franchise-course-list", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Course List</a>'.
                                   '<a href="' . Route("franchise-request-upload-agreement", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-upload"></i> Agreement</a>';
                        })
                        ->rawColumns(['image','name','wallet_amount','alc_name','owner_name','plan','created_at','status', 'action'])
                        // ->toJson();
                        ->make(true);
    }
    
    

    public function get_edit($id = "") {
        if ($id == "") {
            return redirect()->route('franchise-request');
        }
        $model = Franchise::find($id);
        if (empty($model)) {
            return redirect()->route('franchise-request')->with('error_msg', 'Data Not found.');
        }
        return view('admin::franchiserequest.view', ['model' => $model]);
    }
    
    public function post_edit(Request $request, $id){
        
        $validator = Validator::make($request->all(), [
                    'name' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'address' => 'required',
                    'city' => 'required',
                    'post_office' => 'required',
                    'district' => 'required',
                    'state'  => 'required',
                    'pin' => 'required|numeric|min:6',
                    'country' => 'required',
                    'image' => 'nullable|mimes:jpeg,jpg,png|max:10000',
                    'establish' => 'required|numeric',
                    'owner_name' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'email' => 'required|email|max:255',
                    'phone' => 'required|numeric|digits_between:10,15',
                    
                    
                    'designation' => 'required',
                    'qualification' => 'required',
                    'experience' => 'required',
                    'owner_image' => 'nullable|mimes:jpeg,jpg,png|max:10000',
                    'id_proof' => 'nullable|mimes:jpeg,jpg,png|max:10000',
                    
                    'staff_room' => 'required|numeric|max:100',
                    'staff_seating' => 'required|numeric|max:100',
                    'staff_area' => 'required|numeric|max:100',
                    'class_room' => 'required|numeric|max:100',
                    'class_seating' => 'required|numeric|max:100',
                    'class_area' => 'required|numeric|max:100',
                    'lab_room' => 'required|numeric|max:100',
                    'lab_seating' => 'required|numeric|max:100',
                    'lab_area' => 'required|numeric|max:100',
                    'reception_room' => 'required|numeric|max:100',
                    'reception_seating' => 'required|numeric|max:100',
                    'reception_area' => 'required|numeric|max:100',
                    'wash_room' => 'required|numeric|max:100',
                    'wash_seating' => 'required|numeric|max:100',
                    'wash_area' => 'required|numeric|max:100',
                    'wallet_amount' => 'nullable|numeric|not_in:0',
                    'status' => 'required',
                        ]
        );
        $validator->after(function($validator) use($request) {
            $checkUser = Franchise::where('id', '<>', $request->input('id'))->where('email', $request->input('email'))->first();

            if (!empty($checkUser))
                $validator->errors()->add('email', 'Email already in use.');
            $checkUserPhone = Franchise::where('id', '<>', $request->input('id'))->where('phone', $request->input('phone'))->count();
            if ($checkUserPhone > 0) {
                $validator->errors()->add('phone', 'Phone number already in use.');
            }
        });
        if ($validator->passes()) {
            //--- Logic Section
            $data =[];
            $history = [];
            $model = Franchise::findOrFail($id);
            $input = $request->all();
            
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
            
            // $data['name'] = $input['name'];
            // $data['email'] = $input['email'];
            // $data['phone'] = $input['phone'];
            // $data['address'] = $input['address'];
            // $data['state'] = $input['state'];
            // $data['wallet_amount'] = $input['wallet_amount'];
            // $data['status'] = $input['status'];
            
            if($input['wallet_amount'] != ''){
               $amount = $input['wallet_amount'];
               $input['wallet_amount'] = $model->wallet_amount + $input['wallet_amount']; 
               
                $history['franchise_id'] = $model->id;
                $history['wallet_in'] = $amount;
                $history['description'] = "Add amount to Wallet by Super Admin.";
                $history['balance'] = $input['wallet_amount'];
                
                $wallet_history = WalletHistory::create($history);
            }else{
                $input['wallet_amount'] = $model->wallet_amount;
            }

            $model->update($input);
            
            return redirect()->route('franchise-request')->with('success_msg', 'Updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }
    
     public function delete(Request $request, $id) {
        if ($request->ajax()) {
            $data = [];
            $model = Franchise::findorFail($id);
            if (!empty($model)) {
                $model->status = '3';
                $model->updated_at = date('Y-m-d H:i:s');
                $model->save();
                $data['status'] = 200;
                $data['msg'] = 'Franchise deleted successfully.';
            } else {
                $data['msg'] = 'Sorry ! No Franchise details found.';
            }
            return response()->json($data);
        }
    }
    
    
    
    
    public function get_student_data($id) {
        $datas = UserMaster::where('franchise_id','=', $id)->where('type_id', '2')->where('status', '<>', '3')->orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('image', function ($model) {
                            if (isset($model->image)) {
                                $path = URL::asset('public/uploads/user/' . $model->image);
                            } else {
                                $path = URL::asset('public/backend/no-image.png');
                            }
                            return '<img height="50" width="50" src="' . $path . '"/>';
                        })
                        ->editColumn('full_name', function ($model) {
                            return $model->full_name;
                        })
                        
                        ->editColumn('email', function ($model) {
                            return $model->email;
                        })
                        
                        ->editColumn('course_name', function ($model) {
                            $course_id = $model->running_course;
                            if(!empty($course_id)){
                                $data = Course::where('id',$course_id)->first();
                                $course_name = $data->name;
                            }else{
                                $course_name = 'NA';
                            }
                            
                            return $course_name;
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
                        ->editColumn('payment_status', function ($model) {
                            if ($model->payment_status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Not Paid</span>';
                            } else if ($model->payment_status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Paid</span>';
                            }
                            return $status;
                        })
                        ->rawColumns(['image','course_name','payment_status','status'])
                        ->make(true);
    }
    
    public function get_student_list($id) {
        $user = Franchise::where('id', '=', $id)->first();
        return view('admin::franchiserequest.student_list', compact('id', 'user'));
    }
    
    
    public function get_course_data($id) {
        $datas = Course::where('created_by','=', $id)->orderBy('id', 'desc')->get();
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
                        ->editColumn('featured', function ($model) {
                            if ($model->featured == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>No</span>';
                            } else if ($model->featured == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Yes</span>';
                            }
                            return $status;
                        })
                        ->rawColumns(['image','featured','live','status'])
                        ->toJson(); //--- Returning Json Data To Client Side
    }
    
    public function get_course_list($id) {
        $user = Franchise::where('id', '=', $id)->first();
        return view('admin::franchiserequest.course_list', compact('id', 'user'));
    }
    
    
    public function get_upload_agreement($id = "") {
        if ($id == "") {
            return redirect()->route('franchise-request');
        }
        $model = Franchise::find($id);
        if (empty($model)) {
            return redirect()->route('franchise-request')->with('error_msg', 'Data Not found.');
        }
        return view('admin::franchiserequest.agreement', ['model' => $model]);
    }
    
    public function post_upload_agreement(Request $request, $id){
        
        $validator = Validator::make($request->all(), [
                    
                    'agreement_file' => 'required|mimes:pdf,doc,docx|max:10000'
                    
                        ]
        );
        
        if ($validator->passes()) {
            //--- Logic Section
            $data =[];
            $model = Franchise::findOrFail($id);
            $input = $request->all();
            
            if ($request->hasFile('agreement_file')) {
                $sample_image = $request->file('agreement_file');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/bannars');
                $sample_image->move($destinationPath, $imagename);
                $input['agreement_file'] = $imagename;
            }

            $model->update($input);
            
            return redirect()->route('franchise-request')->with('success_msg', 'Uploaded successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        
    }


}

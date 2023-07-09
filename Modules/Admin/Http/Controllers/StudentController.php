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
use PDF;
/* * ************Models************* */
use App\Model\UserMaster;
use App\Model\Course;
use App\Model\AssignCourse;
use App\Model\Exam;

class StudentController extends AdminController {

    protected $appid, $secret;

    public function get_user_list() {


        return view('admin::student.list');
    }

    public function get_user_list_datatable() {
        $user_list = UserMaster::orderBy('id', 'desc')->where('type_id', '2')->where('status', '<>', '3')->where('franchise_id', '=', '0')->get();
        return Datatables::of($user_list)
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
                        ->addColumn('action', function ($model) {
                            return
                            '<a href="' . Route("student-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                            '<a href="' . Route("student-assign-course", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Assign Course</a>' .
                            '<a href="' . Route("admin-student-assign-course-list", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> Assigned Course List</a>' .
                            '<a href="javascript:;" onclick="deleteStudent(this);" data-href="' . Route("student-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['image','course_name','payment_status','status', 'action'])
                        ->make(true);
    }

    public function get_add_user() {
        $data = [];
        return view('admin::student.add', $data);
    }

    public function post_add_user(Request $request) {
        $validator = Validator::make($request->all(), [
                    'full_name' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'gurdian_name' => 'required',
                    'father_name' => 'required',
                    'mother_name' => 'nullable',
                    'dob' => 'required',
                    'gender' => 'required',
                    'category' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'address' => 'required',
                    'state' => 'required',
                    'district' => 'required',
                    'last_qualification' => 'required',
                    'specialization' => 'required',
                    'year_of_passing' => 'required',
                    'school_college_name' => 'required',
                    'marks' => 'required',
                    'image' => 'required|mimes:png,jpeg,jpg,JPEG,gif',
                    'id_proof' => 'required|mimes:jpeg,jpg,png|max:10000',
        ]);
        $validator->after(function ($validator) use ($request) {
            $checkUser = UserMaster::where('email', $request->input('email'))->count();
            if ($checkUser > 0) {
                $validator->errors()->add('email', 'Email already in use.');
            }
            $checkUserPhone = UserMaster::where('phone', $request->input('phone'))->count();
            if ($checkUserPhone > 0) {
                $validator->errors()->add('phone', 'Phone number already in use.');
            }
        });
        if ($validator->passes()) {
            $model = new UserMaster;
            $model->full_name = strtoupper($request->input('full_name'));
            $model->gurdian_name = strtoupper($request->input('gurdian_name'));
            $model->father_name = strtoupper($request->input('father_name'));
            $model->mother_name = strtoupper($request->input('mother_name'));
            $model->dob = $request->input('dob');
            $model->gender = strtoupper($request->input('gender'));
            $model->category = strtoupper($request->input('category'));
            $model->email = $request->input('email');
            $model->phone = $request->input('phone');
            $model->address = strtoupper($request->input('address'));
            $model->state = strtoupper($request->input('state'));
            $model->district = strtoupper($request->input('district'));
            $model->last_qualification = strtoupper($request->input('last_qualification'));
            $model->specialization = strtoupper($request->input('specialization'));
            $model->year_of_passing = $request->input('year_of_passing');
            $model->school_college_name = strtoupper($request->input('school_college_name'));
            $model->marks = $request->input('marks');
            $password = $this->rand_string(8);
            $url = route("login");
            $totaluser = UserMaster::where('type_id', '2')->count();
            $model->password = Hash::make($password);
            $model->type_id = 2;
            $model->student_type = 'offline';
            $model->status = '1';
            $model->payment_status = '1';
            $model->registration_id = 'DITECH/' . str_pad($totaluser + 1, 4, '0', STR_PAD_LEFT);
            
            if ($request->hasFile('image')) {
                $sample_image = $request->file('image');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $model->image = $imagename;
            }
            if ($request->hasFile('id_proof')) {
                $sample_image = $request->file('id_proof');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $model->id_proof = $imagename;
            }
            $model->save();
            $email_setting = $this->get_email_data('new_account_create_for_student', array('NAME' => $request->input('full_name'), 'EMAIL' => $request->input('email'), 'PASSWORD' => $password, 'URL' => $url ,'REGISTRATIONID' =>$model->registration_id));
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'create_customer',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
            return redirect()->route('students')->with('success_msg', 'Student account created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function get_edit_user($id) {
        $data['user'] = $user = UserMaster::where('id', '=', $id)->first();
        if (!$user) {
            return redirect()->route('students')->with('error_msg', 'Invalid Link!');
        }
        $data['id'] = $id;
        return view('admin::student.edit', $data);
    }

    public function post_edit_user(Request $request, $id) {
        $validator = Validator::make($request->all(), [
                    'full_name' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'gurdian_name' => 'required',
                    'father_name' => 'required',
                    'mother_name' => 'nullable',
                    'dob' => 'required',
                    'gender' => 'required',
                    'category' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'address' => 'required',
                    'state' => 'required',
                    'district' => 'required',
                    'last_qualification' => 'required',
                    'specialization' => 'required',
                    'year_of_passing' => 'required',
                    'school_college_name' => 'required',
                    'marks' => 'required',
                    'image' => 'nullable|mimes:png,jpeg,jpg,JPEG,gif',
                    'id_proof' => 'nullable|mimes:jpeg,jpg,png|max:10000',
        ]);
        $validator->after(function ($validator) use ($request) {
            $checkUser = UserMaster::where('id', '<>', $request->input('id'))->where('email', $request->input('email'))->first();

            if (!empty($checkUser))
                $validator->errors()->add('email', 'Email already in use.');
            $checkUserPhone = UserMaster::where('id', '<>', $request->input('id'))->where('phone', $request->input('phone'))->count();
            if ($checkUserPhone > 0) {
                $validator->errors()->add('phone', 'Phone number already in use.');
            }
        });
        if ($validator->passes()) {
            $model = UserMaster::where('id', '=', $id)->first();
            $model->full_name = strtoupper($request->input('full_name'));
            $model->gurdian_name = strtoupper($request->input('gurdian_name'));
            $model->father_name = strtoupper($request->input('father_name'));
            $model->mother_name = strtoupper($request->input('mother_name'));
            $model->dob = $request->input('dob');
            $model->category = strtoupper($request->input('category'));
            $model->gender = strtoupper($request->input('gender'));
            $model->email = $request->input('email');
            $model->phone = $request->input('phone');
            $model->address = strtoupper($request->input('address'));
            $model->state = strtoupper($request->input('state'));
            $model->district = strtoupper($request->input('district'));
            $model->last_qualification = strtoupper($request->input('last_qualification'));
            $model->year_of_passing = $request->input('year_of_passing');
            $model->specialization = strtoupper($request->input('specialization'));
            $model->school_college_name = strtoupper($request->input('school_college_name'));
            $model->marks = $request->input('marks');
            $model->type_id = 2;
            $model->status = $request->input('status');
            $model->payment_status = $request->input('payment_status');
            
            if ($request->hasFile('image')) {
                $sample_image = $request->file('image');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $model->image = $imagename;
            }
            if ($request->hasFile('id_proof')) {
                $sample_image = $request->file('id_proof');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/user');
                $sample_image->move($destinationPath, $imagename);
                $model->id_proof = $imagename;
            }
            $model->save();
            return redirect()->route('students')->with('success_msg', 'Student updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function delete(Request $request, $id) {
        if ($request->ajax()) {
            $data = [];
            $model = UserMaster::findorFail($id);
            if (!empty($model)) {
                $model->status = '3';
                $model->updated_at = date('Y-m-d H:i:s');
                $model->save();
                $data['status'] = 200;
                $data['msg'] = 'Student deleted successfully.';
            } else {
                $data['msg'] = 'Sorry ! No student details found.';
            }
            return response()->json($data);
        }
    }

    public function uploadimage($request) {
        $sample_image = $request->file('image');
        $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
        $destinationPath = public_path('uploads/user');
        $sample_image->move($destinationPath, $imagename);
        return $imagename;
    }

    public function get_edit_assign_course($id) {
        $data['user'] = $user = UserMaster::where('id', '=', $id)->first();
        if (!$user) {
            return redirect()->route('students')->with('error_msg', 'Invalid Link!');
        }
//        if($user->course_status=='1')
//        {
//            return redirect()->route('students')->with('error_msg', 'Sorry! student already persuing a course.');
//        }
        $data['id'] = $id;
        $data['courses'] = Course::where('status', '1')->get();
        return view('admin::student.assign_course', $data);
    }

    public function post_edit_assign_course(Request $request, $id) {
        $validator = Validator::make($request->all(), [
                    'running_course' => 'required',
                    'created_at' => 'required',
        ]);
        $validator->after(function ($validator) use ($request, $id) {
            $check = AssignCourse::where('user_id', $id)->where('course_id', $request->input('running_course'))->first();
            if (!empty($check)) {
                $validator->errors()->add('running_course', 'This user have already purchase this course.');
            }
        });
        if ($validator->passes()) {
            $model = UserMaster::where('id', '=', $id)->first();
            $model->running_course = $request->input('running_course');
            $model->course_status = '1';
            $model->save();
            $course = Course::where('id', $request->input('running_course'))->first();
            $total=AssignCourse::count();
            $assigncourse = new AssignCourse;
            $assigncourse->enrollment_id = $this->rand_number(8);
            $assigncourse->certificate_no = 'DITECH' . str_pad($total + 1, 4, '0', STR_PAD_LEFT);
            $assigncourse->user_id = $id;
            $assigncourse->course_id = $request->input('running_course');
            $assigncourse->created_at = $request->input('created_at');
            $assigncourse->amount_paid = $course->price;
            if($course->exam_status == '0'){
                $assigncourse->status = '1';
            }else{
                $assigncourse->status = '0';
            }
            $assigncourse->save();
            
            if($course->exam_status == '0'){
                $exam = new Exam();
                $exam->user_id = $id;
                $exam->course_id = $course->id;
                $exam->status = '1';
                $exam->save();
            }

            $title = 'Ditechnical';
            //user mail
            $email_setting = $this->get_email_data('purchase_course', array('NAME' => $model->full_name, 'TITLE' => $title, 'COURSENAME' => $course->name));

            $email_data = [
                'to' => $model->email,
                'subject' => "Course purchase",
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];

            $this->SendMail($email_data);
            //admin mail
            $admin_model = UserMaster::where('type_id', '1')->first();
            $email_setting = $this->get_email_data('purchase_course_admin', array('NAME' => $admin_model->name, 'TITLE' => $title, 'TOTALAMOUNT' => $course->price));
            $emails = array("$admin_model->email", "");
            $email_data = [
                'to' => $admin_model->email,
                'subject' => "Course purchase",
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
            
            return redirect()->route('students')->with('success_msg', 'Assign course for student successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function assign_course_list_datatables($id) {
        $datas = AssignCourse::where('user_id', $id)->orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Persuing</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Completed</span>';
                            }
                            return $status;
                        })
                        ->editColumn('course_id', function ($model) {
                            return (!empty($model->course->name))? $model->course->name : 'NA';
                        })
                        ->editColumn('created_at', function ($model) {
                            return (!empty($model->created_at)) ? \Carbon\Carbon::parse($model->created_at)->format('d-m-Y H:i A') : 'Not Found';
                        })
                        ->addColumn('action', function ($model) {
                             return
                                        '<a href="' . Route("admin-student-i-card", ['id' => base64_encode($model->id)])  . '" target="_blank"><button type="button" class="btn btn-success">Download I-Card</button></a>';
                              
                        })
                        ->rawColumns(['status','action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function assign_course_list($id) {
        $user = UserMaster::where('id', '=', $id)->first();
        return view('admin::student.assign_course_list', compact('id', 'user'));
    }
    
    public function download_i_card($id) {
        $data = [];
        $data['assigncourse']= $assigncourse = AssignCourse::where('id', base64_decode($id))->first();
        
        $pdf = PDF::loadView('mail.i_card', $data);
        return $pdf->download($assigncourse->enrollment_id.'i-card.pdf');
        // return $pdf->stream($assigncourse->enrollment_id.'i-card.pdf');
        exit;
        // return redirect()->back();
    }

}

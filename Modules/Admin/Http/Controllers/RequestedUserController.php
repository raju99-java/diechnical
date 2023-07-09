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

/* * ************Models************* */
use App\Model\UserDetails;

class RequestedUserController extends AdminController {

    protected $appid, $secret;

    public function get_user_list() {


        return view('admin::requesteduser.user_list');
    }

    public function get_user_list_datatable() {
        $user_list = UserDetails::orderBy('id','DESC')->where('approve_status','0')->where('status','1')->get();
        return Datatables::of($user_list)
                        ->addIndexColumn()
                        ->editColumn('photo', function ($model) {
                            if (@getimagesize(URL::asset('public/uploads/user/' . $model->photo)) == true) {
                                $path = URL::asset('public/uploads/user/' . $model->photo);
                            } else {
                                $path = URL::asset('public/backend/no-image.png');
                            }
                            $path = URL::asset('public/uploads/user/' . $model->photo);
                            return '<img height="50" width="50" src="' . $path . '"/>';
                        })
                        ->editColumn('first_name', function ($model) {
                            return $model->first_name.' '.$model->last_name;
                        })
                        ->editColumn('email', function ($model) {
                            return $model->email;
                        })
                        ->editColumn('approve_status', function ($model) {
                            if ($model->approve_status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Submitted</span>';
                            } else if ($model->approve_status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Approved</span>';
                            } else if ($model->approve_status == '3') {
                                $status = '<span class="badge badge-danger"><i class="icofont-close"></i>Decline</span>';
                            }
                            return $status;
                        })
                        ->addColumn('action', function ($model) {
                          
                            return
                                    '<a href="' . Route("requested-user-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' ;
                        })
                        ->rawColumns(['photo','approve_status', 'action'])
                        ->make(true);
    }

    public function get_edit_user($id) {
        $data['user'] = $user = UserDetails::where('id', '=', $id)->first();
        if (!$user) {
            return redirect()->route('users')->with('error_msg', 'Invalid Link!');
        }
        $data['id'] = $id;
        return view('admin::requesteduser.user_edit', $data);
    }

    public function post_edit_user(Request $request, $id) {
        $validator = Validator::make($request->all(), [
                    'approve_status' => 'required',
        ]);
        $validator->after(function($validator) use($request) {
           if($request->input('approve_status')=='3')
             {
             if($request->input('decline_reason')=='')
               {
               $validator->errors()->add('decline_reason', 'Please Enter The Decline Reason.');
               
             }
             
           }
        });
        if ($validator->passes()) {
            $model = UserDetails::where('id', '=', $id)->first();
          	$model->approve_status = $request->input('approve_status');

            $model->save();
          	
			if($request->input('approve_status')=='1')
            {
              $user_id = $this->rand_string(8);
              $password = $this->rand_string(8);
              $model->user_id = $user_id;
              $model->password = Hash::make($password);

            $model->save();
            $url = Route('login');
            $email_setting = $this->get_email_data('user_details_approve', array('NAME' => $model->first_name, 'USER_ID' => $user_id, 'PASSWORD' => $password,'REGISTRATION_NUMBER' => $model->registration_number,'SERIAL_NUMBER' => $model->serial_number, 'URL' => $url));
            
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
              
            }else if($request->input('approve_status')=='3'){
              $decline_reason = $request->input('decline_reason');

            
              $email_setting = $this->get_email_data('user_details_decline', array('NAME' => $model->first_name, 'EMAIL' => $model->email, 'REASON' => $decline_reason));
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
            }
            
            return redirect()->route('users')->with('success_msg', 'User updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function delete(Request $request, $id) {
        if ($request->ajax()) {
            $data = [];
            $model = UserDetails::findorFail($id);
            if (!empty($model)) {
                $model->status = '3';
                $model->updated_at = date('Y-m-d H:i:s');
                $model->save();
                $data['status'] = 200;
                $data['msg'] = 'User deleted successfully.';
            } else {
                $data['msg'] = 'Sorry ! No User details found.';
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

    public function get_users_csv() {
        $table = UserDetails::where('approve_status', '=', '0')->get();
        $filename = "requested_users_details.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('User Id', 'Applied For', 'First Name','Last Name','S/O','D.O.B.','Pancard Number','Aadhar Card Number','Mobile Number(County Code)','Mobile Number','Whatsapp Number','Email','House No.','Street No.','City','Country','State','Police Station','Job Title','Occupation','Photo','Signature'));

        foreach ($table as $row) {
            
            fputcsv($handle, array($row['id'],$row['applying_for'],$row['first_name'],$row['last_name'],$row['son_of'],$row['d_o_b'],$row['pan_card'],$row['aadhar_card'],$row['mobile_number_country_code'],$row['mobile_number'],$row['whatsapp_number'],$row['email'],$row['house_no'],$row['street_no'],$row['city'],$row['country'],$row['state'],$row['police_station'],$row['job_title'],$row['occupation']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename);
    }
  
  	public function download_image($name) {
      
        $filepath = public_path('/uploads/user/').$name;

        return response()->download($filepath);

    }

}

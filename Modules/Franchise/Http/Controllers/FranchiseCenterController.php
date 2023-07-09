<?php

namespace Modules\Franchise\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Franchise\Http\Requests\ApplyOnlineRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use App\Model\Franchise;
use App\Model\Plan;
use App\Model\UserMaster;
use App\Model\Settings;
use App\Model\WalletHistory;
use Yajra\Datatables\Datatables;
use URL;
use Validator;

class FranchiseCenterController extends FranchiseController {
    
    public function CenterJoinCommission($id,$amount){
        $hist = [];
        $sub_hist = [];
        $parent_hist = [];
        $franchise = Franchise::where('id',$id)->first();
        
        if($franchise->joining_by_alc != ''){
            
            // Child
            $plan = Plan::where('id', $franchise->plan_id)->first();
            $com = ($amount * $plan->commission / 100);
            
            $franchise->wallet_amount = $franchise->wallet_amount + $com;
            $franchise->save();
            
            $hist['franchise_id'] = $id;
            $hist['wallet_in'] = $com;
            $hist['description'] = "Added Commission to Wallet for New Center Join.";
            $hist['balance'] = $franchise->wallet_amount;
            
            $wallet_hist = WalletHistory::create($hist);
            
            // Sub Parent
            $sub_parent_id = $franchise->joining_by_alc;
            $sub_parent = Franchise::where('id',$sub_parent_id)->first();
            $sub_parent_plan = Plan::where('id', $sub_parent->plan_id)->first();
            $sub_parent_com = ($com * $sub_parent_plan->commission / 100);
            
            $sub_parent->wallet_amount = $sub_parent->wallet_amount + $sub_parent_com;
            $sub_parent->save();
            
            
            $sub_hist['franchise_id'] = $sub_parent_id;
            $sub_hist['wallet_in'] = $sub_parent_com;
            $sub_hist['description'] = "Added Commission to Wallet for New Center Join by ".$franchise->owner_name;
            $sub_hist['balance'] = $sub_parent->wallet_amount;
            
            $sub_wallet_hist = WalletHistory::create($sub_hist);
            
            // Parent
            
            if($sub_parent->joining_by_alc != ''){
                $parent_id = $sub_parent->joining_by_alc;
                $parent = Franchise::where('id',$parent_id)->first();
                $parent_plan = Plan::where('id', $parent->plan_id)->first();
                $parent_com = ($sub_parent_com * $parent_plan->commission / 100);
                
                $parent->wallet_amount = $parent->wallet_amount + $parent_com;
                $parent->save();
                
                $parent_hist['franchise_id'] = $parent_id;
                $parent_hist['wallet_in'] = $parent_com;
                $parent_hist['description'] = "Added Commission to Wallet for New Center Join by ".$franchise->owner_name;
                $parent_hist['balance'] = $parent->wallet_amount;
                
                $parent_wallet_hist = WalletHistory::create($parent_hist);
                
                return 1;
            }else{
                return 1;
            }
            
            
        }else{
            
            $plan = Plan::where('id', $franchise->plan_id)->first();
            $com = ($amount * $plan->commission / 100);
            
            $franchise->wallet_amount = $franchise->wallet_amount + $com;
            $franchise->save();
            
            $hist['franchise_id'] = $id;
            $hist['wallet_in'] = $com;
            $hist['description'] = "Added Commission to Wallet for New Center Join.";
            $hist['balance'] = $franchise->wallet_amount;
            
            $wallet_hist = WalletHistory::create($hist);
            
            return 1;
            
        }
    }

    public function get_center_list(Request $request) {
        return view('franchise::franchisecenter.index');
    }

    public function get_center_list_datatable() {
        $id=Auth()->guard('franchise')->user()->id;
        $centers = Franchise::orderBy('id', 'desc')->where('joining_by_alc','=',$id)->get();
        return Datatables::of($centers)
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
                        
                        ->rawColumns(['image','wallet_amount','created_at','status'])
                        // ->toJson();
                        ->make(true);
    }
    
    
    public function get_add_center() {
        $data = [];
        $MERCHANT_KEY = Settings::where('slug', 'merchant_key')->first();
        $data['MERCHANT_KEY'] = $MERCHANT_KEY->value;
        $SALT = Settings::where('slug', 'salt')->first();
        $data['SALT'] = $SALT->value;
        // echo "<pre>";print_r($data);exit;
        $check_test_mode = Settings::where('slug', 'test_mode')->first();
        if ($check_test_mode->value == 1) {
            $data['BASE_URL'] = 'https://sandboxsecure.payu.in'; //sandbox
        } else {
            $data['BASE_URL'] = 'https://secure.payu.in'; //production
        }
        $data['plans'] = Plan::where('status','=','1')->get();
        return view('franchise::franchisecenter.add', $data);
    }

    public function post_add_center(ApplyOnlineRequest $request) {
        
         if ($request->ajax()) {
            $data_msg = [];
            
            $fid=Auth()->guard('franchise')->user()->id;
            
            $input = $request->all();
            
            //$input['reset_password_token'] = $this->rand_string(20);
            $input['joining_by_alc'] = $fid;
            
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
            
            //$input['owner_sign'] = "default_center.png";
            
            $password = $this->rand_string(8);
            $input['password'] = Hash::make($password);
            
            $totaluser = Franchise::where('type_id', '3')->count();
            $input['registration_id'] = 'DITECH/ALC/' . str_pad($totaluser + 1, 4, '0', STR_PAD_LEFT);
            
            $plan = Plan::where('id', '=', $input['plan_id'])->first();
            
            $amount = $plan->price;
            
            if($amount == ''){
                
                    $input['days_left'] = $plan->validity;
                    $input['payment_status'] = '0';
                    if($plan->free_wallet != ''){
                        $input['wallet_amount'] = $plan->free_wallet;
                    }
                    if($plan->referral_status == '1'){
                        $input['referral_code'] = $this->rand_string(16);
                    }else{
                        $input['referral_code'] = null;
                    }
                    
                    
                    if($plan->joining_wallet != ''){
                        $joining_wallet_amount = 0;
                        $hist = [];
                        $joining_wallet_amount = $plan->joining_wallet;
                        
                        $fran = Franchise::where('id',$fid)->where('status','=','1')->first();
                        $fran->wallet_amount = $fran->wallet_amount + $joining_wallet_amount;
                        $fran->save();
                        
                        $hist['franchise_id'] = $fid;
                        $hist['wallet_in'] = $joining_wallet_amount;
                        $hist['description'] = "Added Wallet Amount as Joining Bonus for Registered a new Center.";
                        $hist['balance'] = $fran->wallet_amount;
                        
                        $wallet_hist = WalletHistory::create($hist);
                    }
                    
                    $franchise = Franchise::create($input);
                    
                    
                    
                    //$link = Route('active-franchise-account', ['id' => base64_encode($franchise->id), 'token' => $franchise->reset_password_token]);
    
                    $email_setting = $this->get_email_data('center_joining', array('NAME' => $franchise->owner_name, 'EMAIL' => $franchise->email, 'REGISTRATIONID' => $franchise->registration_id,'USER'=> $franchise->email, 'PASSWORD'=>$password,));
                    $email_data = [
                        'to' => $franchise->email,
                        'subject' => $email_setting['subject'],
                        'template' => 'signup',
                        'data' => ['message' => $email_setting['body']]
                    ];
                    $this->SendMail($email_data);
                    
                    $admin_email = UserMaster::where('type_id', '=', '1')->first();
                    
                    if (!empty($admin_email)):
                        $email_setting = $this->get_email_data('admin_franchise_signup', array('ADMIN' => "Admin", 'NAME' => $franchise->owner_name, 'EMAIL' => $franchise->email,
                            'PHONE' => $franchise->phone , 'ADDRESS' => $franchise->address));
                        $email_data = [
                            'to' => $admin_email->email,
                            'subject' => $email_setting['subject'],
                            'template' => 'signup',
                            'data' => ['message' => $email_setting['body']]
                        ];
                        $this->SendMail($email_data);
                    endif;
                    
                    $data_msg['free'] = '1';
                    $data_msg['url'] = route('franchise-dashboard');
                    $data_msg['msg'] = 'Thank you for Joining us. We will Contact you soon.';
                    return response()->json($data_msg);
                
            } else {
                
                    $joining_wallet_amount = 0;
                    
                        // if($input['plan_id'] == '2'){
                        //     $input['days_left'] = $plan->validity;
                        //     $input['payment_status'] = '1';
                        // } else if($input['plan_id'] == '3'){
                        //     $input['days_left'] = $plan->validity;
                        //     $input['wallet_amount'] = $plan->free_wallet;
                        //     if($plan->referral_status == '1'){
                        //         $input['referral_code'] = $this->rand_string(16);
                        //     }
                        //     $input['payment_status'] = '1';
                        //      $joining_wallet_amount = $plan->joining_wallet;
                            
                        // } else if($input['plan_id'] == '4'){
                        //     $input['days_left'] = $plan->validity;
                        //     $input['wallet_amount'] = $plan->free_wallet;
                        //     if($plan->referral_status == '1'){
                        //         $input['referral_code'] = $this->rand_string(16);
                        //     }
                        //     $input['payment_status'] = '1';
                        //      $joining_wallet_amount = $plan->joining_wallet;
                        // }
                        
                        $input['days_left'] = $plan->validity;
                        $input['payment_status'] = '1';
                        if($plan->free_wallet != ''){
                            $input['wallet_amount'] = $plan->free_wallet;
                        }
                        if($plan->referral_status == '1'){
                            $input['referral_code'] = $this->rand_string(16);
                        }else{
                            $input['referral_code'] = null;
                        }
                        if($plan->joining_wallet != ''){
                            $joining_wallet_amount = $plan->joining_wallet;
                        }
                        
                        
                        
                        if($input['wallet'] == '1'){
                            
                                $fran = Franchise::where('id',$fid)->where('status','=','1')->first();
                                if(empty($fran)){
                                    $data_msg['free'] = '0';
                                    $data_msg['wallet'] = '1';
                                    $data_msg['msg'] = "Franchise Not Found !";
                                }else{
                                    if($fran->wallet_amount < $amount){
                                        $data_msg['free'] = '0';
                                        $data_msg['wallet'] = '1';
                                        $data_msg['msg'] = "Wallet Amount Insufficient !";
                                    }else{
                                        
                                        $hist = [];
                                        
                                        $fran->wallet_amount = $fran->wallet_amount - $amount;
                                        $fran->save();
                                        
                                        $hist['franchise_id'] = $fid;
                                        $hist['wallet_out'] = $amount;
                                        $hist['description'] = "Deducted Wallet Amount for Registered a new Center.";
                                        $hist['balance'] = $fran->wallet_amount;
                                        
                                        $wallet_hist = WalletHistory::create($hist);
                                        
                                        
                                        
                                        if($plan->joining_wallet != ''){
                                            $hist = [];
                                            
                                            $fran = Franchise::where('id',$fid)->where('status','=','1')->first();
                                            $fran->wallet_amount = $fran->wallet_amount + $plan->joining_wallet;
                                            $fran->save();
                                            
                                            $hist['franchise_id'] = $fid;
                                            $hist['wallet_in'] = $plan->joining_wallet;
                                            $hist['description'] = "Added Wallet Amount as Joining Bonus for Registered a new Center.";
                                            $hist['balance'] = $fran->wallet_amount;
                                            
                                            
                                            $wallet_hist = WalletHistory::create($hist);
                                        }
                                        
                                        $franchise = Franchise::create($input);
                                        
                                        $res = $this->CenterJoinCommission($fid,$amount);
                                
                                        //$link = Route('active-franchise-account', ['id' => base64_encode($franchise->id), 'token' => $franchise->reset_password_token]);
                        
                                        $email_setting = $this->get_email_data('center_joining', array('NAME' => $franchise->owner_name, 'EMAIL' => $franchise->email,'REGISTRATIONID' => $franchise->registration_id,'USER'=> $franchise->email, 'PASSWORD'=>$password,));
                                        $email_data = [
                                            'to' => $franchise->email,
                                            'subject' => $email_setting['subject'],
                                            'template' => 'signup',
                                            'data' => ['message' => $email_setting['body']]
                                        ];
                                        $this->SendMail($email_data);
                                        
                                        $admin_email = UserMaster::where('type_id', '=', '1')->first();
                                        
                                        if (!empty($admin_email)):
                                            $email_setting = $this->get_email_data('admin_franchise_signup', array('ADMIN' => "Admin", 'NAME' => $franchise->owner_name, 'EMAIL' => $franchise->email,
                                                'PHONE' => $franchise->phone , 'ADDRESS' => $franchise->address));
                                            $email_data = [
                                                'to' => $admin_email->email,
                                                'subject' => $email_setting['subject'],
                                                'template' => 'signup',
                                                'data' => ['message' => $email_setting['body']]
                                            ];
                                            $this->SendMail($email_data);
                                        endif;
                                        
                                        $data_msg['free'] = '0';
                                        $data_msg['wallet'] = '1';
                                        $data_msg['url'] = route('franchise-dashboard');
                                        $data_msg['msg'] = 'Thank you for Joining us. We will Contact you soon.';
                                        
                                        
                                    }
                                }
                                
                              return response()->json($data_msg);  
                            
                        }else{
                            
                            Session::push('input', $input);
                            Session::push('password', $password);
                            Session::push('joining_wallet_amount', $joining_wallet_amount);
                            Session::push('amount', $amount);
                           
                                    $slink = Route('success-center-add');
                                    $flink = Route('cancel-center-add');
                                    // $productInfo = "RegistrationFee" . substr(hash('sha256', mt_rand() . microtime()), 0, 10);
                                    $key = Settings::where('slug', 'merchant_key')->first();
                                    $MERCHANT_KEY = $key->value;
                                    $salt = Settings::where('slug', 'salt')->first();
                                    $SALT = $salt->value;
                                    $txnid = 'ditechnical_' . substr(hash('sha256', mt_rand() . microtime()), 0, 10);
                                    $posted = array();
                                    $posted = array(
                                        'key' => $MERCHANT_KEY,
                                        'txnid' => $txnid,
                                        'amount' => $amount,
                                        'firstname' => $input['owner_name'],
                                        'email' => $input['email'],
                                        'productinfo' => 'Registration fee',
                                        'surl' => $slink,
                                        'furl' => $flink,
                                        'service_provider' => 'payu_paisa',
                                    );
                        
                                    if (empty($posted['txnid'])) {
                                        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                                    } else {
                                        $txnid = $posted['txnid'];
                                    }
                                    $hash = '';
                                    $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
                                    if (empty($posted['hash']) && sizeof($posted) > 0) {
                                        $hashVarsSeq = explode('|', $hashSequence);
                                        $hash_string = '';
                                        foreach ($hashVarsSeq as $hash_var) {
                                            $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                                            $hash_string .= '|';
                                        }
                                        $hash_string .= $SALT;
                                        $hash = strtolower(hash('sha512', $hash_string));
                                    } elseif (!empty($posted['hash'])) {
                                        $hash = $posted['hash'];
                                    }
                        
                                    $data_msg['free'] = '0';
                                    $data_msg['wallet'] = '0';
                                    $data_msg['msg'] = "Go for payment.";
                                    $data_msg['surl'] = $slink;
                                    $data_msg['furl'] = $flink;
                                    $data_msg['txnid'] = $txnid;
                                    $data_msg['amount'] = $amount;
                                    $data_msg['hash'] = $hash;
                                    $data_msg['firstname'] = $input['owner_name'];
                                    $data_msg['email'] = $input['email'];
                                    $data_msg['phone'] = $input['phone'];
                                    
                                    
                                    return response()->json($data_msg);
                        }
                        
            }
         
            
        }
        
    }
    
    
    public function post_success_center_add(Request $request){
        $input = Session::get('input');
        $password = Session::get('password');
        $joining_wallet_amount = Session::get('joining_wallet_amount');
        $amt = Session::get('amount');
        $amount = $amt[0];
        
        $fid=Auth()->guard('franchise')->user()->id;
        
        
        if($joining_wallet_amount[0] > 0){
            $hist = [];
            
            $fran = Franchise::where('id',$fid)->where('status','=','1')->first();
            $fran->wallet_amount = $fran->wallet_amount + $joining_wallet_amount[0];
            $fran->save();
            
            $hist['franchise_id'] = $fid;
            $hist['wallet_in'] = $joining_wallet_amount[0];
            $hist['description'] = "Added Wallet Amount as Joining Bonus for Registered a new Center.";
            $hist['balance'] = $fran->wallet_amount;
            
            $wallet_hist = WalletHistory::create($hist);
        }
        
        $franchise = Franchise::create($input[0]);
        
        $res = $this->CenterJoinCommission($fid,$amount);
        
        //$link = Route('active-franchise-account', ['id' => base64_encode($franchise->id), 'token' => $franchise->reset_password_token]);

        $email_setting = $this->get_email_data('center_joining', array('NAME' => $franchise->owner_name, 'EMAIL' => $franchise->email,'REGISTRATIONID' => $franchise->registration_id,'USER'=> $franchise->email, 'PASSWORD'=>$password[0],));
        $email_data = [
            'to' => $franchise->email,
            'subject' => $email_setting['subject'],
            'template' => 'signup',
            'data' => ['message' => $email_setting['body']]
        ];
        $this->SendMail($email_data);
        
        $admin_email = UserMaster::where('type_id', '=', '1')->first();
        
        if (!empty($admin_email)):
            $email_setting = $this->get_email_data('admin_franchise_signup', array('ADMIN' => "Admin", 'NAME' => $franchise->owner_name, 'EMAIL' => $franchise->email,
                'PHONE' => $franchise->phone , 'ADDRESS' => $franchise->address));
            $email_data = [
                'to' => $admin_email->email,
                'subject' => $email_setting['subject'],
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
        endif;
        
        Session::forget('input');
        Session::forget('password');
        Session::forget('joining_wallet_amount');
        Session::forget('amount');
        return redirect()->route('franchise-dashboard')->with('success_msg', 'Thank you for Joining us. We will Contact you soon.');
    }
    
    public function post_cancel_center_add(Request $request){
        Session::forget('input');
        Session::forget('password');
        Session::forget('joining_wallet_amount');
        Session::forget('amount');
        return redirect()->route('franchise-dashboard')->with('error_msg', 'Payment Failed.');
    }


}
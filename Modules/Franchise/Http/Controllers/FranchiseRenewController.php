<?php

namespace Modules\Franchise\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Franchise\Http\Requests\RenewRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use App\Model\Franchise;
use App\Model\WalletHistory;
use App\Model\Plan;
use App\Model\UserMaster;
use App\Model\Settings;
use Yajra\Datatables\Datatables;
use URL;
use Validator;

class FranchiseRenewController extends FranchiseController {
    
    public function PlanRenewCommission($id,$amount){
        $hist = [];
        $sub_hist = [];
        $parent_hist = [];
        $franchise = Franchise::where('id',$id)->first();
        
        $desc ='';
        if($franchise->days_left > '3'){
            $desc = "Added Commission to Wallet for Upgrade the Plan by ".$franchise->owner_name;
        }else{
            $desc = "Added Commission to Wallet for Renew the Plan by ".$franchise->owner_name;
        }
        
        if($franchise->joining_by_alc != ''){
            
            // Child
            $plan = Plan::where('id', $franchise->plan_id)->first();
            $com = ($amount * $plan->commission / 100);
            
            $franchise->wallet_amount = $franchise->wallet_amount + $com;
            $franchise->save();
            
            $hist['franchise_id'] = $id;
            $hist['wallet_in'] = $com;
            $hist['description'] = $desc;
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
            $sub_hist['description'] = $desc;
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
                $parent_hist['description'] = $desc;
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
            $hist['description'] = $desc;
            $hist['balance'] = $franchise->wallet_amount;
            
            $wallet_hist = WalletHistory::create($hist);
            
            return 1;
            
        }
    }

    
    public function get_renew_plan() {
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
        $data['plans'] = Plan::where('status','=','1')->where('price','<>','')->get();
        return view('franchise::franchiseplan.add', $data);
    }

    public function post_renew_plan(RenewRequest $request) {
        
         if ($request->ajax()) {
            $data_msg = [];
            
            $history = [];
            
            $fid=Auth()->guard('franchise')->user()->id;
            
            $fran = Franchise::findOrFail($fid);
            
            $input = $request->all();
            
            $plan = Plan::where('id', '=', $input['plan_id'])->first();
            
            $amount = $plan->price;
                
                    
            // if($input['plan_id'] == '2'){
            //     $input['days_left'] = $fran->days_left + $plan->validity;
            //     $input['payment_status'] = '1';
            //     if($plan->referral_status == '0'){
            //         $input['referral_code'] = null;
            //     }
                
            // } else if($input['plan_id'] == '3'){
            //     $input['days_left'] = $fran->days_left + $plan->validity;
            //     $input['payment_status'] = '1';
            //     $input['wallet_amount'] = $fran->wallet_amount + $plan->free_wallet;
            //     if($plan->referral_status == '1'){
            //         $input['referral_code'] = $this->rand_string(16);
            //     }
                
            // } else if($input['plan_id'] == '4'){
            //     $input['days_left'] = $fran->days_left + $plan->validity;
            //     $input['payment_status'] = '1';
            //     $input['wallet_amount'] = $fran->wallet_amount + $plan->free_wallet;
            //     if($plan->referral_status == '1'){
            //         $input['referral_code'] = $this->rand_string(16);
            //     }
                
            // }
            
            $input['days_left'] = $fran->days_left + $plan->validity;
            $input['payment_status'] = '1';
            if($plan->free_wallet != ''){
                $input['wallet_amount'] = $fran->wallet_amount + $plan->free_wallet;
                
                $history['franchise_id'] = $fran->id;
                $history['wallet_in'] = $plan->free_wallet;
                if($fran->days_left > '3'){
                    $history['description'] = "Added Amount to Wallet for Upgrade the Plan.";
                }else{
                    $history['description'] = "Added Amount to Wallet for Renew the Plan.";
                }
                $history['balance'] = $input['wallet_amount'];
                
            }
            if($plan->referral_status == '1'){
                $input['referral_code'] = $this->rand_string(16);
            }else{
                $input['referral_code'] = null;
            }
            
            
                        
                if($input['wallet'] == '1'){
                    
                        
                        if(empty($fran)){
                            $data_msg['wallet'] = '1';
                            $data_msg['url'] = route('franchise-dashboard');
                            $data_msg['msg'] = "Franchise Not Found !";
                        }else{
                            if($fran->wallet_amount < $amount){
                                $data_msg['wallet'] = '1';
                                $data_msg['url'] = route('franchise-dashboard');
                                $data_msg['msg'] = "Wallet Amount Insufficient !";
                            }else{
                                
                                $hist = [];
                                
                                $fran->update($input);
                                
                                $franchise = Franchise::where('id','=',$fid)->first();
                                $franchise->wallet_amount = $fran->wallet_amount - $amount;
                                $franchise->save();
                                
                                if(!empty($history)){
                                    $wallet_history = WalletHistory::create($history);
                                }
                                
                                $hist['franchise_id'] = $fran->id;
                                $hist['wallet_out'] = $amount;
                                if($fran->days_left > '3'){
                                    $hist['description'] = "Deducted Amount from Wallet for Upgrade the Plan.";
                                }else{
                                    $hist['description'] = "Deducted Amount from Wallet for Renew the Plan.";
                                }
                                
                                $hist['balance'] = $franchise->wallet_amount;
                                
                                $wallet_hist = WalletHistory::create($hist);
                                
                                $res = $this->PlanRenewCommission($fid,$amount);
                        
                
                                $email_setting = $this->get_email_data('franchise_plan', array('NAME' => $franchise->owner_name, 'EMAIL' => $franchise->email,'REGISTRATIONID' => $franchise->registration_id,'USER'=> $franchise->owner_name, 'PLAN'=> $plan->name,));
                                $email_data = [
                                    'to' => $franchise->email,
                                    'subject' => $email_setting['subject'],
                                    'template' => 'signup',
                                    'data' => ['message' => $email_setting['body']]
                                ];
                                $this->SendMail($email_data);
                                
                                $admin_email = UserMaster::where('type_id', '=', '1')->first();
                                
                                if (!empty($admin_email)):
                                    $email_setting = $this->get_email_data('admin_franchise_plan', array('ADMIN' => "Admin", 'NAME' => $franchise->owner_name, 'EMAIL' => $franchise->email, 'PLAN'=> $plan->name,
                                        'PHONE' => $franchise->phone , 'ADDRESS' => $franchise->address));
                                    $email_data = [
                                        'to' => $admin_email->email,
                                        'subject' => $email_setting['subject'],
                                        'template' => 'signup',
                                        'data' => ['message' => $email_setting['body']]
                                    ];
                                    $this->SendMail($email_data);
                                endif;
                                
                                $data_msg['wallet'] = '1';
                                $data_msg['url'] = route('franchise-dashboard');
                                $data_msg['msg'] = 'Thank you for Renew your plan.';
                                
                                
                            }
                        }
                        
                      return response()->json($data_msg);  
                    
                }else{
                    
                    Session::push('input', $input);
                    Session::push('history', $history);
                    Session::push('amount', $amount);
                   
                            $slink = Route('success-renew-plan');
                            $flink = Route('cancel-renew-plan');
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
                                'firstname' => $fran->owner_name,
                                'email' => $fran->email,
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
                            $data_msg['firstname'] = $fran->owner_name;
                            $data_msg['email'] = $fran->email;
                            $data_msg['phone'] = $fran->phone;
                            
                            
                            return response()->json($data_msg);
                }
                        
            
         
            
        }
        
    }
    
    
    public function post_success_renew_plan(Request $request){
        $input = Session::get('input');
        $history = Session::get('history');
        $amt = Session::get('amount');
        $amount = $amt[0];
        
        $fid=Auth()->guard('franchise')->user()->id;
        $fran = Franchise::findOrFail($fid);
        $fran->update($input[0]);
        
        if(!empty($history[0])){
            $wallet_history = WalletHistory::create($history[0]);
        }
        
        $res = $this->PlanRenewCommission($fid,$amount);
        
        $franchise = Franchise::where('id','=',$fid)->first();
        $plan = Plan::where('id','=',$franchise->plan_id)->first();

        $email_setting = $this->get_email_data('franchise_plan', array('NAME' => $franchise->owner_name, 'EMAIL' => $franchise->email,'REGISTRATIONID' => $franchise->registration_id,'USER'=> $franchise->owner_name,'PLAN'=> $plan->name,));
        $email_data = [
            'to' => $franchise->email,
            'subject' => $email_setting['subject'],
            'template' => 'signup',
            'data' => ['message' => $email_setting['body']]
        ];
        $this->SendMail($email_data);
        
        $admin_email = UserMaster::where('type_id', '=', '1')->first();
        
        if (!empty($admin_email)):
            $email_setting = $this->get_email_data('admin_franchise_plan', array('ADMIN' => "Admin", 'NAME' => $franchise->owner_name, 'EMAIL' => $franchise->email, 'PLAN'=> $plan->name,
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
        Session::forget('history');
        Session::forget('amount');
        return redirect()->route('franchise-dashboard')->with('success_msg', 'Thank you for Renew your Plan.');
    }
    
    public function post_cancel_renew_plan(Request $request){
        Session::forget('input');
        Session::forget('history');
        Session::forget('amount');
        return redirect()->route('franchise-dashboard')->with('error_msg', 'Payment Failed.');
    }


}
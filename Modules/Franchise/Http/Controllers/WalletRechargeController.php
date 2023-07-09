<?php

namespace Modules\Franchise\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Franchise\Http\Requests\RechargeRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use App\Model\Franchise;
use App\Model\WalletHistory;
use App\Model\WalletRecharge;
use App\Model\UserMaster;
use App\Model\Settings;
use Yajra\Datatables\Datatables;
use URL;
use Validator;

class WalletRechargeController extends FranchiseController {

    
    public function get_wallet_amount() {
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
        $fid=Auth()->guard('franchise')->user()->id;
        $data['franchise'] = Franchise::where('id',$fid)->first();
        return view('franchise::wallet.index', $data);
    }

    public function post_wallet_amount(RechargeRequest $request) {
        
         if ($request->ajax()) {
            $data_msg = [];
            
            $input = $request->all();
            $fran = Franchise::findOrFail($input['id']);
            
            $amount = $input['wallet_amount'];
            
            $input['wallet_amount'] = $fran->wallet_amount + $amount;
                
            // print_r($input);exit; 
            
            Session::push('input', $input);
            Session::push('amount', $amount);
                   
                $slink = Route('success-recharge-wallet');
                $flink = Route('cancel-recharge-wallet');
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
                    'productinfo' => 'Recharge fee',
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
    
    
    public function post_success_recharge_wallet(Request $request){
        $data=[];
        $main_fran=[];
        $history = [];
        
        $input = Session::get('input');
        $amnt = Session::get('amount');
        
        $main_fran['wallet_amount'] = $input[0]['wallet_amount'];
        $amount = $amnt[0];
        
        /*echo"<pre>";print_r($main_fran);
        echo"<pre>";print_r($amount);
        exit;*/
        
        $fid=Auth()->guard('franchise')->user()->id;
        
        //update franchise wallet
        $fran = Franchise::findOrFail($fid);
        $fran->update($main_fran);
        
        
        //create new wallet recharge
        $data['franchise_id'] = $fid;
        $data['wallet_amount'] = $amount;
        $data['payment_status'] = '1';
        $recharge = WalletRecharge::create($data);
        
        
        $franchise = Franchise::where('id','=',$fid)->first();
        
        //create new wallet history
        $history['franchise_id'] = $fid;
        $history['wallet_in'] = $amount;
        $history['description'] = "Recharge Wallet.";
        $history['balance'] = $franchise->wallet_amount;
        $wallet_history = WalletHistory::create($history);

        $email_setting = $this->get_email_data('wallet_recharge', array('NAME' => $franchise->owner_name, 'EMAIL' => $franchise->email,'RECHARGE AMOUNT'=> $amount));
        $email_data = [
            'to' => $franchise->email,
            'subject' => $email_setting['subject'],
            'template' => 'signup',
            'data' => ['message' => $email_setting['body']]
        ];
        $this->SendMail($email_data);
        
        $admin_email = UserMaster::where('type_id', '=', '1')->first();
        
        if (!empty($admin_email)):
            $email_setting = $this->get_email_data('franchise_wallet_recharge', array('ADMIN' => "Admin", 'NAME' => $franchise->owner_name, 'EMAIL' => $franchise->email, 'RECHARGE AMOUNT'=> $amount));
            $email_data = [
                'to' => $admin_email->email,
                'subject' => $email_setting['subject'],
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
        endif;
        
        Session::forget('input');
        Session::forget('amount');
        return redirect()->route('franchise-dashboard')->with('success_msg', 'Thank you for Recharge your Wallet.');
    }
    
    
    
    public function post_cancel_recharge_wallet(Request $request){
        Session::forget('input');
        Session::forget('amount');
        return redirect()->route('franchise-wallet')->with('error_msg', 'Payment Failed.');
    }



}
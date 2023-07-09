<?php

namespace Modules\Franchise\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Yajra\Datatables\Datatables;
use Validator;
use URL;
use Modules\Franchise\Http\Requests\ElementRequest;
/* * ************Models************* */

use App\Model\Element;
use App\Model\UserMaster;
use App\Model\Franchise;
use App\Model\WalletHistory;
use App\Model\ElementOrder;
use App\Model\Settings;
use App\Model\Plan;

class ElementController extends FranchiseController {
    
    public function PurchaseElementCommission($id,$amount){
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
            $hist['description'] = "Added Commission to Wallet for Purchasing Element.";
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
            $sub_hist['description'] = "Added Commission to Wallet for Purchasing Element by ".$franchise->owner_name;
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
                $parent_hist['description'] = "Added Commission to Wallet for Purchasing Element by ".$franchise->owner_name;
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
            $hist['description'] = "Added Commission to Wallet for Purchasing Element.";
            $hist['balance'] = $franchise->wallet_amount;
            
            $wallet_hist = WalletHistory::create($hist);
            
            return 1;
            
        }
    }

    public function get_element_list() {


        return view('franchise::element.list');
    }

    public function get_element_list_datatable() {
        
        $elements = Element::orderBy('id', 'desc')->get();
        
        return Datatables::of($elements)
                        ->addIndexColumn()
                        ->editColumn('image', function ($model) {
                            if (isset($model->image)) {
                                $path = URL::asset('public/uploads/element/' . $model->image);
                            } else {
                                $path = URL::asset('public/backend/no-image.png');
                            }
                            return '<img height="50" width="50" src="' . $path . '"/>';
                        })
                        ->editColumn('name', function ($model) {
                            return $model->name;
                        })
                        ->editColumn('description', function ($model) {
                            return $model->description;
                        })
                        
                        ->editColumn('price', function ($model) {
                            return $model->price;
                        })
                        
                        ->addColumn('action', function ($model) {
                            return
                            '<a href="' . Route("franchise-element-purchase", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="icofont-shopping-cart"></i> Purchase</a>';
                        })
                        ->rawColumns(['image', 'action'])
                        ->make(true);
    }

    public function get_view_element($id) {
        $data = [];
        
        $MERCHANT_KEY = Settings::where('slug', 'merchant_key')->first();
        $data['MERCHANT_KEY'] = $MERCHANT_KEY->value;
        $SALT = Settings::where('slug', 'salt')->first();
        $data['SALT'] = $SALT->value;
        $check_test_mode = Settings::where('slug', 'test_mode')->first();
        if ($check_test_mode->value == 1) {
            $data['BASE_URL'] = 'https://sandboxsecure.payu.in'; //sandbox
        } else {
            $data['BASE_URL'] = 'https://secure.payu.in'; //production
        }
        
        $data['element'] = $element = Element::where('id', '=', $id)->first();
        if (!$element) {
            return redirect()->route('franchise-elements')->with('error_msg', 'Invalid Link!');
        }
        $data['id'] = $id;
        $data['franchise_id'] = Auth()->guard('franchise')->user()->id;
        
        return view('franchise::element.edit', $data);
    }
    

    public function post_view_element(ElementRequest $request, $id) {
        
        if ($request->ajax()) {
            $data_msg = [];
            $data = [];
            $input = $request->all();
            // print_r($input);
            
            $data['order_number'] = $this->rand_string(8);
            $data['element_id'] = $request->input('element_id');
            $data['franchise_id'] = $request->input('franchise_id');
            $data['pay_amount'] = $request->input('pay_amount');
            $data['payment_status'] = '1';
            $data['order_status'] = '0';
            $pay_amount = $request->input('pay_amount');
            
            
            
            if($request->input('wallet') == '1'){
                
                $hist = [];
                $fid = Auth()->guard('franchise')->user()->id;
                
                $model = Franchise::where('id',$data['franchise_id'])->where('status','=','1')->first();
                
                $model->wallet_amount = $model->wallet_amount - $data['pay_amount'];
                $model->save();
                
                $element_order = ElementOrder::create($data);
                $element = Element::where('id', '=', $element_order->element_id)->first();
                
                $hist['franchise_id'] = $data['franchise_id'];
                $hist['wallet_out'] = $data['pay_amount'];
                $hist['description'] = "Deducted Amount from Wallet for Purchasing Element.";
                $hist['balance'] = $model->wallet_amount;
                
                $wallet_hist = WalletHistory::create($hist);
                
                $res = $this->PurchaseElementCommission($fid,$pay_amount);
                
                    $title = 'Ditechnical';
                    //user mail
                    $email_setting = $this->get_email_data('purchase_element', array('NAME' => $model->name, 'TITLE' => $title, 'COURSENAME' => $element->name));
        
                    $email_data = [
                        'to' => $model->email,
                        'subject' => "Purchase Element",
                        'template' => 'signup',
                        'data' => ['message' => $email_setting['body']]
                    ];
        
                    $this->SendMail($email_data);
                    //admin mail
                    $admin_model = UserMaster::where('type_id', '1')->first();
                    $email_setting = $this->get_email_data('purchase_element_admin', array('NAME' => $admin_model->name, 'TITLE' => $title, 'TOTALAMOUNT' => $element->price));
                    $emails = array("$admin_model->email", "");
                    $email_data = [
                        'to' => $admin_model->email,
                        'subject' => "Purchase Element",
                        'template' => 'signup',
                        'data' => ['message' => $email_setting['body']]
                    ];
                    $this->SendMail($email_data);
                    
                    $data_msg['wallet'] = '1';
                    $data_msg['msg'] = "Order Placed Successfully.";
                    $data_msg['url'] = route('franchise-elements');
                    return response()->json($data_msg);
                
            }else{
                
                Session::push('data', $data);
                Session::push('amount', $pay_amount);
                
                $model = Franchise::where('id',$data['franchise_id'])->where('status','=','1')->first();
                
                $slink = Route('success-element-purchase');
                $flink = Route('cancel-element-purchase');
                // $productInfo = "RegistrationFee" . substr(hash('sha256', mt_rand() . microtime()), 0, 10);
                $key = Settings::where('slug', 'merchant_key')->first();
                $MERCHANT_KEY = $key->value;
                $salt = Settings::where('slug', 'salt')->first();
                $SALT = $salt->value;
                $amount = $data['pay_amount'];
                $txnid = 'ditechnical_' . substr(hash('sha256', mt_rand() . microtime()), 0, 10);
                $posted = array();
                $posted = array(
                    'key' => $MERCHANT_KEY,
                    'txnid' => $txnid,
                    'amount' => $amount,
                    'firstname' => $model->name,
                    'email' => $model->email,
                    'productinfo' => 'Element purchase',
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
    
                $data_msg['wallet'] = '0';
                $data_msg['msg'] = "Go for payment.";
                $data_msg['surl'] = $slink;
                $data_msg['furl'] = $flink;
                $data_msg['txnid'] = $txnid;
                $data_msg['amount'] = $amount;
                $data_msg['hash'] = $hash;
                $data_msg['firstname'] = $model->name;
                $data_msg['email'] = $model->email;
                $data_msg['phone'] = $model->phone;
                
                return response()->json($data_msg);
                
            }
            
        }
        
    }
    
    
    public function post_success_element_purchase(Request $request){
        
        $data = Session::get('data');
        $amt = Session::get('amount');
        $amount = $amt[0];
        
        $franchise_id = Auth()->guard('franchise')->user()->id;
        $model = Franchise::where('id',$franchise_id)->where('status','=','1')->first();
        
        $element_order = ElementOrder::create($data[0]);
        
        $res = $this->PurchaseElementCommission($franchise_id,$amount);
        
        $element = Element::where('id', '=', $element_order->element_id)->first();
        
            $title = 'Ditechnical';
            //user mail
            $email_setting = $this->get_email_data('purchase_element', array('NAME' => $model->name, 'TITLE' => $title, 'COURSENAME' => $element->name));

            $email_data = [
                'to' => $model->email,
                'subject' => "Purchase Element",
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];

            $this->SendMail($email_data);
            //admin mail
            $admin_model = UserMaster::where('type_id', '1')->first();
            $email_setting = $this->get_email_data('purchase_element_admin', array('NAME' => $admin_model->name, 'TITLE' => $title, 'TOTALAMOUNT' => $element->price));
            $emails = array("$admin_model->email", "");
            $email_data = [
                'to' => $admin_model->email,
                'subject' => "Purchase Element",
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
        
        Session::forget('data');
        Session::forget('amount');
        return redirect()->route('franchise-elements')->with('success_msg', 'Order Placed Successfully.');
    }
    
    public function post_cancel_element_purchase(Request $request){
        Session::forget('data');
        Session::forget('amount');
        return redirect()->route('franchise-elements')->with('error_msg', 'Payment Failed.');
    }

    


}

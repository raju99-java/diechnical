<?php

# Copy the code from below to that controller file located at app/Http/Controllers/RazorpayController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
//use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Model\UserMaster;
use App\Model\Order;
use App\Model\Course;
use App\Model\Cart;
use App\Model\AssignCourse;
use App\Model\Exam;
use App\Model\Franchise;
use App\Model\WalletHistory;
use App\Model\Plan;
use App\Model\Settings;
use DB;

class RazorpayController extends Controller {
    
    public function PurchaseCommission($id,$amount){
        $hist = [];
        $sub_hist = [];
        $parent_hist = [];
        $franchise = Franchise::where('id',$id)->first();
        $commission = settings::where('slug', 'online_course_commisssion')->first();
        
        if($franchise->joining_by_alc != ''){
            
            // Child
            $plan = Plan::where('id', $franchise->plan_id)->first();
            $com = ($amount * $commission->value / 100);
            
            $franchise->wallet_amount = $franchise->wallet_amount + $com;
            $franchise->save();
            
            $hist['franchise_id'] = $id;
            $hist['wallet_in'] = $com;
            $hist['description'] = "Added Commission to Wallet for Online Course Purchase.";
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
            $sub_hist['description'] = "Added Commission to Wallet for Online Course Purchase of ".$franchise->owner_name;
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
                $parent_hist['description'] = "Added Commission to Wallet for Online Course Purchase of ".$franchise->owner_name;
                $parent_hist['balance'] = $parent->wallet_amount;
                
                $parent_wallet_hist = WalletHistory::create($parent_hist);
                
                return 1;
            }else{
                return 1;
            }
            
            
        }else{
            
            $plan = Plan::where('id', $franchise->plan_id)->first();
            $com = ($amount * $commission->value / 100);
            
            $franchise->wallet_amount = $franchise->wallet_amount + $com;
            $franchise->save();
            
            $hist['franchise_id'] = $id;
            $hist['wallet_in'] = $com;
            $hist['description'] = "Added Commission to Wallet for Online Course Purchase.";
            $hist['balance'] = $franchise->wallet_amount;
            
            $wallet_hist = WalletHistory::create($hist);
            
            return 1;
            
        }
    }

    public function dopayment(Request $request) {
        //Input items of form
        $data_msg = [];
        $title = 'Ditechnical';
        $card = [];
        $input = $request->all();
        $user_id = Auth::guard('frontend')->user()->id;
//        print_r($input['txnid']);
//        exit;
        $order = [];
        $carts = cart::where('user_id', $user_id)->where('status', '1')->get();
        $order['order_number'] = $this->rand_string(8);
        $order['user_id'] = $user_id;
        $order['payment_id'] = $input['txnid'];
        $order['status'] = '1';
        foreach ($carts as $cart) {
            $order['full_name'] = $input['firstname'];
            $order['email'] = $input['email'];
            $order['phone'] = $input['phone'];
            $order['course_id'] = $cart->course_id;
            $order['pay_amount'] = $cart->course->price;
            $orders = Order::create($order);
            $total=AssignCourse::count();
            
            $course = Course::findOrFail($cart->course_id);
            if($course->created_by != '0'){
                $fid = $course->created_by;
                $amount = $order['pay_amount'];
                $res = $this->PurchaseCommission($fid,$amount);
            }
            $assign_course = [];
            $assign_course['enrollment_id'] = $this->rand_number(8);
            $assign_course['user_id'] = Auth::guard('frontend')->user()->id;
            $assign_course['course_id'] = $cart->course_id;
            $assign_course['amount_paid'] = $cart->course->price;
            $assign_course['certificate_no'] = 'DITECH' . str_pad($total + 1, 4, '0', STR_PAD_LEFT);
            if($course->exam_status == '0'){
                $assign_course['status'] = '1';
            }else{
                $assign_course['status'] = '0';
            }
            
            $assign = AssignCourse::create($assign_course);
            
            if($course->exam_status == '0'){
                $exam = new Exam();
                $exam->user_id = Auth::guard('frontend')->user()->id;
                $exam->course_id = $course->id;
                $exam->status = '1';
                $exam->save();
            }
            
        }





        $model = UserMaster::findOrFail(Auth::guard('frontend')->user()->id);

        $email_setting = $this->get_email_data('purchase_course', array('NAME' => $model->full_name, 'TITLE' => $title, 'TOTALAMOUNT' => $input['amount']));

        $email_data = [
            'to' => $model->email,
            'subject' => "Course purchase",
            'template' => 'signup',
            'data' => ['message' => $email_setting['body']]
        ];

        $this->SendMail($email_data);

        $admin_model = UserMaster::where('type_id', '1')->first();
        $email_setting = $this->get_email_data('purchase_course_admin', array('NAME' => $admin_model->name, 'TITLE' => $title, 'TOTALAMOUNT' => $input['amount']));
        $emails = array("$admin_model->email", "");
        $email_data = [
            'to' => $admin_model->email,
            'subject' => "Course purchase",
            'template' => 'signup',
            'data' => ['message' => $email_setting['body']]
        ];
        $this->SendMail($email_data);
        $data_msg['msg'] = 'Your order has been placed successful.';
        $models = cart::where('user_id', $user_id)->delete();

        return redirect()->route('user-course')->with('success', 'Your order has been purchased successful.');
        // Please check browser console.
    }

    public function cancel_payment(Request $request) {

        return redirect()->route('checkout')->with('error', 'Payment Failed.');
    }

}

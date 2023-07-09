<?php

namespace Modules\Franchise\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Yajra\Datatables\Datatables;
use Validator;
use URL;
/* * ************Models************* */

use App\Model\Element;
use App\Model\Franchise;
use App\Model\ElementOrder;

class FranchiseOrderController extends FranchiseController {

    public function get_element_order_list() {


        return view('franchise::order.list');
    }

    public function get_element_order_list_datatable() {
        
        $franchise_id = Auth()->guard('franchise')->user()->id;
        // $model = Franchise::where('id',$franchise_id)->where('status','=','1')->first();
        
        $element_order = ElementOrder::orderBy('id', 'desc')->where('franchise_id','=',$franchise_id)->get();
        
        return Datatables::of($element_order)
                        ->addIndexColumn()
                        
                        ->editColumn('name', function ($model) {
                            $element = Element::where('id', '=', $model->element_id)->first();
                            return $element->name;
                        })
                        ->editColumn('payment_status', function ($model) {
                            if ($model->payment_status == '0') {
                                $payment_status = '<span class="badge badge-warning"><i class="icofont-warning"></i> Not Paid</span>';
                            } else if ($model->payment_status == '1') {
                                $payment_status = '<span class="badge badge-success"><i class="icofont-check"></i> Paid</span>';
                            } 
                            return $payment_status;
                        })
                        ->editColumn('updated_at', function ($model) {
                            return !empty($model->updated_at) ? date('jS M Y, g:i A', strtotime($model->updated_at)) : '';
                        })
                        ->editColumn('order_status', function ($model) {
                            if ($model->order_status == '0') {
                                $order_status = '<span class="badge badge-warning"><i class="icofont-warning"></i> Order Placed</span>';
                            } else if ($model->order_status == '1') {
                                $order_status = '<span class="badge badge-primary"><i class="icofont-check"></i> Order Confirmed</span>';
                            } else if ($model->order_status == '2') {
                                $order_status = '<span class="badge badge-secondary"><i class="icofont-fast-delivery"></i> Out For Delivery</span>';
                            } else if ($model->order_status == '3') {
                                $order_status = '<span class="badge badge-success"><i class="icofont-check"></i> Order Delivered</span>';
                            }
                            return $order_status;
                        })
                        
                        ->rawColumns(['name','payment_status','updated_at','order_status'])
                        ->make(true);
    }
  


}

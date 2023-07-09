<?php

namespace Modules\Admin\Http\Controllers;

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

class FranchiseOrderController extends AdminController {

    public function get_element_order_list() {


        return view('admin::franchiseorder.list');
    }

    public function get_element_order_list_datatable() {
        
        $element_order = ElementOrder::orderBy('id', 'desc')->get();
        
        return Datatables::of($element_order)
                        ->addIndexColumn()
                        
                        ->editColumn('element_name', function ($model) {
                            $element = Element::where('id', '=', $model->element_id)->first();
                            $name = $element['name'];
                            return $name;
                        })
                        ->editColumn('franchise_name', function ($model) {
                            $franchise = Franchise::where('id', '=', $model->franchise_id)->first();
                            return ($franchise['name'])? $franchise['name'] : 'NA';
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
                        ->addColumn('action', function ($model) {
                            return
                                    '<a href="' . Route("franchise-purchase-element-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>';
                        })
                        ->rawColumns(['element_name','franchise_name','payment_status','updated_at','order_status','action'])
                        ->make(true);
    }
    
    
    public function get_edit_purchase_element($id) {
        $data = [];
        
        $data['element_order'] = $element_order = ElementOrder::where('id', '=', $id)->first();
        if (!$element_order) {
            return redirect()->route('franchise-purchase-elements')->with('error_msg', 'Invalid Link!');
        }
        $data['id'] = $id;
        $data['element'] = $element = Element::where('id', '=', $element_order->element_id)->first();
        $data['franchise'] = $franchise = Franchise::where('id', '=', $element_order->franchise_id)->first();
        
        return view('admin::franchiseorder.edit', $data);
    }
  
  
    public function post_edit_purchase_element(Request $request, $id) {
        
        $validator = Validator::make($request->all(), [
                    'order_status' => 'required'
        ]);
        
        if ($validator->passes()) {
            $model = ElementOrder::where('id', '=', $id)->first();
            
            $model->order_status = $request->input('order_status');
        
            $model->save();
            return redirect()->route('franchise-purchase-elements')->with('success_msg', 'Order Status updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }


}

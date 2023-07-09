<?php

namespace Modules\Franchise\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\WalletHistory;
use App\Model\Franchise;
use Yajra\Datatables\Datatables;

class WalletHistoryController extends FranchiseController {

    public function index(Request $request) {
        return view('franchise::wallethistory.index');
    }

    public function get_list() {
        $id = Auth()->guard('franchise')->user()->id;
        $history = WalletHistory::where('franchise_id',$id)->take(50)->orderBy('id', 'desc')->get();
        return Datatables::of($history)
            ->addIndexColumn()
            
            
            
            ->editColumn('amount', function ($model) {
                if (!empty($model->wallet_in) && empty($model->wallet_out) ) {
                    $amount = "Rs. ".$model->wallet_in;
                    
                }else if (!empty($model->wallet_out) && empty($model->wallet_in)) {
                    $amount = "Rs. ".$model->wallet_out;
                    
                }else{
                    $amount = "NA";
                }
                
                return $amount;
                
            })
            
            ->editColumn('balance', function ($model) {
                if (!empty($model->balance)) {
                    $balance = "Rs. ".$model->balance;
                    
                }else{
                    $balance = "NA";
                }
                
                return $balance;
                
            })
            
            ->editColumn('created_at', function ($model) {
                return (!empty($model->created_at)) ? \Carbon\Carbon::parse($model->created_at)->format('d-m-Y H:i A') : 'Not Found';
            })
            
            ->rawColumns(['amount','balance','created_at'])
            ->make(true);
    }
    
    // public function delete($id) {
    //     $data = [];
    //     $model = WalletHistory::findOrFail($id);
        
        
    //     $model->delete();
    //     //--- Redirect Section
    //     $data['status'] = 200;
    //     $data['msg'] = 'Deleted Successfully.';
    //     return response()->json($data);
    //     //--- Redirect Section Ends
    // }
    
    
}
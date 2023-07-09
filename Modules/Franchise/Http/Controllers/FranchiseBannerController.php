<?php

namespace Modules\Franchise\Http\Controllers;

use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Validator;
use PDF;
use Response;
use URL;
use App\Model\Banner;


class FranchiseBannerController extends FranchiseController {

    //*** JSON Request
    public function datatables() {
        $data = Banner::where('slug','=','franchise')->where('status','<>','0')->orderBy('id', 'desc')->get();
        // print_r($data);exit;
        
        return Datatables::of($data)
                        ->addIndexColumn()
                        ->editColumn('banner_name', function ($model) {
                            return $model->banner_name;
                        })
                        ->editColumn('created_at', function ($model) {
                            return $model->created_at;
                        })
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i> Inactive</span>';
                            } else {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i> Active</span>';
                            } 
                            return $status;
                        })
                        ->addColumn('action', function ($model) {
                            return 
                                    '<a href="' . URL::asset('public/uploads/bannars/'.$model->banner_file) . '" target="_blank" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> View</a>'.
                                    '<a href="' . Route("franchise-banner-download", [$model->banner_file]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-file"></i> Download</a>';
                        })
                        ->rawColumns(['banner_name','created_at','status', 'action'])
                        // ->toJson();
                        ->make(true);
        
    }

    //*** GET Request
    public function index() {
        return view('franchise::franchisebanner.banner_list');
    }


    
    
    public function download_banner(Request $request,$file_name) {
    
        $file= public_path().'/uploads/bannars/'.$file_name;
        
        return response()->download($file);
        
    }
   

}

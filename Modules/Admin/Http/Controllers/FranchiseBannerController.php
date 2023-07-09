<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Franchise;
use App\Model\Banner;
use Yajra\Datatables\Datatables;
use URL;
use Validator;
use PDF;

class FranchiseBannerController extends AdminController {
 
    public function add_banners(Request $request){
        return view('admin::franchisebanner.add_banner');
    } 
    
    public function post_add_banners(Request $request){
        
        
        if($request->input('slug') == 'director'){
            
            $validator = Validator::make($request->all(), [
                    'banner_name' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'slug'  => 'required',
                    'status' => 'required',
                    'banner_file' => 'required|mimes:png,jpeg,jpg,JPEG,gif',
            ]);
            
        }else{
            
            $validator = Validator::make($request->all(), [
                    'banner_name' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'slug'  => 'required',
                    'status' => 'required',
                    'banner_file' => 'required',
            ]);
            
        }
        if ($validator->passes()) {
            $model = new Banner;
            $model->banner_name = strtoupper($request->input('banner_name'));
            $model->slug = strtolower($request->input('slug'));
            $model->status = $request->input('status');
            if ($request->hasFile('banner_file')) {
                $sample_file = $request->file('banner_file');
                $filename = $request->input('banner_name') . '.' . $sample_file->getClientOriginalExtension();
                $destinationPath = public_path('uploads/bannars');
                $sample_file->move($destinationPath, $filename);
                $model->banner_file = $filename;
            }
            $model->save();
            return redirect()->route('franchise-request-banners')->with('success_msg', 'Banner uploaded successfully.');
        }else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }
 
    public function get_banners_list(){
        $data = Banner::orderBy('id', 'desc')->get();
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
                            return '<a href="' . Route("franchise-request-banners-edit", ["id" => $model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>'.
                                    '<a href="' . URL::asset('public/uploads/bannars/'.$model->banner_file) . '" target="_blank" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> View</a>'.
                                   '<a href="javascript:;" onclick="deleteBanner(this);" data-href="' . Route("franchise-request-banners-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['banner_name','created_at','status', 'action'])
                        // ->toJson();
                        ->make(true);
    }
    
    public function get_banners() {
        return view('admin::franchisebanner.banner_list');
    }
    
    public function edit_banners(Request $request, $id) {
        $model = Banner::where('id','=', $id)->first();
        return view('admin::franchisebanner.edit_banner',["model"=>$model]);
    }
    
    public function post_edit_banners(Request $request, $id) {
        
        if($request->input('slug') == 'director'){
            
            $validator = Validator::make($request->all(), [
                    'banner_name' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'slug'  => 'required',
                    'status' => 'required',
                    'banner_file' => 'required|mimes:png,jpeg,jpg,JPEG,gif',
            ]);
            
        }else{
            
            $validator = Validator::make($request->all(), [
                    'banner_name' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'slug'  => 'required',
                    'status' => 'required',
                    'banner_file' => 'required',
            ]);
            
        }
        
        if ($validator->passes()) {
            $model = Banner::where('id', '=', $id)->first();
            $model->banner_name = strtoupper($request->input('banner_name'));
            $model->slug = strtolower($request->input('slug'));
            $model->status = $request->input('status');
            if ($request->hasFile('banner_file')) {
                $sample_file = $request->file('banner_file');
                $filename = $request->input('banner_name') . '.' . $sample_file->getClientOriginalExtension();
                $destinationPath = public_path('uploads/bannars');
                $sample_file->move($destinationPath, $filename);
                $model->banner_file = $filename;
            }
            $model->save();
            return redirect()->route('franchise-request-banners')->with('success_msg', 'Banner updated successfully.');
        }else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }
    
   
    
    public function delete_banners(Request $request, $id) {
        if ($request->ajax()) {
            $data = [];
            $model = Banner::findorFail($id);
            if (!empty($model)) {
                $model->delete();
                $data['status'] = 200;
                $data['msg'] = 'Banner deleted successfully.';
            } else {
                $data['msg'] = 'Sorry ! No Franchise details found.';
            }
            return response()->json($data);
        }
    }

}

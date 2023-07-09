<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Yajra\Datatables\Datatables;
use Validator;
use URL;
use Response;
use Carbon\Carbon;
use App\Model\Gallery;

class GalleryController extends AdminController {

    //*** JSON Request
    public function datatables() {
        $datas = Gallery::orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('image', function(Gallery $data) {
                            $photo = $data->image ? URL::asset('public/uploads/gallery/' . $data->image) : URL::asset('public/backend/no-image.png');
                            return '<img src="' . $photo . '" alt="Image" height="60" width="60">';
                        })
                        
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Active</span>';
                            } else if ($model->status == '3') {
                                $status = '<span class="badge badge-danger"><i class="icofont-close"></i>Delete</span>';
                            }
                            return $status;
                        })
                        ->addColumn('action', function ($model) {
                            return
                                    '<a href="' . Route("admin-gallery-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteGallery(this);" data-href="' . Route("admin-gallery-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['image', 'status', 'action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index() {
        return view('admin::gallery.list');
    }

    //*** GET Request
    public function create() {
        return view('admin::gallery.add');
    }

    //*** POST Request
    public function store(Request $request) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    
                    'status' => 'required',
                    'image' => 'required|mimes:jpeg,jpg,png,svg',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {

            //--- Validation Section Ends
            //--- Logic Section
            $data = new Gallery();
            $input = $request->all();
            if ($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/gallery');
                $file->move($destinationPath, $name);
                $input['image'] = $name;
            }


            $data->fill($input)->save();
            //--- Logic Section Ends
            //--- Redirect Section        
            return redirect()->route('admin-gallery-index')->with('success_msg', 'Gallery Created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends    
    }

    //*** GET Request
    public function edit($id) {
        $data = Gallery::findOrFail($id);
        return view('admin::gallery.edit', compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    
                    'status' => 'required',
                    'image' => 'nullable|mimes:jpeg,jpg,png,svg',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Validation Section Ends
            //--- Logic Section
            $data = Gallery::findOrFail($id);
            $input = $request->all();
            if ($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/gallery');
                $file->move($destinationPath, $name);
                if ($data->image != null) {
                    if (file_exists(public_path('uploads/gallery' . $data->image))) {
                        unlink(public_path('uploads/gallery' . $data->image));
                    }
                }
                $input['image'] = $name;
            }


            $data->update($input);
            //--- Logic Section Ends
            //--- Redirect Section     
            return redirect()->route('admin-gallery-index')->with('success_msg', 'Gallery Updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends            
    }

    //*** GET Request Delete
    public function destroy($id) {
        $data = [];
        $model = Gallery::findOrFail($id);
        //If Photo Doesn't Exist
        if ($model->image == null) {
            $model->delete();
            //--- Redirect Section     
            $data['status'] = 200;
            $data['msg'] = 'Data Deleted Successfully.';
            return response()->json($data);
            //--- Redirect Section Ends     
        }
        //If Photo Exist
        if (isset($model->image))
            if (file_exists(public_path('uploads/gallery' . $model->image))) {
                unlink(public_path('uploads/gallery' . $model->image));
            }
        $model->delete();
        //--- Redirect Section     
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends     
    }

}

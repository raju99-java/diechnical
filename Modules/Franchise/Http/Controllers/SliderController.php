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
use App\Model\Slider;

class SliderController extends AdminController {

    //*** JSON Request
    public function datatables() {
        $datas = Slider::orderBy('id', 'desc')->get();
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('photo', function(Slider $data) {
                            $photo = $data->photo ? URL::asset('public/uploads/slider/' . $data->photo) : URL::asset('public/backend/no-image.png');
                            return '<img src="' . $photo . '" alt="Image" height="60" width="60">';
                        })
                        ->editColumn('title_text', function(Slider $data) {
                            $title = mb_strlen(strip_tags($data->title_text), 'utf-8') > 250 ? mb_substr(strip_tags($data->title_text), 0, 250, 'utf-8') . '...' : strip_tags($data->title_text);
                            return $title;
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
                                    '<a href="' . Route("admin-slider-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                                    '<a href="javascript:;" onclick="deleteSlider(this);" data-href="' . Route("admin-slider-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['photo', 'status', 'action'])
                        ->make(true); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index() {
        return view('admin::slider.list');
    }

    //*** GET Request
    public function create() {
        return view('admin::slider.add');
    }

    //*** POST Request
    public function store(Request $request) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'title_text' => 'required',
                    'details_text' => 'required',
                    'link' => 'required|url',
                    'status' => 'required',
                    'photo' => 'required|mimes:jpeg,jpg,png,svg',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {

            //--- Validation Section Ends
            //--- Logic Section
            $data = new Slider();
            $input = $request->all();
            if ($file = $request->file('photo')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/slider');
                $file->move($destinationPath, $name);
                $input['photo'] = $name;
            }


            $data->fill($input)->save();
            //--- Logic Section Ends
            //--- Redirect Section        
            return redirect()->route('admin-slider-index')->with('success_msg', 'Slider Created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends    
    }

    //*** GET Request
    public function edit($id) {
        $data = Slider::findOrFail($id);
        return view('admin::slider.edit', compact('data'));
    }

    //*** POST Request
    public function update(Request $request, $id) {
        //--- Validation Section
        $validator = Validator::make($request->all(), [
                    'title_text' => 'required',
                    'details_text' => 'required',
                    'link' => 'required|url',
                    'status' => 'required',
                    'photo' => 'nullable|mimes:jpeg,jpg,png,svg',
                        ]
        );
        $validator->after(function($validator) use($request) {
            
        });
        if ($validator->passes()) {
            //--- Validation Section Ends
            //--- Logic Section
            $data = Slider::findOrFail($id);
            $input = $request->all();
            if ($file = $request->file('photo')) {
                $name = time() . $file->getClientOriginalName();
                $destinationPath = public_path('uploads/slider');
                $file->move($destinationPath, $name);
                if ($data->photo != null) {
                    if (file_exists(public_path('uploads/slider' . $data->photo))) {
                        unlink(public_path('uploads/slider' . $data->photo));
                    }
                }
                $input['photo'] = $name;
            }


            $data->update($input);
            //--- Logic Section Ends
            //--- Redirect Section     
            return redirect()->route('admin-slider-index')->with('success_msg', 'Slider Updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        //--- Redirect Section Ends            
    }

    //*** GET Request Delete
    public function destroy($id) {
        $data = [];
        $model = Slider::findOrFail($id);
        //If Photo Doesn't Exist
        if ($model->photo == null) {
            $model->delete();
            //--- Redirect Section     
            $data['status'] = 200;
            $data['msg'] = 'Data Deleted Successfully.';
            return response()->json($data);
            //--- Redirect Section Ends     
        }
        //If Photo Exist
        if (isset($model->photo))
            if (file_exists(public_path('uploads/slider' . $model->photo))) {
                unlink(public_path('uploads/slider' . $model->photo));
            }
        $model->delete();
        //--- Redirect Section     
        $data['status'] = 200;
        $data['msg'] = 'Data Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends     
    }

}

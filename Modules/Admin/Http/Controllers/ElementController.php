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

class ElementController extends AdminController {

    public function get_element_list() {


        return view('admin::element.list');
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
                        ->editColumn('created_at', function ($model) {
                            return !empty($model->created_at) ? date('jS M Y, g:i A', strtotime($model->created_at)) : '';
                        })
                        ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>';
                            } else if ($model->status == '1') {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Active</span>';
                            }
                            return $status;
                        })
                        ->addColumn('action', function ($model) {
                            return
                            '<a href="' . Route("element-edit", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>' .
                            '<a href="javascript:;" onclick="deleteElement(this);" data-href="' . Route("element-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['image','created_at','status', 'action'])
                        ->make(true);
    }

    public function get_add_element() {
        $data = [];
        return view('admin::element.add', $data);
    }

    public function post_add_element(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'price' => 'required|numeric',
                    'description' => 'required',
                    'image' => 'required|mimes:png,jpeg,jpg,JPEG,gif',
                    'status' => 'required',
        ]);
        
        if ($validator->passes()) {
            $model = new Element;
            $model->name = strtoupper($request->input('name'));
            $model->price = $request->input('price');
            $model->description = $request->input('description');
            $model->status = $request->input('status');
            
            if ($request->hasFile('image')) {
                $sample_image = $request->file('image');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/element');
                $sample_image->move($destinationPath, $imagename);
                $model->image = $imagename;
            }
           
            $model->save();
            
            return redirect()->route('elements')->with('success_msg', 'Element created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function get_edit_element($id) {
        $data['element'] = $element = Element::where('id', '=', $id)->first();
        if (!$element) {
            return redirect()->route('elements')->with('error_msg', 'Invalid Link!');
        }
        $data['id'] = $id;
        return view('admin::element.edit', $data);
    }

    public function post_edit_element(Request $request, $id) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'price' => 'required|numeric',
                    'description' => 'required',
                    'image' => 'nullable|mimes:png,jpeg,jpg,JPEG,gif',
                    'status' => 'required',
        ]);
        
        if ($validator->passes()) {
            $model = Element::where('id', '=', $id)->first();
            $model->name = strtoupper($request->input('name'));
            $model->price = $request->input('price');
            $model->description = $request->input('description');
            $model->status = $request->input('status');
            
            if ($request->hasFile('image')) {
                $sample_image = $request->file('image');
                $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/element');
                $sample_image->move($destinationPath, $imagename);
                $model->image = $imagename;
            }
            
            $model->save();
            return redirect()->route('elements')->with('success_msg', 'Element updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }

    public function delete(Request $request, $id) {
        if ($request->ajax()) {
            $data = [];
            $model = Element::findOrFail($id);

            if (!empty($model)) {
                
                $model->delete();
                $data['status'] = 200;
                $data['msg'] = 'Element deleted successfully.';
            } else {
                $data['msg'] = 'Sorry ! No Element details found.';
            }
            return response()->json($data);
        }
    }

    public function uploadimage($request) {
        $sample_image = $request->file('image');
        $imagename = $this->rand_string(14) . '.' . $sample_image->getClientOriginalExtension();
        $destinationPath = public_path('uploads/element');
        $sample_image->move($destinationPath, $imagename);
        return $imagename;
    }


}

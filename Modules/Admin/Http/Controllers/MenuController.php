<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Menu;
use Yajra\Datatables\Datatables;
use Validator;

class MenuController extends AdminController {

    public function index(Request $request) {
        return view('admin::menu.index');
    }

    public function get_list() {
        $menu = Menu::orderBy('id', 'desc')->get();
        return Datatables::of($menu)
                        ->addIndexColumn()
                        ->editColumn('name', function($model) {
                            return $model->name;
                        })
                        ->editColumn('slug', function($model) {
                            return $model->slug;
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
                            return '<a href="' . Route("menu-edit", ["id" => $model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-edit"></i> Edit</a>'.
                                   '<a href="javascript:;" onclick="deleteMenu(this);" data-href="' . Route("menu-delete", [$model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-trash"></i> Delete</a>';
                        })
                        ->rawColumns(['name','slug','created_at','status', 'action'])
                        ->make(true);
    }
    
    public function get_add() {
        $data = [];
        return view('admin::menu.add', $data);
    }
    
    
    public function post_add(Request $request) {
        $data = [];
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'slug' => 'required',
                    'status' => 'required',
        ]);
        
        if ($validator->passes()) {
            
            $model = new Menu;
            $model->name = $request->input('name');
            $model->slug = $request->input('slug');
            $model->status = $request->input('status');
            
            $model->save();
            
            return redirect()->route('menu')->with('success_msg', 'Menu created successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
        
    }
    
    
    public function get_edit($id) {
        $data['menu'] = $menu = Menu::where('id', '=', $id)->first();
        if (!$menu) {
            return redirect()->route('menu')->with('error_msg', 'Invalid Link!');
        }
        $data['id'] = $id;
        return view('admin::menu.edit', $data);
    }
    
    public function post_edit(Request $request, $id) {
        $data = [];
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'slug' => 'required',
                    'status' => 'required',
        ]);
        
        if ($validator->passes()) {
            $model = Menu::where('id', '=', $id)->first();
            $model->name = $request->input('name');
            $model->slug = $request->input('slug');
            $model->status = $request->input('status');
           
            $model->save();
            return redirect()->route('menu')->with('success_msg', 'Menu updated successfully.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Something went wrong please check your input.');
        }
    }
    
    
    public function delete($id) {
        $data = [];
        $model = Menu::findOrFail($id);
        
        
        $model->delete();
        //--- Redirect Section
        $data['status'] = 200;
        $data['msg'] = 'Menu Deleted Successfully.';
        return response()->json($data);
        //--- Redirect Section Ends
    }
    
    
    
}
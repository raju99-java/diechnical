<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\FranchiseRequest;
use Yajra\Datatables\Datatables;

class FranchiseRequestController extends AdminController {

    public function index(Request $request) {
        return view('admin::franchiserequest.index');
    }

    public function get_list() {
        $email = FranchiseRequest::orderBy('id', 'desc')->get();
        return Datatables::of($email)
                        ->addColumn('action', function ($model) {
                            return '<a href="' . Route("franchise-request-view", ["id" => $model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> View</a>';
                        })
                        ->make(true);
    }

    public function get_view($id = "") {
        if ($id == "") {
            return redirect()->route('franchise-request');
        }
        $model = FranchiseRequest::find($id);
        if (empty($model)) {
            return redirect()->route('franchise-request')->with('error_msg', 'Data Not found.');
        }
        return view('admin::franchiserequest.view', ['model' => $model]);
    }

}

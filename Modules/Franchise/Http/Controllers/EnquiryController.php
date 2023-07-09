<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Enquiry;
use Yajra\Datatables\Datatables;

class EnquiryController extends AdminController {

    public function index(Request $request) {
        return view('admin::enquiry.index');
    }

    public function get_list() {
        $email = Enquiry::orderBy('id', 'desc')->get();
        return Datatables::of($email)
                        ->addColumn('action', function ($model) {
                            return '<a href="' . Route("enquiry-view", ["id" => $model->id]) . '" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> View</a>';
                        })
                        ->make(true);
    }

    public function get_view($id = "") {
        if ($id == "") {
            return redirect()->route('enquiry');
        }
        $model = Enquiry::find($id);
        if (empty($model)) {
            return redirect()->route('enquiry')->with('error_msg', 'Data Not found.');
        }
        return view('admin::enquiry.view', ['model' => $model]);
    }

}

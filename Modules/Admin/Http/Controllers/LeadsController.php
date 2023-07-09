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

/* * ************Models************* */
use App\Model\Lead;

class LeadsController extends AdminController {

    protected $appid, $secret;

    public function get_list() {


        return view('admin::leads.list');
    }

    public function get_leads_form_list_datatable() {
        $user_list = Lead::orderBy('id','DESC')->get();
        return Datatables::of($user_list)
                        ->addIndexColumn()
                        
                        ->editColumn('first_name', function ($model) {
                            return $model->first_name.' '.$model->last_name;
                        })
                        ->editColumn('email', function ($model) {
                            return $model->email;
                        })
                        ->editColumn('contact_number', function ($model) {
                            return $model->contact_number;
                        })
                        ->editColumn('interested_in', function ($model) {
                            return $model->interested_in;
                        })
                        
                        ->rawColumns(['photo','approve_status', 'action'])
                        ->make(true);
    }

   

    public function delete(Request $request, $id) {
        if ($request->ajax()) {
            $data = [];
            $model = UserDetails::findorFail($id);
            if (!empty($model)) {
                $model->status = '3';
                $model->updated_at = date('Y-m-d H:i:s');
                $model->save();
                $data['status'] = 200;
                $data['msg'] = 'User deleted successfully.';
            } else {
                $data['msg'] = 'Sorry ! No User details found.';
            }
            return response()->json($data);
        }
    }

    

    public function get_leads_form_csv() {
        $table = Lead::get();
        $filename = "lead_form_details.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('First Name', 'Last Name', 'Email','Contact Number','Country','Interested In'));

        foreach ($table as $row) {
            
            fputcsv($handle, array($row['first_name'],$row['last_name'],$row['email'],$row['contact_number'],$row['country'],$row['interested_in']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename);
    }
  
  	

}

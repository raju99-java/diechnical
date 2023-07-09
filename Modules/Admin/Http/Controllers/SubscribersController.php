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
use App\Model\Subscriber;

class SubscribersController extends AdminController {

    protected $appid, $secret;

    public function index() {


        return view('admin::subscribers.list');
    }

    public function get_list() {
        $user_list = Subscriber::orderBy('id','DESC')->get();
        return Datatables::of($user_list)
                        ->addIndexColumn()
                        
                        
                        ->editColumn('email', function ($model) {
                            return $model->email;
                        })
                        ->editColumn('created_at', function ($model) {
                            return !empty($model->created_at) ? date('jS M Y, g:i A', strtotime($model->created_at)) : '';
                        })
                        
                        ->rawColumns([''])
                        ->make(true);
    }

   

    
    

    

    public function get_subscribers_csv() {
        $table = Subscriber::get();
        $filename = "Subscriber_form_details.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('ID','Email'));

        foreach ($table as $row) {
            
            fputcsv($handle, array($row['id'],$row['email']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename);
    }
  
  	

}

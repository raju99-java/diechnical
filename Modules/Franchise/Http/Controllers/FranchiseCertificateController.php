<?php

namespace Modules\Franchise\Http\Controllers;

use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Validator;
use PDF;

use URL;
use App\Model\QuestionAnswer;
use App\Model\Settings;
use App\Model\Exam;
use App\Model\Course;
use App\Model\UserMaster;
use App\Model\AssignCourse;
use App\Model\Franchise;

class FranchiseCertificateController extends FranchiseController {

    //*** JSON Request
    public function datatables() {
        $id=Auth()->guard('franchise')->user()->id;
        // $datas = Exam::select('exams.*')->join('user_master','user_master.id','=','exams.user_id')->where('user_master.franchise_id', '=', $id)->where('exams.course_id','<>','0')->orderBy('id', 'desc')->get();
        $datas = Franchise::where('id','=',$id)->where('status','=','1')->get();
        // print_r($datas);exit;
        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
                        ->addIndexColumn()
                        ->editColumn('name', function ($model) {
                            // $user=UserMaster::where('id',$model->user_id)->first();
                            $name = $model->name;
                            return $name;
                        })
                        ->editColumn('registration_id', function ($model) {
                            // $course=Course::where('id',$model->course_id)->first();
                            $reg_id = $model->registration_id;
                            return $reg_id;
                        })
                        ->editColumn('status', function ($model) {
                            $status = $model->status;
                            if ($status == '0') {
                                $status = '<span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>';
                            } else  {
                                $status = '<span class="badge badge-success"><i class="icofont-check"></i>Active</span>';
                            }
                            return $status;
                        })
                        ->addColumn('action', function ($model) {
                            
                            return
                            
                            '<a href="' . Route("franchise-certificate-view", [$model->id]) . '" target="_blank" class="btn btn-xs btn-primary pull-left"><i class="fa fa-eye"></i> View Certificate</a>'.
                            '<a href="' . Route("franchise-certificate-download", [$model->id]) . '" target="_blank" class="btn btn-xs btn-primary pull-left"><i class="fa fa-file"></i> Download Certificate</a>';
                    
                        })
                        ->rawColumns(['status', 'action'])
                        ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index() {
        return view('franchise::franchisecertificate.list');
    }

    

    //*** GET Request
    public function view_certificate($id) {
        $data = [];
        $data['model'] = $model = Franchise::where('id',$id)->first();
        
        $link = Route('verify-certificate-verification').'?certificate_no='.$model->registration_id;
        \QrCode::size(200)
            ->format('png')
            ->generate("Certificate Verification: $link", public_path('/frontend/qrcode/'.$model->name.'qrcode.png'));
            
        $data['qrcode']= URL::asset('public/frontend/qrcode/'.$model->name.'qrcode.png');
        
        $pdf = PDF::loadView('franchise::franchisecertificate.alc_certificate', $data);
        // return $pdf->download($model->registration_id.'certificate.pdf');
        return $pdf->stream();
            
        // return view('franchise::franchisecertificate.view_certificate', $data);
    }
   
    
    public function download_certificate(Request $request,$id) {
        $data = [];
        $data['model'] = $model = Franchise::where('id',$id)->first();
        
        $link = Route('verify-certificate-verification').'?certificate_no='.$model->registration_id;
        \QrCode::size(200)
            ->format('png')
            ->generate("Certificate Verification: $link", public_path('/frontend/qrcode/'.$model->name.'qrcode.png'));
            
        $data['qrcode']= URL::asset('public/frontend/qrcode/'.$model->name.'qrcode.png');
        

        $pdf = PDF::loadView('franchise::franchisecertificate.alc_certificate', $data);
        return $pdf->download($model->registration_id.'certificate.pdf');
        // return $pdf->stream();
        exit;
        // return redirect()->back();
    }
   

}

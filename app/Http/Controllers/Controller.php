<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Response;
use Mail;
use App\Model\EmailNotification;
use App\Model\UserMaster;
use App\Model\UserDetails;
use PDF;
class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    protected $item_per_page = 10;
    protected $page_title = '';
    protected $_body_class = 'page';
    protected $view_namespace;
    protected $_theme = '';
    //ajax related attributes
    protected $ajax_fail = TRUE;
    protected $ajax_success = FALSE;
    protected $ajax_message = '';
    protected $ajax_error = '';
    protected $ajax_reload = FALSE;
    protected $ajax_errors = [];
    protected $ajax_area = 'front'; //override from admin corresponding area
    public $_days = ['Monday', 'Tuesday', 'Wednesday', 'Thrusday', 'Friday', 'Saturday', 'Sunday'];
    public $controllerName = '';
    public $actionName = '';

    public function __construct(Request $request) {
        /* if (!$request->ajax()) {
          $route = Route::currentRouteName();
          $seo = Seo::where(['route' => $route])->first();

          if ($seo != NULL) {
          MetaTag::set('title', $seo->title);
          MetaTag::set('keyword', $seo->keyword);
          MetaTag::set('description', $seo->description);
          //                MetaTag::set('image', asset('images/locked-logo.png'));
          }else{
          $seo = new Seo;
          $seo->route = $route;
          $seo->save();
          }
          } */

        /* $currentAction = Route::getActionName();
          list($controller, $action) = explode('@', $currentAction);
          $this->controllerName = preg_replace('/.*\\\/', '', $controller);
          $this->actionName = preg_replace('/.*\\\/', '', $action);
          $this->_body_class = 'page'; */
    }

    public function rand_string($digits) {
        $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz" . time();
        $rand = substr(str_shuffle($alphanum), 0, $digits);
        return $rand;
    }

    public function rand_number($digits) {
        $alphanum = "0123456789" . time();
        $rand = substr(str_shuffle($alphanum), 0, $digits);
        return $rand;
    }

    public function get_email_data($slug, $replacedata = array()) {
        $email_data = EmailNotification::where(['email_code' => $slug])->first();
        $email_msg = "";
        $email_array = array();
        $email_msg = $email_data->body;
        $subject = $email_data->subject;
        if (!empty($replacedata)) {
            foreach ($replacedata as $key => $value) {
                $email_msg = str_replace("{{" . $key . "}}", $value, $email_msg);
            }
        }
        return array('body' => $email_msg, 'subject' => $subject);
    }

    public function SendMail($data) {
        $template = view('mail.layouts.template')->render();
        $content = view('mail.' . $data['template'], $data['data'])->render();
        $view = str_replace('[[email_message]]', $content, $template);
        $data['content'] = $view;
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $headers .= 'From: admin@laravel.com' . "\r\n" .
//                'Reply-To: no-reply@laravel.com' . "\r\n" .
//                'X-Mailer: PHP/' . phpversion();
//        $va = str_replace('[[email_message]]', $content, $template);
//        return mail($data['to'], $data['subject'], $va, $headers);
        Mail::send([], [], function ($message) use ($data) {
            $message->from(env('MAIL_USERNAME', 'no-reply@whrpc.org'), env('PROJECT_NAME', 'Demo'));
            $message->replyTo(env('MAIL_USERNAME', 'no-reply@whrpc.org'), env('PROJECT_NAME', 'Demo'));
            $message->subject($data['subject']);
            $message->setBody($data['content'], 'text/html');
            $message->to($data['to']);
        });
    }
    public function Send_certificate($data) {
        // $template = view('mail.layouts.template')->render();
        $template = view('mail.layouts.template')->render();
        $content = view('mail.' . $data['template'], $data['data'])->render();
        $view = str_replace('[[email_message]]', $content, $template);
        
        $model['user'] =$user= UserDetails::where("id", $data['id'])->first();
        \QrCode::size(500)
            ->format('png')
            ->generate("$user->serial_number", public_path('/frontend/images/qrcode.png'));
        $path = public_path('uploads/pdf/certificate.pdf');
        $data['pdf'] = $pdf = PDF::loadView('mail.' . $data['certificate'], $model)->save($path);
        //Storage::put('public/uploads/pdf/invoice.pdf', $pdf->output());
        //print_r($model);die();
        //$view = view('mail.' . $data['template'], $model)->render();
        //print_r($view);die();
        // $view = str_replace('[[email_message]]', $content, $template);
        $data['content'] = $view;
        Mail::send([], [], function ($message) use ($data, $pdf) {
            $message->from(env('MAIL_USERNAME', 'no-reply@whrpc.org'), env('PROJECT_NAME', 'Demo'));
            $message->replyTo(env('MAIL_USERNAME', 'no-reply@whrpc.org'), env('PROJECT_NAME', 'Demo'));
            $message->subject($data['subject']);
            $message->setBody($data['content'], 'text/html');
            $message->attach(public_path('uploads/pdf/certificate.pdf'));
            $message->to($data['to']);
        });
    }
    public function PassExam($data) {
        // $template = view('mail.layouts.template')->render();
        $template = view('mail.layouts.template')->render();
        $content = view('mail.' . $data['template'], $data['data'])->render();
        $view = str_replace('[[email_message]]', $content, $template);
        
        
        
        $data['content'] = $view;
        Mail::send([], [], function ($message) use ($data) {
            $message->from(env('MAIL_USERNAME', 'no-reply@whrpc.org'), env('PROJECT_NAME', 'Demo'));
            $message->replyTo(env('MAIL_USERNAME', 'no-reply@whrpc.org'), env('PROJECT_NAME', 'Demo'));
            $message->subject($data['subject']);
            $message->setBody($data['content'], 'text/html');
            // $message->attach(public_path('uploads/pdf/certificate.pdf'));
            $message->to($data['to']);
        });
    }

    public function render($view, array $data = []) {

        $data['_theme'] = $this->_theme;
        //share value to master layout
        $_commom = [
            '__controller' => SiteHelpers::getControllerName(),
            '_page_title' => $this->page_title,
            '_body_class' => $this->_body_class,
        ];
        \View::share($_commom);
        $data = array_merge($data, $this->data);
//        if (Config::get('app.debug')) {
////            Debugbar::addMessage($_commom, 'global variable'); //remove in production
////            Debugbar::addMessage($data, 'View variable'); //remove in production
//            $data2['current_locale'] = App::getLocale();
////            Debugbar::addMessage($data2, 'View variable2'); //remove in production
//        }
        if (\Request::ajax()) {
            return \Response::json($data);
        }
        $this->layout->content = View::make($this->view_namespace . "$view")->with($data);
    }

    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = \View::make($this->layout);
        }
    }

    protected function ajaxResponse($data = []) {
        $fixed_data = [
            'is_login' => auth()->guard('admin')->check(),
            'reload' => $this->ajax_reload,
            'area' => $this->ajax_area,
            'message' => $this->ajax_message,
            'fail' => $this->ajax_fail,
            'success' => $this->ajax_success,
            'errors' => $this->ajax_errors,
            'error' => $this->ajax_error,
        ];
        $response = array_merge($fixed_data, $data);
        return Response::json($response);
    }
	

}

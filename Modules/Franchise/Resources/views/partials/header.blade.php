<?php
use App\Model\Franchise;

$id=Auth()->guard('franchise')->user()->id;
$franchise = Franchise::where('id','=',$id)->first();
?>

<?php
$routeArray = app('request')->route()->getAction();
$controllerAction = class_basename($routeArray['controller']);
list($controller, $action) = explode('@', $controllerAction);

?>
<!-------- Mobile view menu section -------->
<div class="mobile-view">
    <div class="logo-sec">
        <div class="clearfix d-flex">
            <div class="col-xs-6 col-6">
                <a href="{{ Route('franchise-profile') }}"><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="" class="img-responsive"></a>
            </div>
            <div class="col-xs-6 col-6 text-right">
                <a href="javascript:void(0);" id="MobilesidebarToggle" class="bgr-mnu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26.855" height="13.913" viewBox="0 0 26.855 13.913"><defs><style>.b{
                                fill: #0070c0;
                            }</style></defs><g transform="translate(0 -3)"><path class="b" d="M7.238,124.886H1.109a1.109,1.109,0,1,1,0-2.218H7.238a1.109,1.109,0,1,1,0,2.218Zm0,0" transform="translate(0 -113.82)"/><path class="a" d="M25.736,2.218H1.119A1.109,1.109,0,1,1,1.119,0H25.736a1.109,1.109,0,1,1,0,2.218Zm0,0" transform="translate(0 3)"/><path class="a" d="M16.37,247.55H1.109a1.109,1.109,0,0,1,0-2.218H16.37a1.109,1.109,0,0,1,0,2.218Zm0,0" transform="translate(0 -230.636)"/></g></svg>
                    <div class="clearfix"></div>
                </a>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="mobile-menu-link" style="display: none;">
        <ul>
            <li class="{{ ($controller=='DashboardController') ? 'active' : '' }}"><a href="{{ Route('franchise-dashboard') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
        
            @if($franchise->days_left > '0')
            <li class="{{ ($controller=='CourseController') ? 'active' : '' }}"><a href="{{Route('franchise-course-index')}}"><i class="fa fa-sitemap" aria-hidden="true"></i> Courses</a></li>
            <li class="{{ ($controller=='QuestionAnswerController') ? 'active' : '' }}"><a href="{{Route('franchise-question-answer-index')}}"><i class="fa fa-question" aria-hidden="true"></i>Question Answers</a></li>
            <li class="{{ ($controller=='StudentCourseAnswerController') ? 'active' : '' }}"><a href="{{Route('franchise-student-exam-answer-index')}}"><i class="fa fa-book" aria-hidden="true"></i>Exam Data</a></li>
            <li class="{{ ($controller=='StudentController') ? 'active' : '' }}"><a href="{{Route('franchise-students')}}"><i class="fa fa-user"></i> Students</a></li>
            <li class="{{ ($controller=='LiveClassController') ? 'active' : '' }}"><a href="{{Route('course-live-class-list')}}"><i class="icofont-video"></i> Live Class</a></li>
            
            
            <li class="{{ ($controller=='FranchiseBannerController') ? 'active' : '' }}"><a href="{{Route('franchise-banner-index')}}"><i class="fa fa-image"></i> Free Elements</a></li>
            <li class="{{ ($controller=='ElementController') ? 'active' : '' }}"><a href="{{Route('franchise-elements')}}"><i class="icofont-brand-alcatel"></i> Paid Elements</a></li>
            <li class="{{ ($controller=='FranchiseOrderController') ? 'active' : '' }}"><a href="{{Route('franchise-order-elements')}}"><i class="icofont-shopping-cart"></i> Your Orders</a></li>
            @endif
            
            
            <li><a href="{{ Route('franchise-logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
        <div class="top-right-btn">      
            <ul class="list-inline header-top pull-right">
                <!--<li>-->
                <!--    <a href="#" class="icon-info">-->
                <!--        <i class="dash_menu_icon_7"></i>-->
                <!--        <span class="label label-primary"></span>-->
                <!--    </a>-->
                <!--</li>-->
                <li class="">
                    <div class="dropdown dash-drop">
                        <span data-toggle="dropdown" aria-expanded="false">
                            <img class="img-responsive rounded-circle headr-prof-pic" src="{{URL::asset('public/uploads/user/'.Auth::guard('franchise')->user()->owner_image)}}" onerror="this.src='{{ URL::asset('public/backend/images/user.jpg') }}';" alt="">
                                <h1>{{!empty(Auth::guard('franchise')->user()->owner_name)?Auth::guard('franchise')->user()->owner_name:'Director'}} <i class="icofont-caret-down"></i></h1>
                        </span>
                        <ul class="dropdown-menu nw-drp">
                            <li><a href="{{ Route('franchise-profile') }}" data-original-title="" title=""><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Profile</a></li>
                            <li><a href="{{ Route('franchise-logout') }}" data-original-title="" title=""><i class="fa fa-power-off" aria-hidden="true"></i>&nbsp;Logout</a></li>
                        </ul>
                    </div>
                </li>
                <li class="d-flex align-items-center">
                    <span  class=" d-flex align-items-center">
                        
                        
                    </span>
                </li>
                <li>
                    @if($franchise->days_left <= '3')
                    
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-cst-4 ">
                                <a href="{{Route('franchise-renew-plan')}}" class="btn btn-primary">Renew Plan</a>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-cst-4 ">
                                <a href="{{Route('franchise-renew-plan')}}" class="btn btn-primary">Upgrade Plan</a>
                            </div>
                        </div>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>
<!-------- End Mobile view menu section -------->

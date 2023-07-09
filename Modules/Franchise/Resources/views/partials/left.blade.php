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

<div class="user-left-side">
    <div class="side-bar-menu">      
        <!--<a href="#" class="big-logo"><img src="{{ URL::asset('assets/backend/images/dash_logo.png') }}" class="img-responsive"></a>-->
        <a href="{{ Route('franchise-dashboard') }}" class="big-logo"><img src="{{ URL::asset('public/frontend/images/logo.png') }}" class="img-responsive"></a>
        <!--<a href="{{ Route('franchise-dashboard') }}" class="big-logo">Ditechnical</a>-->
        <a href="javascript:void(0);" class="berger" id="sidebarToggle">
            <svg xmlns="http://www.w3.org/2000/svg" width="26.855" height="13.913" viewBox="0 0 26.855 13.913"><defs><style>.a{
                        fill:#8898aa;
                    }</style></defs><g transform="translate(0 -3)"><path class="a" d="M7.238,124.886H1.109a1.109,1.109,0,1,1,0-2.218H7.238a1.109,1.109,0,1,1,0,2.218Zm0,0" transform="translate(0 -113.82)"/><path class="a" d="M25.736,2.218H1.119A1.109,1.109,0,1,1,1.119,0H25.736a1.109,1.109,0,1,1,0,2.218Zm0,0" transform="translate(0 3)"/><path class="a" d="M16.37,247.55H1.109a1.109,1.109,0,0,1,0-2.218H16.37a1.109,1.109,0,0,1,0,2.218Zm0,0" transform="translate(0 -230.636)"/></g></svg>
            <div class="clearfix"></div>
        </a>
    </div>
    <h1 class="left_top_menu_heading"></h1>
    <ul>
        <li class="{{ ($controller=='DashboardController') ? 'active' : '' }}"><a href="{{ Route('franchise-dashboard') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
        
        @if($franchise->days_left > 0)
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
</div>

@if(in_array($controller, ['SettingsController','EmailNotificationController','CmspageController','CmsController','FaqController']))
<script>
    $(window).on('load', function () {
        $('#accordion-menu').trigger('click');
        $('#accordion-menus').trigger('click');
    });
</script>
@endif
@if(in_array($controller, ['ApplyController']))
<script>
    $(window).on('load', function () {
        $('#apply').trigger('click');
        $('#applies').trigger('click');
    });
</script>
@endif
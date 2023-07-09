<?php
$routeArray = app('request')->route()->getAction();
$controllerAction = class_basename($routeArray['controller']);
list($controller, $action) = explode('@', $controllerAction);
?>

<div class="col-md-3 col-sm-3 tab_dsh_1">
    <div class="dash-left-menu">
        <ul>
            <li class="{{(in_array(\Request::route()->getName(),['dashboard']))?'active':''}} add-border"><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> DASHBOARD</a>
            </li>
            <li class="{{(in_array(\Request::route()->getName(),['user-course']))?'active':''}} add-border"><a href="{{route('user-course')}}"><i class="fa fa-cart-arrow-down"></i> COURSES</a>
            </li>
            <li class="{{(in_array(\Request::route()->getName(),['user-live-class']))?'active':''}} add-border"><a href="{{route('user-live-class')}}"><i class="icofont-video"></i> Live Classes</a>
            </li>
            <li class="{{(in_array(\Request::route()->getName(),['my-profile']))?'active':''}} add-border"><a href="{{route('my-profile')}}"><i class="fa fa-user"></i> MY ACCOUNT</a>
            </li>
            <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> LOGOUT</a>
            </li>
        </ul>
    </div>
</div>




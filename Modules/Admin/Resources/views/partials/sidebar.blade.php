<div class="user-top-head">

    <div class="top-right-btn">      
        <ul class="list-inline header-top d-flex pull-right">
            <!--<li class="d-flex align-items-center">-->
            <!--    <a href="#" class="icon-info d-flex align-items-center">-->
            <!--        <i class="dash_menu_icon_8"></i>-->
            <!--        <span class="label label-primary"></span>-->
            <!--    </a>-->
            <!--</li>-->
            <!--<li class="d-flex align-items-center">-->
            <!--    <a href="#" class="icon-info d-flex align-items-center">-->
            <!--        <i class="dash_menu_icon_7"></i>-->
            <!--        <span class="label label-primary"></span>-->
            <!--    </a>-->
            <!--</li>-->
            <li class="">
                <div class="dropdown dash-drop">
                    <span data-toggle="dropdown" aria-expanded="false">
                        <img class="img-responsive rounded-circle headr-prof-pic" src="{{URL::asset('public/uploads/user/'.Auth::guard('backend')->user()->image)}}" onerror="this.src='{{ URL::asset('public/backend/images/user.jpg') }}';" alt="">
                        <h1>{{!empty(Auth::guard('backend')->user()->full_name)?Auth::guard('backend')->user()->full_name:'Admin'}} <i class="icofont-caret-down"></i></h1>

                    </span>
                    <ul class="dropdown-menu nw-drp">
                        <li><a href="{{ Route('admin-profile') }}" data-original-title="" title=""><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Profile</a></li>
                        <li><a href="{{ Route('admin-logout') }}" data-original-title="" title=""><i class="fa fa-power-off" aria-hidden="true"></i>&nbsp;Logout</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
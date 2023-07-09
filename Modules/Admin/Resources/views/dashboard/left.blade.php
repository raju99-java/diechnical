<?php
$routeArray = app('request')->route()->getAction();
$controllerAction = class_basename($routeArray['controller']);
list($controller, $action) = explode('@', $controllerAction);
$user_left_model = \App\Model\UserMaster::where('id', Auth::guard('backend')->id())->first();
?>
<div class="profile-sidebar">
    <div class="portlet light profile-sidebar-portlet bordered">
        <div class="profile-userpic text-center">
            <img style="height: 150px;" src="{{URL::asset('public/uploads/user/'.$user_left_model->image)}}" onerror="this.src='{{ URL::asset('public/backend/images/user.jpg') }}';" class="img-responsive" alt=""> </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"> {{ Auth()->guard('backend')->user()->name }} </div>
            <div class="profile-usertitle-job"> {{($user_left_model->type_id==1 ? 'Admin' : 'Moderator')}} </div>
        </div>
        <div class="profile-usermenu ">
            <ul class="nav justify-content-center">
                <li class="mb-2 {{($action=='get_profile') ? 'active' : ''}}">
                    <a href="{{Route('admin-profile')}}">
                        <i class="fa fa-cog"></i> Account Settings 
                    </a>
                </li>
                <li class="{{($action=='get_change_password') ? 'active' : ''}}">
                    <a href="{{Route('admin-change-password')}}">
                        <i class="fa fa-info-circle"></i> Change Password 
                    </a>
                </li>
                <li class="{{($action=='get_change_image') ? 'active' : ''}}">
                    <a href="{{Route('user-change-image')}}">
                        <i class="fa fa-file-photo-o"></i> Change Image
                    </a>
                </li>
                <li class="{{($action=='get_center_incharge_image') ? 'active' : ''}}">
                    <a href="{{Route('center-incharge-image')}}">
                        <i class="fa fa-file-photo-o"></i> Center Incharge Image
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
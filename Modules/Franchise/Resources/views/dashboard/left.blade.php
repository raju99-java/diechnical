<?php
$routeArray = app('request')->route()->getAction();
$controllerAction = class_basename($routeArray['controller']);
list($controller, $action) = explode('@', $controllerAction);
$user_left_model = \App\Model\Franchise::where('id', Auth::guard('franchise')->id())->first();
?>
<div class="profile-sidebar">
    <div class="portlet light profile-sidebar-portlet bordered">
        <div class="profile-userpic text-center">
            <img style="height: 150px;" src="{{URL::asset('public/uploads/user/'.$user_left_model->owner_image)}}" onerror="this.src='{{ URL::asset('public/backend/images/user.jpg') }}';" class="img-responsive" alt=""> </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"> {{ Auth()->guard('franchise')->user()->owner_name }} </div>
            <div class="profile-usertitle-job"> Director </div>
        </div>
        <div class="profile-usermenu ">
            <ul class="nav justify-content-center">
                <li class="mb-2 {{($action=='get_profile') ? 'active' : ''}}">
                    <a href="{{Route('franchise-profile')}}">
                        <i class="fa fa-cog"></i> Account Settings 
                    </a>
                </li>
                <li class="{{($action=='get_change_password') ? 'active' : ''}}">
                    <a href="{{Route('franchise-change-password')}}">
                        <i class="fa fa-info-circle"></i> Change Password 
                    </a>
                </li>
                <li class="{{($action=='get_change_image') ? 'active' : ''}}">
                    <a href="{{Route('franchise-user-change-image')}}">
                        <i class="fa fa-file-photo-o"></i> Change Image
                    </a>
                </li>
                <li class="{{($action=='get_sign_image') ? 'active' : ''}}">
                    <a href="{{Route('franchise-user-sign-image')}}">
                        <i class="fa fa-file-photo-o"></i> Upload Signature
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
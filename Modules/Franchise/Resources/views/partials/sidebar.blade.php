<?php
use App\Model\Franchise;

$id=Auth()->guard('franchise')->user()->id;
$franchise = Franchise::where('id','=',$id)->first();
?>
<div class="user-top-head">

    <div class="top-right-btn">
              
        <ul class="list-inline header-top d-flex pull-right">
            
            <li class="d-flex align-items-left">
                <!--<a href="#" class="icon-info d-flex align-items-center">-->
                <!--    <i class="dash_menu_icon_8">Renew</i>-->
                <!--    <span class="label label-primary"></span>-->
                <!--</a>-->
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
            <li class="d-flex align-items-center">
                <span  class=" d-flex align-items-center">
                    
                    
                </span>
            </li>
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
        </ul>
    </div>
</div>


@extends('franchise::layouts.main')

@section('content')

@php
use Illuminate\Support\Str;
@endphp
<div class="clearfix">
    <div class="dash-bottom-part">
        <div class="bottom-part-1">
            <div class="col-sm-12">
                <h1 class="dash_heading">DASHBOARD</h1>
                
               
                
                <div class="row">
                    
                    @if($franchise['days_left'] > '0')
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('franchise-students')}}">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                  	<div class="media-right">
                                        <i class="fa fa-users" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_student)?$total_student:'0'}}</h1>
                                        <h2>TOTAL STUDENT</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>
                    
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('franchise-certificate-index')}}">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                  	<div class="media-right">
                                        <i class="fa fa-certificate" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_certificate_generate)?$total_certificate_generate:'0'}}</h1>
                                        <h2>CERTIFICATE VIEW & DOWNLOAD</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('franchise-course-index')}}">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                  	<div class="media-right">
                                        <i class="fa fa-book" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_course)?$total_course:'0'}}</h1>
                                        <h2>TOTAL COURSE</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('franchise-student-exam-answer-index')}}">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                  	<div class="media-right">
                                        <i class="fa fa-database" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_exam_data)?$total_exam_data:'0'}}</h1>
                                        <h2>TOTAL EXAM DATA</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>
                    
                    
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('franchise-wallet')}}">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                  	<div class="media-right">
                                        <i class="icofont-wallet" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                        
                                    </div>
                                    <div class="media-left">
                                        <h1>₹ {{isset($franchise->wallet_amount)?(float)($franchise->wallet_amount):'0.0'}}</h1>
                                        <h2>Wallet Amount</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>
                    @endif
                    
                    @if($franchise['referral_code'] != '' && $franchise['days_left'] > '0')
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{Route('franchise-centers')}}">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                  	<div class="media-right">
                                        <i class="icofont-ui-rate-add" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        
                                        <h1>Center Joining</h1>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>
                    @endif
                    
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="#">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                  	<div class="media-right">
                                        <i class="icofont-brand-axiata" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                        
                                    </div>
                                    <div class="media-left">
                                        <h1>  {{isset($franchise->plan->name)?$franchise->plan->name:'NA'}}</h1>
                                        <h2>  Current Plan</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>
                    
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="#">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                  	<div class="media-right">
                                        <i class="icofont-ui-timer" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                        
                                    </div>
                                    <div class="media-left">
                                        <h1>  {{isset($franchise['days_left'])?$franchise['days_left']:'0'}} Days Left</h1>
                                        <h2>  Validity</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>
                    
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{ isset($franchise['agreement_file'])? URL::asset('public/uploads/bannars/'.$franchise->agreement_file) : '' }}" target="_blank">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                  	<div class="media-right">
                                        <i class="fa fa-file" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                        
                                    </div>
                                    <div class="media-left">
                                        <h1>   ALC Agreement</h1>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>
                    
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('franchise-wallet-history')}}">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                  	<div class="media-right">
                                        <i class="icofont-wallet" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_wallet_history)?$total_wallet_history:'0'}}</h1>
                                        <h2>Wallet History</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>
                    
                    
                    
                </div>
                
                <div class="row">
                    
                    <div class="col-sm-12">
                            <h1 class="dash_heading">All Franchise Plan Fee Charge</h1>
                    </div>
                    
                    <div id="here_table" class="col-sm-12" >
                        <div style="overflow: auto;">
                            <table  class="table table-striped table-bordered" style="text-transform: uppercase;">
                                <tbody>
                                    <tr>
                                        <th><b>Plan</b></th>
                                        
                                        @forelse($plans as $plan)
                                            <th><b>{{$plan->name}}</b></th>
                                        @empty
                                        @endforelse
                                    </tr>  
                
                                                
                                    <tr>
                                        <td><b>Registration Fee</b></td>
                                        
                                        @forelse($plans as $plan)
                                            <td>{{$plan->registration_fee}}</td>
                                        @empty
                                        @endforelse
                                    </tr>
                                    <tr>
                                        <td><b>Course Assign Fee</b></td>
                                        
                                        @forelse($plans as $plan)
                                            <td>{{$plan->course_assign_fee}}</td>
                                        @empty
                                        @endforelse
                                    </tr>
                                    <tr>
                                        <td><b>Certificate Fee</b></td>
                                        
                                        @forelse($plans as $plan)
                                            <td>{{$plan->certificate_fee}}</td>
                                        @empty
                                        @endforelse
                                    </tr>
                                    <tr>
                                        <td><b>Commission</b></td>
                                        
                                        @forelse($plans as $plan)
                                            <td>{{$plan->commission}} %</td>
                                        @empty
                                        @endforelse
                                    </tr>
                                    <tr>
                                        <td><b>Total Amount Payable by ALC</b></td>
                                        
                                        @forelse($plans as $plan)
                                            <td><b>{{$plan->registration_fee + $plan->course_assign_fee + $plan->certificate_fee}}</b></td>
                                        @empty
                                        @endforelse
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    
                </div>
                <!-- @if($franchise['days_left'] <= '3')-->
                    
                <!--    <div class="row">-->
                <!--        <div class="col-lg-3 col-sm-6 col-cst-4 ">-->
                <!--            <a href="{{Route('franchise-renew-plan')}}" class="btn btn-primary">Renew Plans</a>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--@else-->
                <!--    <div class="row">-->
                <!--        <div class="col-lg-3 col-sm-6 col-cst-4 ">-->
                <!--            <a href="{{Route('franchise-renew-plan')}}" class="btn btn-primary">Upgrade Plans</a>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--@endif-->
            </div>
        </div>
    </div>
</div>
@stop
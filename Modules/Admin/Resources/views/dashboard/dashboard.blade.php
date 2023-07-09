@extends('admin::layouts.main')

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
                    
                    
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('students')}}">
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
                        <a href="#">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                  	<div class="media-right">
                                        <i class="fa fa-book" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_course_purchase)?$total_course_purchase:'0'}}</h1>
                                        <h2>TOTAL COURSE PURCHASE</h2>
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
                                        <i class="fa fa-certificate" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_certificate_generate)?$total_certificate_generate:'0'}}</h1>
                                        <h2>TOTAL CERTIFICATE GENERATE</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('admin-course-index')}}">
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
                        <a href="{{route('admin-student-exam-answer-index')}}">
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
                    <!-- franchise sec -->
                    
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('franchise-request')}}">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                  	<div class="media-right">
                                        <i class="fa fa-list-ul" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_franchise)?$total_franchise:'0'}}</h1>
                                        <h2>FRANCHISE LIST</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>
                    
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('franchise-course-list-index')}}">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                  	<div class="media-right">
                                        <i class="fa fa-sitemap" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_franchise_course)?$total_franchise_course:'0'}}</h1>
                                        <h2>FRANCHISE COURSES</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>
                    
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('franchise-student-exams')}}">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                  	<div class="media-right">
                                        <i class="fa fa-database" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($franchise_exam_data)?$franchise_exam_data:'0'}}</h1>
                                        <h2>FRANCHISE EXAM DATA</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>
                    
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('franchise-student-list')}}">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                  	<div class="media-right">
                                        <i class="fa fa-users" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_franchise_student)?$total_franchise_student:'0'}}</h1>
                                        <h2>FRANCHISE STUDENTS</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>
                    
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('wallet-history')}}">
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
                    
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('enquiry')}}">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                  	<div class="media-right">
                                        <i class="fa fa-question" style="font-size: 5em; color: #0088CC;" aria-hidden="true"></i>
                                    </div>
                                    <div class="media-left">
                                        <h1>{{isset($total_enquiry)?$total_enquiry:'0'}}</h1>
                                        <h2>ENQUIRY</h2>
                                    </div>
                                    
                                </div>
                            </div> 
                        </a>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@stop
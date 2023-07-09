@extends('layouts.main')
@section('css')
<style>

</style>
@stop
@section('content')
<!--------------------breadcrumb ---------------------->
<section class="breadcrumb about-us-b">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-title-div">
                    <div class="bread-left-side">
                        <h2>Affiliation Process</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="/">HOME</a>/</li>
                            <li><span>Affiliation Process</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------- //breadcrumb ------------------->
<!--------------------------------Main content Start--------------------------->
<section class="main">
        <div class="container">
             
             
            <div class="row row-eq-height">
                @foreach($plans as $plan)
                <div class="col-sm-3 equal-col">
                    <div class="plans-main-div">
                        <div class="plan-name">
                            <h3><i class="icofont-plus-circle plus-icon"></i> {{$plan->name}} <span class="theme-colour">Plan</span></h3>
                        </div>
                        <div class="plan-price">
                            <p><i class="icofont-rupee"></i> {{ ($plan->price == '')? "Free*" : $plan->price }} </p>
                        </div>
                        <div class="plan-details">
                            {!! $plan->details !!}
                            
                        </div>
                        <div class="plan-timing">
                            @if($plan->validity > 29 && $plan->validity < 365)
                              <p>For {{ round($plan->validity / 30) }} Months*</p>
                            @else
                              <p>For {{ round($plan->validity / 365) }} Year*</p>
                            @endif
                            
                        </div>
                    </div>
                </div>
                @endforeach
                
                
            </div>
            
            <div class="row">
                <div class="col-sm-8 offset-sm-2">
                    <div class="affiliation-process">
                        <div class="Director-Message">
                            <h3>Affiliation Process</h3>
                            <h6 class="m-0 pt-4">Guidelines For Authorized Learning Center</h6>
                            <ul class="exams-ul">
                            <li>Check out Affiliation Fee</li>
                            <li>Select any Plan & details View </li>
                            </ul>
                        </div>
                        
                        <div class="Director-Message">
                            <h6 class="m-0 pt-4">Requeirment </h6>
                            <ul class="exams-ul">
                            <li>Personal Full Details</li>
                            <li>Passport Size Photograph</li> 
                            <li>Adhar Card + Pan Card</li>
                            <li>Bank Pass Book</li>
                            <li>Office Address Proof (Bijli Bill / Rent Agreement etc)</li>
                            <li>Minimume System Requirment 4 Set</li>
                            <li>Office images ( Front + Office counter + Computer Lab  + Theory Room)</li>
                            <li>Internet Connection</li>

                            </ul>
                        </div>
                        <a href="{{route('apply-online')}}" class="btn btn-danger">Apply Now</a>
                    </div>
                    <!--<div class="franchisee"><a href="{{route('apply-online')}}" class="btn btn-danger">Apply Now</a></div>-->
                </div>
            </div> 
        </div>
    </section>

<!----------------------------------Main content End--------------------------->

@stop
@section('js')

@stop
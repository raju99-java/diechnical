@extends('layouts.main')
@section('css')
<style>

</style>
@stop
@section('content')
<!--------------------breadcrumb ---------------------->
<section class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-title-div">
                    <div class="bread-left-side">
                        <h2>toppers talk</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="/">HOME</a>/</li>
                            <li><span>toppers talk</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------- //breadcrumb ------------------->
<!--------------------------------Main content Start--------------------------->
<section class="main-content">
    <section class="toppers-talk">
        <div  class="container">
            <div class="who-we-are-title">
                <h3>Complete Academic and Career Success with DITECHNICAL</h3>		
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="services-box">
                        <div class="services-icon">	<img width="137" height="137" src="{{ URL::asset('public/frontend/images/toppers.png') }}" class="image-fluid" alt="">
                        </div>
                        <div class="services-text">
                            <h3 class="box-title">Harsh Yadav</h3>
                            <p>We all need a helping hand at some point in time, and it has become more evident during the current corona pandemic situation globally. We all understand that you need loyal friends more than anything else in a time of an emergency.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="services-box">
                        <div class="services-icon">	<img width="137" height="137" src="{{ URL::asset('public/frontend/images/toppers.png') }}" class="image-fluid" alt="">
                        </div>
                        <div class="services-text">
                            <h3 class="box-title">Subhash</h3>
                            <p>Dreams are dream, without goals. So make your strategy and get your vision, Don’t make pretence. I highly recommend to those students, who want to make bright future on their way. Then have to visit DITECHNICAL.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="services-box">
                        <div class="services-icon">	<img width="137" height="137" src="{{ URL::asset('public/frontend/images/toppers.png') }}" class="image-fluid" alt="">
                        </div>
                        <div class="services-text">
                            <h3 class="box-title">Deepak Yadav</h3>
                            <p>Its a very famous coaching institute for academic classes. The facilities of this institute are Superb they teach very effectively . Specially study materials are very good so it is very helpfull</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<!----------------------------------Main content End--------------------------->
@stop
@section('js')

@stop
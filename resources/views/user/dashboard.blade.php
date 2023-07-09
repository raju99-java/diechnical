@extends('layouts.main')
@section('page_css')

@stop
@section('content')


<!--------------------breadcrumb ---------------------->
<section class="breadcrumb about-us-b">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-title-div">
                    <div class="bread-left-side">
                        <h2>dashboard</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="/">HOME</a>/</li>
                            <li><span>dashboard</span></li>
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
    <section class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('partials.left')
                <div class="col-md-9 col-sm-9 tab_dsh_2">
                    <div class="dash-right-sec">
                        <div class="successfull">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="user-profile-details">
                                            <div class="account-info">
                                                <div class="header-area">
                                                    <h4 class="title">
                                                        DASHBOARD
                                                    </h4>
                                                </div>
                                                <div class="edit-info-area">
                                                    <div class="body">
                                                        <div class="edit-info-area-form">
                                                            <p> Hello {{Auth()->guard('frontend')->user()->full_name}}, (If Not <a href="{{route('logout')}}">!Logout</a>)</p>
                                                            <p>From your account dashboard. you can easily check &amp; view your course details.</p>
                                                        </div>
                                                        <div class="button-course">
                                                            <a href="{{route('courses')}}" class="btn btn-view-course">View Courses</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</section>
<!----------------------------------Main content End--------------------------->
@stop
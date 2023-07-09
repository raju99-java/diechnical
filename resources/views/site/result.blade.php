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
                        <h2>RESULT</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="/">HOME</a>/</li>
                            <li><span>RESULT</span></li>
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
    <section class="exam-div">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 mb-3">
                    <div class="result-download">
                        <h2>DI TECHNICAL</h>
                            <h3>Result Online</h3>
                    </div>
                    <form class="" id="download-result-form" action="{{route('download-result')}}" method="POST">
                        @csrf
                        <input type="text" class="enroll form-control" name="enrollment_id" placeholder="Enrollment Number" required=""><br>
                        <span class="help-block" id="error-enrollment_id"></span>
                        <input type="submit" name="submit" class="btn btn-success" value="SUBMIT">
                        
                    </form>
                    <span id="result-content"></span>
                    <div class="di-table-image text-center mt-3">
                        <img src="{{ URL::asset('public/frontend/images/Screenshot (13).png') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="side-bar-page">
                        <div class="enqir-sec">
                            <h3 class="quick-title-sec">Quick Enquiry</h3>
                            <form class="quick-enquiry-form" id="enquiry-form" action="{{route('post-enquiry')}}" method="POST">
                                @csrf
                                <div class="form-group q-grp">
                                    <label class="quick-label">Services*</label>
                                    <select id="services" class="form-control" name="services">
                						<option value="">Select Services</option>
                						<option value="New Franchise">New Franchise</option>
                						<option value="Admission">Admission</option>
                						<option value="Student">Student</option>
                						<option value="ALC">ALC</option>
                						<option value="Other">Other</option>
                					</select>
                                    <span class="help-block" id="error-services"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Full Name*</label>
                                    <input type="text" name="name" class="form-control quick-input" placeholder="Enter Your Full Name.." > 
                                    <span class="help-block" id="error-name"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Contact No*</label>
                                    <input type="tel" name="phone" class="form-control quick-input" placeholder="Enter Your Contact No.." >	
                                    <span class="help-block" id="error-phone"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Email Id*</label>
                                    <input type="email" name="email" class="form-control quick-input" placeholder="Enter Your Email Id..">	
                                    <span class="help-block" id="error-email"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Address*</label>
                                    <textarea name="address" cols="20" rows="2" class="form-control quick-textaeea" placeholder="Address"></textarea>	
                                    <span class="help-block" id="error-address"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Message*</label>
                                    <textarea name="message" cols="20" rows="2" class="form-control quick-textaeea" placeholder="Message"></textarea>	
                                    <span class="help-block" id="error-message"></span>
                                </div>
                                <button type="submit" class="quick-submit">Submit</button>
                            </form>
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
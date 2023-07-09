@extends('layouts.main')
@section('css')
<style>

.plans-main-div{
    border-radius : 20px !important;
    margin-top: 0px !important;
    min-height: 620px !important;
}
.plan-details {
    min-height: 600px !important;
}
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
                        <h2>Student Facilities</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="/">HOME</a>/</li>
                            <li><span>Student Facilities</span></li>
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
                
                <div class="col-sm-7">
                    
                    <!--<div class="exam-sec">-->
                    <!--    <div class="Director-Message">-->
                    <!--        <h3>Student Facilities</h3>		-->
                    <!--    </div>-->
                    <!--    <p><i class="icofont-bubble-right"></i> Online Registration-->

                    <!--    <p><i class="icofont-bubble-right"></i> Offline Registration</p>-->
                        
                    <!--    <p><i class="icofont-bubble-right"></i> Login ID Password</p>-->
                        
                    <!--    <p><i class="icofont-bubble-right"></i> ID Card</p>-->
                        
                    <!--    <p><i class="icofont-bubble-right"></i> Weekly Group Discussion</p>-->
                        
                    <!--    <p><i class="icofont-bubble-right"></i> Online Admit Card</p>-->
                        
                    <!--    <p><i class="icofont-bubble-right"></i> Monthly Test</p>-->

                    <!--    <p><i class="icofont-bubble-right"></i> Every Month Exam</p>-->
                        
                    <!--    <p><i class="icofont-bubble-right"></i> Online Study Material</p>-->
                        
                    <!--    <p><i class="icofont-bubble-right"></i> Offline Study Material</p>-->
                        
                    <!--    <p><i class="icofont-bubble-right"></i> Online Certificate</p>-->
                        
                    <!--    <p><i class="icofont-bubble-right"></i> Offline Certificate</p>-->
                        
                    <!--    <p><i class="icofont-bubble-right"></i> Online Certification Verification</p>-->
                        
                    <!--    <p><i class="icofont-bubble-right"></i> Working Mode Education</p>-->
                        
                    <!--    <p><i class="icofont-bubble-right"></i> 100% Job Oriented Course</p>-->
                        
                    <!--</div>-->
                    
                    <div class="plans-main-div">
                        <div class="plan-name">
                            <h3><i class="icofont-user"></i> Student <span class="theme-colour">Facilities</span></h3>
                        </div>
                        
                        <div class="plan-details">
                            
                            <p><i class="icofont-bubble-right"></i> Online Registration

                            <p><i class="icofont-bubble-right"></i> Offline Registration</p>
                            
                            <p><i class="icofont-bubble-right"></i> Login ID Password</p>
                            
                            <p><i class="icofont-bubble-right"></i> ID Card</p>
                            
                            <p><i class="icofont-bubble-right"></i> Weekly Group Discussion</p>
                            
                            <p><i class="icofont-bubble-right"></i> Online Admit Card</p>
                            
                            <p><i class="icofont-bubble-right"></i> Monthly Test</p>
    
                            <p><i class="icofont-bubble-right"></i> Every Month Exam</p>
                            
                            <p><i class="icofont-bubble-right"></i> Online Study Material</p>
                            
                            <p><i class="icofont-bubble-right"></i> Offline Study Material</p>
                            
                            <p><i class="icofont-bubble-right"></i> Online Certificate</p>
                            
                            <p><i class="icofont-bubble-right"></i> Offline Certificate</p>
                            
                            <p><i class="icofont-bubble-right"></i> Online Certification Verification</p>
                            
                            <p><i class="icofont-bubble-right"></i> Working Mode Education</p>
                            
                            <p><i class="icofont-bubble-right"></i> 100% Job Oriented Course</p>
                        
                        </div>
                        
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
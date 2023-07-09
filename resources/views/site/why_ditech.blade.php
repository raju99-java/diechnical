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
                        <h2>WHY DI TECHNICAL</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="/">HOME</a>/</li>
                            <li><span>WHY DI TECHNICAL</span></li>
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
                    <div class="exam-sec">
                        <div class="Director-Message">
                            <h3>Why DI TECHNICAL</h3>		
                        </div>
                        <p style="text-align: justify;">DI TECHNICAL Advanced Training Institute (DI TECHNICAL) is a national program meant to impart information technology education to people countrywide. Ours is an ISO certified firm and can be useful for computer institute govt. registration/ computer institute registration/ computer center registration. Besides, we undertake requirements related to new computer institute registration. We are supported by a team of diligent individuals, who assist our clients in the complete computer institute registration process. So, contact us anytime.

                        <br><br>DI TECHNICAL provides single source for quality assurance in computer education among the nation's non-formal institutes, After turning out competent IT professionals in large numbers. DI TECHNICAL aims to provides maximum benefits to ALC  and Students with quality...</p>
                        <div class="Director-Message">
                            <h3>Computer Institute Registration</h3>
                            <h6 style="margin: 0 0 0px;">Benefits of Affiliation:</h6>
                            <ul class="exams-ul">
                            <li>An ISO Certified Organization.</li>
                            <li>A Globally Famous Organization.</li>
                            <li>All India Valid Certificate.</li>
                            <li>Lowest course fees.</li>
                            <li>Since we are examination body we do not share from course fees given in Prospectus. Only Registration and exam fees will be charged by the ALC.</li>
                            <li>Online and Offline mode of exam.</li>
                            <li>High-standard and navigation friendly course materials, question papers, innovative and industry friendly course structure.</li>
                            <li>Training Support for your Faculty, counselor and marketing team.</li>
                            <li>Marketing inputs & guidelines for a sustainable business.</li>
                            <li>Brand Promotion /Advertisements Support.</li>
                            <li>High quality standard designs of promotional materials for local promotion.</li>
                            <li>Automated tools for tracking your business in a single portal that will help you analyse, monitor and manage your growth.</li>
                            <li>A transparent and user friendly single window online portal for all transactions and operational inputs.</li>
                            <li>Placement assistance.</li>
                        </ul>
                       </div>
                       
                       <div class="Director-Message">
                            <h3>Student Registration</h3>
                            <h6 style="margin: 0 0 0px;">Benefits of Registration:</h6>
                            <ul class="exams-ul">
                            <li>Quality education provided at very affordable charge.</li>
                            <li>Online and Offline exam at your ALC.</li>
                            <li>Globally accepted Certificate after the completion of course.</li>
                            <li>Value added on services like personality developments, Multilanguage learning.</li>
                            <li>Free Live Project Training for Scholars.</li>
                            <li>Free placement assistance.</li>
                            </ul>
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
            
            <div class="row">
                <div class="col-sm-5">
                    <div class="enqir-sec">
                        <h4><span style="color:#ff5421;">Franchise</span> Process : <a href="{{Route('affiliation-process')}}">Click Here</a> </h4>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="enqir-sec">
                        <h4><span style="color:#ff5421;">Student</span> Register : <a href="{{Route('registration-process')}}">Click Here</a> </h4>
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
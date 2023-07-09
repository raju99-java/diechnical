@extends('layouts.main')
@section('css')
<style>
.q-grp {margin-bottom: 1rem;}
.quick-input, .quick-textaeea {
 border: 1px solid #dfdfdf;
 border-radius: 0px;
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
                        <h2>Contact Us</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="/">HOME</a>/</li>
                            <li><span>CONTACT US</span>
                            </li>
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
    <section class="contact-div">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="who-we-are-title">
                        <h3>CONTACT INFO</h3>	
                    </div>
                    <p class="contact-wel-p">Welcome to DI TECHNICAL. We are glad to have you around.</p>
                    <hr>
                    @php
                    use App\Model\Settings;
                    $social_links = Settings::where('module', '=', 'Social Link')->get();
                    $locations = Settings::where('module', '=', 'Location')->get();
                    @endphp
                    <div class="row">
                        <div class="col-sm-6 col-xs-6 phone-div d-flex"> 
                          <span class="phone-icon">
                                <i class="fa fa-phone"></i>
                            </span>
                            <span class="phone-text">
                                <h6 class="heading__primary">Phone</h6> 
                                <a class="desc-content" href="tel: {{$locations[1]->value}}">{{$locations[1]->value}}</a>
                            </span>
                        </div>

                        <div class="col-sm-6 col-xs-6  phone-div d-flex"> 
                            <span class="phone-icon">
                                <i class="fa fa-phone"></i>
                            </span>
                            <span class="phone-text">
                                <h6 class="heading__primary">Phone</h6> 
                                <a class="desc-content" href="tel: {{$locations[3]->value}}">{{$locations[3]->value}}</a>
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6 phone-div d-flex"> 
                          <span class="phone-icon">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <span class="phone-text">
                                <h6 class="heading__primary">Email</h6> 
                                <a class="desc-content" href="mailto: {{$locations[2]->value}}">{{$locations[2]->value}}</a>
                            </span>
                        </div>
                        <div class="col-sm-6 phone-div d-flex"> <span class="phone-icon">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            <span class="phone-text">
                                <h6 class="heading__primary">Address</h6> 
                                <a class="desc-content" href="#">{{$locations[0]->value}}</a>
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="elementor-social-icons-wrapper elementor-grid">	
                                <span class="elementor-grid-item">
                                    <a class="elementor-icon elementor-social-icon elementor-social-icon-facebook elementor-repeater-item-5ba0f62" target="_blank" href="{{$social_links[0]->value}}">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </span>	
                                <span class="elementor-grid-item">
                                    <a class="elementor-icon elementor-social-icon elementor-social-icon-facebook elementor-repeater-item-5ba0f62" target="_blank" href="{{$social_links[1]->value}}">
                                        <i class="fa fa-whatsapp"></i>
                                    </a>
                                </span>	
                                <span class="elementor-grid-item">
                                    <a class="elementor-icon elementor-social-icon elementor-social-icon-facebook elementor-repeater-item-5ba0f62" target="_blank" href="{{$social_links[2]->value}}">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </span>	
                                <span class="elementor-grid-item">
                                    <a class="elementor-icon elementor-social-icon elementor-social-icon-facebook elementor-repeater-item-5ba0f62" target="_blank" href="{{$social_links[3]->value}}">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                </span>
                              	<span class="elementor-grid-item">
                                    <a class="elementor-icon elementor-social-icon elementor-social-icon-facebook elementor-repeater-item-5ba0f62" target="_blank" href="{{$social_links[4]->value}}">
                                        <i class="fa fa-telegram"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="who-we-are-title">
                        <h3>SEND A MESSAGE</h3>	
                    </div>
                    <p class="contact-wel-p">Your email address will not be published. Required fields are marked.</p>
                    <div class="contact-form">
                        <form class="quick-enquiry-form" id="contact-us-form" action="{{route('contact-us')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group q-grp">
                                        <input type="text" name="name" class="form-control quick-input" placeholder="Enter Your Full Name.." > 
                                        <span class="help-block" id="error-name"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group q-grp">
                                        <input type="email" name="email" class="form-control quick-input" placeholder="Enter Your Email Id..">	
                                        <span class="help-block" id="error-email"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group q-grp">
                                        <input type="tel" name="phone" class="form-control quick-input" placeholder="Enter Your Contact No.." >	
                                        <span class="help-block" id="error-phone"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group q-grp">
                                    <select class="form-control" name="services">
                						<option value="">Select Service</option>
                						<option value="New Franchise">New Franchise</option>
                						<option value="Admission">Admission</option>
                						<option value="Student">Student</option>
                						<option value="ALC">ALC</option>
                						<option value="Other">Other</option>
                					</select>
                                    <span class="help-block" id="error-services"></span>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group q-grp">
                                        <textarea name="message" cols="20" rows="5" class="form-control quick-textaeea" placeholder="Message"></textarea>	
                                        <span class="help-block" id="error-message"></span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="quick-submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="map">
        <div class="container-fluid p-0 m-0">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7328.903542754923!2d85.27217!3d23.299362000000002!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa80b2ab6afd69ec4!2sDI%20TECHNICAL!5e0!3m2!1sen!2sin!4v1634556319486!5m2!1sen!2sin" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </section>
</section>
<!----------------------------------Main content End--------------------------->
@stop

@section('js')

@stop    
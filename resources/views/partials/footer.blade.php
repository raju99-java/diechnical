<!-----------------------------------Footer Start-------------------------------->
<footer id="rs-footer" class="rs-footer home9-style main-home home14-style home15">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 footer-widget md-mb-50">
                    <div class="footer-logo mb-30">
                        <a href="{{route('/')}}">
                            <img src="{{ URL::asset('public/frontend/images/logo-15.png') }}" alt="">
                            <span class="footer-logo-di">DI TECHNICAL</span>
                        </a>
                    </div>
                    <div class="textwidget pr-60 md-pr-15">
                        <p>An ISO 9001:2015 Certifyed Instutute Certificate No: QMS/092020/1623 Registred on MCA Govt. of India
                            CIN NO: U80902JH2021PTC016021 Registred on MSME Govvt. of India UDYAM-JH-20-0007592</p>
                    </div>
                    <ul class="footer_social">
                        <li> <a href="{{$social_link[0]->value}}" target="_blank"><span><i class="fa fa-facebook"></i></span></a> 
                        </li>
                        <li> <a href="{{$social_link[1]->value}}" target="_blank"><span><i class="fa fa-whatsapp"></i></span></a> 
                        </li>
                        <li> <a href="{{$social_link[2]->value}}" target="_blank"><span><i class="fa fa-instagram"></i></span></a> 
                        </li>
                        <li> <a href="{{$social_link[3]->value}}" target="_blank"><span><i class="fa fa-youtube"></i></span></a> 
                        </li>
                        <li> <a href="{{$social_link[4]->value}}" target="_blank"><span><i class="fa fa-telegram"></i></span></a> 
                        </li>
                        
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 col-sm-12 pl-50 md-pl-15 footer-widget md-mb-50">
                    <h3 class="widget-title">Useful Links</h3>
                    <ul class="site-map">
                        <li><a href="{{route('/')}}">Home</a>
                        </li>
                        <li><a href="{{route('about-us')}}">About DI TECHNICAL</a>
                        </li>
                        <li><a href="{{route('director-message')}}">Director Message</a>
                        </li>
                        <li><a href="{{route('mission-and-vision')}}">Mission & Vision</a>
                        </li>
                        <li><a href="{{route('quality-policy')}}">Quality Policy</a>
                        </li>
                        <li><a href="{{route('courses')}}">All Courses</a>
                        </li>
                        <li><a href="{{route('gallery')}}">Gallery</a>
                        </li>
                        <li><a href="{{route('contact-us')}}">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 footer-widget">
                    <h3 class="widget-title">Student's Zone</h3>
                    <ul class="site-map">
                        <li><a href="{{route('registration-process')}}">Registration Process</a></li>
                        <li><a href="{{route('examination-process')}}">Examination Process</a></li>
                        <li><a href="{{route('students-facilities')}}">Students Facilities</a></li>
                        <li><a href="{{route('registered-students')}}">Registered Students</a></li>
                        <li><a href="{{route('i-card')}}">I-Card Download</a></li>
                        <li><a href="{{route('certificate-verification')}}">Certificate Verification</a></li>
                        <!--<li><a href="student-registration.html">Direct Admission</a></li>-->
                    </ul>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 footer-widget md-mb-50">
                    <h3 class="widget-title">Address</h3>
                    <ul class="address-widget">
                        <li> <i class="icofont-map-pins"></i>
                            <div class="desc">{{$location[0]->value}}</div>
                        </li>
                        <li> <i class="icofont-phone"></i>
                            <div class="desc"> <a href="tel:{{$location[1]->value}}">{{$location[1]->value}}</a>
                            </div>
                        </li>
                      	<li> <i class="icofont-phone"></i>
                            <div class="desc"> <a href="tel:{{$location[3]->value}}">{{$location[3]->value}}</a>
                            </div>
                        </li>
                        <li> <i class="icofont-send-mail"></i>
                            <div class="desc"> <a href="mailto:{{$location[2]->value}}">{{$location[2]->value}}</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 footer-widget">
                    <h3 class="widget-title">Franchise/ALC</h3>
                   <ul class="site-map">
                        <li><a href="{{route('why-ditech')}}">Why DI TECHNICAL</a>
                        </li>
                        <li><a href="{{route('affiliation-process')}}">Affiliation Process</a>
                        </li>
                        <li><a href="{{route('apply-online')}}">Apply Online</a>
                        </li>
                        <li><a href="{{route('affiliation-center')}}">Affiliated Centers</a>
                        </li>
                        <li><a href="{{route('prospectus')}}">Prospectus</a>
                        </li>
                        <!--<li><a href="{{route('franchise-affiliation-form')}}">Franchise Affiliation Form</a>-->
                        </li>
                        <li><a href="{{route('student-registration-form')}}">Student Registration Form</a>
                        </li>
                    </ul> 
                </div>
                
                <div class="col-lg-4 col-md-12 col-sm-12 footer-widget">
                    <h3 class="widget-title">Subscribe Us</h3>
                    <form class="subscription-form" id="subscription-form" action="{{route('post-subcribers')}}">
                      @csrf
                      <div class="input-group">
                        <input type="email" id="email" name="subscribe_email" placeholder="Your Email" class="form-control subs-input">
        				<span class="input-group-btn">
                          <button class="bg-theme-color-2" type="submit">Subscribe</button>
                        </span>
                      </div>
                      <span class="help-block" id="error-subscribe_email"></span>
                    </form>
                    <h3 class="widget-title mt-5">Opening Hours</h3> 
                   <ul class="site-map">
                        <li><p class="text-white">Monday - Saturday : 07.00 AM - 07.00 PM</p></li>
                        <li><p class="text-white">Sunday : Closed</p></li>
                   </ul>
                </div>
                
                <div class="col-lg-4 col-md-12 col-sm-12 footer-widget">
                   <h3 class="widget-title">Center Query</h3> 
                    <form class="subscription-form" method="post"  action="{{route('center-query')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <table>
                            <input type="hidden" name="services"  value="Franchise" > 
                            <tr>
                                <td>
                                    <div class="form-group q-grp {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <input type="text" name="name" class="form-control quick-input" placeholder="Your Name *" value="{{ (old('name')!="") ? old('name') : '' }}" > 
                                        @if ($errors->has('name'))
                                           <span class="help-block" style="font-size: 12px;"> {{ $errors->first('name') }} </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group q-grp {{ $errors->has('center_name') ? ' has-error' : '' }}">
                                        <input type="text" name="center_name" class="form-control quick-input" placeholder="Center Name" value="{{ (old('center_name')!="") ? old('center_name') : '' }}" > 
                                        @if ($errors->has('center_name'))
                                           <span class="help-block" style="font-size: 12px;"> {{ $errors->first('center_name') }} </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <div class="form-group q-grp {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input type="email" name="email" class="form-control quick-input" placeholder="Email *" value="{{ (old('email')!="") ? old('email') : '' }}" >	
                                        @if ($errors->has('email'))
                                           <span class="help-block" style="font-size: 12px;"> {{ $errors->first('email') }} </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group q-grp {{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <input type="tel" name="phone" class="form-control quick-input" placeholder="Mobile *" value="{{ (old('phone')!="") ? old('phone') : '' }}" >	
                                        @if ($errors->has('phone'))
                                           <span class="help-block" style="font-size: 12px;"> {{ $errors->first('phone') }} </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>    
                            
                            <tr>
                                <td>
                                    <div class="form-group q-grp {{ $errors->has('address') ? ' has-error' : '' }}">
                                        <input type="text" name="address" class="form-control quick-input" placeholder="Address *" value="{{ (old('address')!="") ? old('address') : '' }}" >	
                                        @if ($errors->has('address'))
                                           <span class="help-block" style="font-size: 12px;"> {{ $errors->first('address') }} </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group q-grp {{ $errors->has('city') ? ' has-error' : '' }}">
                                        <input type="text" name="city" class="form-control quick-input" placeholder="City *" value="{{ (old('city')!="") ? old('city') : '' }}" >	
                                        @if ($errors->has('city'))
                                           <span class="help-block" style="font-size: 12px;"> {{ $errors->first('city') }} </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <div class="form-group q-grp {{ $errors->has('district') ? ' has-error' : '' }}">
                                        <input type="text" name="district" class="form-control quick-input" placeholder="District *" value="{{ (old('district')!="") ? old('district') : '' }}" >	
                                        @if ($errors->has('district'))
                                           <span class="help-block" style="font-size: 12px;"> {{ $errors->first('district') }} </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group q-grp {{ $errors->has('state') ? ' has-error' : '' }}">
                                        <input type="text" name="state" class="form-control quick-input" placeholder="State *" value="{{ (old('state')!="") ? old('state') : '' }}" >	
                                        @if ($errors->has('state'))
                                           <span class="help-block" style="font-size: 12px;"> {{ $errors->first('state') }} </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="3">
                                    <div class="form-group q-grp {{ $errors->has('message') ? ' has-error' : '' }}">
                                        <textarea class="form-control ckeditor"  name="message"  >{{ (old('message')!="") ? old('message') : 'मैं कंप्यूटर संस्थान खोलना चाहता हूं |' }}</textarea>	
                                        @if ($errors->has('message'))
                                           <span class="help-block" style="font-size: 12px;"> {{ $errors->first('message') }} </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="3">
                                    <div class="form-group q-grp">
                                        <button type="submit" class="quick-submit" style="background-color:#ff5421;">Submit</button>
                                    </div>
                                </td>
                            </tr>
                            
                        </table> 
                        
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row y-middle">
                <div class="col-lg-6 md-mb-20">
                    <div class="copyright">
                        <p>Copyright © {{date('Y')}} DI TECHNICAL. All Rights Reserved.</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 text-right md-text-left">
                    <ul class="copy-right-menu">
                        <li><a href="{{route('privacy-policy')}}">Privacy Policy</a>
                        </li>
                        <li><a href="{{route('terms-condition')}}">Terms & Conditions</a>
                        </li>
                        <li><a href="{{route('return-refund-policy')}}">Return & Refund Policy</a>
                        </li>
                    </ul>
                </div>
            </div>
</footer>
<div id="scrollUp" class="orange-color"> <i class="fa fa-angle-up"></i>
</div>
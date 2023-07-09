@extends('layouts.main') 
@section('css')


@endsection
@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="2000">
    <div class="carousel-inner">
        @forelse($sliders as $index => $slider)
        <div class="carousel-item {{($index=='0')?'active':''}}">
            <img class="d-block w-100" src="{{asset('public/uploads/slider/'.$slider->photo)}}" alt="{{$slider->title_text}}">
            <div class="carousel-caption text-center">
			  <h2>{!!$slider->details_text!!}</h2>
			  <div class="slider-btn"><a href="{{$slider->link}}" class="btn btn-new">Click Here</a></div>
			</div>
        </div>
        @empty
        @endforelse
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- //end banner -->
<section class="main-content">
    
    
    <!-- popular-courses -->
    <section class="popular-courses-div">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="courses-div">
                        <!-- courses -->
                        <div id="rs-team" class="rs-team home-style15 pt-100 pb-100 md-pt-70 md-pb-70">
                            <h3 class="others-courses">POPULAR <span class="theme-colour">COURSES</span></h3>
                            <div class="rs-carousel owl-carousel others-carousel" data-loop="true" data-items="5" data-margin="30" data-autoplay="true" data-autoplay-timeout="2500" data-smart-speed="2000" data-dots="true" data-nav="false" data-nav-speed="false" data-mobile-device="2" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="4" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="5" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="5" data-md-device-nav="false" data-md-device-dots="false">
                                @forelse($featured_courses as $index => $featured_course)
                                <div class="team-item">
                                    <div class="team-wrap">
                                        <div class="team-img">
                                            <a href="{{Route('course-details',['id'=>base64_encode($featured_course->id)])}}">
                                                <img src="{{ URL::asset('public/uploads/course/'.$featured_course->image) }}" alt="" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="team-content">
                                            <h4 class="line-bottom">{{$featured_course->name}}</h4>
                                            <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase" href="{{Route('course-details',['id'=>base64_encode($featured_course->id)])}}">view details</a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                        <!--//courses -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- counter -->
    <section id="counter-stats" class="wow">
        <div class="container">
          
            <div class="row">
            @foreach($counters as $counter) 
            
                @if($counter->slug == 'admission_done')
                <div class="col-lg-3 stats">	
                    <div><i class="icofont-globe-alt"></i></div>
                    <div class="counting" data-count="{{$counter->value}}">0</div> <i class="icofont-plus plus-icon"></i>
                    <h5>{{$counter->title}}</h5>
                </div>
                @endif
                
                @if($counter->slug == 'student_served')
                <div class="col-lg-3 stats">	
                    <div><i class="icofont-users-social"></i></div>
                    <div class="counting" data-count="{{$counter->value}}">0</div> <i class="icofont-plus plus-icon"></i>
                    <h5>{{$counter->title}}</h5>
                </div>
                @endif
                
                @if($counter->slug == 'authorized_learning_center')
                <div class="col-lg-3 stats">	
                    <div><i class="icofont-teacher"></i></div>
                    <div class="counting" data-count="{{$counter->value}}">0</div> <i class="icofont-plus plus-icon"></i>
                    <h5>{{$counter->title}}</h5>
                </div>
                @endif
                
                @if($counter->slug == 'total_courses')
                <div class="col-lg-3 stats"> 
                    <div><i class="icofont-check-circled"></i></div>
                    <div class="counting" data-count="{{$counter->value}}">0</div> <i class="icofont-plus plus-icon"></i>
                    <h5>{{$counter->title}}</h5>
                </div>
                @endif
                
            @endforeach    
            </div>
            
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>

    <!-- about-us -->
    <section class="about-div">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="about-us">
                        <h3 class="about-us-text">ABOUT <span class="theme-colour">US</span></h3>
                        <div class="about-para">
                            <p>"DI TECHNICAL" is AN ISO 9001:2015 CERTIFIED INSTITUTION No. : QMS/092020/1623, REGD.: [PURSUANT TO SUB-SECTION (2) OF SECTION 7 AND SUB- SECTION (1) OF SECTION 8 OF THE COMPANIES ACT, 2013 (18 OF 2013) AND RULE 18 OF THE COMPANIES (INCORPORATION) RULES 2014, CIN : U80902JH2021PTC016021 & MINISTRY OF MICRO, SMALL & MEDIUM ENTERPRISES, GOVT. OF INDIA. Our Institute is providing the best quality and best education to every student with that DI TECHNICAL is providing QR Code & Digital Signature for authentication Diploma. We are fully digitalized. DI TECHNICAL build up expert.</p>
                            
                        </div>
                        <div class="about-us-btn"> <a href="{{route('about-us')}}" class="btn btn-small">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="about-us-image text-center">
                        <img src="{{ URL::asset('public/frontend/images/about-us-2.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- parallux -->
    <section class="compact-area-4">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-sm-12">
                    <div class="parallux">
                        <div class="parallux-text">
                            <div class="iso-no">
                               <img src="{{ URL::asset('public/frontend/images/iso-logo-1.png') }}" class="img-fluid" alt="">
                            </div>
                            <h5>DI TECHNICAL</h5>
                            <p class="cer-p">CERTIFIED BY MCA & MSME ( GOVT. OF INDIA )</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- why-choose-us -->
    <section class="why-choose-us">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="why-choose-us-main">
                        <div class="row">
                            <div class="col-sm-4">
                                <h3 class="why-title">WHY <span class="theme-colour">CHOOSE US</span></h3>
                                <p class="why-para">Our Institute is providing the best quality and best education to every student with that DI TECHNIAL is providing QR Code & Digital Signature for authentication Diploma. We are fully digitalized. DI TECHNIAL build up expert.</p>
                            </div>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="info-box-wrap">
                                            <div class="box-icon-wrapper">
                                                <div class="info-box-icon"> <i class="icofont-tick-boxed"></i>
                                                </div>
                                            </div>
                                            <div class="info-box-content">
                                                <h4 class="info-box-title">Training in vast range of topics</h4>	
                                            </div>
                                        </div>
                                        <div class="info-box-wrap">
                                            <div class="box-icon-wrapper">
                                                <div class="info-box-icon"> <i class="icofont-tick-boxed"></i>
                                                </div>
                                            </div>
                                            <div class="info-box-content">
                                                <h4 class="info-box-title">Quality teaching and high achivement rates</h4>	
                                            </div>
                                        </div>
                                        <div class="info-box-wrap">
                                            <div class="box-icon-wrapper">
                                                <div class="info-box-icon"> <i class="icofont-tick-boxed"></i>
                                                </div>
                                            </div>
                                            <div class="info-box-content">
                                                <h4 class="info-box-title">Zero level to high level education</h4>	
                                            </div>
                                        </div>
                                        <div class="info-box-wrap">
                                            <div class="box-icon-wrapper">
                                                <div class="info-box-icon"> <i class="icofont-tick-boxed"></i>
                                                </div>
                                            </div>
                                            <div class="info-box-content">
                                                <h4 class="info-box-title">Special class for poor students</h4>	
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="info-box-wrap">
                                            <div class="box-icon-wrapper">
                                                <div class="info-box-icon"> <i class="icofont-tick-boxed"></i>
                                                </div>
                                            </div>
                                            <div class="info-box-content">
                                                <h4 class="info-box-title">An iso certified institute</h4>	
                                            </div>
                                        </div>
                                        <div class="info-box-wrap">
                                            <div class="box-icon-wrapper">
                                                <div class="info-box-icon"> <i class="icofont-tick-boxed"></i>
                                                </div>
                                            </div>
                                            <div class="info-box-content">
                                                <h4 class="info-box-title">Certified by central govt. of india</h4>	
                                            </div>
                                        </div>
                                        <div class="info-box-wrap">
                                            <div class="box-icon-wrapper">
                                                <div class="info-box-icon"> <i class="icofont-tick-boxed"></i>
                                                </div>
                                            </div>
                                            <div class="info-box-content">
                                                <h4 class="info-box-title">100% job oriented education</h4>	
                                            </div>
                                        </div>
                                        <div class="info-box-wrap">
                                            <div class="box-icon-wrapper">
                                                <div class="info-box-icon"> <i class="icofont-tick-boxed"></i>
                                                </div>
                                            </div>
                                            <div class="info-box-content">
                                                <h4 class="info-box-title">Our cources is affordable</h4>	
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

    <!-- other courses -->
    <section class="compact-area-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <!-- other courses div -->
                    <div id="rs-team" class="rs-team home-style15 pt-100 pb-100 md-pt-70 md-pb-70">
                        <h3 class="others-courses">ALL <span class="theme-colour">COURSES</span></h3>
                        <div class="rs-carousel owl-carousel others-carousel" data-loop="true" data-items="5" data-margin="30" data-autoplay="true" data-autoplay-timeout="2500" data-smart-speed="2000" data-dots="true" data-nav="false" data-nav-speed="false" data-mobile-device="2" data-mobile-device-nav="false" data-mobile-device-dots="false" data-ipad-device="4" data-ipad-device-nav="false" data-ipad-device-dots="false" data-ipad-device2="5" data-ipad-device-nav2="false" data-ipad-device-dots2="false" data-md-device="5" data-md-device-nav="false" data-md-device-dots="false">
                            @forelse($all_courses as $index => $all_course)

                            <div class="team-item">
                                <div class="team-wrap">
                                    <div class="team-img">
                                        <a href="{{Route('course-details',['id'=>base64_encode($all_course->id)])}}">
                                            <img src="{{ URL::asset('public/uploads/course/'.$all_course->image) }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="team-content">
                                        <h4 class="line-bottom">{{$all_course->name}}</h4>
                                        <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase" href="{{Route('course-details',['id'=>base64_encode($all_course->id)])}}">view details</a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <!-- //other courses div -->
                </div>
            </div>
        </div>
    </section>

    <!-- client -->
    <section class="clients">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- students placed -->
                    <div class="students-placed-div">
                        <h3 class="student-placed-title">Our Students <span class="theme-colour">Placed In</span></h3>
                        <section class="customer-logos slider">
                            <div class="slide">
                                <img src="{{ URL::asset('public/frontend/images/india-mart.jpg') }}">
                            </div>
                            <div class="slide">
                                <img src="{{ URL::asset('public/frontend/images/govt-logo.jpg') }}">
                            </div>
                            <div class="slide">
                                <img src="{{ URL::asset('public/frontend/images/reliance.jpg') }}">
                            </div>
                            <div class="slide">
                                <img src="{{ URL::asset('public/frontend/images/tata.jpg') }}">
                            </div>
                            <div class="slide">
                                <img src="{{ URL::asset('public/frontend/images/hdfc.jpg') }}">
                            </div>
                            <div class="slide">
                                <img src="{{ URL::asset('public/frontend/images/amul.jpg') }}">
                            </div>
                            <div class="slide">
                                <img src="{{ URL::asset('public/frontend/images/post.jpg') }}">
                            </div>
                            <div class="slide">
                                <img src="{{ URL::asset('public/frontend/images/vivo.jpg') }}">
                            </div>
                        </section>
                    </div>
                    <!-- //students placed -->
                    
                </div>
            </div>
        </div>
    </section>

    <!-- enquiry form -->
    <section class="enquiry-div">
        <div class="container-fluid p-0 m-0">
            <div class="row">
                <div class="col-sm-6 p-0 m-0">
                    <div class="image-enroll mobile">
                        <img src="{{ URL::asset('public/frontend/images/new.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-sm-6 p-0 m-0">
                    <div class="quick-enquiry-div">
                        <h3 class="quick-title">Quick Enquiry</h3>
                        <form class="quick-enquiry-form" id="enquiry-form" action="{{route('post-enquiry')}}" method="POST">
                            @csrf
                            <div class="form-group q-grp">
                                    <label class="quick-label">Services*</label>
                                    <select id="services" class="form-control" name="services">
                						<option value="">Select Service</option>
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
                                <textarea name="address" cols="20" rows="1" class="form-control quick-textaeea" placeholder="Address"></textarea>	
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
    </section>


    <section class="gallerys">
        <div class="container">
            <h3 class="student-placed-title">Our <span class="theme-colour">Gallery</span></h3>	
            <!--<div class="portfolio">-->
            <!--    @forelse($gallries as $gallery)-->
            <!--    <a href="#" class="card-1">-->
            <!--        <div class="image">-->
            <!--            <img src="{{asset('public/uploads/gallery/'.$gallery->image)}}" alt="" />-->
            <!--        </div>-->
            <!--    </a>-->
            <!--    @empty-->
            <!--    @endforelse-->
                
            <!--</div>-->
            
            <div class="row gallery-row">
            @forelse($gallries as $gallery)
			  <a href="{{asset('public/uploads/gallery/'.$gallery->image)}}" data-toggle="lightbox" data-gallery="gallery" class="col-md-3">
				<img src="{{asset('public/uploads/gallery/'.$gallery->image)}}" class="img-fluid rounded">
			  </a>
			@empty
			@endforelse
			</div>
            
            <div class="about-us-btn text-center"> <a href="{{route('gallery')}}" class="btn btn-small">View More</a></div>
        </div>
    </section>  

    <!-- testimonials -->
    <!--<section class="compact-area-4">-->
    <!--    <div class="container-fluid p-0">-->
    <!--        <div class="row">-->
    <!--            <div class="col-sm-12">-->
                    <!-- testimonial -->
    <!--                <div class="testimonials">-->
    <!--                    <h3 class="testimonial-text">OUR <span class="theme-colour">TESTIMONIAL</span></h3> -->
    <!--                    <div class="slider-container">-->
    <!--                        <div class="slider test-slide">-->
    <!--                            <div class="slide-box">-->
                                    <!-- Testi One -->
    <!--                                <p class="comment">Teaching style of Anil Sir is very very nice. It is not praise. It is reality. One can feel this automatically when he/she study in that Institute.</p>-->
    <!--                                <img src="{{ URL::asset('public/frontend/images/test-1.png') }}" />-->
    <!--                                <h3 class="name">Krishna Kumar Singh</h3>-->
    <!--                                <h4 class="job">Student</h4>-->
    <!--                            </div>-->
    <!--                            <div class="slide-box">-->
                                    <!-- Testi One -->
    <!--                                <p class="comment">It was awesome experience with sir !!! 💜And also his ways of teaching is much better as compared to other teachers !!!! Also, his tests will upgrade you from depth!!!!</p>-->
    <!--                                <img src="{{ URL::asset('public/frontend/images/test-2.png') }}" />-->
    <!--                                <h3 class="name">Komal Gupta</h3>-->
    <!--                                <h4 class="job">Student</h4>-->
    <!--                            </div>-->
    <!--                            <div class="slide-box">-->
                                    <!-- Testi One -->
    <!--                                <p class="comment">Sir ka baat karna ka tarika or samjhane ka tarika bahut achha hai.</p>-->
    <!--                                <img src="{{ URL::asset('public/frontend/images/testi-3.png') }}" />-->
    <!--                                <h3 class="name">Priyanka Kumari</h3>-->
    <!--                                <h4 class="job">Student</h4>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <a href="#!" class="control-slider btn-left">	<i class="fa fa-chevron-left"></i>-->
    <!--                        </a>-->
    <!--                        <a href="#!" class="control-slider btn-right">	<i class="fa fa-chevron-right"></i>-->
    <!--                        </a>-->
    <!--                    </div>-->
    <!--                </div>-->
                    <!-- //testimonial -->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    
    <section class="testimonial">
		<div class="container">
		    <h3 class="testimonial-text">OUR <span class="theme-colour">TESTIMONIAL</span></h3>
			<div class="row">
				<div class="clients-carousel owl-carousel">
					<div class="single-box">
						<div class="content-testi">
							<p>"Teaching style of Anil Sir is very very nice. It is not praise. It is reality. One can feel this automatically when he/she study in that Institute."</p>
		                    <div class="img-area"><img alt="" class="img-fluid" src="{{ URL::asset('public/frontend/images/test-1.png') }}"></div>
		                    <h4>Krishna Kumar Singh</h4>
							<h6>Student</h6>
						</div>
					</div>
					<div class="single-box">
						<div class="content-testi">
							<p>"It was awesome experience with sir !!! 💜And also his ways of teaching is much better as compared to other teachers !!!! Also, his tests will upgrade you from depth!!!!"</p>
							<div class="img-area"><img alt="" class="img-fluid" src="{{ URL::asset('public/frontend/images/test-2.png') }}"></div>
							<h4>Komal Gupta</h4>
							<h6>Student</h6>
						</div>
					</div>
					<div class="single-box">
						<div class="content-testi">
							<p>"Sir ka baat karna ka tarika or samjhane ka tarika bahut achha hai."</p>
							<div class="img-area"><img alt="" class="img-fluid" src="{{ URL::asset('public/frontend/images/testi-3.png') }}"></div>
							<h4>Priyanka Kumari</h4>
							<h6>Student</h6>
						</div>
					</div>
					<!--<div class="single-box">-->
					<!--	<div class="img-area"><img alt="" class="img-fluid" src="https://images.pexels.com/photos/1270076/pexels-photo-1270076.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"></div>-->
					<!--	<div class="content">-->
					<!--		<span class="rating-star"><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i></span>-->
					<!--		<p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, doloribus minima praesentium laborum ea earum."</p>-->
					<!--		<h4>Priyanka Kumari</h4>-->
					<!--		<h6>Designation Here</h6>-->
					<!--	</div>-->
					<!--</div>-->
				</div>
			</div>
		</div>
	</section>

    <!--MOST RECENT FAQ'S-->      
    <section class="faq-section">
        <div class="container-fluid p-0">
            <div class="row">
                <!-- ***** FAQ Start ***** -->
                <div class="col-md-6 m-0 p-0 bg-xyz">
                    <div class="faq-title text-center pb-3">
                        <h3 class="testimonial-text">Frequently Asked <span class="theme-colour">Questions</span></h3>
                    </div>
                    <div class="faq" id="accordion">
                        <?php $count = 1;?>
                        @foreach($faqs as $faq)
                            <div class="card">
                                @if($faq->question != '')
                                    <div class="card-header" id="faqHeading-{{$count}}">
                                        <div class="mb-0">
                                            <div class="faq-title" data-toggle="collapse" data-target="#faqCollapse-{{$count}}" data-aria-expanded="true" data-aria-controls="faqCollapse-{{$count}}">
                                                <span class="badge">{{$count}}</span>  
                                                <span>{!! $faq->question !!}</span>
                                                
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($faq->answer != '')
                                    <div id="faqCollapse-{{$count}}" class="collapse" aria-labelledby="faqHeading-{{$count}}" data-parent="#accordion">
                                        <div class="card-body">
                                            {!! $faq->answer !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <?php $count++; ?>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 m-0 p-0">
                    <div class="images-call-to-ac">
                        <a href="{{route('signup')}}"><img src="{{ URL::asset('public/frontend/images/enroll-image.png') }}"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END MOST RECENT FAQ'S-->
</section>






@stop
@section('js')


@endsection

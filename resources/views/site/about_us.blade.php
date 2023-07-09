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
                        <h2>About Us</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="/">HOME</a>/</li>
                            <li><span>ABOUT US</span></li>
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
    <!-- //about-us -->
    
    <!-- logos -->
    <section class="certi-logos">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="iso-logos text-center">
                       <img src="{{ URL::asset('public/frontend/images/msme.png') }}" class="img-fluid" alt=""> 
                    </div>
                </div>
                
                <div class="col-sm-4">
                    <div class="iso-logos text-center">
                       <img src="{{ URL::asset('public/frontend/images/iso-logo-1.png') }}" class="img-fluid" alt=""> 
                    </div>
                </div>
                
                <div class="col-sm-4">
                    <div class="iso-logos text-center">
                       <img src="{{ URL::asset('public/frontend/images/mca.png') }}" class="img-fluid" alt=""> 
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //logos -->
    <!-- our courses -->
    <section class="our-courses-div">
        <div class="container">
            <h3 class="about-us-text">OUR <span class="theme-colour">COURSES</span></h3>
            <div class="row">
                <div class="col-sm-4">
                    <div class="iconbox-theme">
                        <span class="icon-dark-s"><i class="fa fa-desktop"></i></span>
                        <div class="iconbox-theme-details">
                            <h3>DCA</h3>
                            <p>Diploma in Computer Applications, is a one-year diploma course in the field of Computer Applications</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="iconbox-theme">
                        <span class="icon-dark-s"><i class="fa fa-bar-chart"></i></span>
                        <div class="iconbox-theme-details">
                            <h3>TALLT + GST</h3>
                            <p>TallyPrime manages your Accounting, Billing, Inventory, GST and other Business needs.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="iconbox-theme">
                        <span class="icon-dark-s"><i class="fa fa-file-excel-o"></i></span>
                        <div class="iconbox-theme-details">
                            <h3>ADVANCE EXCEL</h3>
                            <p>Advanced Excel skills are all about mastery over formulas, and other Excel features for complex tasks.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="iconbox-theme">
                        <span class="icon-dark-s"><i class="icofont-file-python"></i></span>
                        <div class="iconbox-theme-details">
                            <h3>PYTHON</h3>
                            <p>Python is an interpreted high-level general-purpose programming <br>language.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="iconbox-theme">
                        <span class="icon-dark-s"><i class="fa fa-code"></i></span>
                        <div class="iconbox-theme-details">
                            <h3>WEB DEVELOPMENT</h3>
                            <p>Web development is the work involved in developing a Web site for the Internet or an intranet.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="iconbox-theme">
                        <span class="icon-dark-s"><i class="icofont-brand-microsoft"></i></span>
                        <div class="iconbox-theme-details">
                            <h3>M.S OFFICE</h3>
                            <p>Microsoft Office is a set of computer applications mainly used for business or office purposes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //our courses -->
</section>







<!----------------------------------Main content End--------------------------->
@stop
@section('js')

@stop
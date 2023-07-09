<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7566142385530938"
     crossorigin="anonymous"></script>
<!--Full width header Start-->
<div class="full-width-header header-style3 home-style15">
    <!--Header Start-->
    <header id="rs-header" class="rs-header">
        <!-- Topbar Area Start -->
        <div class="topbar-area home11-topbar modify1 home15-style">
            <div class="container-fluid2">
                <div class="row y-middle">
                    <div class="col-md-5">
                        <ul class="topbar-contact">
                            <li> <i class="flaticon-email"></i>
                                <a href="mailto:{{$location[2]->value}}"><i class="fa fa-envelope-o"></i> {{$location[2]->value}}</a>
                            </li>
                            <li> <i class="fa flaticon-call"></i>
                                <a href="tel: {{$location[1]->value}}"> <i class="fa fa-phone"></i> {{$location[1]->value}}</a>
                            </li>
                            <li>
                                <a href="{{$old_version->value}}"> <i class="icofont-web"></i> {{$old_version_name->value}}</a>
                            </li>
                            <li>
                                <a href="{{route('apply-online')}}"> <i class="icofont-user-alt-7"></i> New Franchise</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-7 left-part">
                        <ul class="toolbar-sl-share">
                            <li class="opening">
                                <a href="{{route('certificate-verification')}}">Certificate Verification</a>
                            </li>
                            <li class="opening">
                                <a href="{{route('result')}}">Result Download</a>
                            </li>
                            <li class="opening">
                                <a href="{{route('signup')}}">Direct Admission</a>
                            </li>
                            <li class="opening">
                                <a href="{{route('courses')}}">All Courses</a>
                            </li>
                            <li class="opening">
                                <a href="{{route('login')}}">Student Login</a>
                            </li>
                            <li class="opening">
                                <a href="/franchise">ALC Login</a>
                            </li>
                            
                            <!--<li class="opening"> <i class="fa fa-map-marker"></i> {{$location[0]->value}}</li>-->
                            <!--<li><a href="{{$social_link[0]->value}}"><i class="fa fa-facebook"></i></a>-->
                            <!--</li>-->
                            <!--<li><a href="{{$social_link[1]->value}}"><i class="fa fa-whatsapp"></i></a>-->
                            <!--</li>-->
                            <!--<li><a href="{{$social_link[2]->value}}"><i class="fa fa-instagram"></i></a>-->
                            <!--</li>-->
                            <!--<li><a href="{{$social_link[3]->value}}"><i class="fa fa-youtube"></i></a>-->
                            <!--</li>-->
                            <!--<li><a href="{{$social_link[4]->value}}"><i class="fa fa-telegram"></i></a>-->
                            <!--</li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar Area End -->
        <!-- Header Middle Area Start -->
        <!--<div class="header-middle-part">-->
        <!--    <div class="container">-->
        <!--        <div class="d-flex justify-content-around">-->
        <!--            <div class="logo">-->
        <!--                <a href="{{route('/')}}"> <img src="{{ URL::asset('public/frontend/images/new-logo-di-2.png') }}" class="img-fluid" alt=""></a>-->
        <!--            </div>-->
        <!--            <div class="logo-text">-->
        <!--                <p class="di-name">Di Technical Pvt. Ltd</p>-->
        <!--                <p class="institute">(Institute Of Computer Education Center)</p>-->
        <!--                <p class="CIN">Govt.of India CIN: U80902JH2021PTC016021</p>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

        <div class="middle-img">
            <div class="container-fluid p-0 m-0">
                <div class="row p-0 m-0">
                    <div class="mid-img-width"><a href="{{route('/')}}"><img src="{{ URL::asset('public/frontend/images/upper-head-img.png') }}" class="img-fluid" alt=""></a></div>
                </div>
            </div>
        </div>
        <!-- Header Middle Area End -->
        <!-- Menu Start -->
        <div class="menu-area menu-sticky">
            <div class="container-fluid2">
                <div class="custom-table">
                    <div class="col-cell">
                        <div class="header-logo mobile-view-logo" id="desktop">
                            <div class="custom-logo-area">
                                <a href="{{route('/')}}">
                                    <img src="{{ URL::asset('public/frontend/images/logo-15.png') }}" alt="Header">
                                    <span class="di-logo-name">DI TECHNICAL</span>
                                </a>

                            </div>

                            <div class="custom-sticky-logo">
                                <a href="{{route('/')}}">
                                    <img src="{{ URL::asset('public/frontend/images/logo-15.png') }}" alt="Header">
                                </a>
                            </div>
                        </div>
                    </div>
                    @php
                    if (Auth()->guard('frontend')->guest()) {
                    $user_id=0;
                    } else if(!Auth()->guard('frontend')->guest()) {
                    $user_id = Auth()->guard('frontend')->user()->id;
                    }else{
                    $user_id=0;
                    }
                    if($user_id!==0){
                    $cart_count=App\Model\Cart::where('user_id','=',$user_id)->wherestatus('1')->count();
                    $wishlist_count=App\Model\Wishlist::where('user_id','=',$user_id)->wherestatus('1')->count();
                    }else{
                    $cart_count=0;
                    $wishlist_count=0;
                    }
                    @endphp
                    <div class="col-cell">
                        <div class="rs-menu-area">
                            <div class="main-menu">
                                <div class="mobile-menu">
                                    <a class="rs-menu-toggle"> <i class="fa fa-bars"></i>
                                    </a>
                                    <span class="wish-cart-icon-div" id="desktop">
                                        <a class="wish-icon-nav" href="{{route('wishlist')}}"><i class="icofont-ui-love love-icon"></i><span class="cart_count wishlist">{{$wishlist_count}}</span></a>
                                        <a class="wish-icon-nav" href="{{route('cart')}}"><i class="icofont-cart love-icon"></i><span class="cart_count cart">{{$cart_count}}</span></a>
                                    </span>
                                </div>
                                <nav class="rs-menu">
                                    <ul class="nav-menu">
                                        <li> <a href="{{route('/')}}">Home</a>
                                        </li>
                                        <li class="menu-item-has-children"> <a href="javascript:void(0);">About Us</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{route('about-us')}}">About DI TECHNICAL</a> </li>
                                                <li><a href="{{route('director-message')}}">Director Message</a> </li>
                                                <li><a href="{{route('mission-and-vision')}}">Mission & Vision</a> </li>
                                                <li><a href="{{route('quality-policy')}}">Quality Policy</a> </li>
                                            </ul>
                                            <span class="rs-menu-parent"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                        </li>
                                        <li class="menu-item-has-children"> <a href="javascript:void(0);">Linkage & Authorization</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{route('msme-registeration')}}">MSME Registration</a> </li>
                                                <li><a href="{{route('iso-certification')}}">ISO 9001:2015 Org</a> </li>
                                                <li><a href="{{route('mca')}}">Ministry Of Corporate Affairs (MCA)</a> </li>
                                            </ul>
                                            <span class="rs-menu-parent"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                        </li>
                                        <li> <a href="{{route('courses')}}">All Courses</a>
                                        </li>
                                        <li class="menu-item-has-children"> <a href="javascript:void(0);">Students</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{route('registration-process')}}">Registration Process</a></li>
                                                <li><a href="{{route('examination-process')}}">Examination Process</a></li>
                                                <li><a href="{{route('students-facilities')}}">Students Facilities</a></li>
                                                <li><a href="{{route('registered-students')}}">Registered Students</a></li>
                                                <li><a href="{{route('i-card')}}">I-Card Download</a></li>
                                                <li><a href="{{route('result')}}">Results Online</a></li>
                                                <li><a href="{{route('certificate-verification')}}">Certificate Verification</a></li>
                                                <!--<li><a href="student-registration.html">Direct Admission</a></li>-->


                                            </ul>
                                            <span class="rs-menu-parent"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                        </li>
                                        <li class="menu-item-has-children"> <a href="javascript:void(0);">Franchise/ALC</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{route('why-ditech')}}">Why DI TECHNICAL</a></li>
                                                <li><a href="{{route('affiliation-process')}}">Affiliation Process</a></li>
                                                <li><a href="{{route('apply-online')}}">Apply Online</a></li>
                                                <li><a href="{{route('affiliation-center')}}">Affiliated Centers</a></li>
                                                <li class="menu-item-has-children">
                                                         <a href="javascript:void(0);">Download</a>
                                                         <ul class="sub-menu right">
                                                             <li><a href="{{route('prospectus')}}">Prospectus</a></li>
                                                             <!--<li><a href="{{route('franchise-affiliation-form')}}">Franchise Affiliation Form</a></li>-->
                                                             <li><a href="{{route('student-registration-form')}}">Student Registration Form</a></li>
                                                         <div class="sub-menu-close"><i class="fa fa-times" aria-hidden="true"></i>Close</div></ul>
                                                     <span class="rs-menu-parent"><i class="fa fa-angle-down" aria-hidden="true"></i></span></li>
                                            </ul>
                                            <span class="rs-menu-parent"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                        </li>
                                        <li> <a href="{{route('gallery')}}">Gallery</a>
                                        </li>
                                        
                                        <li class="menu-item-has-children"> <a href="javascript:void(0);">More</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{route('useful-links')}}">Useful Links</a></li>
                                                <li><a href="https://blog.ditechnical.in" target="_blank">Blog</a></li>
                                            </ul>
                                            <span class="rs-menu-parent"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                        </li>
                                        
                                        <li> <a href="{{route('contact-us')}}">Contact Us</a>
                                        </li>

                                        <li> <a href="{{$old_version->value}}" id="nav-mob-li">{{$old_version_name->value}}</a>
                                        </li>
                                        <li> <a href="{{route('apply-online')}}" id="nav-mob-li">New Franchise</a>
                                        </li>
                                        @if (Auth()->guard('frontend')->guest())
                                        <li> <a href="{{route('login')}}" id="nav-mob-li">Login</a>
                                        </li>
                                        <li> <a href="{{route('signup')}}" id="nav-mob-li">Registration</a>
                                        </li>
                                        @else
                                        <li> <a href="{{route('dashboard')}}" id="nav-mob-li">Dashboard</a>
                                        </li>
                                        @endif
                                    </ul>

                                    <!-- //.nav-menu -->
                                </nav>
                            </div>
                            <!-- //.main-menu -->
                        </div>
                    </div>
                    <div class="col-cell">
                        <div class="expand-btn-inner">
                            <ul>
                                <li><a class="cart-icon" href="{{route('wishlist')}}"><i class="icofont-ui-love custom-i"></i><span class="cart_count wishlist">{{$wishlist_count}}</span></a>
                                </li>
                                <li><a class="cart-icon" href="{{route('cart')}}"><i class="icofont-cart custom-i"></i><span class="cart_count cart">{{$cart_count}}</span></a>
                                </li>
                                @if (Auth()->guard('frontend')->guest())
                                <li><a class="apply-btn-reg" href="{{route('signup')}}">Registration</a>
                                </li>
                                <li><a class="apply-btn" href="{{route('login')}}">Student Login</a>
                                </li>
                                @else
                                <li><a class="apply-btn" href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Menu End -->
    </header>
    <!--Header End-->
    
</div>

<div class="icons">
    @if(!empty($supports))
        @foreach($supports as $support)
            @if($support->slug == 'whatsapp_number')
                <a href="https://wa.me/{{$support->value}}" target="_blank" class="wp"><i class="icofont-whatsapp"></i></a>
            @endif
            
            @if($support->slug == 'phone_number')
                <a href="tel:{{$support->value}}" target="_blank" class="tel"><i class="icofont-iphone"></i></a>
            @endif
            
            @if($support->slug == 'email')
                <a href="mailto:{{$support->value}}" target="_blank" class="email"><i class="icofont-envelope"></i></a>
            @endif
        @endforeach
    @endif
</div>

<!--Full width header End-->
@extends('layouts.main') 
@section('css')
<link rel="stylesheet" href="{{ URL::asset('public/frontend/css/new-css/theme.css') }}">
<link rel="stylesheet" href="{{ URL::asset('public/frontend/css/new-css/custom.css') }}">
<link rel="stylesheet" href="{{ URL::asset('public/frontend/css/new-css/media.css') }}">

<style>
    hr {
        border-top: 0.0625rem solid #010163 !important;
    }
    body{
        padding-left: 0px !important;
    }
    .a2a_full_footer {
        display: none;
    }
</style>
@endsection
@section('content')

<!--------------------breadcrumb ---------------------->
<section class="breadcrumb about-us-b">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-title-div">
                    <div class="bread-left-side">
                        <h2>Courses Details</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="{{route('/')}}">HOME</a>/</li>
                            <li><span>Courses Details</span></li>
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
    <!--------------new courses details page-------------->
    <main id="content" role="main" class="mt-5 mb-5">
        <div class="main-white course-detail-main">
            <div class="position-relative blue-bg text-white pb-md-4 pt-md-4">
                <!-- Hero Section -->
                <div class="gradient-y-overlay-lg-white bg-img-hero space-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7 col-lg-8">
                                <div class="position-relative mobile-view-video mb-3 d-block d-md-none">
                                    <!-- Video Popup -->
                                    <a class="video-player mb-0" data-toggle="modal" data-target="#previewModal" href="javascript:void(0);">
                                        <img class="card-img-top" src="{{ URL::asset('public/uploads/course/'.$course_detail->image) }}" alt="Image Description"> <span class="video-player-btn video-player-centered text-center">
                                            <span class="video-player-icon mb-2">
                                                <i class="fa fa-play"></i>
                                            </span>
                                            <span class="d-none text-center text-white">Preview this course</span>
                                        </span>
                                        <div class="watch-de"><span class="dot-blink"></span> Watch Demo Videos</div>
                                    </a>
                                    <!-- End Video Popup -->
                                </div> <small class=" text-uppercase mb-2">Top course</small>
                                <h1 class="text-lh-sm">{{$course_detail->name}}</h1>
                                <p>{{$course_detail->short_description}}</p>
                                <ul class="d-flex align-items-center list-inline flex-wrap ml-0 pl-0 mb-md-3 mb-2">
                                    <li class="pr-0"> <span class="font-weight-bold mr-0 yellow-txt" style="color:#f5e624;">5</span>
                                    </li>
                                    <li class="pr-2 pr-md-3">
                                        <ul class="list-inline mt-n1 mb-0 mr-0 ml-2 d-flex ul-rate">
                                            <li class="list-inline-item mx-0"> <i class="fa fa-star" style="color:#efce4a;"></i>
                                            </li>
                                            <li class="list-inline-item mx-0"> <i class="fa fa-star" style="color:#efce4a;"></i>
                                            </li>
                                            <li class="list-inline-item mx-0"> <i class="fa fa-star" style="color:#efce4a;"></i>
                                            </li>
                                            <li class="list-inline-item mx-0"> <i class="fa fa-star" style="color:#efce4a;"></i>
                                            </li>
                                            <li class="list-inline-item mx-0"> <i class="fa fa-star" style="color:#efce4a;"></i>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="pr-3"> <span class="d-inline-block ml-md-2">

                                            <span class="">({{$course_detail->no_of_reviews}} Reviews)
                                            </span>
                                        </span>
                                    </li>
                                    <li class="pr-3 d-block d-md-inline-block"><span class="d-inline-block">
                                            <span class=" font-weight-bold ml-sm-2">{{$course_detail->students_enrolled}}</span>
                                            <span class="">Students enrolled</span>
                                        </span>
                                    </li>
                                </ul>
                                <!-- Authors -->
                                <div class="d-flex align-items-center ml-0 author-avar">
                                    <div class="avatar-group"> <span class="avatar avatar-xs avatar-circle">
                                            <img class="avatar-img" src="{{ URL::asset('public/frontend/images/logo-15.png') }}" alt="Image Description">
                                        </span>
                                    </div> <span class="pl-md-2 d-flex align-items-center">Created by <a class="link-underline" href="{{route('/')}}">DI TCHNICAL</a></span>
                                </div>
                                <!-- End Authors -->
                                <ul class="d-md-flex align-items-center flex-wrap list-inline mt-0 mt-md-3 mb-2 mb-md-3 detail-lst-svg">
                                    <li class="mr-2 mr-md-4 py-1 py-md-0">
                                        <svg class="mb-0 mr-0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="" width="20" height="20" viewBox="0 0 20 20">
                                        <image width="20" height="20" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAQAAAAngNWGAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAKqNIzIAAAAJcEhZcwAACxIAAAsSAdLdfvwAAAAHdElNRQflAx4QEzbPSA2WAAAA/0lEQVQoz4WRLUsEARCGn1sWVzmE9eMOETRZ/AVnsVwWvZP7AcKByWg3CQa7iF9FwSgY1WSwWsSgyWS6PVAPhcPHsNH9eCfMhGfeGWaQgpjywW5aUwK+q6vlIOKJui4VAWosEfHLf30wwjkxG4g7FqunWnGTQy45Y0CQ4ZgwyRUxLRz6VLjjtdoU1INcqO6PuiwSANPkacgNHe4BQgb0c8EeKwCMEeGE1dJb7vsZkPAFNLigluscU007FlSdy3XcVcRFBz4Xjr7TkAa3jLLFDPWMoRLRpske9tWk5ImnErLNEbIGjGc4BnzzyAsgdtTjshOlqaW+OVsOYtdX54vAP+wZYBtUvPPyAAAAAElFTkSuQmCC" />
                                        </svg> <span class=" ml-2 mr-2"> Last updated </span>
                                        <span class=" font-weight-bold">
                                            {{(!empty($course_detail->updated_at)) ? \Carbon\Carbon::parse($course_detail->updated_at)->format('D, d-F-Y') : ''}}</span>
                                        <br>
                                    </li>
                                    <li class="mr-2 mr-md-4 py-1 py-md-0"> <span class="text-white ml-md-2 d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Language"><svg class="mr-2 mb-0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21" height="19" viewBox="0 0 21 19">
                                            <image width="21" height="19" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAATCAQAAADVR44AAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAKqNIzIAAAAJcEhZcwAACxIAAAsSAdLdfvwAAAAHdElNRQflAx4RCzZMkf/4AAABQklEQVQoz22SPSuFcRiHr/PE8RJSikQmk5QvcIwGK9sZLCzqfAImGaRMDAqRRSm7nEU4Fpvl5KVEDhIW5aXEZXieo3Mez31P96/r/79fkQTv9sSFuFrDfxsiD5TicvAPnCLPASXSUZxmhBRAPPWeuiRee/Kn6bFYhfb5oo6J+GFBrDVno6PqjGCPs2646oL6am/07NWC2Kiei2tqC15YtkdTfxlCFAfVrKhzqOsiFi1WFFNG8VDFK+8D4Dvqr5kkWwYCVugMgNpobD+J6B3QxFU41/KvqUS0HXijK0S/APjhMxEdB76Z4Bkf1Gdf1OuEtvrUnKiL2O+mR+67rV7aVoU2qE/ivNpeua2MqsMivlsQ65y1w0y47OoLaPVUnRZvq27gLH4DoS+p2964G8X1TtqcjGJW1Z24HiSMZ4sBitzF5V9GimS97kJkZwAAAABJRU5ErkJggg=="/>
                                            </svg>
                                            {{$course_detail->course_language}}</span>
                                    </li>
                                    <li class="mr-2 py-1 py-md-0"> <span class="badge badge-success d-md-block" data-toggle="tooltip" data-placement="top" title="Course level">{{$course_detail->course_level}}</span>
                                    </li>
                                </ul>
                                <ul class="d-none d-md-flex list-inline align-items-center pl-0 ml-0 mt-md-4 mb-0">
                                    <li class="pr-3 pr-md-4">
                                        @csrf
                                        <a class="btn-white-o " id="" onclick="AddtoWishlist(this)" data-id="{{$course_detail->id}}" href="javascript:;">
                                            <i class="icofont-heart"></i> Wishlist</a>
                                    </li>
                                    <li>
                                        <div class="tag-social-link">

                            <div class="social-sharing a2a_kit a2a_kit_size_32" style="line-height: 32px;">
                                <ul class="social-links">
                                    <li>
                                        <a class="facebook a2a_button_facebook" href="/#facebook" target="_blank" rel="nofollow noopener">
                                            <i class="fa fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="twitter a2a_button_twitter" href="/#twitter" target="_blank" rel="nofollow noopener">
                                            <i class="fa fa-twitter"></i>
                                        </a>

                                    </li>
                                    <li>
                                        <a class="linkedin a2a_button_linkedin" href="/#linkedin" target="_blank" rel="nofollow noopener">
                                            <i class="fa fa-linkedin"></i>
                                        </a>

                                    </li>
                                    <li>

                                        <a class="a2a_dd plus" href="https://www.addtoany.com/share#url={{Route('course-details',['id'=>base64_encode($course_detail->id)])}}&amp;title={{$course_detail->name}}">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <script async="" src="https://static.addtoany.com/menu/page.js"></script>

                        </div>
                                        <!-- End Button trigger modal -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Hero Section -->
                <!-- Sidebar Content Section -->
                <div class="container space-top-md-2 position-md-absolute sidbar-detail top-0 right-0 left-0">
                    <div class="row justify-content-end">
                        <div id="stickyBlockStartPoint" class="col-md-5 col-lg-4 z-index-2">
                            <!-- <div class="js-sticky-block card border" -->
                            <div class="card js-sticky-block" data-hs-sticky-block-options='{
                                 "parentSelector": "#stickyBlockStartPoint",
                                 "breakpoint": "md",
                                 "startPoint": "#stickyBlockStartPoint",
                                 "endPoint": "#stickyBlockEndPoint",
                                 "stickyOffsetTop": 20,
                                 "stickyOffsetBottom": 20
                                 }'>
                                <div class="position-relative d-none d-md-block">
                                    <!-- Video Popup -->
                                    <a id="modalOpen" class="video-player mb-0" data-toggle="modal" data-target="#previewModal" href="javascript:;">
                                        <img class="card-img-top" src="{{ URL::asset('public/uploads/course/'.$course_detail->image) }}" alt="Image Description"> <span class="video-player-btn video-player-centered text-center">
                                            <span class="video-player-icon mb-2">
                                                <i class="fa fa-play"></i>
                                            </span>
                                            <span class="d-none text-center text-white">
                                                Preview this course                        </span>
                                        </span>
                                        <div class="watch-de"><span class="dot-blink"></span> Watch Demo Videos</div>
                                    </a>
                                    <!-- End Video Popup -->
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="d-md-flex justify-content-between align-items-center">
                                            <div class="d-md-flex justify-content-md-between align-items-center"> <span class="h2 text-lh-sm mr-1 mb-0 discounted-price font-rupee font-weight-bold">₹{{$course_detail->price}}</span>
                                                <span class="d-price font-rupee"><del>₹{{$course_detail->original_price}}</del></span>
                                            </div>
                                            <div> <span class="d-price font-rupee">Get Discount {{$course_detail->discount_percentage}} % off
                                                </span>
                                            </div>
                                        </div>
                                        <div class="discount-info">
                                            <div class="day-left">
                                                <svg id="icon-alarm" enable-background="new 0 0 443.294 443.294" height="24" viewBox="0 0 443.294 443.294" width="24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="m221.647 0c-122.214 0-221.647 99.433-221.647 221.647s99.433 221.647 221.647 221.647 221.647-99.433 221.647-221.647-99.433-221.647-221.647-221.647zm0 415.588c-106.941 0-193.941-87-193.941-193.941s87-193.941 193.941-193.941 193.941 87 193.941 193.941-87 193.941-193.941 193.941z" />
                                                <path d="m235.5 83.118h-27.706v144.265l87.176 87.176 19.589-19.589-79.059-79.059z" />
                                                </svg> <strong>{{$course_detail->hours_left_for_this_price}} hours</strong> left for this price</div>
                                        </div>
                                    </div>
                                    <div class="mb-3"> <a class="btn  btn-see btn-buy w-100 mb-0 " id="" onclick="AddtoCart(this)" data-id="{{$course_detail->id}}" href="javascript:;">Add to cart</a>
                                    </div>
                                    <div class="mb-3"> <a class="btn btn-green w-100 mb-0" onclick="BuyNow(this)" data-id="{{$course_detail->id}}" href="javascript:;">Buy now</a>  <span id="getloader" style="display:none;color:black;"><i class="fa fa-spinner fa-spin"></i> Loading Please Wait</span>
                                    </div>
                                    <div class="btn-fixed-bottom d-md-none">
                                        <div class="fixed-bottom-price"> <span class="h2 text-lh-sm mr-2 mb-0 font-rupee">₹{{$course_detail->price}}</span>
                                            <strike class="p text-lh-sm mr-2 mb-0 font-rupee">₹{{$course_detail->original_price}}</strike>
                                        </div> <a class="btn btn-green w-100" onclick="BuyNow(this)" data-id="{{$course_detail->id}}" href="javascript:;">Buy now</a>
                                    </div>
                                    <!--<div class="money-back">30 days money back guarantee</div>-->

                                    <ul class="row d-flex d-md-none justify-content-center  list-inline align-items-center mobile-wish-btns">
                                        <li><a class="btn-white-o " id="" onclick="AddtoWishlist(this)" data-id="{{$course_detail->id}}" href="javascript:;">
                                                Wishlist <i class="icofont-heart"></i></a> 
                                        </li>
                                        <!--<li>-->
                                            <!-- Button trigger modal -->
                                        <!--    <a class="btn-white-o" data-toggle="modal" data-target="#copyToClipboardModal" href="javascript:;">-->
                                        <!--        Share <i class="icofont-share"></i></a>-->
                                            <!-- End Button trigger modal -->
                                        <!--</li>-->
                                        <!--new-->
                                            <li>
                                        <div class="tag-social-link">

                            <div class="social-sharing a2a_kit a2a_kit_size_32" style="line-height: 32px;">
                                <ul class="social-links">
                                    <li>
                                        <a class="facebook a2a_button_facebook" href="/#facebook" target="_blank" rel="nofollow noopener">
                                            <i class="fa fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="twitter a2a_button_twitter" href="/#twitter" target="_blank" rel="nofollow noopener">
                                            <i class="fa fa-twitter"></i>
                                        </a>

                                    </li>
                                    <li>
                                        <a class="linkedin a2a_button_linkedin" href="/#linkedin" target="_blank" rel="nofollow noopener">
                                            <i class="fa fa-linkedin"></i>
                                        </a>

                                    </li>
                                    <li>

                                        <a class="a2a_dd plus" href="https://www.addtoany.com/share#url={{Route('course-details',['id'=>base64_encode($course_detail->id)])}}&title={{$course_detail->name}}">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <script async="" src="https://static.addtoany.com/menu/page.js"></script>

                        </div>
                                        <!-- End Button trigger modal -->
                                    </li>
                                        
                                        
                                        <!--new//-->
                                    </ul>
                                    <div class="mt-3">
                                        <h2 class="h4">This course includes:</h2>
                                        <!-- Icon Block -->
                                        <div class="media text-body font-size-1 mb-2">
                                            <div class="min-w-3rem text-center mr-3">
                                                <i class="fa fa-clock-o" aria-hidden="true" width="18" height="18"></i>
                                            </div>
                                            <div class="media-body">{{$hour_minute}} On demand videos</div>
                                        </div>
                                        <!-- End Icon Block -->
                                        <!-- Icon Block -->
                                        <div class="media text-body font-size-1 mb-2">
                                            <div class="min-w-3rem text-center mr-3">
                                                <i class="icofont-book"></i>

                                            </div>
                                            <div class="media-body">{{$total_lessons}} Lessons</div>
                                        </div>
                                        <!-- End Icon Block -->
                                        <!-- Icon Block -->
                                        <div class="media text-body font-size-1 mb-2">
                                            <div class="min-w-3rem text-center mr-3">
                                                <i class="icofont-infinite" width="18" height="18"></i>
                                            </div>
                                            <div class="media-body">Full time access</div>
                                        </div>
                                        <!-- End Icon Block -->
                                        <!-- Icon Block -->
                                        <div class="media text-body font-size-1 mb-2">
                                            <div class="min-w-3rem text-center mr-3">
                                                <i class="fa fa-mobile" aria-hidden="true"></i>
                                            </div>
                                            <div class="media-body">Access on mobile, Tablet and tv</div>
                                        </div>
                                        <!-- End Icon Block -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Sidebar Content Section -->
            </div>
            <div class="container space-top-2 space-top-md-1">
                <div class="row">
                    <div class="col-md-7 col-lg-8">
                        <!-- Info -->
                        <div class="pt-0 mt-3 mt-md-5 border p-3 p-md-5 border-radius ">
                            <h3 class="mb-3 mb-md-4">What you will learn ?</h3>
                            <div class="row">
                                {!!$course_detail->what_you_will_learn!!}
                            </div>
                        </div>
                        <!-- End Info -->
                        <div class="pt-3 mt-3 mt-md-5">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h3 class="mb-4">Get certificate of completion</h3>
                                            <div class="mt-3">
                                                <img src="{{ URL::asset('public/frontend/images/new-image/certificate-1.jpg') }}" alt="" class="img-responsive" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 pt-3 pt-lg-0">
                                            <h3 class="mb-4">
                                                <svg class="mb-0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="20">
                                                <image x="0px" y="0px" width="40" height="20" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOIAAABxCAMAAAD/PI8IAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABUFBMVEUcttL///8cttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttIcttL///+KO+1gAAAAbnRSTlMAACQ0QjqBz8M276ej31LHocHh8dE49VDt6flWZvde/Vh08377bo/njYXbMJ0yzSylvbUuKLe/uSZon62baofdWirVr9fTiYvjyeXrYnB8PHKDeJFKYFRcTGROdkZEsWy7SJmXlUCzxdl6y6s+k5AFCCAAAAABYktHRAH/Ai3eAAAAB3RJTUUH5QMfCxcVoYySFAAABkVJREFUeNrtnGlb20YQgJ2RDLgQLtuYKyYQjoJtLjsgyh3uK4SblHAH2qat/v/H2oDBMjPS7mr1WNp0Plra0byaPWdGDoWCKeAkmh4GyN/45k2lTRUErKo2GaQmAgFFBP0XFsCC1EIwETVWwLzUQRAR4S0HoqkFEbGeh9BsgErbKyCNXIhmEBGb/kdUAPEn6Kh8000gEaFZeUSupT+giKBHVUcsbMNjqiO+PkzFm5VDLJNwi3petEqiVcGOaiVsU3Eslgjo7UpONyXSoeiM+iKd7xRHhGSXqutikfC9ukv/E2E3wtSjEiJ8QAh7dYUQoQ8hjIZBHUSoQgib4yF1EKEfIRwIh9RBhF8xwkhIHUQYRAiHUiF1ECGNEDZoIXUQAQs0xjIhdRBRHw6PFK8qgAijCOHYyPPl4CPCOEI4nn25HnjE3EeEcCJX8gqCjpibxHxolNxROURj6rfpmdmcSy05LIDaaNFaKcTU3Pzj2rXg6pGLnxDCJet7qwwi6MvPj6xy8czsCkJYV6awEogQsYyftPBDs/MI4Wq5ugogptbKJ4eUoKJ1hPB1pwDLcI15jwjJ14VOG5qIpswmQtiPEFjOkVVeF6VAahqxy9yK86vSsKD+IOYjKMnNRb0uLcqtmrj0bvP2H7QobAfXUhK90b0tEIMFmzqnz3yMu1jW9AuhA7Sn4RjTPK2Bg3jatJM9DkbQexEN+7QGqG9sajqoB0+LNWHfdJBGdsZDrP0RU3vPECH5yYkwv9NZZFR2jPnwhO0NeYUYGXUGzMsQ0+IBp0jTrq+MfcAbRKOvhYnQNHvCzobCMdYyyWqMF4jw+wojYEEcnQGzWLND5nHsAeJumgMwL2f2xsI20qYtwj5TSUeEvk2aZgb9dc3uCAk60iL6jcMiyYig21T8fDDgHN0KXBi0wkvk/i6dxya5iJFaGnBJK/StzBV2rTpCEWKJmdZdLqNkIhpH9KcFK8VZZRGLnpnz1zghliBd5/KhTEQ4H6NduPoy3AAdkD0JZP6Az8idm3w+lIiYvaEBpy2LH+oa05x6fbK9RW7bynIYJRPR2KGPFJsd5aGVE7QSqPz0bnxHblrmjxdIQYQw3Ufb+xGjOtCKtVsLY+4AuWVYIFogAzHXTwKa4xm0SRwLwpgTJYsH1GGEBqNJchGhjy4iXCYPA8YEdn/s7vn6PXK5RoTQNSJcX9AuXM3QDXNou/nE49URzIcTjEcvuYiwRgPWnNvuIwGbTcx3x4VGi9gW4kowWOgKEb7SZaADjnF9dG/2EHBaxD6nWRINh7pAhG/zJGD7AcPkDpfo4jHZOYz8Oi4c8BVHNLZJQHPslE3HAvotAnacvhcPaYsiwjG91m8lme2J25y8SuW7i6C9IKJ+RZuzN8KhKDvJQjjjJi0hhJid6yGt+YM94vCoq9ZjQhFEqP+T7qN93NbAgRNhv7vUEjciaB9pYw5EjCEWj2f5y2XyjBcxW0XbMnkqZgwk7Qjn3KYH+RDh5AdpSrRbuFABDukafZ7EhwREu6lhRmwD+SQatQR9cZ/i5UA0BulvWpriLk3J4COcf/ZygQgJeru23u3KhQ+SxZLJZzLS9IyIoN2SgGZdhEmH0yNeh61k+JAVkYgoPUjDuaSKCNgp09whRzELIizQ82gb+37U+TknpZp7WZNrEhAzNvPoaFgaYIHx8CVG0rItS6sjInGoe5C3CdlVO8/1Xxt37pWxIUKC3o+2dXtQlmScbeQ1T8t8d/aIkVUS0LwRKA5ikdTpgjwPOiHapQpj7wNTq0sjgk7Po107gQG0QczY/ONKWqhIz2eIuaMBEnDYXVmwPxDhziZV6PaE6gvEjE3JxU0qaIQIItikCockbRsrighhOnzYPsgTPvSNlCHapQr/5k5B+0MsiMYs/WdAP44D2EfLEeF6iXbhoGBNvg/kBRFswocXDPWGvpUiInTSqcIVzhi+z+QJ8W6YBIzuBXSasSDCJR2qveIsx/KfPCDSo3BdMIbvJykg7vYSgD1TwQd8RKQq1cfPK22dLETA409tbF9B+F8KiCjhnlClkh+FQExnFHEhhdh6qQ7gI2J53mtOmT5aRAz9Yzlf3Ad5P0ohhko+Z6muV8uFRURIFv34r2IefEYs7FInWrea9rMKEuYR/wMb7uqegQKYRwAAAABJRU5ErkJggg==" />
                                                </svg>
                                                Jobs that require this skill:                     </h3>
                                            <ul class="certificate-uls pl-7">
                                                {!!$course_detail->jobs_that_require_this_skill!!}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Collapse -->
                        <div class=" pt-7 mt-3 mt-md-5">
                            <div class="row mb-3">
                                <div class="col-12 mb-2">
                                    <h3 class="mb-0">Course content</h3>
                                </div>
                                <div class="col-12 col-md-7">
                                    <div class="row">
                                        <div class="col-lg-12"> <span class="font-size-1"><strong>{{$total_lessons}}</strong> Lessons</span>
                                            <span> • </span>
                                            <span class="font-size-1">{{$hour_minute}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-5 text-md-right pt-2 pt-md-0"> <span class="card-all-toggle ml-md-4 mr-0">
                                        Collapse all sections
                                    </span>
                                </div>
                            </div>
                            <div class="border-radius-top-right">
                                <!-- Card -->
                                <!-- View More - Collapse -->
                                @forelse($course_modules as $mod => $course_module)
                                <?php
                                $videos = App\Model\CourseModuleVideo::where('module_id', $course_module->id)->where('status', '1')->get();
                                if (sizeof($videos) > 0) {
                                    $total_lesson_module = App\Model\CourseModuleVideo::where('course_id',$course_module->course_id)->where('module_id',$course_module->id)->where('status','1')->count();
                                    $totaltime= App\Model\CourseModuleVideo::where('course_id',$course_module->course_id)->where('module_id',$course_module->id)->where('status','1')->sum('time');
                                    $hour = floor($totaltime / 60);
                                    $minute = ($totaltime % 60);
                                    ?>
                                    <div class="card mb-0 curriculum-course">
                                        <div class="card-header card-collapse" id="coursesHeading{{$mod}}">
                                            <a class="btn btn-link btn-sm btn-block card-btn p-3 px-3 text-body-2  " href="javascript:;" role="button" data-toggle="collapse" data-target="#coursesCollapse{{$mod}}" aria-expanded="false" aria-controls="coursesCollapse{{$mod}}">
                                                <!-- Header --> <span class="row">
                                                    <span class="col-12 col-md-7">
                                                        <span class="media">
                                                            <span class="media-body">
                                                                <span class="text-body-2 section-nm font-weight-bold mr-5">{{$course_module->name}}</span>
                                                            </span>
                                                        </span>
                                                    </span> 
                                                    <span class="col-12 col-md-5 text-md-right  pt-1 pt-md-0 pos-inherit">
                                                        <span class="row">
                                                            <span class="col-lg-12 pos-inherit">
                                                                <span class="d-flex align-items-center justify-content-md-end">
                                                                    <span class="text-body-2 ">
                                                                        {{$total_lesson_module}} Lessons                        </span>
                                                                    <span class="px-2  d-md-inline-block"> • </span>
                                                                    <span class="text-body-2">
                                                                        {{$hour}} Hr {{$minute}} Min
                                                                    </span>
                                                                    <span class="card-btn-toggle ml-4 mr-0 text-body-2">
                                                                        <span class="card-btn-toggle-default"><img src="https://www.efacourses.com/assets/frontend/efanew/img/right-arrow.svg" width="14"></span>
                                                                        <span class="card-btn-toggle-active"><img src="https://www.efacourses.com/assets/frontend/efanew/img/right-arrow.svg" width="14"></span>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </span>
                                                <!-- End Header -->
                                            </a>
                                        </div>
                                        @foreach($videos as $video)
                                        <div id="coursesCollapse{{$mod}}" class="collapse  show" aria-labelledby="coursesHeading{{$mod}}">
                                            <div class="card-body p-0 py-3">
                                                <!-- Course Program -->
                                                <div class="py-2 pl-3 pr-3 pr-md-5 pl-md-5">
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <a class="media font-size-1 mr-md-5" href="javascript:void(0);"> <i class="fa fa-play-circle min-w-3rem text-center opacity-lg mt-1 mr-2 ml-0"></i>
                                                                <span class="media-body">
                                                                    <span>{{$video->name}}</span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <?php
                                                        $hours = floor($video->time / 60);
                                                        $minutes = ($video->time % 60);
                                                        ?>
                                                        <div class="col-12 col-md-4 text-md-right  py-1 py-md-0 pl-36 d-none d-md-inline-block">
                                                            <div class="row">
                                                                <div class="col-md-12 text-md-right"> <span class="text-body-2 font-size-1">{{$hours}} Hr {{$minutes}} Min</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <?php
                                }
                                ?>
                                @empty
                                @endforelse






                            </div>
                            <!-- End Card -->
                            <!-- Link -->
                            <!-- End Link -->
                        </div>
                        <!-- End Collapse -->
                        <!-- Info -->
                        <div class="pt-3 mt-3 mt-md-5">
                            <h3 class="mb-4">Requirements</h3>
                            <div class="row">
                                {!!$course_detail->requirements!!}
                            </div>
                        </div>
                        <!-- End Info -->
                        <hr>
                        <!-- Info -->
                        <div class="border-top pt-7 mt-7">
                            <h3 class="mb-4">Course description</h3>
                            <div class="description">
                                {!!$course_detail->long_description!!}
                            </div>

                            <!--                             Link 
                                                        <a class="link link-collapse small font-weight-bold pt-0 blue-text" data-toggle="collapse" href="#collapseDescriptionSection" role="button" aria-expanded="false" aria-controls="collapseDescriptionSection"> <span class="link-collapse-default" onclick="limitedDescription('read_more')">Show more</span>
                                                            <span class="link-collapse-active" onclick="limitedDescription('read_less')">Show less</span>
                                                        </a>-->
                        </div>
                        <!-- End Info -->



                        <hr>
                        <div class=" pt-2 mt-3 mt-md-5 efa-guarante">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-lg-6">
                                    <div class="media align-items-center mb-3">
                                        <svg class="mb-0" fill="#7c89d7" width="60" height="60" id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                        <path d="m356.016 16h-70.018l-120.005 90h70.017z" />
                                        <path d="m477.012 16h-71.014l-120.005 90h70.017z" />
                                        <path d="m405.991 106h106.009v-75c0-1.157-.41-2.179-.657-3.261z" />
                                        <path d="m44.993 106h71.017l120.006-90h-70.018z" />
                                        <path d="m0 481c0 8.291 6.709 15 15 15h482c8.291 0 15-6.709 15-15v-345h-512zm181-270c0-5.405 2.9-10.386 7.603-13.052s10.474-2.593 15.117.19l150 90c4.512 2.71 7.28 7.588 7.28 12.861s-2.769 10.151-7.28 12.861l-150 90c-4.646 2.782-10.419 2.854-15.117.19-4.703-2.664-7.603-7.645-7.603-13.05z" />
                                        <path d="m15 16c-8.291 0-15 6.709-15 15v71.257l116.016-86.257z" />
                                        <path d="m211 237.499v127.002l105.85-63.501z" />
                                        </g>
                                        </svg>
                                        <div class="media-body">
                                            <h2> {{$total_lessons}} Video <br>
                                                Lessons 
                                            </h2>
                                        </div>
                                    </div>
                                    <h3 class="mb-2"> Get instant & lifetime access</h3>
                                    <div class="pl-7">
                                        <p>This course contains pre-recorded videos that can be watched anytime</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!--<div class="media align-items-center mb-3">-->
                                    <!--    <svg class="mb-0" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="70" height="70">-->
                                    <!--    <image x="0px" y="0px" width="70" height="70" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAANAAAADiCAMAAAAIyLngAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABUFBMVEV814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814t814v////T+To/AAAAbnRSTlMAJEKt3+e3aoG5o7Wlp/OrNGKvse+Rz/VMvb/Bw8XHy7NYLnzNh0bpdDhQ26EycpvRYH7j7WyT3UpU8XDT2XjhMIX95WhOUiqdQHo8KER295W7+Ys2Zus6SFY+WoP7ianJ1yaXmWQsXNVuj16Nnzv2NXwAAAABYktHRG9VCGGBAAAAB3RJTUUH5QQBCjkSN8uYEAAAEYBJREFUeNrdXelDUzkQ7yAgKAsUlEPYaoFySEGsHCsigiAVpXigAoqICyqgvP//47aUo5PM5M2890oX5puSTObX5CVzZRKLVYYAoEIjlwVN1bVqr6b2+lXBBHVekeqvBiK44Z3SzauACBq8c6qrtDQR4PmrBI/XeOmnCJo8RM2VFigsnmsYjxevtEQh8bQYeC75DEGriefWpf6G4KaJx7tdaZlC4am18LRd5gmCegtPe0elhQqDp/OK4blzxfB0XTE83VcMz99XDE+CwHOJLVa461FUc68u2XMpYfV6DupL9V82TDDguam9ZXDoMoG67wloOJ38H2GCkdEHY+mHjEQZCaA8PXpw//+BCa6fKGnjE6RAk0JAeZqa/KfSmODxjelzgZ5Q4sTlgPI0M1pJ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" />-->
                                    <!--    </svg>-->
                                    <!--    <div class="media-body">-->
                                    <!--        <h2> 30 day <br>-->
                                    <!--            money back -->
                                    <!--        </h2>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<h3 class="mb-2">Don’t like it, no problems</h3>-->
                                    <!--<p>If for any reason you are not happy with your purchase, simply email us within 30 days of purchase and we will refund you within 24 hours.</p>-->
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="border-top pt-2 mt-3 mt-md-5 how-tobuy-section">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="mb-3">How to buy this course:</h3>
                                    <p><span>STEP 1:</span> Click on BUY NOW button</p>
                                    <p><span>STEP 2:</span> Register yourself by filling basic details</p>
                                    <p><span>STEP 3:</span> Make payment via credit card, debit card, UPI Pay TM or other payment wallets</p>
                                    <p><span>STEP 4:</span> Get instant access and unlock the course</p>
                                </div>
                                <div class="col-lg-6 pt-3 pt-lg-0">
                                    <h3 class="mb-3">How to access the course:</h3>
                                    <p><span>STEP 1:</span> Login to your account</p>
                                    <p><span>STEP 2:</span> Click MY COURSES section and view your course</p>
                                    <p><span>STEP 3:</span> Click videos to begin</p>
                                </div>
                            </div>
                        </div>
                        <div class="big-course-btn">
                            <a href="{{route('courses')}}" class="btn big-course">More Course</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="stickyBlockEndPoint"></div>
            <div class="modal fade modal-course-video" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="previewModalLabel">Free Sample Videos</h5>
                            <button type="button" id="closeModal"  class="close" data-dismiss="modal" aria-label="Close">
                               
                                <i class="icofont-close-line"></i>
                            </button>
                            
                        </div>
                        <div class="modal-body">
                            <div class="plyr__video-embed" >
                                <!--<div id="vimeo-player"></div>-->
                                <!--<iframe width="100%" height="500" src="{{ URL::asset('public/uploads/course/'.$course_detail->video) }}" autostart="false" controls controlsList="nodownload"></iframe>-->
                                <video width="100%" height="auto" id="demo-video" controls="controls" controlsList="nodownload" > 
                                    <source src="{{ URL::asset('public/uploads/course/'.$course_detail->video) }}" type="video/mp4" >
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Copy to Clipboard Modal -->
            <div class="modal fade" id="copyToClipboardModal" tabindex="-1" role="dialog" aria-labelledby="copyToClipboardModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <!-- Header -->
                        <div class="modal-header">
                            <h4 id="copyToClipboardModalTitle" class="mb-0">Share this course</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg aria-hidden="true" class="mb-0" width="14" height="14" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z" />
                                </svg>
                            </button>
                        </div>
                        <!-- End Header -->
                        <!-- Body -->
                        <div class="modal-body">
                            <form>
                                <!-- Clipboard -->
                                <div class="input-group mb-4">
                                    <input id="copyToClipboard" type="text" class="form-control" value="https://www.efacourses.com/home/course/learn-fl-studio-music-production-for-beginners-course-in-hindi/77">
                                    <div class="input-group-append"> <a class="js-clipboard input-group-text btn btn-primary" href="javascript:;" data-hs-clipboard-options='{
                                                                        "contentTarget": "#copyToClipboard",
                                                                        "successText": "Copied!",
                                                                        "container": "#copyToClipboardModal"
                                                                        }'>Copy</a>
                                    </div>
                                </div>
                                <!-- End Clipboard -->
                            </form>
                            <!-- Social Networks -->
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <a class="btn btn-xs btn-icon btn-outline-secondary" target="_blank" href="http://www.facebook.com/sharer.php?u=https://www.efacourses.com/home/course/learn-fl-studio-music-production-for-beginners-course-in-hindi/77"> <i class="fa fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn btn-xs btn-icon btn-outline-secondary" target="_blank" href="http://twitter.com/share?url=https://www.efacourses.com/home/course/learn-fl-studio-music-production-for-beginners-course-in-hindi/77&text=Efa Courses&hashtags=simplesharebuttons"> <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn btn-xs btn-icon btn-outline-secondary" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=https://www.efacourses.com/home/course/learn-fl-studio-music-production-for-beginners-course-in-hindi/77"> <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn btn-xs btn-icon btn-outline-secondary" target="_blank" href="mailto:?Subject=Efa Courses&Body=https://www.efacourses.com/home/course/learn-fl-studio-music-production-for-beginners-course-in-hindi/77"> <i class="fa fa-envelope"></i>
                                    </a>
                                </li>
                            </ul>
                            <!-- End Social Networks -->
                        </div>
                        <!-- End Body -->
                    </div>
                </div>
            </div>
        </div>
    </main>


</section>
<!----------------------------------Main content End--------------------------->

@stop
@section('js')
<!--<script src="{{ URL::asset('public/frontend/js/jquery.min.js') }}"></script>-->
<!--<script src="{{ URL::asset('public/frontend/js/new-js/player.js ') }}"></script>-->
<script type="text/javascript">
    $(document).ready(function () {
        $(".card-all-toggle").click(function () {
            $(this).text($(this).text() == 'Expand all sections' ? 'Collapse all sections' : 'Expand all sections');
        });
        $('.card-all-toggle').on('click', function () {
            $('.card .collapse').collapse('toggle');
        });
        
          $("#modalOpen").click(function(){
            $("#demo-video").trigger('play');
          });
          $("#closeModal").click(function(){
            $("#demo-video").trigger('pause');
          });

    });
</script>
<script>
var vid = document.getElementById("myVideo");
function enableAutoplay() { 
  vid.autoplay = true;
  vid.load();
}

function disableAutoplay() { 
  vid.autoplay = false;
  vid.load();
} 

function checkAutoplay() { 
  alert(vid.autoplay);
} 
</script> 

<!-- JS Global Compulsory -->
<script src="{{ URL::asset('public/frontend/js/new-js/jquery-migrate.min.js') }}"></script>
<script src="{{ URL::asset('public/frontend/js/new-js/bootstrap.bundle.min.js') }}"></script>
<!-- JS Implementing Plugins -->
<script src="{{ URL::asset('public/frontend/js/new-js/hs-header.min.js') }}"></script>
<script src="{{ URL::asset('public/frontend/js/new-js/hs-unfold.min.js') }}"></script>
<script src="{{ URL::asset('public/frontend/js/new-js/hs-sticky-block.min.js') }}"></script>
<script src="{{ URL::asset('public/frontend/js/new-js/clipboard.min.js') }}"></script>

<!-- SHOW TOASTR NOTIFIVATION -->
<!-- JS Plugins Init. -->
<script>
    $(document).on('ready', function () {
        // initialization of header
        var header = new HSHeader($('#header')).init();
        
       // initialization of unfold
        var unfold = new HSUnfold('.js-hs-unfold-invoker').init();
        
       // initialization of sticky blocks
        $('.js-sticky-block').each(function () {
            var stickyBlock = new HSStickyBlock($(this)).init();
        });
    });
</script>

@endsection
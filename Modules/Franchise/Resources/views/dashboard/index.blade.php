<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{env('PROJECT_NAME', 'Madrasa')}} :: Admin</title>
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/animate.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/icofont.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/bootstrap-select.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/select2.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/animate.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/aos.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/main.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/responsive.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/dashboard.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/dashboard_responsive.css') }}" />
    </head>
    <body>
        <div class="dashboard">
            <div class="container-fluid">
                <div class="row">
                    <!-------- Mobile view menu section -------->
                    <div class="mobile-view">
                        <div class="logo-sec">
                            <div class="clearfix d-flex">
                                <div class="col-xs-6 col-6">
                                    <a href="#"><img src="{{ URL::asset('public/backend/images/dash_logo.png') }}" alt="" class="img-responsive"></a>
                                </div>
                                <div class="col-xs-6 col-6 text-right">
                                    <a href="javascript:void(0);" id="MobilesidebarToggle" class="bgr-mnu">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26.855" height="13.913" viewBox="0 0 26.855 13.913"><defs><style>.b{fill: #0070c0;}</style></defs><g transform="translate(0 -3)"><path class="b" d="M7.238,124.886H1.109a1.109,1.109,0,1,1,0-2.218H7.238a1.109,1.109,0,1,1,0,2.218Zm0,0" transform="translate(0 -113.82)"/><path class="a" d="M25.736,2.218H1.119A1.109,1.109,0,1,1,1.119,0H25.736a1.109,1.109,0,1,1,0,2.218Zm0,0" transform="translate(0 3)"/><path class="a" d="M16.37,247.55H1.109a1.109,1.109,0,0,1,0-2.218H16.37a1.109,1.109,0,0,1,0,2.218Zm0,0" transform="translate(0 -230.636)"/></g></svg>
                                        <div class="clearfix"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-------- End Mobile view menu section -------->
                    <div class="user-dash-right">
                        <div class="clearfix">

                            <div class="dash-bottom-part">
                                <div class="bottom-part-1">
                                    <div class="col-sm-12">
                                        <h1 class="dash_heading">DASHBOARD</h1>
                                        <div class="row">
                                            <div class="col-lg-3 col-sm-6 col-cst-4">
                                                <a href="#">
                                                    <div class="inner-box d-flex align-items-center gradient-bg-1">
                                                        <div class="media justify-content-between align-items-center d-flex">
                                                            <div class="media-left">
                                                                <h1>36</h1>
                                                                <h2>TOTAL USERS</h2>
                                                            </div>
                                                            <div class="media-right">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="42.901" height="27.24" viewBox="0 0 42.901 27.24"><defs><style>.a{fill:#fff;}</style></defs><g transform="translate(0 -92.25)"><g transform="translate(0 92.25)"><path class="a" d="M37.1,104.236a4.9,4.9,0,1,0-5.619,0,8.486,8.486,0,0,0-2.895,1.7,10.981,10.981,0,0,0-3.973-2.165,6.205,6.205,0,1,0-6.417,0,11.073,11.073,0,0,0-3.93,2.139,8.555,8.555,0,0,0-2.861-1.664,4.9,4.9,0,1,0-5.619,0A8.6,8.6,0,0,0,0,112.368v.56a.037.037,0,0,0,.034.034H10.415a11.417,11.417,0,0,0-.093,1.435v.577a4.514,4.514,0,0,0,4.516,4.516H28a4.514,4.514,0,0,0,4.516-4.516V114.4a11.417,11.417,0,0,0-.093-1.435H42.867a.037.037,0,0,0,.034-.034v-.56A8.63,8.63,0,0,0,37.1,104.236Zm-6.349-4.015a3.54,3.54,0,1,1,3.608,3.54h-.136A3.535,3.535,0,0,1,30.754,100.221Zm-14.21-1.766a4.847,4.847,0,1,1,5.127,4.838h-.56A4.854,4.854,0,0,1,16.544,98.455Zm-11.51,1.766a3.54,3.54,0,1,1,3.608,3.54H8.506A3.54,3.54,0,0,1,5.034,100.221ZM10.653,111.6H1.375a7.253,7.253,0,0,1,7.147-6.477h.1a7.177,7.177,0,0,1,4.626,1.723A11.145,11.145,0,0,0,10.653,111.6Zm20.483,3.378a3.163,3.163,0,0,1-3.158,3.158H14.821a3.163,3.163,0,0,1-3.158-3.158V114.4a9.751,9.751,0,0,1,9.448-9.736c.093.008.2.008.289.008s.2,0,.289-.008a9.751,9.751,0,0,1,9.448,9.736Zm1.01-3.378a11.116,11.116,0,0,0-2.572-4.72,7.212,7.212,0,0,1,4.669-1.757h.1a7.253,7.253,0,0,1,7.147,6.477Z" transform="translate(0 -92.25)"/></g></g></svg>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="dashboard-footer">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-sm-12"><div class="copy-right text-center">©2020 Copyright {{env('PROJECT_NAME')}}.</div></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div><!-- end of dashboard right section -->
                    </div>



                    <a href="#" class="scroll_top" id="scroll_top" style="display: none;"><i class="icofont-long-arrow-up"></i></a>

                    <script type="text/javascript" src="{{ URL::asset('public/backend/js/jquery.min.js') }}"></script>
                    <script type="text/javascript" src="{{ URL::asset('public/backend/js/popper.min.js') }}"></script>
                    <script type="text/javascript" src="{{ URL::asset('public/backend/js/bootstrap.min.js') }}"></script>
                    <script type="text/javascript" src="{{ URL::asset('public/backend/js/bootstrap-select.js') }}"></script>
                    <script type="text/javascript" src="{{ URL::asset('public/backend/js/select2.full.min.js') }}"></script>
                    <script type="text/javascript" src="{{ URL::asset('public/backend/js/jquery.nicescroll.js') }}"></script>
                    <script type="text/javascript">
var $ = jQuery;
$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#scroll_top').show();
        } else {
            $('#scroll_top').hide();
        }
    });
    $('#scroll_top').click(function () {
        $("html, body").animate({scrollTop: 0}, 1500);
        return false;
    });
});
$("#sidebarToggle").on('click', function (e) {
    e.preventDefault();
    $("body").toggleClass("sidebar-toggled");
    $(".user-dash-right").toggleClass("slide-right-side");
    $(".user-left-side").toggleClass("toggled");
});
$("#MobilesidebarToggle").click(function () {
    $(".mobile-menu-link").toggle('2000');
});
                    </script>
                    <script>
                        $(function () {

                            // We can attach the `fileselect` event to all file inputs on the page
                            $(document).on('change', ':file', function () {
                                var input = $(this),
                                        numFiles = input.get(0).files ? input.get(0).files.length : 1,
                                        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                                input.trigger('fileselect', [numFiles, label]);
                            });

                            // We can watch for our custom `fileselect` event like this
                            $(document).ready(function () {
                                $(':file').on('fileselect', function (event, numFiles, label) {

                                    var input = $(this).parents('.input-group').find(':text'),
                                            log = numFiles > 1 ? numFiles + ' files selected' : label;

                                    if (input.length) {
                                        input.val(log);
                                    } else {
                                        if (log)
                                            alert(log);
                                    }

                                });
                            });

                        });
                    </script>
                    <script type="text/javascript">
                        $('.btn-next').click(function () {
                            $(this).closest('.screen').removeClass('active');
                            $(this).closest('.screen').next().addClass('active');
                        });
                        $('.btn-back').click(function () {
                            $(this).closest('.screen').removeClass('active');
                            $(this).closest('.screen').prev().addClass('active');
                        });
                        $('.prev').click(function () {
                            $(this).closest('.screen').removeClass('active');
                            $(this).closest('.screen').prev().addClass('active');
                        });
                        $(".js-example-basic-multiple").select2();
                        $(".js-example-placeholder-multiple").select2({
                            placeholder: "Pick services*"

                        });

                    </script>
                    <script>
                        $(document).ready(function () {
                            $(".cust-scroll-table").niceScroll({touchbehavior: false, cursorcolor: "#439DD1", cursoropacitymax: 0.7, cursorwidth: 5, background: "#fff", cursorborder: "none", cursorborderradius: "5px", autohidemode: false});
                            $(window).scroll(function () {
                                $(".cust-scroll-table").getNiceScroll().resize();
                            });
                            $(window).resize(function () {
                                $(".cust-scroll-table").getNiceScroll().resize();
                            });
                            var nicesx = $(".field-scroll").niceScroll(".field-scroll div", {touchbehavior: true, cursorcolor: "#439DD1", cursoropacitymax: 0.6, cursorwidth: 24, usetransition: true, hwacceleration: true, autohidemode: "hidden"});
                            $(window).scroll(function () {
                                $(".field-scroll").getNiceScroll().resize();
                            });
                            $(window).resize(function () {
                                $(".field-scroll").getNiceScroll().resize();
                            });
                        });
                    </script>
                    </body>
                    </html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script type="text/javascript">
            var full_path = '<?= url('/') . '/franchise/'; ?>';
        </script>
        <meta charset="UTF-8">
        <title>{{env('PROJECT_NAME', 'Ditechnical')}} :: Franchise</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/icofont.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/bootstrap-select.css') }}" />
        <link href="{{ URL::asset('public/backend/custom/datatable/dataTables.min.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/select2.min.css') }}" />
        <link href="{{ URL::asset('public/backend/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/dashboard.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/custom.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/dashboard_responsive.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/custom/notie/dist/notie.css') }}">
        <link href="{{ URL::asset('public/frontend/custom/iao-alert/iao-alert.min.css') }}" rel="stylesheet" type="text/css" />
        
        
        <script type="text/javascript" src="{{ URL::asset('public/backend/js/jquery.min.js') }}"></script>
        
        <script src="{{ URL::asset('public/frontend/custom/sweet-alert/sweetalert.min.js') }}" type="text/javascript"></script>
        <link href="{{ URL::asset('public/frontend/custom/sweet-alert/sweetalert.min.css') }}" rel="stylesheet" type="text/css" />
        <!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
        
        <link rel="shortcut icon" href="{{ URL::asset('favicon.png') }}">
        @yield('page_css')
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
        
        <div class="dashboard">
            <div class="container-fluid">
                <div class="row">
                    <!-- BEGIN HEADER -->
                    @include('franchise::partials.header')
                    <!-- END HEADER -->
                    @include('franchise::partials.left')
                    <!-- BEGIN HEADER & CONTENT DIVIDER -->
                    <div class="user-dash-right">
                        <!-- END HEADER & CONTENT DIVIDER -->

                        <!-- BEGIN QUICK SIDEBAR -->
                        @include('franchise::partials.sidebar')
                        <!-- END QUICK SIDEBAR -->

                        <div class="page-container ml-2 mr-2">
                            <!-- BEGIN SIDEBAR -->

                            <!-- END SIDEBAR -->
                            <!-- BEGIN CONTENT -->
                            <div class="page-content-wrapper">
                                <!-- BEGIN CONTENT BODY -->
                                
                                <div class="page-content">
                                    @if(Session::has('success_msg'))
                                        <input type="hidden" id="success_msg" value="{{ Session::get('success_msg') }}"/>
                                        <script>
                                            var success_msg = $('#success_msg').val();
                                            
                                            swal("",success_msg,"success",{
                                                buttons: false,
                                                timer: 3000,
                                            });
                                            
                                            
                                        </script>
                                    @endif
                                    @if(Session::has('error_msg'))
                                        <input type="hidden" id="error_msg" value="{{ Session::get('error_msg') }}"/>
                                        <script>
                                            var error_msg = $('#error_msg').val();
                                            
                                            swal("",error_msg,"error",{
                                                buttons: false,
                                                timer: 3000,
                                            });
                                            
                                        </script>
                                    @endif

                                    @yield('content')
                                </div>
                                <!-- END CONTENT BODY -->
                            </div>
                            <!-- END CONTENT -->

                        </div>
                        <!-- BEGIN FOOTER -->
                        @include('franchise::partials.footer')
                        <!-- END FOOTER -->
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="scroll_top" id="scroll_top" style="display: none;"><i class="icofont-long-arrow-up"></i></a>

        <script type="text/javascript" src="{{ URL::asset('public/backend/js/popper.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('public/backend/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('public/frontend/custom/iao-alert/iao-alert.min.js') }}" type="text/javascript"></script>
        
        
        <script type="text/javascript" src="{{ URL::asset('public/backend/js/bootstrap-select.js') }}"></script>
        <script src="{{ URL::asset('public/backend/custom/datatable/dataTables.min.js') }}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ URL::asset('public/backend/custom/notie/dist/notie.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('public/backend/js/select2.full.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('public/backend/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ URL::asset('public/backend/global/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/custom/js/franchisecommon.js') }}" type="text/javascript"></script>
        
       
        
        @yield('page_js')
    </body>
</html>
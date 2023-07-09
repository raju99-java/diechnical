<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="_token" content="{{ csrf_token() }}" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{env('PROJECT_NAME', 'Global E-Seva Kendra')}} :: Admin</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet">
        <link href="{{ URL::asset('public/backend/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
      
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ URL::asset('public/backend/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{ URL::asset('public/backend/css/login-4.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="{{ URL::asset('favicon.png') }}">
        <!--<link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('assets/FAV/favicon-32x32.png') }}">-->
        
        <script src="{{ URL::asset('public/backend/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        @yield('css')
        @yield('page_css')
        <script>
            var assets_path = '<?php echo URL::asset('/'); ?>';
            var full_path = '<?php echo Route('/'); ?>';
        </script>
    </head>
    <body class="login">
        @yield('content')
        
        <script src="{{ URL::asset('public/backend/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script><!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        
        <script src="{{ URL::asset('public/backend/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        
        @yield('js')
        @yield('page_js')

    </body>
</html>

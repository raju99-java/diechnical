@extends('admin::layouts.login')
@section('content')
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="{{Route('admin-login')}}">
        <img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="" /> 
        <!--<h2>MADRASA BOARD</h2>-->
    </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="{{ url('/admin/admin-login') }}" method="post">
        {{ csrf_field() }}
        <h3 class="form-title">Login to your account</h3>

        @if(Session::has('error_msg'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <span> {{Session('error_msg')}} </span>
        </div>
        @endif
        @if(Session::has('success_msg'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <span> {{Session('success_msg')}} </span>
        </div>
        @endif
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix {{ $errors->has('email') ? ' has-error' : '' }}" type="text" autocomplete="off" placeholder="email" name="email" value="{{ old('email') }}"/>
                @if ($errors->has('email'))
                <span class="help-block">
                    {{ $errors->first('email') }}
                </span>
                @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix {{ $errors->has('password') ? ' has-error' : '' }}" type="password" autocomplete="off" placeholder="Password" name="password" />
                @if ($errors->has('password'))
                <span class="help-block">
                    {{ $errors->first('password') }}
                </span>
                @endif
            </div>
        </div>
        <div class="form-actions text-center">
            <label class="checkbox">
                <!--<input type="checkbox" name="remember" value="1" /> Remember me </label>-->
                <button type="submit" class="btn green pull-right"> Login </button>
        </div>

    </form>
    <!-- END LOGIN FORM -->

</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright" style="color: #aaa;"> {{date('Y')}} &copy; {{env('PROJECT_NAME')}} - Admin Login. </div>

<script>
    $(document).ready(function () {
        $.backstretch([
            "{{ URL::asset('public/backend/background/1.jpg') }}",
            "{{ URL::asset('public/backend/background/2.jpg') }}",
            "{{ URL::asset('public/backend/background/3.jpg') }}",
        ], {
            fade: 1000,
            duration: 8000
        }
        );
    });
</script>

<!-- END COPYRIGHT -->
@endsection


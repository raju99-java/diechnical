@extends('franchise::layouts.login')
@section('content')
<style>
    .form-footer {
        text-align: center;
        margin-top: 18px;
    }
    .form-footer a {
        color: #32C5D2;
        font-weight: 500;
        font-size: 15px;
    }
    .form-footer p {
        color: #000 !important;
        font-weight: 300;
        margin: 0 0 0px;
    }
    .login .content .form-actions {
         padding: 0 0px 0px !important; 
    }
</style>
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="{{Route('franchise-login')}}">
        <img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="" /> 
        <!--<h2>MADRASA BOARD</h2>-->
    </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="forgot-form" action="{{ url('/franchise/forgot-password') }}" method="post">
        {{ csrf_field() }}
        <h3 class="form-title">Forgot Password</h3>

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
            <label class="control-label visible-ie8 visible-ie9">Email</label>
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
        <div class="form-actions text-center">
            <label class="checkbox">
                <!--<input type="checkbox" name="remember" value="1" /> Remember me </label>-->
                <button type="submit" class="btn green pull-right"> Submit </button>
        </div>
        <div class="form-footer">
            <p>Already have an account? <a href="{{route('franchise-login')}}">Login Here</a></p>
        </div>

    </form>
    <!-- END LOGIN FORM -->

</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright" style="color: #aaa;"> {{date('Y')}} &copy; {{env('PROJECT_NAME')}} - Franchise Login. </div>

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


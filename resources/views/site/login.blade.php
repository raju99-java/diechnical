@extends('layouts.main')
@section('css')
<style>
    .help-block{
        color:red;
    }
</style>
@stop
@section('content')




<section class="main-content">
      <section class="login-div">
          <div class="container">
              <div class="row">
                  <div class="col-sm-6 offset-sm-3">
                      <div class="login-box">
                        <div class="form-header">
                            <h4>Login</h4>
                        </div> 
                        <form class="student-log-reg-form" id="login-form" action="{{ Route('login') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                   <div class="form-group"> 
                                        <input class="form-control" type="email" name="email" placeholder="Enter Email" value="<?php
                        if (isset($_COOKIE['email']) && $_COOKIE['email'] !== NULL) {
                            echo $_COOKIE['email'];
                        }
                        ?>">
                                        <span class="help-block" id="error-email"></span>
                                   </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="password" placeholder="Enter Password" value="<?php
                        if (isset($_COOKIE['password']) && $_COOKIE['password'] !== NULL) {
                            echo $_COOKIE['password'];
                        }
                        ?>">
                                        <span class="help-block" id="error-password"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="checkbox" id="remember" name="rememberMe" value="1">
                                    <label class="remember-me-label" for="Remember Me">Remember Me</label> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-center"> 
                                        <input type="submit" value="LOGIN">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="form-footer">
                            <a href="{{route('forgot-password')}}">Forgot Your Password?</a>
                            <p>Don't have account? <a href="{{route('signup')}}">Create New Account</a></p>
                      </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
	</section>

@stop
@section('js')

@stop
@extends('layouts.main') 
@section('css')
<style>
.help-block{
    color:red;
}
</style>
@endsection
@section('content')

<!--Start Breadcrumb-->

<!--End Breadcrumb-->

<!--Start Login-->
<section class="main-content">
      <section class="login-div">
          <div class="container">
              <div class="row">
                  <div class="col-sm-6 offset-sm-3">
                      <div class="login-box">
                        <div class="form-header">
                            <h4>Forgot Password</h4>
                        </div> 
                        <form class="student-log-reg-form" id="reset-password-form" action="{{ Route('set-password') }}" method="POST">
                        @csrf
                        
                            <div class="row">
                                <div class="col-sm-12">
                                   <div class="form-group"> 
                                        <input type="password" name="password" class="form-control" placeholder="New Password*">
                                        <div class="help-block" id="error-password"></div>
                                   </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                   <div class="form-group"> 
                                        <input type="password" name="retype_password" class="form-control" placeholder="Confirm Password*">
                                        <div class="help-block" id="error-retype_password"></div>
                                   </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-center"> 
                                        <input type="submit" value="SUBMIT">
                                    </div>
                                </div>
                            </div>
                        </form>
                      </div>
                  </div>
              </div>
          </div>
      </section>
	</section>
<!--End Login-->
@stop
@section('js')


@endsection

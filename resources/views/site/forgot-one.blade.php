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
                        <form class="student-log-reg-form" id="forgot-form" action="{{ Route('forgot-password') }}" method="POST"> 
                        @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                   <div class="form-group"> 
                                        <input class="form-control" type="email" name="email" placeholder="Enter Email">
                                        <div class="help-block" id="error-email"></div>
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
                        <div class="form-footer">
                            <p>Don't have account? <a href="{{route('signup')}}">Create New Account</a></p>
                      </div>
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

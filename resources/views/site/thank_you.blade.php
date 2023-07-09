@extends('layouts.main')
@section('css')
<style>
    /*********thank you page**********/
.thanks-page {
    text-align: center;
    padding-top: 3rem;
    padding-bottom: 3rem;
}

.thanks-page h1 {
    color: #131212;
    font-family: 'Poppins', sans-serif;
    font-size: 35px;
    font-weight: 600;
    letter-spacing: 1px;
    margin: 0px;
    text-align: center;
}

.thanks-page p {
    color: #2b2a29;
    font-family: 'Dancing Script', cursive;
    font-size: 20px;
    font-weight: 200;
    letter-spacing: 1px;
    margin: 4px;
    padding-top: 10px;
    padding-bottom: 25px;
    text-align: center;
}


.thanks-page a {
    padding: 10px;
    color: #000;
    background-color: transparent;
    border: 2px solid #C1282A;
    border-radius: 50px;
    font-family: 'Poppins', sans-serif;
    font-size: 15px;
    font-weight: normal;
    text-align: center;
}

.thanks-page a:hover{
    background: #C1282A;
    color: #fff;
    border: none !important;
}

.thanks-page {
    box-shadow: -2px -1px 12px -4px rgba(0,0,0,0.75);
    margin-top: 5rem;
    margin-bottom: 5rem;
    border: 2px dotted #C1282A;
    background: #fff;
}

.thank-u-body{
background: #f5f5f5;
}
</style>
@stop
@section('content')
<!--Start Breadcrumb-->
<section class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="breadcrumb-title-div">
                        <div class="bread-left-side">
                            <h2>Thank you</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<!--End Breadcrumb-->
<section class="thank-u-body">
        <div class="container">
          <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 thanks-bg">
              <div class="thanks-page">
               <h1>THANK YOU!</h1>
               <p>For Showing Interest in Doctorate Program.</p>
                 <a href="/">HOME PAGE <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
               </div>
            </div>
            <div class="col-sm-3"></div>
          </div>
      </div>  
    </section>
@stop
@section('js')

@stop
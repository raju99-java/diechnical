@extends('layouts.main')
@section('css')

@stop
@section('content')
<!-- START MAIN CONTENT -->
<div id="pagetitle" class="page-title bg-image ">
	<div class="container">
		<div class="page-title-inner">
			<div class="page-title-holder">
				<h1 class="page-title">Exam Guide</h1> 
			</div>
			<ul class="ct-breadcrumb">
				<li><a class="breadcrumb-entry" href="https://whrpc.org/">
				    Home</a>
				</li>
				<li><span class="breadcrumb-entry">Exam Guide</span></li>
			</ul>
		</div>
	</div>
</div>

<div class="dashboard">
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-sm-3 tab_dsh_1">
              <!--<h2 class="abc">DASHBOARD</h2>-->
				@include('partials.left')
			</div>
			<div class="col-md-10 col-sm-9 tab_dsh_2">
				<div class="dash-right-sec">
					<h2 class="dash-title">Book</h2>
					<div class="successfull">
						<div class="col-sm-12">
						   <div class="message">
						      <h1 Class="demo">Exam Guide</h1> 
						   </div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END MAIN CONTENT -->
@stop
@section('js')
<script>
function newWindow(){
    var params = 'width=' + screen.width + ', height=' + screen.height
            + ', top=0, left=0'
            + ',toolbar=no,scrollbars=no,status=no,menubar=no';
window.open("{{route('user_details')}}",'aboutus',params);	
}
</script>
@stop
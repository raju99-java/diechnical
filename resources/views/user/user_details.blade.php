@extends('layouts.main')
@section('page_css')

@stop
@section('content')
<!-- START MAIN CONTENT -->
<div id="pagetitle" class="page-title bg-image ">
	<div class="container">
		<div class="page-title-inner">
			<div class="page-title-holder">
				<h1 class="page-title">User Details</h1> 
			</div>
			<ul class="ct-breadcrumb">
				<li><a class="breadcrumb-entry" href="https://whrpc.org/">
				    Home</a>
				</li>
				<li><span class="breadcrumb-entry">User Details</span></li>
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
                    <h2 class="dash-title">User Details</h2>
                    <!--<div class="prof-img" style="text-align: center;padding-bottom: 13px;">-->
                    <!--    <img id="blah" src="{{($model->photo!='')? URL::asset('public/uploads/user').'/'.$model->photo:URL::asset('public/frontend/images/default-pic.jpeg') }}" alt="your image" height="70" width="70" />-->
                    <!--</div>-->
                    <div class="bg-abc-apply">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="usr" class="user-label-apply">Applied For:</label>
                                    <p class="user-details">{{$model->applying_for}}</p>
                                </div>
                            </div> 
                        </div>
                    </div>    
                    
                    <div class="bg-abc">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">First Name</label>
                                    <p class="user-details">{{$model->first_name}}</p>
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">Last Name</label>
                                    <p class="user-details">{{$model->last_name}}</p> 
                                </div>
                            </div> 
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">S/O</label>
                                    <p class="user-details">{{$model->son_of}}</p>
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">D.O.B.</label>
                                    <p class="user-details">{{$model->d_o_b}}</p> 
                                </div>
                            </div> 
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">Pancard Number</label>
                                    <p class="user-details">{{$model->pan_card}}</p>
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">Aadhar Card Number</label>
                                    <p class="user-details">{{$model->aadhar_card}}</p> 
                                </div>
                            </div> 
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">Mobile Number(County Code)</label>
                                    <p class="user-details">{{$model->mobile_number_country_code}}</p>
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">Mobile Number</label>
                                    <p class="user-details">{{$model->mobile_number}}</p> 
                                </div>
                            </div> 
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">Whatsapp Number</label>
                                    <p class="user-details">{{$model->whatsapp_number}}</p>
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">Email</label>
                                    <p class="user-details">{{$model->email}}</p> 
                                </div>
                            </div> 
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">House No.</label>
                                    <p class="user-details">{{$model->house_no}}</p>
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">Street No.</label>
                                    <p class="user-details">{{$model->street_no}}</p> 
                                </div>
                            </div> 
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">City</label>
                                    <p class="user-details">{{$model->city}}</p>
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">Country</label>
                                    <p class="user-details">{{$model->country}}</p> 
                                </div>
                            </div> 
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">State</label>
                                    <p class="user-details">{{$model->state}}</p>
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">Police Station</label>
                                    <p class="user-details">{{$model->police_station}}</p> 
                                </div>
                            </div> 
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">Job Title</label>
                                    <p class="user-details">{{$model->job_title}}</p>
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">Occupation</label>
                                    <p class="user-details">{{$model->occupation}}</p> 
                                </div>
                            </div> 
                        </div>
                        <!--<div class="row">-->
                        <!--    <div class="col-sm-6">-->
                        <!--        <div class="form-group">-->
                        <!--            <label for="usr" class="user-label">Registration Number</label>-->
                        <!--            <p class="user-details">{{$model->registration_number}}</p>-->
                        <!--        </div>-->
                        <!--    </div> -->
                        <!--    <div class="col-sm-6">-->
                        <!--        <div class="form-group">-->
                        <!--            <label for="usr" class="user-label">Serial Number</label>-->
                        <!--            <p class="user-details">{{$model->serial_number}}</p> -->
                        <!--        </div>-->
                        <!--    </div> -->
                        <!--</div>-->
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">Photo</label><br>
                                    <img id="blah" src="{{($model->photo!='')? URL::asset('public/uploads/user').'/'.$model->photo:URL::asset('public/frontend/images/default-pic.jpeg') }}" alt="your image" style="height: 70px; width: 70px;"/> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" class="user-label">Signature</label><br>
                                    <img id="blah" src="{{($model->signature!='')? URL::asset('public/uploads/user').'/'.$model->signature:URL::asset('public/frontend/images/default-pic.jpeg') }}" alt="your image" style="height: 70px; width: 70px;"/>
                                </div>
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
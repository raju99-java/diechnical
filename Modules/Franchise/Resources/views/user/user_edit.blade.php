@extends('admin::layouts.main')
@section('page_css')

@stop
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('users')}}">User</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Update</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Update User of {{$user->first_name}}</span>
                </div>
            </div>
            
        </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('user-edit',['id'=>$id])}}" class="form-horizontal" enctype="multipart/form-data">
                    @method('PUT')
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="form-body">
                        
                        <div class="form-group">
                            <label class="control-label col-md-12 ">First Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->first_name) && $user->first_name !== NULL) ? $user->first_name : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Last Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->last_name) && $user->last_name !== NULL) ? $user->last_name : "Not Given" }} </p>
                            </div>
                        </div>    
                        <div class="form-group">
                            <label class="control-label col-md-12 ">S/O:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->son_of) && $user->son_of !== NULL) ? $user->son_of : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">DOB:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->d_o_b) && $user->d_o_b !== NULL) ? $user->d_o_b : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Pancard:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->pan_card) && $user->pan_card !== NULL) ? $user->pan_card : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Aadhar Card:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->aadhar_card) && $user->aadhar_card !== NULL) ? $user->aadhar_card : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Mobile Country Code:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->mobile_number_country_code) && $user->mobile_number_country_code !== NULL) ? $user->mobile_number_country_code : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Mobile Number:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->mobile_number) && $user->mobile_number !== NULL) ? $user->mobile_number : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Whatsapp Number:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->whatsapp_number) && $user->whatsapp_number !== NULL) ? $user->whatsapp_number : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Email:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->email) && $user->email !== NULL) ? $user->email : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">House No:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->house_no) && $user->house_no !== NULL) ? $user->house_no : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Street No:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->street_no) && $user->street_no !== NULL) ? $user->street_no : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">City:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->city) && $user->city !== NULL) ? $user->city : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Country:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->country) && $user->country !== NULL) ? $user->country : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">State:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->state) && $user->state !== NULL) ? $user->state : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Police Station:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->police_station) && $user->police_station !== NULL) ? $user->police_station : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Job Title:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->job_title) && $user->job_title !== NULL) ? $user->job_title : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Occupation:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->occupation) && $user->occupation !== NULL) ? $user->occupation : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Registartion Number:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->registration_number) && $user->registration_number !== NULL) ? $user->registration_number : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Serial Number:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->serial_number) && $user->serial_number !== NULL) ? $user->serial_number : "Not Given" }} </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Photo:</label>
                            <div class="col-md-9">
                                <img class="img-responsive" src="{{ URL::asset('public/uploads/user/'. $user->photo) }}" alt="{{ $user->photo }}" width="200" height="200">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Signature:</label>
                            <div class="col-md-9">
                               <img class="img-responsive" src="{{ URL::asset('public/uploads/user/'. $user->signature) }}" alt="{{ $user->signature }}" width="200" height="200">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 ">Applied For:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($user->applying_for) && $user->applying_for !== NULL) ? $user->applying_for : "Not Given" }} </p>
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1"  {{ ($user->status == '1') ? 'checked' : '' }} > Active 
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0" {{ ($user->status == '0') ? 'checked' : '' }} > Inactive 
                                    </label>
                                    @if ($errors->has('status'))
                                    <div class="help-block">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                      	
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{Route('users')}}" class="btn btn-primary">Cancel</a>
                                
                                <button type="submit" class="btn green"> Submit</button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('page_js')
<script src="{{ URL::asset('public/frontend/js/state.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/frontend/js/jquery.js') }}" type="text/javascript"></script>

<script>
          var currentTab = 0; // Current tab is set to be the first tab (0)
          showTab(currentTab); // Display the current tab

          function showTab(n) {
              // This function will display the specified tab of the form...
              var x = document.getElementsByClassName("tab");
              x[n].style.display = "block";
              //... and fix the Previous/Next buttons:
              if (n == 0) {
                  document.getElementById("prevBtn").style.display = "none";
              } else {
                  document.getElementById("prevBtn").style.display = "inline";
              }

              if (n == (x.length - 1)) {
                  document.getElementById("nextBtn").innerHTML = "Next";
              } else {
                  document.getElementById("nextBtn").innerHTML = "Next";
              }
              if (n == 4) {
                  document.getElementById("nextBtn").style.display = "none";
              } else {
                  document.getElementById("nextBtn").style.display = "inline";
              }
              //... and run a function that will display the correct step indicator:
              fixStepIndicator(n)
          }

          function nextPrev(n) {
              // This function will figure out which tab to display
              var x = document.getElementsByClassName("tab");
              // Exit the function if any field in the current tab is invalid:

              // Hide the current tab:
              x[currentTab].style.display = "none";
              // Increase or decrease the current tab by 1:
              currentTab = currentTab + n;
              // if you have reached the end of the form...
              if (currentTab >= x.length) {


              }
              // Otherwise, display the correct tab:
              showTab(currentTab);
          }



          function fixStepIndicator(n) {
              // This function removes the "active" class of all steps...
              var i, x = document.getElementsByClassName("step");
              for (i = 0; i < x.length; i++) {
                  x[i].className = x[i].className.replace(" active", "");
              }
              //... and adds the "active" class on the current step:
              x[n].className += " active";
          }
</script>
@stop
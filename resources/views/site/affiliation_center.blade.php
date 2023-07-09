@extends('layouts.main')
@section('css')
<style>

</style>
@stop
@section('content')
<!--------------------breadcrumb ---------------------->
<!--------------------breadcrumb ---------------------->
<section class="breadcrumb about-us-b">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-title-div">
                    <div class="bread-left-side">
                        <h2>Affiliation Center</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="/">HOME</a>/</li>
                            <li><span>Affiliation Center</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------- //breadcrumb ------------------->
<!--------------------------------Main content Start--------------------------->
<section class="main">
    
    <script src="{{ URL::asset('public/frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <section class="exam-div">
        <div class="container">
            <div class="row">
                
                <div class="col-sm-7 mb-3">
                    <div class="result-download">
                        <h2>AFFILIATION CENTER</h>
                            <h3>Search by State</h3>
                    </div>
                    
                    <!-- id="search_center" -->
                    <form class=""  action="{{route('affiliation-center')}}" method="POST">
                        
                        @csrf
                        
                        <div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}">
                            <select name="state" class="form-control">
                                <option value="" class="option selected focus">Select State</option>
                                
                                <option value="all" class="option" {{ (old('state')!="") ? ('all'==old('state'))?'selected':'' : ''}}>All</option>
                                <option value="Andhra Pradesh" class="option" {{ (old('state')!="") ? ('Andhra Pradesh'==old('state'))?'selected':'' : ''}}>Andhra Pradesh</option>
                                <option value="Andaman and Nicobar Islands" class="option" {{ (old('state')!="") ? ('Andaman and Nicobar Islands'==old('state'))?'selected':'' : ''}}>Andaman and Nicobar Islands</option>
                                <option value="Arunachal Pradesh" class="option" {{ (old('state')!="") ? ('Arunachal Pradesh'==old('state'))?'selected':'' : ''}}>Arunachal Pradesh</option>
                                <option value="Assam" class="option" {{ (old('state')!="") ? ('Assam'==old('state'))?'selected':'' : ''}}>Assam</option>
                                <option value="Bihar" class="option" {{ (old('state')!="") ? ('Bihar'==old('state'))?'selected':'' : ''}}>Bihar</option>
                                <option value="Chandigarh" class="option" {{ (old('state')!="") ? ('Chandigarh'==old('state'))?'selected':'' : ''}}>Chandigarh</option>
                                <option value="Chhattisgarh" class="option" {{ (old('state')!="") ? ('Chhattisgarh'==old('state'))?'selected':'' : ''}}>Chhattisgarh</option>
                                <option value="Dadar and Nagar Haveli" class="option" {{ (old('state')!="") ? ('Dadar and Nagar Haveli'==old('state'))?'selected':'' : ''}}>Dadar and Nagar Haveli</option>
                                <option value="Daman and Diu" class="option" {{ (old('state')!="") ? ('Daman and Diu'==old('state'))?'selected':'' : ''}}>Daman and Diu</option>
                                <option value="Delhi" class="option" {{ (old('state')!="") ? ('Delhi'==old('state'))?'selected':'' : ''}}>Delhi</option>
                                <option value="Lakshadweep" class="option" {{ (old('state')!="") ? ('Lakshadweep'==old('state'))?'selected':'' : ''}}>Lakshadweep</option>
                                <option value="Puducherry" class="option" {{ (old('state')!="") ? ('Puducherry'==old('state'))?'selected':'' : ''}}>Puducherry</option>
                                <option value="Goa" class="option" {{ (old('state')!="") ? ('Goa'==old('state'))?'selected':'' : ''}}>Goa</option>
                                <option value="Gujarat" class="option" {{ (old('state')!="") ? ('Gujarat'==old('state'))?'selected':'' : ''}}>Gujarat</option>
                                <option value="Haryana" class="option" {{ (old('state')!="") ? ('Haryana'==old('state'))?'selected':'' : ''}}>Haryana</option>
                                <option value="Himachal Pradesh" class="option" {{ (old('state')!="") ? ('Himachal Pradesh'==old('state'))?'selected':'' : ''}}>Himachal Pradesh</option>
                                <option value="Jammu and Kashmir" class="option" {{ (old('state')!="") ? ('Jammu and Kashmir'==old('state'))?'selected':'' : ''}}>Jammu and Kashmir</option>
                                <option value="Jharkhand" class="option" {{ (old('state')!="") ? ('Jharkhand'==old('state'))?'selected':'' : ''}}>Jharkhand</option>
                                <option value="Karnataka" class="option" {{ (old('state')!="") ? ('Karnataka'==old('state'))?'selected':'' : ''}}>Karnataka</option>
                                <option value="Kerala" class="option" {{ (old('state')!="") ? ('Kerala'==old('state'))?'selected':'' : ''}}>Kerala</option>
                                <option value="Madhya Pradesh" class="option" {{ (old('state')!="") ? ('Madhya Pradesh'==old('state'))?'selected':'' : ''}}>Madhya Pradesh</option>
                                <option value="Maharashtra" class="option" {{ (old('state')!="") ? ('Maharashtra'==old('state'))?'selected':'' : ''}}>Maharashtra</option>
                                <option value="Manipur" class="option" {{ (old('state')!="") ? ('Manipur'==old('state'))?'selected':'' : ''}}>Manipur</option>
                                <option value="Meghalaya" class="option" {{ (old('state')!="") ? ('Meghalaya'==old('state'))?'selected':'' : ''}}>Meghalaya</option>
                                <option value="Mizoram" class="option" {{ (old('state')!="") ? ('Mizoram'==old('state'))?'selected':'' : ''}}>Mizoram</option>
                                <option value="Nagaland" class="option" {{ (old('state')!="") ? ('Nagaland'==old('state'))?'selected':'' : ''}}>Nagaland</option>
                                <option value="Odisha" class="option" {{ (old('state')!="") ? ('Odisha'==old('state'))?'selected':'' : ''}}>Odisha</option>
                                <option value="Punjab" class="option" {{ (old('state')!="") ? ('Punjab'==old('state'))?'selected':'' : ''}}>Punjab</option>
                                <option value="Rajasthan" class="option" {{ (old('state')!="") ? ('Rajasthan'==old('state'))?'selected':'' : ''}}>Rajasthan</option>
                                <option value="Sikkim" class="option" {{ (old('state')!="") ? ('Sikkim'==old('state'))?'selected':'' : ''}}>Sikkim</option>
                                <option value="Tamil Nadu" class="option" {{ (old('state')!="") ? ('Tamil Nadu'==old('state'))?'selected':'' : ''}}>Tamil Nadu</option>
                                <option value="Telangana" class="option" {{ (old('state')!="") ? ('Telangana'==old('state'))?'selected':'' : ''}}>Telangana</option>
                                <option value="Tripura" class="option" {{ (old('state')!="") ? ('Tripura'==old('state'))?'selected':'' : ''}}>Tripura</option>
                                <option value="Uttar Pradesh" class="option" {{ (old('state')!="") ? ('Uttar Pradesh'==old('state'))?'selected':'' : ''}}>Uttar Pradesh</option>
                                <option value="Uttarakhand" class="option" {{ (old('state')!="") ? ('Uttarakhand'==old('state'))?'selected':'' : ''}}>Uttarakhand</option>
                                <option value="West Bengal" class="option" {{ (old('state')!="") ? ('West Bengal'==old('state'))?'selected':'' : ''}}>West Bengal</option>
                            </select>
                            
                            <span class="help-block" id="error-state"></span>
                            @if ($errors->has('state'))
                               <span class="help-block"> {{ $errors->first('state') }} </span>
                            @endif
                        </div>
                        
                        <input type="submit" name="submit" class="btn btn-success" value="Search">
                        
                    </form>
                    
                    
                    
                </div>
                
                @if(isset($status))
                
                    @if($status == '1')
                        
                        @foreach($franchises as $franchise)
                            <div id="here_table" class="col-sm-7" >
                
                                <div style="overflow: auto;">
                                    <table  class="table table-striped table-bordered" style="text-transform: uppercase;">
                                        <tbody>  
            
                                            <tr>
                                                <td><b>Director Image:</b></td>
                                                <td class="image"><img height="90" width="115" src="{{URL::asset('public/uploads/user/'.$franchise->owner_image)}}" /></td>
                                            </tr>
                                            
                                            <tr>
                                                <td><b>Center Name:</b></td>
                                                <td class="name">{{strtoupper($franchise->name)}}</td>
                                            </tr>
                                            
                                            <tr>
                                                <td><b>Director Name:</b></td>
                                                <td class="name">{{strtoupper($franchise->owner_name)}}</td>
                                            </tr>
                                            
                                            <tr>
                                                <td><b>Students Enrolled:</b></td>
                                                <td class="name">{{strtoupper($franchise->total_student)}}</td>
                                            </tr>
                                            
                                            <tr>
                                                <td><b>Students Passout:</b></td>
                                                <td class="name">{{strtoupper($franchise->pass_student)}}</td>
                                            </tr>
                                            
                                            <tr>
                                                <td><b>Center Address:</b></td>
                                                <td class="city">{{strtoupper($franchise->address)}} </td>
                                            </tr>
            
                                            <tr>
                                                <td><b>Center City:</b></td>
                                                <td class="code">{{strtoupper($franchise->city)}}</td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                <td><b>Center District:</b></td>
                                                <td class="district"> {{strtoupper($franchise->district)}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Center State:</b></td>
                                                <td class="state">{{strtoupper($franchise->state)}}</td>
                                            </tr>
                                            
            
                                        </tbody>  
                                    </table>
                                </div>
                            </div>
                        @endforeach
                        
                            @if($status == '1')
                                <input type="hidden" id="success_msg" value="{{$success}}"/>
                                
                                <script>
                                    var success_msg = $('#success_msg').val();
                                    swal({
                                     icon: "success",
                                     text: success_msg,
                                     timer: 5000,
                                     button:false
                                   });
                                </script>
                            @endif
                        
                    @else
                    
                            @if($status == '0')
                                <input type="hidden" id="error_msg" value="{{$error}}"/>
                                
                                <script>
                                    var error_msg = $('#error_msg').val();
                                    swal({
                                      icon: "error",
                                      text: error_msg,
                                      timer: 5000,
                                      button:false
                                    });
                                </script>
                            @endif 
                
                    @endif
                
                @endif
                
                <div class="col-sm-5">
                    <div class="side-bar-page">
                        <div class="enqir-sec">
                            <h3 class="quick-title-sec">Quick Enquiry</h3>
                            <form class="quick-enquiry-form" id="enquiry-form" action="{{route('post-enquiry')}}" method="POST">
                                @csrf
                                <div class="form-group q-grp">
                                    <label class="quick-label">Services*</label>
                                    <select id="services" class="form-control" name="services">
                						<option value="">Select Services</option>
                						<option value="New Franchise">New Franchise</option>
                						<option value="Admission">Admission</option>
                						<option value="Student">Student</option>
                						<option value="ALC">ALC</option>
                						<option value="Other">Other</option>
                					</select>
                                    <span class="help-block" id="error-services"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Full Name*</label>
                                    <input type="text" name="name" class="form-control quick-input" placeholder="Enter Your Full Name.." > 
                                    <span class="help-block" id="error-name"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Contact No*</label>
                                    <input type="tel" name="phone" class="form-control quick-input" placeholder="Enter Your Contact No.." >	
                                    <span class="help-block" id="error-phone"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Email Id*</label>
                                    <input type="email" name="email" class="form-control quick-input" placeholder="Enter Your Email Id..">	
                                    <span class="help-block" id="error-email"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Address*</label>
                                    <textarea name="address" cols="20" rows="2" class="form-control quick-textaeea" placeholder="Address"></textarea>	
                                    <span class="help-block" id="error-address"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Message*</label>
                                    <textarea name="message" cols="20" rows="2" class="form-control quick-textaeea" placeholder="Message"></textarea>	
                                    <span class="help-block" id="error-message"></span>
                                </div>
                                <button type="submit" class="quick-submit">Submit</button>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>  
        </div>
    </section>
</section>
<!----------------------------------Main content End--------------------------->

@stop
@section('js')

@stop
@extends('layouts.main')
@section('css')
<style>
    .help-block{
        color:red;
    }
    .p-tag-field {
    color: #000 !important;
    border-bottom: 1px solid #CCCCCC;
    padding-bottom: 21px;
    line-height: 28px !important;
    }
    .abc-links-in {
    margin-top: 20px;
    }
</style>
@endsection
@section('content')

<!--------------------breadcrumb ---------------------->
<section class="breadcrumb about-us-b">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-title-div">
                    <div class="bread-left-side">
                        <h2>MY PROFILE</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="{{route('/')}}">HOME</a>/</li>
                            <li><span>MY PROFILE</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------- //breadcrumb ------------------->

<!--------------------------------Main content Start--------------------------->
<section class="main-content">
    <section class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('partials.left')
                <div class="col-md-9 col-sm-9 tab_dsh_2">
                    <div class="dash-right-sec">
                        <div class="successfull">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="user-profile-details">
                                            <div class="account-info">
                                                <div class="header-area">
                                                    <h4 class="title">MY PROFILE</h4>
                                                </div>
                                                <div class="edit-info-area">
                                                    <div class="body">
                                                        <div class="edit-info-area">
                                                            <div class="body">
                                                                <div class="edit-info-area-form">
                                                                    <form method="post" class="form" action="{{route('post-myprofile')}}" id="customer-editprofile-form" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="upload-images">
                                                                                    <img id="blah" src="{{($model->image!='')? URL::asset('public/uploads/user').'/'.$model->image:URL::asset('public/frontend/images/profile.jpg') }}" alt="profile">
                                                                                </div>  
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <p class="p-tag-field text-center mb-4"><b>Registration No:</b> {{isset($model->registration_id)?$model->registration_id:''}}</p>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        <div class="row">
                                                                            <!--<div class="col-lg-6">-->
                                                                            <!--    <input name="full_name" type="text" class="input-field" placeholder="Full Name"  value="{{isset($model->full_name)?$model->full_name:''}}" readonly>-->
                                                                            <!--    <span class="help-block" id="err-full_name"></span>-->
                                                                            <!--</div>-->
                                                                            <div class="col-lg-6">
                                                                                <p class="p-tag-field">{{isset($model->full_name)?$model->full_name:''}}</p>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <input class="input-field" name="image" type="file" onchange="readURL(this);" accept="image/png, image/jpeg, image/jpg">
                                                                                <span class="help-block" id="err-image"></span> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <p class="p-tag-field">{{isset($model->father_name)?$model->father_name:''}}</p>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <p class="p-tag-field">{{isset($model->mother_name)?$model->mother_name:''}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <input type="text" class="input-field" placeholder="Gurdian Name" name="gurdian_name" value="{{isset($model->gurdian_name)?$model->gurdian_name:''}}"/>
                                                                                <span class="help-block" id="err-gurdian_name"></span>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <input type="date" class="input-field" placeholder="DOB" name="dob" value="{{isset($model->dob)?$model->dob:''}}"/>
                                                                                <span class="help-block" id="err-dob"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <select name="gender" class="input-field">
                                                                                    
                                                                                    <option value="" class="option selected focus">Select Gender</option>
                                                                                    <option value="Male" class="option" {{ (old('gender')!="") ? ('Male'==old('gender'))?'selected':'' : strcasecmp("Male","$model->gender")?'':'selected'}}>Male</option>
                                                                                    <option value="Female" class="option" {{ (old('gender')!="") ? ('Female'==old('gender'))?'selected':'' : strcasecmp("Female","$model->gender")?'':'selected'}}>Female</option>
                                                                                    <option value="Others" class="option" {{ (old('gender')!="") ? ('Others'==old('gender'))?'selected':'' : strcasecmp("Others","$model->gender")?'':'selected'}}>Others</option>
                                                                                </select>
                                                                                <span class="help-block" id="err-gender"></span>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <select name="category" class="input-field">
                                                                                    <option value="" class="option selected focus">Select Category</option>
                                                                                    
                                                                                    <option value="General" class="option" {{ (old('category')!="") ? ('General'==old('category'))?'selected':'' : strcasecmp("General","$model->category")?'':'selected'}}>General</option>
                                                                                    <option value="SC" class="option" {{ (old('category')!="") ? ('SC'==old('category'))?'selected':'' : strcasecmp("SC","$model->category")?'':'selected'}}>SC</option>
                                                                                    <option value="ST" class="option" {{ (old('category')!="") ? ('ST'==old('category'))?'selected':'' : strcasecmp("ST","$model->category")?'':'selected'}}>ST</option>
                                                                                    <option value="OBC" class="option" {{ (old('category')!="") ? ('OBC'==old('category'))?'selected':'' : strcasecmp("OBC","$model->category")?'':'selected'}}>OBC</option>
                                                                                </select>
                                                                                <span class="help-block" id="err-category"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <input name="email" type="email" class="input-field" placeholder="Email Id" value="{{$model->email}}">
                                                                                <span class="help-block" id="err-email"></span>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <input name="phone" type="tel" class="input-field" placeholder="Phone Number" value="{{$model->phone}}">
                                                                                <span class="help-block" id="err-phone"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <textarea class="input-field" placeholder="Address" name="address" id="address" cols="1">{{ (old('address')!="") ? old('address') : $model->address }}</textarea>
                                                                                <span class="help-block" id="err-address"></span>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <input type="text" class="input-field" placeholder="Last Qualification (10th/12th/B.A/B.SC/B.COM/M.A/M.SC/M.COM etc..)" name="last_qualification" value="{{ (old('last_qualification')!="") ? old('last_qualification') : $model->last_qualification }}"/>
                                                                                <span class="help-block" id="err-last_qualification"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <input type="text" class="input-field" placeholder="Specialization/Stream (Science/Arts/Commerce/Computer Science Engineering/Mechanical/Civil etc..)" name="specialization" value="{{ (old('specialization')!="") ? old('specialization') : $model->specialization }}"/>
                                                                                <span class="help-block" id="err-specialization"></span>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <input type="number" class="input-field" placeholder="Year of Passing" name="year_of_passing" value="{{ (old('year_of_passing')!="") ? old('year_of_passing') : $model->year_of_passing }}"/>
                                                                                <span class="help-block" id="err-year_of_passing"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <input type="text" class="input-field" placeholder="School/college Name" name="school_college_name" value="{{ (old('school_college_name')!="") ? old('school_college_name') : $model->school_college_name }}"/>
                                                                                <span class="help-block" id="err-school_college_name"></span>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <input type="text" class="input-field" placeholder="Percentage of Marks" name="marks" value="{{ (old('marks')!="") ? old('marks') : $model->marks }}"/>
                                                                                <span class="help-block" id="err-marks"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <label class="my-label">Upload Govt.Id Proof (Exam: Aadhar Card/Voter Card/Pan Card)</label>
                                                                                <input class="input-field" name="id_proof" type="file"  accept="image/png, image/jpeg, image/jpg">
                                                                                <span class="help-block" id="err-id_proof"></span>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <!--<input type="text" class="input-field" placeholder="State" name="state" value="West Bengal"/>-->
                                                                                <label></label>
                                                                                <select name="state" class="input-field">
                                                                                    <option value="" class="option selected focus">Select Your State</option>
                                                                                    
                                                                                    <option value="Andhra Pradesh" class="option" {{ strcasecmp("Andhra Pradesh","$model->state")?'':'selected'}}>Andhra Pradesh</option>
                                                                                    <option value="Andaman and Nicobar Islands" class="option" {{ strcasecmp("Andaman and Nicobar Islands","$model->state")?'':'selected'}}>Andaman and Nicobar Islands</option>
                                                                                    <option value="Arunachal Pradesh" class="option" {{ strcasecmp("Arunachal Pradesh","$model->state")?'':'selected'}}>Arunachal Pradesh</option>
                                                                                    <option value="Assam" class="option" {{ strcasecmp("Assam","$model->state")?'':'selected'}}>Assam</option>
                                                                                    <option value="Bihar" class="option" {{ strcasecmp("Bihar","$model->state")?'':'selected'}}>Bihar</option>
                                                                                    <option value="Chandigarh" class="option" {{ strcasecmp("Chandigarh","$model->state")?'':'selected'}}>Chandigarh</option>
                                                                                    <option value="Chhattisgarh" class="option" {{ strcasecmp("Chhattisgarh","$model->state")?'':'selected'}}>Chhattisgarh</option>
                                                                                    <option value="Dadar and Nagar Haveli" class="option" {{ strcasecmp("Dadar and Nagar Haveli","$model->state")?'':'selected'}}>Dadar and Nagar Haveli</option>
                                                                                    <option value="Daman and Diu" class="option" {{ strcasecmp("Daman and Diu","$model->state")?'':'selected'}}>Daman and Diu</option>
                                                                                    <option value="Delhi" class="option" {{ strcasecmp("Delhi","$model->state")?'':'selected'}}>Delhi</option>
                                                                                    <option value="Lakshadweep" class="option" {{ strcasecmp("Lakshadweep","$model->state")?'':'selected'}}>Lakshadweep</option>
                                                                                    <option value="Puducherry" class="option" {{ strcasecmp("Puducherry","$model->state")?'':'selected'}}>Puducherry</option>
                                                                                    <option value="Goa" class="option" {{ strcasecmp("Goa","$model->state")?'':'selected'}}>Goa</option>
                                                                                    <option value="Gujarat" class="option" {{ strcasecmp("Gujarat","$model->state")?'':'selected'}}>Gujarat</option>
                                                                                    <option value="Haryana" class="option" {{ strcasecmp("Haryana","$model->state")?'':'selected'}}>Haryana</option>
                                                                                    <option value="Himachal Pradesh" class="option" {{ strcasecmp("Himachal Pradesh","$model->state")?'':'selected'}}>Himachal Pradesh</option>
                                                                                    <option value="Jammu and Kashmir" class="option" {{ strcasecmp("Jammu and Kashmir","$model->state")?'':'selected'}}>Jammu and Kashmir</option>
                                                                                    <option value="Jharkhand" class="option" {{ strcasecmp("Jharkhand","$model->state")?'':'selected'}}>Jharkhand</option>
                                                                                    <option value="Karnataka" class="option" {{ strcasecmp("Karnataka","$model->state")?'':'selected'}}>Karnataka</option>
                                                                                    <option value="Kerala" class="option" {{ strcasecmp("Kerala","$model->state")?'':'selected'}}>Kerala</option>
                                                                                    <option value="Madhya Pradesh" class="option" {{ strcasecmp("Madhya Pradesh","$model->state")?'':'selected'}}>Madhya Pradesh</option>
                                                                                    <option value="Maharashtra" class="option" {{ strcasecmp("Maharashtra","$model->state")?'':'selected'}}>Maharashtra</option>
                                                                                    <option value="Manipur" class="option" {{ strcasecmp("Manipur","$model->state")?'':'selected'}}>Manipur</option>
                                                                                    <option value="Meghalaya" class="option" {{ strcasecmp("Meghalaya","$model->state")?'':'selected'}}>Meghalaya</option>
                                                                                    <option value="Mizoram" class="option" {{ strcasecmp("Mizoram","$model->state")?'':'selected'}}>Mizoram</option>
                                                                                    <option value="Nagaland" class="option" {{ strcasecmp("Nagaland","$model->state")?'':'selected'}}>Nagaland</option>
                                                                                    <option value="Odisha" class="option" {{ strcasecmp("Odisha","$model->state")?'':'selected'}}>Odisha</option>
                                                                                    <option value="Punjab" class="option" {{ strcasecmp("Punjab","$model->state")?'':'selected'}}>Punjab</option>
                                                                                    <option value="Rajasthan" class="option" {{ strcasecmp("Rajasthan","$model->state")?'':'selected'}}>Rajasthan</option>
                                                                                    <option value="Sikkim" class="option" {{ strcasecmp("Sikkim","$model->state")?'':'selected'}}>Sikkim</option>
                                                                                    <option value="Tamil Nadu" class="option" {{ strcasecmp("Tamil Nadu","$model->state")?'':'selected'}}>Tamil Nadu</option>
                                                                                    <option value="Telangana" class="option" {{ strcasecmp("Telangana","$model->state")?'':'selected'}}>Telangana</option>
                                                                                    <option value="Tripura" class="option" {{ strcasecmp("Tripura","$model->state")?'':'selected'}}>Tripura</option>
                                                                                    <option value="Uttar Pradesh" class="option" {{ strcasecmp("Uttar Pradesh","$model->state")?'':'selected'}}>Uttar Pradesh</option>
                                                                                    <option value="Uttarakhand" class="option" {{ strcasecmp("Uttarakhand","$model->state")?'':'selected'}}>Uttarakhand</option>
                                                                                    <option value="West Bengal" class="option" {{ strcasecmp("West Bengal","$model->state")?'':'selected'}}>West Bengal</option>
                                                                                </select>
                                                                                <span class="help-block" id="err-state"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <input type="text" class="input-field" placeholder="District" name="district" value="{{ (old('district')!="") ? old('district') : $model->district }}"/>
                                                                                <span class="help-block" id="err-district"></span>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        

                                                                        <div class="form-links abc-links-in">
                                                                            <button class="submit-btn" type="submit">Save</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="header-area mt-4">
                                                            <h4 class="title">CHANGE PASSWORD</h4>
                                                        </div>

                                                        <div class="edit-info-area-form">
                                                            <form method="post" class="form" action="{{route('post-reset-password')}}" id="reset-password-frm">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <input name="old_password" type="password" class="input-field" placeholder="Old Password" >
                                                                        <span class="help-block" id="err-old_password"></span>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <input name="password" type="password" class="input-field" placeholder="New Password"  >
                                                                        <span class="help-block" id="err-password"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <input name="retype_password" type="password" class="input-field" placeholder="Confirm Password"  >
                                                                        <span class="help-block" id="err-retype_password"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-links">
                                                                    <button class="submit-btn" type="submit">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

@endsection




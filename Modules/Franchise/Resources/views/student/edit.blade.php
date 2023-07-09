@extends('franchise::layouts.main')
@section('page_css')
<style>
   .form-control {
    text-transform: uppercase;
} 
</style>
@stop
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('franchise-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('franchise-students')}}">student</a>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Update Student of {{$user->full_name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('franchise-student-edit',['id'=>$id])}}" class="form-horizontal" enctype="multipart/form-data">
                    @method('PUT')
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Name" name="full_name" value="{{ (old('full_name')!="") ? old('full_name') : $user->full_name}}"/>
                                @if ($errors->has('full_name'))
                                <span class="help-block"> {{ $errors->first('full_name') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('gurdian_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Gurdian Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Gurdian Name" name="gurdian_name" value="{{ (old('gurdian_name')!="") ? old('gurdian_name') : $user->gurdian_name }}"/>
                                    @if ($errors->has('gurdian_name'))
                                       <span class="help-block"> {{ $errors->first('gurdian_name') }} </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('father_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Father Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Father Name" name="father_name" value="{{ (old('father_name')!="") ? old('father_name') : $user->father_name }}"/>
                                    @if ($errors->has('father_name'))
                                       <span class="help-block"> {{ $errors->first('father_name') }} </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('mother_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Mother Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Mother Name" name="mother_name" value="{{ (old('mother_name')!="") ? old('mother_name') : $user->mother_name }}"/>
                                    @if ($errors->has('mother_name'))
                                       <span class="help-block"> {{ $errors->first('mother_name') }} </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('dob') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">DOB</label>
                            <div class="col-md-10">
                                <input type="date" class="form-control" placeholder="DOB" name="dob" value="{{ (old('dob')!="") ? old('dob') : $user->dob }}"/>
                                    @if ($errors->has('dob'))
                                       <span class="help-block"> {{ $errors->first('dob') }} </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Gender</label>
                            <div class="col-md-10">
                                <select name="gender" class="form-control">
                                    <option value="" class="option selected focus">Select Gender</option>
                                    <option value="Male" class="option" {{ (old('gender')!="") ? ('Male'==old('gender'))?'selected':'' : strcasecmp("Male","$user->gender")?'':'selected'}}>Male</option>
                                    <option value="Female" class="option" {{ (old('gender')!="") ? ('Female'==old('gender'))?'selected':'' : strcasecmp("Female","$user->gender")?'':'selected'}}>Female</option>
                                    <option value="Others" class="option" {{ (old('gender')!="") ? ('Others'==old('gender'))?'selected':'' : strcasecmp("Others","$user->gender")?'':'selected'}}>Others</option>
                                </select>
                                @if ($errors->has('gender'))
                                   <span class="help-block"> {{ $errors->first('gender') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Category</label>
                            <div class="col-md-10">
                                <select name="category" class="form-control">
                                    <option value="" class="option selected focus">Select Category</option>
                                    <option value="General" class="option" {{ (old('category')!="") ? ('General'==old('category'))?'selected':'' : strcasecmp("General","$user->category")?'':'selected'}}>General</option>
                                    <option value="SC" class="option" {{ (old('category')!="") ? ('SC'==old('category'))?'selected':'' : strcasecmp("SC","$user->category")?'':'selected'}}>SC</option>
                                    <option value="ST" class="option" {{ (old('category')!="") ? ('ST'==old('category'))?'selected':'' : strcasecmp("ST","$user->category")?'':'selected'}}>ST</option>
                                    <option value="OBC" class="option" {{ (old('category')!="") ? ('OBC'==old('category'))?'selected':'' : strcasecmp("OBC","$user->category")?'':'selected'}}>OBC</option>
                                </select>
                                @if ($errors->has('category'))
                                   <span class="help-block"> {{ $errors->first('category') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Email</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Email" name="email" value="{{ (old('email')!="") ? old('email') : $user->email }}"/>
                                    @if ($errors->has('email'))
                                       <span class="help-block"> {{ $errors->first('email') }} </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Phone</label>
                            <div class="col-md-10">
                                <input type="tel" class="form-control" placeholder="phone" name="phone" value="{{ (old('phone')!="") ? old('phone') : $user->phone }}"/>
                                    @if ($errors->has('phone'))
                                       <span class="help-block"> {{ $errors->first('phone') }} </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Address</label>
                            <div class="col-md-10">
                                <textarea class="form-control" placeholder="Address" name="address" id="address">{{ (old('address')!="") ? old('address') : $user->address }}</textarea>
                                    @if ($errors->has('address'))
                                       <span class="help-block"> {{ $errors->first('address') }} </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">State</label>
                            <div class="col-md-10">
                                <select name="state" class="form-control">
                                    <option value="" class="option selected focus">Select State</option>
                                    
                                    <option value="Andhra Pradesh" class="option" {{ strcasecmp("Andhra Pradesh","$user->state")?'':'selected'}}>Andhra Pradesh</option>
                                    <option value="Andaman and Nicobar Islands" class="option" {{ strcasecmp("Andaman and Nicobar Islands","$user->state")?'':'selected'}}>Andaman and Nicobar Islands</option>
                                    <option value="Arunachal Pradesh" class="option" {{ strcasecmp("Arunachal Pradesh","$user->state")?'':'selected'}}>Arunachal Pradesh</option>
                                    <option value="Assam" class="option" {{ strcasecmp("Assam","$user->state")?'':'selected'}}>Assam</option>
                                    <option value="Bihar" class="option" {{ strcasecmp("Bihar","$user->state")?'':'selected'}}>Bihar</option>
                                    <option value="Chandigarh" class="option" {{ strcasecmp("Chandigarh","$user->state")?'':'selected'}}>Chandigarh</option>
                                    <option value="Chhattisgarh" class="option" {{ strcasecmp("Chhattisgarh","$user->state")?'':'selected'}}>Chhattisgarh</option>
                                    <option value="Dadar and Nagar Haveli" class="option" {{ strcasecmp("Dadar and Nagar Haveli","$user->state")?'':'selected'}}>Dadar and Nagar Haveli</option>
                                    <option value="Daman and Diu" class="option" {{ strcasecmp("Daman and Diu","$user->state")?'':'selected'}}>Daman and Diu</option>
                                    <option value="Delhi" class="option" {{ strcasecmp("Delhi","$user->state")?'':'selected'}}>Delhi</option>
                                    <option value="Lakshadweep" class="option" {{ strcasecmp("Lakshadweep","$user->state")?'':'selected'}}>Lakshadweep</option>
                                    <option value="Puducherry" class="option" {{ strcasecmp("Puducherry","$user->state")?'':'selected'}}>Puducherry</option>
                                    <option value="Goa" class="option" {{ strcasecmp("Goa","$user->state")?'':'selected'}}>Goa</option>
                                    <option value="Gujarat" class="option" {{ strcasecmp("Gujarat","$user->state")?'':'selected'}}>Gujarat</option>
                                    <option value="Haryana" class="option" {{ strcasecmp("Haryana","$user->state")?'':'selected'}}>Haryana</option>
                                    <option value="Himachal Pradesh" class="option" {{ strcasecmp("Himachal Pradesh","$user->state")?'':'selected'}}>Himachal Pradesh</option>
                                    <option value="Jammu and Kashmir" class="option" {{ strcasecmp("Jammu and Kashmir","$user->state")?'':'selected'}}>Jammu and Kashmir</option>
                                    <option value="Jharkhand" class="option" {{ strcasecmp("Jharkhand","$user->state")?'':'selected'}}>Jharkhand</option>
                                    <option value="Karnataka" class="option" {{ strcasecmp("Karnataka","$user->state")?'':'selected'}}>Karnataka</option>
                                    <option value="Kerala" class="option" {{ strcasecmp("Kerala","$user->state")?'':'selected'}}>Kerala</option>
                                    <option value="Madhya Pradesh" class="option" {{ strcasecmp("Madhya Pradesh","$user->state")?'':'selected'}}>Madhya Pradesh</option>
                                    <option value="Maharashtra" class="option" {{ strcasecmp("Maharashtra","$user->state")?'':'selected'}}>Maharashtra</option>
                                    <option value="Manipur" class="option" {{ strcasecmp("Manipur","$user->state")?'':'selected'}}>Manipur</option>
                                    <option value="Meghalaya" class="option" {{ strcasecmp("Meghalaya","$user->state")?'':'selected'}}>Meghalaya</option>
                                    <option value="Mizoram" class="option" {{ strcasecmp("Mizoram","$user->state")?'':'selected'}}>Mizoram</option>
                                    <option value="Nagaland" class="option" {{ strcasecmp("Nagaland","$user->state")?'':'selected'}}>Nagaland</option>
                                    <option value="Odisha" class="option" {{ strcasecmp("Odisha","$user->state")?'':'selected'}}>Odisha</option>
                                    <option value="Punjab" class="option" {{ strcasecmp("Punjab","$user->state")?'':'selected'}}>Punjab</option>
                                    <option value="Rajasthan" class="option" {{ strcasecmp("Rajasthan","$user->state")?'':'selected'}}>Rajasthan</option>
                                    <option value="Sikkim" class="option" {{ strcasecmp("Sikkim","$user->state")?'':'selected'}}>Sikkim</option>
                                    <option value="Tamil Nadu" class="option" {{ strcasecmp("Tamil Nadu","$user->state")?'':'selected'}}>Tamil Nadu</option>
                                    <option value="Telangana" class="option" {{ strcasecmp("Telangana","$user->state")?'':'selected'}}>Telangana</option>
                                    <option value="Tripura" class="option" {{ strcasecmp("Tripura","$user->state")?'':'selected'}}>Tripura</option>
                                    <option value="Uttar Pradesh" class="option" {{ strcasecmp("Uttar Pradesh","$user->state")?'':'selected'}}>Uttar Pradesh</option>
                                    <option value="Uttarakhand" class="option" {{ strcasecmp("Uttarakhand","$user->state")?'':'selected'}}>Uttarakhand</option>
                                    <option value="West Bengal" class="option" {{ strcasecmp("West Bengal","$user->state")?'':'selected'}}>West Bengal</option>
                                </select>
                                @if ($errors->has('state'))
                                   <span class="help-block"> {{ $errors->first('state') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('district') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">District</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="District" name="district" value="{{ (old('district')!="") ? old('district') : $user->district }}"/>
                                    @if ($errors->has('district'))
                                       <span class="help-block"> {{ $errors->first('district') }} </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('last_qualification') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Last Qualification</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Last Qualification" name="last_qualification" value="{{ (old('last_qualification')!="") ? old('last_qualification') : $user->last_qualification }}"/>
                                    @if ($errors->has('last_qualification'))
                                       <span class="help-block"> {{ $errors->first('last_qualification') }} </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('specialization') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Specialization</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Specialization" name="specialization" value="{{ (old('specialization')!="") ? old('specialization') : $user->specialization }}"/>
                                    @if ($errors->has('specialization'))
                                       <span class="help-block"> {{ $errors->first('specialization') }} </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('year_of_passing') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Year of Passing</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Year of Passing" name="year_of_passing" value="{{ (old('year_of_passing')!="") ? old('year_of_passing') : $user->year_of_passing }}"/>
                                    @if ($errors->has('year_of_passing'))
                                       <span class="help-block"> {{ $errors->first('year_of_passing') }} </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('school_college_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">School/college Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="School/college Name" name="school_college_name" value="{{ (old('school_college_name')!="") ? old('school_college_name') : $user->school_college_name }}"/>
                                    @if ($errors->has('school_college_name'))
                                       <span class="help-block"> {{ $errors->first('school_college_name') }} </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('marks') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Percentage of Marks</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Percentage of Marks" name="marks" value="{{ (old('marks')!="") ? old('marks') : $user->marks }}"/>
                                    @if ($errors->has('marks'))
                                       <span class="help-block"> {{ $errors->first('marks') }} </span>
                                    @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Upload Image</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="image" onchange="readURL(this);">
                                @if ($errors->has('image'))
                                <span class="help-block"> {{ $errors->first('image') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <a href="{{isset($user->image)?URL::asset('public/uploads/user/'.$user->image):''}}" class="btn btn-xs btn-primary pull-left" target="_blank"><i class="fa fa-eye"></i>View Image</a><br/>
                            </div>
                        </div>
                        <br>
                        <div class="form-group {{ $errors->has('id_proof') ? ' has-error' : '' }}">
                            <label class="control-label col-md-10">Upload Govt. Id Proof (Exam: Aadhar Card/Voter Card/Pan Card)</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="id_proof" >
                                @if ($errors->has('id_proof'))
                                <span class="help-block"> {{ $errors->first('id_proof') }} </span>
                                @endif
                            </div>
                        </div>
                        @if(isset($user->id_proof))
                        <div class="form-group">
                            <div class="col-md-10">
                                <a href="{{isset($user->id_proof)?URL::asset('public/uploads/user/'.$user->id_proof):''}}" class="btn btn-xs btn-primary pull-left" target="_blank"><i class="fa fa-eye"></i>View ID Proof</a><br/>
                            </div>
                        </div>
                        <br>
                        @endif
                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" {{ ($user->status == '1') ? 'checked' : '' }}> Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0" {{ ($user->status == '0') ? 'checked' : '' }}> Inactive
                                    </label>
                                    @if ($errors->has('status'))
                                    <div class="help-block">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--<div class="form-group {{ $errors->has('payment_status') ? ' has-error' : '' }}">-->
                        <!--    <label class="control-label col-md-3">Registration Fee <span class="required">*</span></label>-->
                        <!--    <div class="col-md-10">-->
                        <!--        <div class="radio-list">-->
                        <!--            <label class="radio-inline">-->
                        <!--                <input type="radio" name="payment_status" value="1" {{ ($user->payment_status == '1') ? 'checked' : '' }}> Paid-->
                        <!--            </label>-->
                        <!--            <label class="radio-inline">-->
                        <!--                <input type="radio" name="payment_status" value="0" {{ ($user->payment_status == '0') ? 'checked' : '' }}> Not Paid-->
                        <!--            </label>-->
                        <!--            @if ($errors->has('payment_status'))-->
                        <!--            <div class="help-block">{{ $errors->first('payment_status') }}</div>-->
                        <!--            @endif-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{Route('franchise-students')}}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn green"> Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
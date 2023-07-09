<?php

$PAYU_BASE_URL = $BASE_URL;
$action = '';
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$posted = array();
$posted = array(
    'key' => $MERCHANT_KEY,
    'txnid' => $txnid,
    'amount' => '',
    'firstname' => 'Akash Sarkar',
    'email' => 'albert@yopmail.com',
    'productinfo' => 'Registration fee',
    'surl' => 'http://ditechnical.in',
    'furl' => 'http://ditechnical.in',
    'service_provider' => 'payu_paisa',
);

if (empty($posted['txnid'])) {
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
    $txnid = $posted['txnid'];
}
$hash = '';
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if (empty($posted['hash']) && sizeof($posted) > 0) {
    $hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';
    foreach ($hashVarsSeq as $hash_var) {
        $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
        $hash_string .= '|';
    }
    $hash_string .= $SALT;
    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
} elseif (!empty($posted['hash'])) {
    $hash = $posted['hash'];
    $action = $PAYU_BASE_URL . '/_payment';
}
?>

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
        <a href="{{Route('franchise-students')}}">Student</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Add Student</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Student</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="student-add-form" method="post" action="{{route('franchise-student-add')}}" class="form-horizontal" enctype='multipart/form-data'>
                    
                    @csrf
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Student Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Student Name" name="full_name" value="{{ (old('full_name')!="") ? old('full_name') : '' }}"/>
                                <span class="help-block" id="error-full_name"></span>
                                    @if ($errors->has('full_name'))
                                       <span class="help-block"> {{ $errors->first('full_name') }} </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('gurdian_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Gurdian Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Gurdian Name" name="gurdian_name" value="{{ (old('gurdian_name')!="") ? old('gurdian_name') : '' }}"/>
                                <span class="help-block" id="error-gurdian_name"></span>
                                    <!--@if ($errors->has('gurdian_name'))-->
                                    <!--   <span class="help-block"> {{ $errors->first('gurdian_name') }} </span>-->
                                    <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('father_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Father Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Father Name" name="father_name" value="{{ (old('father_name')!="") ? old('father_name') : '' }}"/>
                                <span class="help-block" id="error-father_name"></span>
                                    <!--@if ($errors->has('father_name'))-->
                                    <!--   <span class="help-block"> {{ $errors->first('father_name') }} </span>-->
                                    <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('mother_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Mother Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Mother Name" name="mother_name" value="{{ (old('mother_name')!="") ? old('mother_name') : '' }}"/>
                                <span class="help-block" id="error-mother_name"></span>
                                    <!--@if ($errors->has('mother_name'))-->
                                    <!--   <span class="help-block"> {{ $errors->first('mother_name') }} </span>-->
                                    <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('dob') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">DOB</label>
                            <div class="col-md-10">
                                <input type="date" class="form-control" placeholder="DOB" name="dob" value="{{ (old('dob')!="") ? old('dob') : '' }}"/>
                                <span class="help-block" id="error-dob"></span>
                                    <!--@if ($errors->has('dob'))-->
                                    <!--   <span class="help-block"> {{ $errors->first('dob') }} </span>-->
                                    <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Gender</label>
                            <div class="col-md-10">
                                <select name="gender" class="form-control">
                                    <option value="" class="option selected focus">Select Gender</option>
                                    <option value="Male" class="option" {{ (old('gender')!="") ? ('Male'==old('gender'))?'selected':'' : ''}}>Male</option>
                                    <option value="Female" class="option" {{ (old('gender')!="") ? ('Female'==old('gender'))?'selected':'' : ''}}>Female</option>
                                    <option value="Others" class="option" {{ (old('gender')!="") ? ('Others'==old('gender'))?'selected':'' : ''}}>Others</option>
                                </select>
                                <span class="help-block" id="error-gender"></span>
                                <!--@if ($errors->has('gender'))-->
                                <!--   <span class="help-block"> {{ $errors->first('gender') }} </span>-->
                                <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Category</label>
                            <div class="col-md-10">
                                <select name="category" class="form-control">
                                    <option value="" class="option selected focus">Select Category</option>
                                    <option value="General" class="option" {{ (old('category')!="") ? ('General'==old('category'))?'selected':'' : ''}}>General</option>
                                    <option value="SC" class="option" {{ (old('category')!="") ? ('SC'==old('category'))?'selected':'' : ''}}>SC</option>
                                    <option value="ST" class="option" {{ (old('category')!="") ? ('ST'==old('category'))?'selected':'' : ''}}>ST</option>
                                    <option value="OBC" class="option" {{ (old('category')!="") ? ('OBC'==old('category'))?'selected':'' : ''}}>OBC</option>
                                </select>
                                <span class="help-block" id="error-category"></span>
                                <!--@if ($errors->has('category'))-->
                                <!--   <span class="help-block"> {{ $errors->first('category') }} </span>-->
                                <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Email</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Email" name="email" value="{{ (old('email')!="") ? old('email') : '' }}"/>
                                <span class="help-block" id="error-email"></span>
                                    <!--@if ($errors->has('email'))-->
                                    <!--   <span class="help-block"> {{ $errors->first('email') }} </span>-->
                                    <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Phone</label>
                            <div class="col-md-10">
                                <input type="tel" class="form-control" placeholder="phone" name="phone" value="{{ (old('phone')!="") ? old('phone') : '' }}"/>
                                <span class="help-block" id="error-phone"></span>
                                    <!--@if ($errors->has('phone'))-->
                                    <!--   <span class="help-block"> {{ $errors->first('phone') }} </span>-->
                                    <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Address</label>
                            <div class="col-md-10">
                                <textarea class="form-control" placeholder="Address" name="address" id="address">{{ (old('address')!="") ? old('address') : '' }}</textarea>
                                <span class="help-block" id="error-address"></span>
                                    <!--@if ($errors->has('address'))-->
                                    <!--   <span class="help-block"> {{ $errors->first('address') }} </span>-->
                                    <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('last_qualification') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Last Qualification</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Last Qualification" name="last_qualification" value="{{ (old('last_qualification')!="") ? old('last_qualification') : '' }}"/>
                                <span class="help-block" id="error-last_qualification"></span>
                                    <!--@if ($errors->has('last_qualification'))-->
                                    <!--   <span class="help-block"> {{ $errors->first('last_qualification') }} </span>-->
                                    <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('specialization') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Specialization</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Specialization" name="specialization" value="{{ (old('specialization')!="") ? old('specialization') : '' }}"/>
                                <span class="help-block" id="error-specialization"></span>
                                    <!--@if ($errors->has('specialization'))-->
                                    <!--   <span class="help-block"> {{ $errors->first('specialization') }} </span>-->
                                    <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('year_of_passing') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Year of Passing</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Year of Passing" name="year_of_passing" value="{{ (old('year_of_passing')!="") ? old('year_of_passing') : '' }}"/>
                                <span class="help-block" id="error-year_of_passing"></span>
                                    <!--@if ($errors->has('year_of_passing'))-->
                                    <!--   <span class="help-block"> {{ $errors->first('year_of_passing') }} </span>-->
                                    <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('school_college_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">School/college Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="School/college Name" name="school_college_name" value="{{ (old('school_college_name')!="") ? old('school_college_name') : '' }}"/>
                                <span class="help-block" id="error-school_college_name"></span>
                                    <!--@if ($errors->has('school_college_name'))-->
                                    <!--   <span class="help-block"> {{ $errors->first('school_college_name') }} </span>-->
                                    <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('marks') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Percentage of Marks</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Percentage of Marks" name="marks" value="{{ (old('marks')!="") ? old('marks') : '' }}"/>
                                <span class="help-block" id="error-marks"></span>
                                    <!--@if ($errors->has('marks'))-->
                                    <!--   <span class="help-block"> {{ $errors->first('marks') }} </span>-->
                                    <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">State</label>
                            <div class="col-md-10">
                                <select name="state" class="form-control">
                                    <option value="" class="option selected focus">Select State</option>
                                    
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
                                <!--@if ($errors->has('state'))-->
                                <!--   <span class="help-block"> {{ $errors->first('state') }} </span>-->
                                <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('district') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">District</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="District" name="district" value="{{ (old('district')!="") ? old('district') : '' }}"/>
                                <span class="help-block" id="error-district"></span>
                                    <!--@if ($errors->has('district'))-->
                                    <!--   <span class="help-block"> {{ $errors->first('district') }} </span>-->
                                    <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Upload Image</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="image" onchange="readURL(this);">
                                <span class="help-block" id="error-image"></span>
                                <!--@if ($errors->has('image'))-->
                                <!--<span class="help-block"> {{ $errors->first('image') }} </span>-->
                                <!--@endif-->
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('id_proof') ? ' has-error' : '' }}">
                            <label class="control-label col-md-10">Upload Govt. Id Proof (Exam: Aadhar Card/Voter Card/Pan Card)</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="id_proof" >
                                <span class="help-block" id="error-id_proof"></span>
                                <!--@if ($errors->has('id_proof'))-->
                                <!--<span class="help-block"> {{ $errors->first('id_proof') }} </span>-->
                                <!--@endif-->
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1"> Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0"> Inactive
                                    </label>
                                    <span class="help-block" id="error-status"></span>
                                    @if ($errors->has('status'))
                                    <div class="help-block">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('wallet') ? ' has-error' : '' }}">
                            <label class="control-label col-md-5">Payment through Wallet (Pay Rs.{{$amount}}) <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="wallet" value="1"> Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="wallet" value="0"> No
                                    </label>
                                    <span class="help-block" id="error-wallet"></span>
                                    @if ($errors->has('wallet'))
                                    <div class="help-block">{{ $errors->first('wallet') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="offset-md-3 col-md-9">
                                <a href="{{Route('franchise-students')}}" class="btn btn-primary">Cancel</a>
                                <!--<button type="submit" class="btn green">Submit</button>-->
                                <input type="submit" class="btn green" value="Submit">
                            </div>
                        </div>
                    </div>
                </form>
                <form action="<?php echo $action; ?>" method="post" name="payuForm">
                    @csrf
                    <input type="hidden" name="key"  value="<?php echo $MERCHANT_KEY ?>" />
                    <input type="hidden" name="hash" id="hash" value="<?php echo $hash ?>"/>
                    <input type="hidden" name="txnid" id="txnid" value="<?php echo $txnid ?>" />
                    <input type="hidden" name="amount" id="amount" value="" /><br />
                    <input type="hidden" name="firstname" id="firstname" value="Akash Sarkar" />
                    <input type="hidden" name="email" id="email" value="albert@yopmail.com" />
                    <input type="hidden" name="phone" id="phone" value=""/>
                    <input type="hidden" name="productinfo" value="Registration fee">
                    <input type="hidden" name="surl" id="surl" value="" />
                    <input type="hidden" name="furl" id="furl" value="" />
                    <input type="hidden" name="service_provider" value="payu_paisa" />
                    <?php if (!$hash) { ?>
                        <input type="submit" value="Submit" />
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@section('page_js')
<script>

    function submitPayuForm() {
        var hash = $('input[name=hash]').val();
        if (hash == '') {
            return;
        }
        var payuForm = document.forms.payuForm;
        payuForm.submit();
    }
</script>
@endsection
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
    'surl' => 'http://ditechnical.in/',
    'furl' => 'http://ditechnical.in/',
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

@extends('layouts.main')
@section('css')
<style>

</style>
@stop
@section('content')
<!--------------------------------Main content Start--------------------------->
<!--<section class="main-content">-->
<!--    <section class="login-div">-->
<!--        <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="col-sm-6 offset-sm-3">-->
<!--                    <div class="login-box">-->
<!--                        <div class="form-header">-->
<!--                            <h4>Apply Form For Affiliation</h4>-->
<!--                        </div> -->
<!--                        <form class="student-log-reg-form" id="franchise-request-form" action="{{route('apply-online')}}">-->
<!--                            @csrf-->
                            
                            
    						
<!--    						<div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('plan_id') ? ' has-error' : '' }}"> -->
<!--                                        <select name="plan_id" class="form-control" ><option disabled selected>Affiliation Type & Fee*</option>-->
<!--            								<option value='1' class="option" {{ (old('plan_id')!="") ? ('1'==old('plan_id'))?'selected':'' : ''}}>FREE AFFILIATION FOR 6 MONTHS</option>-->
<!--            								<option value='2' class="option" {{ (old('plan_id')!="") ? ('2'==old('plan_id'))?'selected':'' : ''}}>START UP AFFILIATION FOR 1 YEAR [ Rs. 2999 ]</option>-->
<!--            								<option value='3' class="option" {{ (old('plan_id')!="") ? ('3'==old('plan_id'))?'selected':'' : ''}}>SILVER AFFILIATION FOR 1 YEAR [ Rs. 3999 ]</option>-->
<!--            								<option value='4' class="option" {{ (old('plan_id')!="") ? ('4'==old('plan_id'))?'selected':'' : ''}}>GOLD AFFILIATION FOR 2 YEARS[ Rs. 20000 ]</option>-->
<!--            							</select>-->
<!--            							<span class="help-block" id="error-plan_id"></span>-->
<!--                                        @if ($errors->has('plan_id'))-->
<!--                                           <span class="help-block"> {{ $errors->first('plan_id') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Franchise Name*" name="name" value="{{ (old('name')!="") ? old('name') : '' }}" />-->
<!--                                        <span class="help-block" id="error-name"></span>-->
<!--                                        @if ($errors->has('name'))-->
<!--                                           <span class="help-block"> {{ $errors->first('name') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Franchise Address*" name="address" value="{{ (old('address')!="") ? old('address') : '' }}" />-->
<!--                                        <span class="help-block" id="error-address"></span>-->
<!--                                        @if ($errors->has('address'))-->
<!--                                           <span class="help-block"> {{ $errors->first('address') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Franchise City*" name="city" value="{{ (old('city')!="") ? old('city') : '' }}" />-->
<!--                                        <span class="help-block" id="error-city"></span>-->
<!--                                        @if ($errors->has('city'))-->
<!--                                           <span class="help-block"> {{ $errors->first('city') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('district') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Franchise District*" name="district" value="{{ (old('district')!="") ? old('district') : '' }}" />-->
<!--                                        <span class="help-block" id="error-district"></span>-->
<!--                                        @if ($errors->has('district'))-->
<!--                                           <span class="help-block"> {{ $errors->first('district') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}"> -->
<!--                                        <select name="state" class="form-control" ><option value="" disabled selected>Franchise State*</option>-->
<!--            								<option value="Andhra Pradesh" class="option" {{ (old('state')!="") ? ('Andhra Pradesh'==old('state'))?'selected':'' : ''}}>Andhra Pradesh</option>-->
<!--                                            <option value="Andaman and Nicobar Islands" class="option" {{ (old('state')!="") ? ('Andaman and Nicobar Islands'==old('state'))?'selected':'' : ''}}>Andaman and Nicobar Islands</option>-->
<!--                                            <option value="Arunachal Pradesh" class="option" {{ (old('state')!="") ? ('Arunachal Pradesh'==old('state'))?'selected':'' : ''}}>Arunachal Pradesh</option>-->
<!--                                            <option value="Assam" class="option" {{ (old('state')!="") ? ('Assam'==old('state'))?'selected':'' : ''}}>Assam</option>-->
<!--                                            <option value="Bihar" class="option" {{ (old('state')!="") ? ('Bihar'==old('state'))?'selected':'' : ''}}>Bihar</option>-->
<!--                                            <option value="Chandigarh" class="option" {{ (old('state')!="") ? ('Chandigarh'==old('state'))?'selected':'' : ''}}>Chandigarh</option>-->
<!--                                            <option value="Chhattisgarh" class="option" {{ (old('state')!="") ? ('Chhattisgarh'==old('state'))?'selected':'' : ''}}>Chhattisgarh</option>-->
<!--                                            <option value="Dadar and Nagar Haveli" class="option" {{ (old('state')!="") ? ('Dadar and Nagar Haveli'==old('state'))?'selected':'' : ''}}>Dadar and Nagar Haveli</option>-->
<!--                                            <option value="Daman and Diu" class="option" {{ (old('state')!="") ? ('Daman and Diu'==old('state'))?'selected':'' : ''}}>Daman and Diu</option>-->
<!--                                            <option value="Delhi" class="option" {{ (old('state')!="") ? ('Delhi'==old('state'))?'selected':'' : ''}}>Delhi</option>-->
<!--                                            <option value="Lakshadweep" class="option" {{ (old('state')!="") ? ('Lakshadweep'==old('state'))?'selected':'' : ''}}>Lakshadweep</option>-->
<!--                                            <option value="Puducherry" class="option" {{ (old('state')!="") ? ('Puducherry'==old('state'))?'selected':'' : ''}}>Puducherry</option>-->
<!--                                            <option value="Goa" class="option" {{ (old('state')!="") ? ('Goa'==old('state'))?'selected':'' : ''}}>Goa</option>-->
<!--                                            <option value="Gujarat" class="option" {{ (old('state')!="") ? ('Gujarat'==old('state'))?'selected':'' : ''}}>Gujarat</option>-->
<!--                                            <option value="Haryana" class="option" {{ (old('state')!="") ? ('Haryana'==old('state'))?'selected':'' : ''}}>Haryana</option>-->
<!--                                            <option value="Himachal Pradesh" class="option" {{ (old('state')!="") ? ('Himachal Pradesh'==old('state'))?'selected':'' : ''}}>Himachal Pradesh</option>-->
<!--                                            <option value="Jammu and Kashmir" class="option" {{ (old('state')!="") ? ('Jammu and Kashmir'==old('state'))?'selected':'' : ''}}>Jammu and Kashmir</option>-->
<!--                                            <option value="Jharkhand" class="option" {{ (old('state')!="") ? ('Jharkhand'==old('state'))?'selected':'' : ''}}>Jharkhand</option>-->
<!--                                            <option value="Karnataka" class="option" {{ (old('state')!="") ? ('Karnataka'==old('state'))?'selected':'' : ''}}>Karnataka</option>-->
<!--                                            <option value="Kerala" class="option" {{ (old('state')!="") ? ('Kerala'==old('state'))?'selected':'' : ''}}>Kerala</option>-->
<!--                                            <option value="Madhya Pradesh" class="option" {{ (old('state')!="") ? ('Madhya Pradesh'==old('state'))?'selected':'' : ''}}>Madhya Pradesh</option>-->
<!--                                            <option value="Maharashtra" class="option" {{ (old('state')!="") ? ('Maharashtra'==old('state'))?'selected':'' : ''}}>Maharashtra</option>-->
<!--                                            <option value="Manipur" class="option" {{ (old('state')!="") ? ('Manipur'==old('state'))?'selected':'' : ''}}>Manipur</option>-->
<!--                                            <option value="Meghalaya" class="option" {{ (old('state')!="") ? ('Meghalaya'==old('state'))?'selected':'' : ''}}>Meghalaya</option>-->
<!--                                            <option value="Mizoram" class="option" {{ (old('state')!="") ? ('Mizoram'==old('state'))?'selected':'' : ''}}>Mizoram</option>-->
<!--                                            <option value="Nagaland" class="option" {{ (old('state')!="") ? ('Nagaland'==old('state'))?'selected':'' : ''}}>Nagaland</option>-->
<!--                                            <option value="Odisha" class="option" {{ (old('state')!="") ? ('Odisha'==old('state'))?'selected':'' : ''}}>Odisha</option>-->
<!--                                            <option value="Punjab" class="option" {{ (old('state')!="") ? ('Punjab'==old('state'))?'selected':'' : ''}}>Punjab</option>-->
<!--                                            <option value="Rajasthan" class="option" {{ (old('state')!="") ? ('Rajasthan'==old('state'))?'selected':'' : ''}}>Rajasthan</option>-->
<!--                                            <option value="Sikkim" class="option" {{ (old('state')!="") ? ('Sikkim'==old('state'))?'selected':'' : ''}}>Sikkim</option>-->
<!--                                            <option value="Tamil Nadu" class="option" {{ (old('state')!="") ? ('Tamil Nadu'==old('state'))?'selected':'' : ''}}>Tamil Nadu</option>-->
<!--                                            <option value="Telangana" class="option" {{ (old('state')!="") ? ('Telangana'==old('state'))?'selected':'' : ''}}>Telangana</option>-->
<!--                                            <option value="Tripura" class="option" {{ (old('state')!="") ? ('Tripura'==old('state'))?'selected':'' : ''}}>Tripura</option>-->
<!--                                            <option value="Uttar Pradesh" class="option" {{ (old('state')!="") ? ('Uttar Pradesh'==old('state'))?'selected':'' : ''}}>Uttar Pradesh</option>-->
<!--                                            <option value="Uttarakhand" class="option" {{ (old('state')!="") ? ('Uttarakhand'==old('state'))?'selected':'' : ''}}>Uttarakhand</option>-->
<!--                                            <option value="West Bengal" class="option" {{ (old('state')!="") ? ('West Bengal'==old('state'))?'selected':'' : ''}}>West Bengal</option>-->
<!--            							</select>-->
<!--            							<span class="help-block" id="error-state"></span>-->
<!--                                        @if ($errors->has('state'))-->
<!--                                           <span class="help-block"> {{ $errors->first('state') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('pin') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Pin Code*" name="pin" value="{{ (old('pin')!="") ? old('pin') : '' }}" />-->
<!--                                        <span class="help-block" id="error-pin"></span>-->
<!--                                        @if ($errors->has('pin'))-->
<!--                                           <span class="help-block"> {{ $errors->first('pin') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Country*" name="country" value="{{ (old('country')!="") ? old('country') : '' }}" />-->
<!--                                        <span class="help-block" id="error-country"></span>-->
<!--                                        @if ($errors->has('country'))-->
<!--                                           <span class="help-block"> {{ $errors->first('country') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">-->
<!--                                        <input type="file" class="form-control"  placeholder="Upload Image*" name="image" onchange="readURL(this);">-->
<!--                                        <span class="help-block" id="error-image"></span>-->
<!--                                        @if ($errors->has('image'))-->
<!--                                        <span class="help-block"> {{ $errors->first('image') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('establish') ? ' has-error' : '' }}"> -->
<!--                                        <select name="establish" class="form-control" ><option disabled selected>Year of Establishment*</option>-->
<!--                                            <option value="2022" class="option" {{ (old('establish')!="") ? ('2022'==old('establish'))?'selected':'' : ''}}>2022</option>-->
<!--                                            <option value="2021" class="option" {{ (old('establish')!="") ? ('2021'==old('establish'))?'selected':'' : ''}}>2021</option>-->
<!--            								<option value="2020" class="option" {{ (old('establish')!="") ? ('2020'==old('establish'))?'selected':'' : ''}}>2020</option>-->
<!--                    						<option value="2019" class="option" {{ (old('establish')!="") ? ('2019'==old('establish'))?'selected':'' : ''}}>2019</option>-->
<!--                    						<option value="2018" class="option" {{ (old('establish')!="") ? ('2018'==old('establish'))?'selected':'' : ''}}>2018</option>-->
<!--                    						<option value="2017" class="option" {{ (old('establish')!="") ? ('2017'==old('establish'))?'selected':'' : ''}}>2017</option>-->
<!--                    						<option value="2016" class="option" {{ (old('establish')!="") ? ('2016'==old('establish'))?'selected':'' : ''}}>2016</option>-->
<!--                    						<option value="2015" class="option" {{ (old('establish')!="") ? ('2015'==old('establish'))?'selected':'' : ''}}>2015</option>-->
<!--                    						<option value="2014" class="option" {{ (old('establish')!="") ? ('2014'==old('establish'))?'selected':'' : ''}}>2014</option>-->
<!--                    						<option value="2013" class="option" {{ (old('establish')!="") ? ('2013'==old('establish'))?'selected':'' : ''}}>2013</option>-->
<!--                    						<option value="2012" class="option" {{ (old('establish')!="") ? ('2012'==old('establish'))?'selected':'' : ''}}>2012</option>-->
<!--                    						<option value="2011" class="option" {{ (old('establish')!="") ? ('2011'==old('establish'))?'selected':'' : ''}}>2011</option>-->
<!--                    						<option value="2010" class="option" {{ (old('establish')!="") ? ('2010'==old('establish'))?'selected':'' : ''}}>2010</option>-->
<!--                    						<option value="2009" class="option" {{ (old('establish')!="") ? ('2009'==old('establish'))?'selected':'' : ''}}>2009</option>-->
<!--                    						<option value="2008" class="option" {{ (old('establish')!="") ? ('2008'==old('establish'))?'selected':'' : ''}}>2008</option>-->
<!--                    						<option value="2007" class="option" {{ (old('establish')!="") ? ('2007'==old('establish'))?'selected':'' : ''}}>2007</option>-->
<!--                    						<option value="2006" class="option" {{ (old('establish')!="") ? ('2006'==old('establish'))?'selected':'' : ''}}>2006</option>-->
<!--                    						<option value="2005" class="option" {{ (old('establish')!="") ? ('2005'==old('establish'))?'selected':'' : ''}}>2005</option>-->
<!--                    						<option value="2004" class="option" {{ (old('establish')!="") ? ('2004'==old('establish'))?'selected':'' : ''}}>2004</option>-->
<!--                    						<option value="2003" class="option" {{ (old('establish')!="") ? ('2003'==old('establish'))?'selected':'' : ''}}>2003</option>-->
<!--                    						<option value="2002" class="option" {{ (old('establish')!="") ? ('2002'==old('establish'))?'selected':'' : ''}}>2002</option>-->
<!--                    						<option value="2001" class="option" {{ (old('establish')!="") ? ('2001'==old('establish'))?'selected':'' : ''}}>2001</option>-->
<!--                    						<option value="2000" class="option" {{ (old('establish')!="") ? ('2000'==old('establish'))?'selected':'' : ''}}>2000</option>-->
<!--                    						<option value="1999" class="option" {{ (old('establish')!="") ? ('1999'==old('establish'))?'selected':'' : ''}}>1999</option>-->
<!--                    						<option value="1998" class="option" {{ (old('establish')!="") ? ('1998'==old('establish'))?'selected':'' : ''}}>1998</option>-->
<!--                    						<option value="1997" class="option" {{ (old('establish')!="") ? ('1997'==old('establish'))?'selected':'' : ''}}>1997</option>-->
<!--                    						<option value="1996" class="option" {{ (old('establish')!="") ? ('1996'==old('establish'))?'selected':'' : ''}}>1996</option>-->
<!--                    						<option value="1995" class="option" {{ (old('establish')!="") ? ('1995'==old('establish'))?'selected':'' : ''}}>1995</option>-->
<!--                    						<option value="1994" class="option" {{ (old('establish')!="") ? ('1994'==old('establish'))?'selected':'' : ''}}>1994</option>-->
<!--                    						<option value="1993" class="option" {{ (old('establish')!="") ? ('1993'==old('establish'))?'selected':'' : ''}}>1993</option>-->
<!--                    						<option value="1992" class="option" {{ (old('establish')!="") ? ('1992'==old('establish'))?'selected':'' : ''}}>1992</option>-->
<!--                    						<option value="1991" class="option" {{ (old('establish')!="") ? ('1991'==old('establish'))?'selected':'' : ''}}>1991</option>-->
<!--                    						<option value="1990" class="option" {{ (old('establish')!="") ? ('1990'==old('establish'))?'selected':'' : ''}}>1990</option>-->
<!--                    						<option value="1989" class="option" {{ (old('establish')!="") ? ('1989'==old('establish'))?'selected':'' : ''}}>1989</option>-->
<!--                    						<option value="1988" class="option" {{ (old('establish')!="") ? ('1988'==old('establish'))?'selected':'' : ''}}>1988</option>-->
<!--                    						<option value="1987" class="option" {{ (old('establish')!="") ? ('1987'==old('establish'))?'selected':'' : ''}}>1987</option>-->
<!--                    						<option value="1986" class="option" {{ (old('establish')!="") ? ('1986'==old('establish'))?'selected':'' : ''}}>1986</option>-->
<!--                    						<option value="1985" class="option" {{ (old('establish')!="") ? ('1985'==old('establish'))?'selected':'' : ''}}>1985</option>-->
<!--                    						<option value="1984" class="option" {{ (old('establish')!="") ? ('1984'==old('establish'))?'selected':'' : ''}}>1984</option>-->
<!--                    						<option value="1983" class="option" {{ (old('establish')!="") ? ('1983'==old('establish'))?'selected':'' : ''}}>1983</option>-->
<!--                    						<option value="1982" class="option" {{ (old('establish')!="") ? ('1982'==old('establish'))?'selected':'' : ''}}>1982</option>-->
<!--                    						<option value="1981" class="option" {{ (old('establish')!="") ? ('1981'==old('establish'))?'selected':'' : ''}}>1981</option>-->
<!--                    						<option value="1980" class="option" {{ (old('establish')!="") ? ('1980'==old('establish'))?'selected':'' : ''}}>1980</option>-->
<!--                    						<option value="1979" class="option" {{ (old('establish')!="") ? ('1979'==old('establish'))?'selected':'' : ''}}>1979</option>-->
<!--                    						<option value="1978" class="option" {{ (old('establish')!="") ? ('1978'==old('establish'))?'selected':'' : ''}}>1978</option>-->
<!--                    						<option value="1977" class="option" {{ (old('establish')!="") ? ('1977'==old('establish'))?'selected':'' : ''}}>1977</option>-->
<!--                    						<option value="1976" class="option" {{ (old('establish')!="") ? ('1976'==old('establish'))?'selected':'' : ''}}>1976</option>-->
<!--                    						<option value="1975" class="option" {{ (old('establish')!="") ? ('1975'==old('establish'))?'selected':'' : ''}}>1975</option>-->
<!--                    						<option value="1974" class="option" {{ (old('establish')!="") ? ('1974'==old('establish'))?'selected':'' : ''}}>1974</option>-->
<!--                    						<option value="1973" class="option" {{ (old('establish')!="") ? ('1973'==old('establish'))?'selected':'' : ''}}>1973</option>-->
<!--                    						<option value="1972" class="option" {{ (old('establish')!="") ? ('1972'==old('establish'))?'selected':'' : ''}}>1972</option>-->
<!--                    						<option value="1971" class="option" {{ (old('establish')!="") ? ('1971'==old('establish'))?'selected':'' : ''}}>1971</option>-->
<!--            							</select>-->
<!--            							<span class="help-block" id="error-establish"></span>-->
<!--                                        @if ($errors->has('establish'))-->
<!--                                           <span class="help-block"> {{ $errors->first('establish') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group"> -->
<!--                                        <p style="color:#fff;">Information About the Chief Executive/Principal/Director of the Franchise</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('owner_name') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter Your Full Name*" name="owner_name" value="{{ (old('owner_name')!="") ? old('owner_name') : '' }}" />-->
<!--                                        <span class="help-block" id="error-owner_name"></span>-->
<!--                                        @if ($errors->has('owner_name'))-->
<!--                                        <span class="help-block"> {{ $errors->first('owner_name') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}"> -->
<!--                                        <input type="email" class="form-control" placeholder="Enter Your Email*" name="email" value="{{ (old('email')!="") ? old('email') : '' }}" />-->
<!--                                        <span class="help-block" id="error-email"></span>-->
<!--                                        @if ($errors->has('email'))-->
<!--                                        <span class="help-block"> {{ $errors->first('email') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}"> -->
<!--                                        <input type="tel" class="form-control" placeholder="Enter Your Contact No.*" name="phone" value="{{ (old('phone')!="") ? old('phone') : '' }}" />-->
<!--                                        <span class="help-block" id="error-phone"></span>-->
<!--                                        @if ($errors->has('phone'))-->
<!--                                        <span class="help-block"> {{ $errors->first('phone') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}"> -->
<!--                                        <input type="password" class="form-control" placeholder="Enter Password*" name="password" value="{{ (old('password')!="") ? old('password') : '' }}" />-->
<!--                                        <span class="help-block" id="error-password"></span>-->
<!--                                        @if ($errors->has('password'))-->
<!--                                        <span class="help-block"> {{ $errors->first('password') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('confirm_password') ? ' has-error' : '' }}"> -->
<!--                                        <input type="password" class="form-control" placeholder="Confirm Your Password*" name="confirm_password" value="{{ (old('confirm_password')!="") ? old('confirm_password') : '' }}" />-->
<!--                                        <span class="help-block" id="error-confirm_password"></span>-->
<!--                                        @if ($errors->has('confirm_password'))-->
<!--                                        <span class="help-block"> {{ $errors->first('confirm_password') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('designation') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter Your Designation*" name="designation" value="{{ (old('designation')!="") ? old('designation') : '' }}" />-->
<!--                                        <span class="help-block" id="error-designation"></span>-->
<!--                                        @if ($errors->has('designation'))-->
<!--                                        <span class="help-block"> {{ $errors->first('designation') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('qualification') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter Your Qualification*" name="qualification" value="{{ (old('qualification')!="") ? old('qualification') : '' }}" />-->
<!--                                        <span class="help-block" id="error-qualification"></span>-->
<!--                                        @if ($errors->has('qualification'))-->
<!--                                        <span class="help-block"> {{ $errors->first('qualification') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('experience') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter Your Professional Experience*" name="experience" value="{{ (old('experience')!="") ? old('experience') : '' }}" />-->
<!--                                        <span class="help-block" id="error-experience"></span>-->
<!--                                        @if ($errors->has('experience'))-->
<!--                                        <span class="help-block"> {{ $errors->first('experience') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <label class="control-label col-sm-5" style="color:#fff;">Your Image</label>-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('owner_image') ? ' has-error' : '' }}">-->
<!--                                        <input type="file" class="form-control"  placeholder="Upload Image*" name="owner_image" onchange="readURL(this);">-->
<!--                                        <span class="help-block" id="error-owner_image"></span>-->
<!--                                        @if ($errors->has('owner_image'))-->
<!--                                        <span class="help-block"> {{ $errors->first('owner_image') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <label class="control-label col-sm-5" style="color:#fff;">ID Proof</label>-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('id_proof') ? ' has-error' : '' }}">-->
<!--                                        <input type="file" class="form-control"  placeholder="Upload Image*" name="id_proof" onchange="readURL(this);">-->
<!--                                        <span class="help-block" id="error-owner_image"></span>-->
<!--                                        @if ($errors->has('id_proof'))-->
<!--                                        <span class="help-block"> {{ $errors->first('id_proof') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <label class="control-label col-sm-5" style="color:#fff;">Staff Room</label>-->
                                
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('staff_room') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter No. of Rooms*" name="staff_room" value="{{ (old('staff_room')!="") ? old('staff_room') : '' }}" />-->
<!--                                        <span class="help-block" id="error-staff_room"></span>-->
<!--                                        @if ($errors->has('staff_room'))-->
<!--                                        <span class="help-block"> {{ $errors->first('staff_room') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('staff_seating') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter No. of Seating Capacity*" name="staff_seating" value="{{ (old('staff_seating')!="") ? old('staff_seating') : '' }}" />-->
<!--                                        <span class="help-block" id="error-staff_seating"></span>-->
<!--                                        @if ($errors->has('staff_seating'))-->
<!--                                        <span class="help-block"> {{ $errors->first('staff_seating') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('staff_area') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter Total Area (Sq.Ft.)*" name="staff_area" value="{{ (old('staff_area')!="") ? old('staff_area') : '' }}" />-->
<!--                                        <span class="help-block" id="error-staff_area"></span>-->
<!--                                        @if ($errors->has('staff_area'))-->
<!--                                        <span class="help-block"> {{ $errors->first('staff_area') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
                                
<!--                            </div>-->
                            
                            
                            
<!--                            <div class="row">-->
<!--                                <label class="control-label col-sm-5" style="color:#fff;">Class Room</label>-->
                                
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('class_room') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter No. of Rooms*" name="class_room" value="{{ (old('class_room')!="") ? old('class_room') : '' }}" />-->
<!--                                        <span class="help-block" id="error-class_room"></span>-->
<!--                                        @if ($errors->has('class_room'))-->
<!--                                        <span class="help-block"> {{ $errors->first('class_room') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('class_seating') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter No. of Seating Capacity*" name="class_seating" value="{{ (old('class_seating')!="") ? old('class_seating') : '' }}" />-->
<!--                                        <span class="help-block" id="error-class_seating"></span>-->
<!--                                        @if ($errors->has('class_seating'))-->
<!--                                        <span class="help-block"> {{ $errors->first('class_seating') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('class_area') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter Total Area (Sq.Ft.)*" name="class_area" value="{{ (old('class_area')!="") ? old('class_area') : '' }}" />-->
<!--                                        <span class="help-block" id="error-class_area"></span>-->
<!--                                        @if ($errors->has('class_area'))-->
<!--                                        <span class="help-block"> {{ $errors->first('class_area') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
                                
<!--                            </div>-->
                            
                            
<!--                            <div class="row">-->
<!--                                <label class="control-label col-sm-5" style="color:#fff;">Computer Lab</label>-->
                                
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('lab_room') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter No. of Rooms*" name="lab_room" value="{{ (old('lab_room')!="") ? old('lab_room') : '' }}" />-->
<!--                                        <span class="help-block" id="error-lab_room"></span>-->
<!--                                        @if ($errors->has('lab_room'))-->
<!--                                        <span class="help-block"> {{ $errors->first('lab_room') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('lab_seating') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter No. of Seating Capacity*" name="lab_seating" value="{{ (old('lab_seating')!="") ? old('lab_seating') : '' }}" />-->
<!--                                        <span class="help-block" id="error-lab_seating"></span>-->
<!--                                        @if ($errors->has('lab_seating'))-->
<!--                                        <span class="help-block"> {{ $errors->first('lab_seating') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('lab_area') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter Total Area (Sq.Ft.)*" name="lab_area" value="{{ (old('lab_area')!="") ? old('lab_area') : '' }}" />-->
<!--                                        <span class="help-block" id="error-lab_area"></span>-->
<!--                                        @if ($errors->has('lab_area'))-->
<!--                                        <span class="help-block"> {{ $errors->first('lab_area') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
                                
<!--                            </div>-->
                            
                            
                            
<!--                            <div class="row">-->
<!--                                <label class="control-label col-sm-5" style="color:#fff;">Reception</label>-->
                                
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('reception_room') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter No. of Rooms*" name="reception_room" value="{{ (old('reception_room')!="") ? old('reception_room') : '' }}" />-->
<!--                                        <span class="help-block" id="error-reception_room"></span>-->
<!--                                        @if ($errors->has('reception_room'))-->
<!--                                        <span class="help-block"> {{ $errors->first('reception_room') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('reception_seating') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter No. of Seating Capacity*" name="reception_seating" value="{{ (old('reception_seating')!="") ? old('reception_seating') : '' }}" />-->
<!--                                        <span class="help-block" id="error-reception_seating"></span>-->
<!--                                        @if ($errors->has('reception_seating'))-->
<!--                                        <span class="help-block"> {{ $errors->first('reception_seating') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('reception_area') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter Total Area (Sq.Ft.)*" name="reception_area" value="{{ (old('reception_area')!="") ? old('reception_area') : '' }}" />-->
<!--                                        <span class="help-block" id="error-reception_area"></span>-->
<!--                                        @if ($errors->has('reception_area'))-->
<!--                                        <span class="help-block"> {{ $errors->first('reception_area') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
                                
<!--                            </div>-->
                            
                            
<!--                            <div class="row">-->
<!--                                <label class="control-label col-sm-5" style="color:#fff;">Wash Room</label>-->
                                
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('wash_room') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter No. of Rooms*" name="wash_room" value="{{ (old('wash_room')!="") ? old('wash_room') : '' }}" />-->
<!--                                        <span class="help-block" id="error-wash_room"></span>-->
<!--                                        @if ($errors->has('wash_room'))-->
<!--                                        <span class="help-block"> {{ $errors->first('wash_room') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('wash_seating') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter No. of Seating Capacity*" name="wash_seating" value="{{ (old('wash_seating')!="") ? old('wash_seating') : '' }}" />-->
<!--                                        <span class="help-block" id="error-wash_seating"></span>-->
<!--                                        @if ($errors->has('wash_seating'))-->
<!--                                        <span class="help-block"> {{ $errors->first('wash_seating') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="form-group {{ $errors->has('wash_area') ? ' has-error' : '' }}"> -->
<!--                                        <input type="text" class="form-control" placeholder="Enter Total Area (Sq.Ft.)*" name="wash_area" value="{{ (old('wash_area')!="") ? old('wash_area') : '' }}" />-->
<!--                                        <span class="help-block" id="error-wash_area"></span>-->
<!--                                        @if ($errors->has('wash_area'))-->
<!--                                        <span class="help-block"> {{ $errors->first('wash_area') }} </span>-->
<!--                                        @endif-->
<!--                                    </div>-->
<!--                                </div>-->
                                
<!--                            </div>-->
                            
<!--                            <div class="row">-->
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="text-center"> -->
<!--                                        <input type="submit" value="Submit">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </form>-->
                        
<!--                        <form action="<?php echo $action; ?>" method="post" name="payuForm">-->
<!--                            @csrf-->
<!--                            <input type="hidden" name="key"  value="<?php echo $MERCHANT_KEY ?>" />-->
<!--                            <input type="hidden" name="hash" id="hash" value="<?php echo $hash ?>"/>-->
<!--                            <input type="hidden" name="txnid" id="txnid" value="<?php echo $txnid ?>" />-->
<!--                            <input type="hidden" name="amount" id="amount" value="" /><br />-->
<!--                            <input type="hidden" name="firstname" id="firstname" value="Akash Sarkar" />-->
<!--                            <input type="hidden" name="email" id="email" value="albert@yopmail.com" />-->
<!--                            <input type="hidden" name="phone" id="phone" value=""/>-->
<!--                            <input type="hidden" name="productinfo" value="Registration fee">-->
<!--                            <input type="hidden" name="surl" id="surl" value="" />-->
<!--                            <input type="hidden" name="furl" id="furl" value="" />-->
<!--                            <input type="hidden" name="service_provider" value="payu_paisa" />-->
<!--                            <?php if (!$hash) { ?>-->
<!--                                <input type="submit" value="Submit" />-->
<!--                            <?php } ?>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<!--</section>-->


<section id="home" class="divider parallax layer-overlay mt-4" data-bg-img="images/bg/bg5.jpg">
      <div class="display-table-r">
        <div class="display-table-cell-r">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-md-push-0">
                
                <div class="bg-lightest border-1px p-25">
					<div class="widget-item" style="height: auto;">
					<form class="student-log-reg-form" id="franchise-request-form" action="{{route('apply-online')}}">
					    @csrf
					    
						<div class="col-xs-12 text-center">
							<h2 class="others-courses">APPLICATION FORM <span class="theme-colour">FOR AFFILIATION</span></h2>
						</div>
						<div style="overflow-x:auto;">
						 <table class="table table-striped table-bordered">
						 
						<tr>
						    <td colspan="4"><font color="red"></font><font color="green"></font></td>
						</tr>
						<tr>
    						<td colspan="4"><h4>Information About Institution
    						<span style="color: red;font-weight: normal;">(All fields are mandatory!)</span></h4>
    						</td>
						</tr>
						
						<tr>
        					<td>Affiliation Type & Fee</td>
        					<td class="box_left2 form-group {{ $errors->has('plan_id') ? ' has-error' : '' }}" colspan="3">
        					       
        						<select name="plan_id" class="form-control" ><option value="" disabled="" selected>{{ __("Select Affiliation Plans") }}</option>
        						    @foreach($plans as $plan)
                                         <option value="{{ $plan->id }}"  {{ (old('plan_id')!="") ? ($plan->id==old('plan_id'))?'selected':'' : ''}}>{{ $plan->name }} FOR {{ ($plan->validity >= 365)? round($plan->validity/365) ." YEAR " : round($plan->validity/30) ." MONTHS " }} [ {{ ($plan->price != '')? "Rs. ".$plan->price : "FREE*" }} ]</option>
                                    @endforeach
        						</select>
        						<span class="help-block" id="error-plan_id"></span>
                                @if ($errors->has('plan_id'))
                                   <span class="help-block"> {{ $errors->first('plan_id') }} </span>
                                @endif
        					</td> 
						</tr>
								
						<tr>
    						<td>Institute Name</td>
    						<td class="box_left2 form-group {{ $errors->has('name') ? ' has-error' : '' }}" colspan="3">
    						    <input type="text" class="form-control"  name="name" value="{{ (old('name')!="") ? old('name') : '' }}"   oninput="this.value = this.value.toUpperCase()"/>
    						    <span class="help-block" id="error-name"></span>
                                @if ($errors->has('name'))
                                   <span class="help-block"> {{ $errors->first('name') }} </span>
                                @endif
    						</td>
						</tr>
						
						<tr>
    						<td>Institute Image</td>
    						<td class="box_left2 form-group {{ $errors->has('image') ? ' has-error' : '' }}" colspan="3">
    						    <input type="file" class="form-control"   name="image" onchange="readURL(this);">
                                <span class="help-block" id="error-image"></span>
                                @if ($errors->has('image'))
                                <span class="help-block"> {{ $errors->first('image') }} </span>
                                @endif
    						</td>
						</tr>
						<tr>
    						<td>Institute Address</td>
    						<td class="box_left2 form-group {{ $errors->has('address') ? ' has-error' : '' }}" colspan="3">
    						    <input type="text" class="form-control"  name="address" value="{{ (old('address')!="") ? old('address') : '' }}"   oninput="this.value = this.value.toUpperCase()"/>
    						    <span class="help-block" id="error-address"></span>
                                @if ($errors->has('address'))
                                   <span class="help-block"> {{ $errors->first('address') }} </span>
                                @endif
    						</td>
						</tr>
						
						<tr>
    						<td>City</td>
    						<td class="box_left2 form-group {{ $errors->has('city') ? ' has-error' : '' }}" colspan="3">
    						    <input type="text" class="form-control" name="city"  value="{{ (old('city')!="") ? old('city') : '' }}"  oninput="this.value = this.value.toUpperCase()" />
						        <span class="help-block" id="error-city"></span>
                                @if ($errors->has('city'))
                                   <span class="help-block"> {{ $errors->first('city') }} </span>
                                @endif
						    </td>
						</tr>
						
						<tr>
    						<td>Post Office Address</td>
    						<td class="box_left2 form-group {{ $errors->has('post_office') ? ' has-error' : '' }}" colspan="3">
    						    <input type="text" class="form-control" name="post_office"  value="{{ (old('post_office')!="") ? old('post_office') : '' }}"  oninput="this.value = this.value.toUpperCase()" />
						        <span class="help-block" id="error-post_office"></span>
                                @if ($errors->has('post_office'))
                                   <span class="help-block"> {{ $errors->first('post_office') }} </span>
                                @endif
						    </td>
						</tr>
						
						<tr>
						    <td>District</td>
						    <td class="form-group {{ $errors->has('district') ? ' has-error' : '' }}">
						        <input type="text" class="form-control" name="district" value="{{ (old('district')!="") ? old('district') : '' }}"   oninput="this.value = this.value.toUpperCase()"/>
						        <span class="help-block" id="error-district"></span>
                                @if ($errors->has('district'))
                                   <span class="help-block"> {{ $errors->first('district') }} </span>
                                @endif
						    </td>
						    
						    <td>State</td>
        					<td class="form-group {{ $errors->has('state') ? ' has-error' : '' }}">
        					    <select name="state" class="form-control" ><option value="" disabled selected>Select State</option>
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
        					</td>
						</tr>
						<tr>
    						<td>Pin</td>
    						<td class="form-group {{ $errors->has('pin') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="pin"  value="{{ (old('district')!="") ? old('district') : '' }}"  />
    						    <span class="help-block" id="error-pin"></span>
                                @if ($errors->has('pin'))
                                   <span class="help-block"> {{ $errors->first('pin') }} </span>
                                @endif
    						</td>
    						
    						<td>Country</td>
    						<td class="form-group {{ $errors->has('country') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="country"  value="INDIA"  oninput="this.value = this.value.toUpperCase()"/>
    						    <span class="help-block" id="error-country"></span>
                                @if ($errors->has('country'))
                                   <span class="help-block"> {{ $errors->first('country') }} </span>
                                @endif
    						</td>
						</tr>
						<tr>
    						<td>Mobile</td>
    						<td>
    							<div class="input-group form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
    								<input type="text" class="form-control"  name="phone" placeholder="Max 10 Digit"  value="{{ (old('phone')!="") ? old('phone') : '' }}"  />
    								<span class="help-block" id="error-phone"></span>
                                    @if ($errors->has('phone'))
                                       <span class="help-block"> {{ $errors->first('phone') }} </span>
                                    @endif
    							</div>
    						</td>
    						
    						<td>Email</td>
    						<td class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
    						    <input type="email" class="form-control"  name="email"  value="{{ (old('phone')!="") ? old('phone') : '' }}"   oninput="this.value = this.value.toUpperCase()"/>
    						    <span class="help-block" id="error-email"></span>
                                @if ($errors->has('email'))
                                   <span class="help-block"> {{ $errors->first('email') }} </span>
                                @endif
    						</td>
						</tr>
						<tr>
						
        					<td>Year of Establishment</td>
        					<td>
        						<div class="input-group form-group {{ $errors->has('establish') ? ' has-error' : '' }}">
        							<select name="establish" class="form-control" ><option disabled selected>Select Year</option>
                                        <option value="2022" class="option" {{ (old('establish')!="") ? ('2022'==old('establish'))?'selected':'' : ''}}>2022</option>
                                        <option value="2021" class="option" {{ (old('establish')!="") ? ('2021'==old('establish'))?'selected':'' : ''}}>2021</option>
        								<option value="2020" class="option" {{ (old('establish')!="") ? ('2020'==old('establish'))?'selected':'' : ''}}>2020</option>
                						<option value="2019" class="option" {{ (old('establish')!="") ? ('2019'==old('establish'))?'selected':'' : ''}}>2019</option>
                						<option value="2018" class="option" {{ (old('establish')!="") ? ('2018'==old('establish'))?'selected':'' : ''}}>2018</option>
                						<option value="2017" class="option" {{ (old('establish')!="") ? ('2017'==old('establish'))?'selected':'' : ''}}>2017</option>
                						<option value="2016" class="option" {{ (old('establish')!="") ? ('2016'==old('establish'))?'selected':'' : ''}}>2016</option>
                						<option value="2015" class="option" {{ (old('establish')!="") ? ('2015'==old('establish'))?'selected':'' : ''}}>2015</option>
                						<option value="2014" class="option" {{ (old('establish')!="") ? ('2014'==old('establish'))?'selected':'' : ''}}>2014</option>
                						<option value="2013" class="option" {{ (old('establish')!="") ? ('2013'==old('establish'))?'selected':'' : ''}}>2013</option>
                						<option value="2012" class="option" {{ (old('establish')!="") ? ('2012'==old('establish'))?'selected':'' : ''}}>2012</option>
                						<option value="2011" class="option" {{ (old('establish')!="") ? ('2011'==old('establish'))?'selected':'' : ''}}>2011</option>
                						<option value="2010" class="option" {{ (old('establish')!="") ? ('2010'==old('establish'))?'selected':'' : ''}}>2010</option>
                						<option value="2009" class="option" {{ (old('establish')!="") ? ('2009'==old('establish'))?'selected':'' : ''}}>2009</option>
                						<option value="2008" class="option" {{ (old('establish')!="") ? ('2008'==old('establish'))?'selected':'' : ''}}>2008</option>
                						<option value="2007" class="option" {{ (old('establish')!="") ? ('2007'==old('establish'))?'selected':'' : ''}}>2007</option>
                						<option value="2006" class="option" {{ (old('establish')!="") ? ('2006'==old('establish'))?'selected':'' : ''}}>2006</option>
                						<option value="2005" class="option" {{ (old('establish')!="") ? ('2005'==old('establish'))?'selected':'' : ''}}>2005</option>
                						<option value="2004" class="option" {{ (old('establish')!="") ? ('2004'==old('establish'))?'selected':'' : ''}}>2004</option>
                						<option value="2003" class="option" {{ (old('establish')!="") ? ('2003'==old('establish'))?'selected':'' : ''}}>2003</option>
                						<option value="2002" class="option" {{ (old('establish')!="") ? ('2002'==old('establish'))?'selected':'' : ''}}>2002</option>
                						<option value="2001" class="option" {{ (old('establish')!="") ? ('2001'==old('establish'))?'selected':'' : ''}}>2001</option>
                						<option value="2000" class="option" {{ (old('establish')!="") ? ('2000'==old('establish'))?'selected':'' : ''}}>2000</option>
                						<option value="1999" class="option" {{ (old('establish')!="") ? ('1999'==old('establish'))?'selected':'' : ''}}>1999</option>
                						<option value="1998" class="option" {{ (old('establish')!="") ? ('1998'==old('establish'))?'selected':'' : ''}}>1998</option>
                						<option value="1997" class="option" {{ (old('establish')!="") ? ('1997'==old('establish'))?'selected':'' : ''}}>1997</option>
                						<option value="1996" class="option" {{ (old('establish')!="") ? ('1996'==old('establish'))?'selected':'' : ''}}>1996</option>
                						<option value="1995" class="option" {{ (old('establish')!="") ? ('1995'==old('establish'))?'selected':'' : ''}}>1995</option>
                						<option value="1994" class="option" {{ (old('establish')!="") ? ('1994'==old('establish'))?'selected':'' : ''}}>1994</option>
                						<option value="1993" class="option" {{ (old('establish')!="") ? ('1993'==old('establish'))?'selected':'' : ''}}>1993</option>
                						<option value="1992" class="option" {{ (old('establish')!="") ? ('1992'==old('establish'))?'selected':'' : ''}}>1992</option>
                						<option value="1991" class="option" {{ (old('establish')!="") ? ('1991'==old('establish'))?'selected':'' : ''}}>1991</option>
                						<option value="1990" class="option" {{ (old('establish')!="") ? ('1990'==old('establish'))?'selected':'' : ''}}>1990</option>
                						<option value="1989" class="option" {{ (old('establish')!="") ? ('1989'==old('establish'))?'selected':'' : ''}}>1989</option>
                						<option value="1988" class="option" {{ (old('establish')!="") ? ('1988'==old('establish'))?'selected':'' : ''}}>1988</option>
                						<option value="1987" class="option" {{ (old('establish')!="") ? ('1987'==old('establish'))?'selected':'' : ''}}>1987</option>
                						<option value="1986" class="option" {{ (old('establish')!="") ? ('1986'==old('establish'))?'selected':'' : ''}}>1986</option>
                						<option value="1985" class="option" {{ (old('establish')!="") ? ('1985'==old('establish'))?'selected':'' : ''}}>1985</option>
                						<option value="1984" class="option" {{ (old('establish')!="") ? ('1984'==old('establish'))?'selected':'' : ''}}>1984</option>
                						<option value="1983" class="option" {{ (old('establish')!="") ? ('1983'==old('establish'))?'selected':'' : ''}}>1983</option>
                						<option value="1982" class="option" {{ (old('establish')!="") ? ('1982'==old('establish'))?'selected':'' : ''}}>1982</option>
                						<option value="1981" class="option" {{ (old('establish')!="") ? ('1981'==old('establish'))?'selected':'' : ''}}>1981</option>
                						<option value="1980" class="option" {{ (old('establish')!="") ? ('1980'==old('establish'))?'selected':'' : ''}}>1980</option>
                						<option value="1979" class="option" {{ (old('establish')!="") ? ('1979'==old('establish'))?'selected':'' : ''}}>1979</option>
                						<option value="1978" class="option" {{ (old('establish')!="") ? ('1978'==old('establish'))?'selected':'' : ''}}>1978</option>
                						<option value="1977" class="option" {{ (old('establish')!="") ? ('1977'==old('establish'))?'selected':'' : ''}}>1977</option>
                						<option value="1976" class="option" {{ (old('establish')!="") ? ('1976'==old('establish'))?'selected':'' : ''}}>1976</option>
                						<option value="1975" class="option" {{ (old('establish')!="") ? ('1975'==old('establish'))?'selected':'' : ''}}>1975</option>
                						<option value="1974" class="option" {{ (old('establish')!="") ? ('1974'==old('establish'))?'selected':'' : ''}}>1974</option>
                						<option value="1973" class="option" {{ (old('establish')!="") ? ('1973'==old('establish'))?'selected':'' : ''}}>1973</option>
                						<option value="1972" class="option" {{ (old('establish')!="") ? ('1972'==old('establish'))?'selected':'' : ''}}>1972</option>
                						<option value="1971" class="option" {{ (old('establish')!="") ? ('1971'==old('establish'))?'selected':'' : ''}}>1971</option>
        							</select>
        							
        							<span class="help-block" id="error-establish"></span>
                                    @if ($errors->has('establish'))
                                       <span class="help-block"> {{ $errors->first('establish') }} </span>
                                    @endif
        						</div>
        					</td>
						</tr>
						<tr>
    						<td>Password</td>
    						<td>
    							<div class="input-group form-group {{ $errors->has('password') ? ' has-error' : '' }}">
    								<input type="password" class="form-control" name="password" value="{{ (old('password')!="") ? old('password') : '' }}" />
    								<span class="help-block" id="error-password"></span>
                                    @if ($errors->has('password'))
                                       <span class="help-block"> {{ $errors->first('password') }} </span>
                                    @endif
    							</div>
    						</td>
    						
    						<td>Confirm Password</td>
    						<td class="form-group {{ $errors->has('confirm_password') ? ' has-error' : '' }}">
    						    <input type="password" class="form-control" name="confirm_password" value="{{ (old('confirm_password')!="") ? old('confirm_password') : '' }}" />
    						    <span class="help-block" id="error-confirm_password"></span>
                                @if ($errors->has('confirm_password'))
                                   <span class="help-block"> {{ $errors->first('confirm_password') }} </span>
                                @endif
    						</td>
						</tr>
						<tr>
						    <td colspan="4"><h3>Information About the Chief Executive/Principal/Director of the Institute</h3></td>
						</tr>
						<tr>
    						<td>Name</td>
    						<td class="form-group {{ $errors->has('owner_name') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control"  name="owner_name" value="{{ (old('owner_name')!="") ? old('owner_name') : '' }}"   oninput="this.value = this.value.toUpperCase()" />
    						    <span class="help-block" id="error-owner_name"></span>
                                @if ($errors->has('owner_name'))
                                   <span class="help-block"> {{ $errors->first('owner_name') }} </span>
                                @endif
    						</td>
						
    						<td class="box_left1">Photo</td>
    						<td class="box_left2 form-group {{ $errors->has('owner_image') ? ' has-error' : '' }}" colspan="3">
    						    <input type="file" class="form-control"   name="owner_image" onchange="readURL(this);">
                                <span class="help-block" id="error-owner_image"></span>
                                @if ($errors->has('owner_image'))
                                <span class="help-block"> {{ $errors->first('owner_image') }} </span>
                                @endif
    						</td>
						</tr>
						<tr>
    						<td>Designation/Position</td>
    						<td class="form-group {{ $errors->has('designation') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="designation" value="{{ (old('designation')!="") ? old('designation') : '' }}"   oninput="this.value = this.value.toUpperCase()" />
    						    <span class="help-block" id="error-designation"></span>
                                @if ($errors->has('designation'))
                                   <span class="help-block"> {{ $errors->first('designation') }} </span>
                                @endif
    						</td>
    						
    						<td>Education Qualifiation</td>
    						<td class="form-group {{ $errors->has('qualification') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="qualification" value="{{ (old('qualification')!="") ? old('qualification') : '' }}"   oninput="this.value = this.value.toUpperCase()" />
    						    <span class="help-block" id="error-qualification"></span>
                                @if ($errors->has('qualification'))
                                   <span class="help-block"> {{ $errors->first('qualification') }} </span>
                                @endif
    						</td>
						</tr>
						<tr>
    						<td>Professional Experience</td>
    						<td class="form-group {{ $errors->has('experience') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="experience" value="{{ (old('experience')!="") ? old('experience') : '' }}"   oninput="this.value = this.value.toUpperCase()" />
    						    <span class="help-block" id="error-experience"></span>
                                @if ($errors->has('experience'))
                                   <span class="help-block"> {{ $errors->first('experience') }} </span>
                                @endif
    						</td>
    						
    						<td class="box_left1">ID Proof</td>
    						<td class="box_left2 form-group {{ $errors->has('id_proof') ? ' has-error' : '' }}" colspan="3">
    						    <input type="file" class="form-control"   name="id_proof" onchange="readURL(this);">
                                <span class="help-block" id="error-id_proof"></span>
                                @if ($errors->has('id_proof'))
                                <span class="help-block"> {{ $errors->first('id_proof') }} </span>
                                @endif
    						</td>
						
						</tr>
						
						<tr>
						    <td colspan="4"><h3>Infrastructure Facility</h3></td>
						</tr>
						<tr>
    						<td><strong>PARTICULARS</strong></td>
    						<td><strong>NO.OF ROOMS</strong></td>
    						<td><strong>SEATING CAPACITY</strong></td>
    						<td><strong>TOTAL AREA (Sq.Ft.)</strong></td>
						</tr>
						<tr>
    						<td>Staff Room</td>
    						<td class="form-group {{ $errors->has('staff_room') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="staff_room"  value="{{ (old('staff_room')!="") ? old('staff_room') : '' }}" />
    						    <span class="help-block" id="error-staff_room"></span>
                                @if ($errors->has('staff_room'))
                                   <span class="help-block"> {{ $errors->first('staff_room') }} </span>
                                @endif
    						</td>
    						<td class="form-group {{ $errors->has('staff_seating') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="staff_seating"  value="{{ (old('staff_seating')!="") ? old('staff_seating') : '' }}" />
    						    <span class="help-block" id="error-staff_seating"></span>
                                @if ($errors->has('staff_seating'))
                                   <span class="help-block"> {{ $errors->first('staff_seating') }} </span>
                                @endif
    						</td>
    						<td class="form-group {{ $errors->has('staff_area') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="staff_area"  value="{{ (old('staff_area')!="") ? old('staff_area') : '' }}" />
    						    <span class="help-block" id="error-staff_area"></span>
                                @if ($errors->has('staff_area'))
                                   <span class="help-block"> {{ $errors->first('staff_area') }} </span>
                                @endif
    						</td>
						</tr>
						<tr>
    						<td>Class Room</td>
    						<td class="form-group {{ $errors->has('class_room') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="class_room"  value="{{ (old('class_room')!="") ? old('class_room') : '' }}" />
    						    <span class="help-block" id="error-class_room"></span>
                                @if ($errors->has('class_room'))
                                   <span class="help-block"> {{ $errors->first('class_room') }} </span>
                                @endif
    						</td>
    						<td class="form-group {{ $errors->has('class_seating') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="class_seating"  value="{{ (old('class_seating')!="") ? old('class_seating') : '' }}" />
    						    <span class="help-block" id="error-class_seating"></span>
                                @if ($errors->has('class_seating'))
                                   <span class="help-block"> {{ $errors->first('class_seating') }} </span>
                                @endif
    						</td>
    						<td class="form-group {{ $errors->has('class_area') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="class_area"  value="{{ (old('class_area')!="") ? old('class_area') : '' }}" />
    						    <span class="help-block" id="error-class_area"></span>
                                @if ($errors->has('class_area'))
                                   <span class="help-block"> {{ $errors->first('class_area') }} </span>
                                @endif
    						</td>
    						
    					</tr>
						<tr>
    						<td>Computer Lab</td>
    						<td class="form-group {{ $errors->has('lab_room') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="lab_room"  value="{{ (old('lab_room')!="") ? old('lab_room') : '' }}" />
    						    <span class="help-block" id="error-lab_room"></span>
                                @if ($errors->has('lab_room'))
                                   <span class="help-block"> {{ $errors->first('lab_room') }} </span>
                                @endif
    						</td>
    						<td class="form-group {{ $errors->has('lab_seating') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="lab_seating"  value="{{ (old('lab_seating')!="") ? old('lab_seating') : '' }}" />
    						    <span class="help-block" id="error-lab_seating"></span>
                                @if ($errors->has('lab_seating'))
                                   <span class="help-block"> {{ $errors->first('lab_seating') }} </span>
                                @endif
    						</td>
    						<td class="form-group {{ $errors->has('lab_area') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="lab_area"  value="{{ (old('lab_area')!="") ? old('lab_area') : '' }}" />
    						    <span class="help-block" id="error-lab_area"></span>
                                @if ($errors->has('lab_area'))
                                   <span class="help-block"> {{ $errors->first('lab_area') }} </span>
                                @endif
    						</td>
						</tr>
						<tr>
    						<td>Reception</td>
    						<td class="form-group {{ $errors->has('reception_room') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="reception_room"  value="{{ (old('reception_room')!="") ? old('reception_room') : '' }}" />
    						    <span class="help-block" id="error-reception_room"></span>
                                @if ($errors->has('reception_room'))
                                   <span class="help-block"> {{ $errors->first('reception_room') }} </span>
                                @endif
    						</td>
    						<td class="form-group {{ $errors->has('reception_seating') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="reception_seating"  value="{{ (old('reception_seating')!="") ? old('reception_seating') : '' }}" />
    						    <span class="help-block" id="error-reception_seating"></span>
                                @if ($errors->has('reception_seating'))
                                   <span class="help-block"> {{ $errors->first('reception_seating') }} </span>
                                @endif
    						</td>
    						<td class="form-group {{ $errors->has('reception_area') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="reception_area"  value="{{ (old('reception_area')!="") ? old('reception_area') : '' }}" />
    						    <span class="help-block" id="error-reception_area"></span>
                                @if ($errors->has('reception_area'))
                                   <span class="help-block"> {{ $errors->first('reception_area') }} </span>
                                @endif
    						</td>
				    	</tr>
						<tr>
    						<td>Wash Room</td>
    						<td class="form-group {{ $errors->has('wash_room') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="wash_room"  value="{{ (old('wash_room')!="") ? old('wash_room') : '' }}" />
    						    <span class="help-block" id="error-wash_room"></span>
                                @if ($errors->has('wash_room'))
                                   <span class="help-block"> {{ $errors->first('wash_room') }} </span>
                                @endif
    						</td>
    						<td class="form-group {{ $errors->has('wash_seating') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="wash_seating"  value="{{ (old('wash_seating')!="") ? old('wash_seating') : '' }}" />
    						    <span class="help-block" id="error-wash_seating"></span>
                                @if ($errors->has('wash_seating'))
                                   <span class="help-block"> {{ $errors->first('wash_seating') }} </span>
                                @endif
    						</td>
    						<td class="form-group {{ $errors->has('wash_area') ? ' has-error' : '' }}">
    						    <input type="text" class="form-control" name="wash_area"  value="{{ (old('wash_area')!="") ? old('wash_area') : '' }}" />
    						    <span class="help-block" id="error-wash_area"></span>
                                @if ($errors->has('wash_area'))
                                   <span class="help-block"> {{ $errors->first('wash_area') }} </span>
                                @endif
    						</td>
						</tr>
						
						
						<tr>
						 <td colspan="2">
						 <input type="submit" id="send" value="SUBMIT" class="btn btn-effect btn-info" style="float: right;"/>
						 </td>
						 
						</tr>
						</table>
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
          </div>
        </div>
      </div>
    </section>
<!----------------------------------Main content End--------------------------->

@stop
@section('js')
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
@stop
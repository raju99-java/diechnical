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
    'productinfo' => 'Course fee',
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
        <span class="active">Assign Course</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Assign course Student of {{$user->full_name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                 
               
                <form id="assign_course" method="post" action="{{route('franchise-student-assign-course',['id'=>$id])}}" class="form-horizontal" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    
                
                 @if($course == '1')
                    <!-- admin courses section -->
                    <div class="form-body desc" id="course1">
                        <div class="form-group {{ $errors->has('running_course') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Assign Course<span class="required">*</span></label>
                            <div class="col-md-10">
                                <select id="select1"  name="running_course"  class="form-control" >
                                    <option value="" disabled="" selected>{{ __("Select Course of Admin") }}</option>
                                    @foreach($courses as $course)
                                      <option value="{{ $course->id }}"  {{ (old('running_course')!="") ? ($course->id==old('running_course'))?'selected':'' : ''}}>{{ $course->name }}{{" - Rs: "}}{{ $amount }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block" id="error-running_course"></span>
                                @if ($errors->has('running_course'))
                                <span class="help-block"> {{ $errors->first('running_course') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('created_at') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Assign Date</label>
                            <div class="col-md-10">
                                <input type="date" class="form-control" placeholder="Assign Date" id="created_at" name="created_at" value="{{ (old('created_at')!="") ? old('created_at') : '' }}"/>
                                <span class="help-block" id="error-created_at"></span>    
                                    @if ($errors->has('created_at'))
                                       <span class="help-block"> {{ $errors->first('created_at') }} </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('wallet') ? ' has-error' : '' }}">
                            <label class="control-label col-md-5">Payment through Wallet <span class="required">*</span></label>
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
                    <!-- end admin courses section -->
                @endif
                
                @if($course == '2')
                    <!-- alc courses section -->
                    <div class="form-body desc" id="course2" >
                        <div class="form-group {{ $errors->has('running_course') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Assign Course<span class="required">*</span></label>
                            <div class="col-md-10">
                                <select id="select1"  name="running_course"  class="form-control" >
                                    <option value="" disabled="" selected>{{ __("Select Course of ALC") }}</option>
                                    @foreach($franchise_courses as $course)
                                      <option value="{{ $course->id }}"  {{ (old('running_course')!="") ? ($course->id==old('running_course'))?'selected':'' : ''}}>{{ $course->name }}{{" - Rs: "}}{{ $amount }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block" id="error-running_course"></span>
                                @if ($errors->has('running_course'))
                                <span class="help-block"> {{ $errors->first('running_course') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('created_at') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Assign Date</label>
                            <div class="col-md-10">
                                <input type="date" class="form-control" placeholder="Assign Date" id="created_at" name="created_at" value="{{ (old('created_at')!="") ? old('created_at') : '' }}"/>
                                <span class="help-block" id="error-created_at"></span>  
                                    @if ($errors->has('created_at'))
                                       <span class="help-block"> {{ $errors->first('created_at') }} </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('wallet') ? ' has-error' : '' }}">
                            <label class="control-label col-md-5">Payment through Wallet <span class="required">*</span></label>
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
                    <!-- end alc courses section -->
                @endif
                  
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{Route('franchise-students')}}" class="btn btn-primary">Cancel</a>
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
                    <input type="hidden" name="productinfo" value="Course fee">
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
@endsection

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

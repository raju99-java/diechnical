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

<?php
use App\Model\Franchise;

$id=Auth()->guard('franchise')->user()->id;
$franchise = Franchise::where('id','=',$id)->first();
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
    @if($franchise->days_left > '3')
        <li>
            <span class="active">Upgrade Plans</span>
        </li>
    @else
        <li>
            <span class="active">Renew Plans</span>
        </li>
    @endif
    
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus font-red-sunglo"></i>
                    @if($franchise->days_left > '3')
                        <span class="caption-subject font-red-sunglo bold uppercase">Upgrade Plans</span>
                    @else
                        <span class="caption-subject font-red-sunglo bold uppercase">Renew Plans</span>
                    @endif
                    
                </div>
            </div>
            <div class="portlet-body form">
                <form id="renew-plan-form" method="post" action="{{route('franchise-renew-plan')}}" class="form-horizontal" enctype='multipart/form-data'>
                    
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->has('plan_id') ? ' has-error' : '' }}"> 
                                <select name="plan_id" class="form-control" ><option disabled selected>Affiliation Type & Fee*</option>
    								@foreach($plans as $plan)
    								    @if($plan->price > 0)
                                         <option value="{{ $plan->id }}"  {{ (old('plan_id')!="") ? ($plan->id==old('plan_id'))?'selected':'' : ''}}>{{ $plan->name }} FOR {{ ($plan->validity >= 365)? round($plan->validity/365) ." YEAR " : round($plan->validity/30) ." MONTHS " }} [ {{ "Rs. ".$plan->price }} ]</option>
                                        @endif
                                    @endforeach
    							</select>
    							<span class="help-block" id="error-plan_id"></span>
                                @if ($errors->has('plan_id'))
                                   <span class="help-block"> {{ $errors->first('plan_id') }} </span>
                                @endif
                            </div>
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
                        
                        
                        
                    
                    <div class="form-actions">
                        <div class="row">
                            <div class="offset-md-3 col-md-9">
                                <a href="{{Route('franchise-dashboard')}}" class="btn btn-primary">Cancel</a>
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
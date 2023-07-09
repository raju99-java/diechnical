<?php

$PAYU_BASE_URL = $BASE_URL;
$action = '';
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$posted = array();
$posted = array(
    'key' => $MERCHANT_KEY,
    'txnid' => $txnid,
    'amount' => $element->price,
    'firstname' => 'Akash Sarkar',
    'email' => 'albert@yopmail.com',
    'productinfo' => 'Element purchase',
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
        <a href="{{Route('franchise-elements')}}">Element Lists</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Purchase</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Purchase Element of {{$element->name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="element-purchase" method="post" action="{{route('franchise-element-purchase',['id'=>$id])}}" class="form-horizontal" enctype="multipart/form-data">
                    @method('PUT')
                    {{csrf_field()}}
                    <input type="hidden" id="element_id" name="element_id" value="{{ $element->id }}">
                    <input type="hidden" id="franchise_id" name="franchise_id" value="{{ $franchise_id }}">
                    <div class="form-body">
                        
                        <div class="form-group">
                            <div class="col-md-10 text-center">
                                
                                <img src="{{ (isset($element->image)) ? URL::asset('public/uploads/element/' . $element->image) : URL::asset('public/backend/no-image.png') }}" style="max-width: 400;max-height: 200px">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-10 text-center">
                                <label class="control-label col-md-3">Element Name : {{ (isset($element->name)) ? $element->name : 'NA' }}</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-10 text-center">
                                <label class="control-label col-md-3">Element Desc : {{ (isset($element->description)) ? $element->description : 'NA' }}</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-10 text-center">
                                <label class="control-label col-md-3">Element Price : ₹ {{ (isset($element->price)) ? $element->price : '0' }}</label>
                                <input type="hidden" id="pay_amount" name="pay_amount" value="{{ $element->price }}">
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('wallet') ? ' has-error' : '' }}">
                            
                            <div class="col-md-10 text-center">
                                <label class="control-label col-md-3">Payment through Wallet <span class="required">*</span></label>
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="wallet" value="1" > Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="wallet" value="0" > No
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
                            <div class="col-md-10 text-center">
                                <a href="{{Route('franchise-elements')}}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn green"> Order Now</button>
                            </div>
                        </div>
                    </div>
                </form>
                
                <form action="<?php echo $action; ?>" method="post" name="payuForm">
                    @csrf
                    <input type="hidden" name="key"  value="<?php echo $MERCHANT_KEY ?>" />
                    <input type="hidden" name="hash" id="hash" value="<?php echo $hash ?>"/>
                    <input type="hidden" name="txnid" id="txnid" value="<?php echo $txnid ?>" />
                    <input type="hidden" name="amount" id="amount" value="{{$element->price}}" /><br />
                    <input type="hidden" name="firstname" id="firstname" value="Akash Sarkar" />
                    <input type="hidden" name="email" id="email" value="albert@yopmail.com" />
                    <input type="hidden" name="phone" id="phone" value=""/>
                    <input type="hidden" name="productinfo" value="Element purchase">
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
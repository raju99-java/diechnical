<?php
$PAYU_BASE_URL = $BASE_URL;
$action = '';
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$posted = array();
$posted = array(
    'key' => $MERCHANT_KEY,
    'txnid' => $txnid,
    'amount' => $totalprice,
    'firstname' => Auth()->guard('frontend')->user()->full_name,
    'email' => Auth()->guard('frontend')->user()->email,
    'productinfo' => 'Course Buy',
    'surl' => Route('dopayment'),
    'furl' => Route('cancel-payment'),
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
//  print_r('100');exit;
?>
@extends('layouts.main') 
@section('css')
<style>

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
                        <h2>Checkout</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="{{route('/')}}">HOME</a>/</li>
                            <li><span>Checkout</span></li>
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
    <section class="checkout pt-5 pb-5"> 
        <div class="container">
            <form id="check-out-form" action="{{Route('checkout')}}" method="POST" class="">
                @csrf
                
                <div class="checkout-bg-outline">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="shippings">    
                                <h2 class="bill-address">Billing Information :</h2>  
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Your Name" type="text" name="full_name" id="full_name" value="{{Auth()->guard('frontend')->user()->full_name}}">
                                            <div class="help-block" id="error-full_name"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Email Address" type="email" name="email" id="email" value="{{Auth()->guard('frontend')->user()->email}}">
                                            <div class="help-block" id="error-email"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Phone Number" type="tel" name="phone" id="phone" value="{{isset(Auth()->guard('frontend')->user()->phone)?Auth()->guard('frontend')->user()->phone:''}}">
                                            <div class="help-block" id="error-phone"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 billing">
                            <div class="Yorder">
                                <h4 class="bill-address-you">Your order</h4>
                                <table style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th class="product-name">COURSE DETAILS</th>
                                            <th class="product-total">SUBTOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $total=0;
                                        @endphp
                                        @CSRF
                                        @forelse($carts as $cart)
                                        @php
                                        $total+=($cart->course->price);

                                        @endphp
                                        <tr>
                                            <td class="check-td">Course Name:<br>{{$cart->course->name}}</td>
                                            <td class="check-tds"><i class="fa fa-inr" aria-hidden="true"></i>{{$cart->course->price}}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="total">TOTAL</td>
                                            <td class="total-amount"><i class="fa fa-inr" aria-hidden="true"></i>{{$total}}</td>
                                        </tr>

                                    </tbody>
                                </table><br>
                                <div>
                                    <input type="radio" name="dbt" value="cd" checked=""> Payumoney
                                </div>
                                <div class="place-button text-center">

                                    <a href="javascript:void(0)"><button type="submit" class="btn place-order" id="checkout_submit">Place Order</button>
                                    </a>
                                </div>

                            </div><!-- Yorder -->
                        </div>  
                    </div>
                </div>
            </form>  
            <form action="<?php echo $action; ?>" method="post" name="payuForm">
                @csrf
                <input type="hidden" name="key"  value="<?php echo $MERCHANT_KEY ?>" />
                <input type="hidden" name="hash" id="hash" value="<?php echo $hash ?>"/>
                <input type="hidden" name="txnid" id="txnid" value="<?php echo $txnid ?>" />
                <input type="hidden" name="amount" value="{{$totalprice}}" /><br />
                <input type="hidden" name="firstname" id="firstname" value="{{Auth()->guard('frontend')->user()->full_name}}" />
                <input type="hidden" name="email" id="email" value="{{Auth()->guard('frontend')->user()->email}}" />
                <input type="hidden" name="phone" id="phone" value="{{Auth()->guard('frontend')->user()->phone}}"/>
                <input type="hidden" name="productinfo" value="Course Buy">
                <input type="hidden" name="surl" id="surl" value="{{route('dopayment')}}" />
                <input type="hidden" name="furl" id="furl" value="{{route('cancel-payment')}}" />
                <input type="hidden" name="service_provider" value="payu_paisa" />
                <?php if (!$hash) { ?>
                    <input type="submit" value="Submit" />
                <?php } ?>
            </form>

        </div>     
    </section> 
</section>
<!----------------------------------Main content End--------------------------->



<!--End Checkout-->




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

@endsection
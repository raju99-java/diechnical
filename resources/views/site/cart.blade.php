@extends('layouts.main') 
@section('css')
<style>
    .cardss {
        margin: 2rem 0rem 2rem;
    }
    table.table.table-bordered {
        box-shadow: none;
    }
    .table thead th {
        vertical-align: bottom;
        border-top: none;
        border-right: none;
        border-left: none;
        border-bottom: 2px solid #dee2e6;
        color: #6f6f71;
        font-weight: 500;
    }

    .table-bordered th, .table-bordered td {
        border-bottom: 1px solid #dee2e6;
        border-top: none;
        border-right: none;
        border-left: none;
        color: #6f6f71;
    }
    .coupon label {
        display: none;
    }

    .coupon .input-text {
        max-width: 300px;
        margin-right: 10px;
    }

    input[type=text], input[type=email], input[type=url], input[type=password], input[type=number], input[type=date], input[type=tel], select, textarea {
        width: 100%;
        height: 40px;
        border: 1px solid rgba(129,129,129,.25);
        font-size: 14px;
        line-height: 18px;
        padding: 0 10px;
        transition: border-color .5s;
        box-shadow: none;
        border-radius: 0;
    }

    button.button {
        border-color: #000000;
        background-color: #000000;
        padding-left: 30px;
        padding-right: 30px;
        color: #fff;
        height: 40px;
    }

    .delivery-box {
        background-color: #f7f7f7;
        padding: 5px 10px;
        border-radius: 2px;
        border: 2px dashed #e9e9e9;
        margin: 10px 0px;
        display: block;
        clear: both;
    }

    .wc-delivery-button {
        background: #ECECEC;
        color: black;
        padding: 8.9px;
        line-height: 42px;
    }

    .billing {
        background: #f6f6f6;
        padding-bottom: 16px;
        margin-bottom: 35px;
    }

    .Yorder {
        margin-top: 15px;
        height: auto;
        padding: 20px;
        border: 1px solid #dadada;
    }
    .Yorder {
        flex: 2;
    }

    .bill-address-you {
        font-weight: 700;
        color: black;
        font-size: 22px;
        margin-left: 12px;
        text-align: center;
    }

    table {
        margin: 0;
        padding: 0;
    }

    th{
        border-bottom: 1px solid #dadada;
        padding: 10px 0;
    }
    tr>td:nth-child(1){
        text-align: left;
        color: #2d2d2a;
        font-size: 13px;
    }

    td {
        border-bottom: 1px solid #dadada;
        padding: 12px 145px 12px 15px;
        font-size: 13px;
    }

    p{
        display: block;
        color: #888;
        margin: 0;
        padding-left: 25px;
    }
    .Yorder>div{
        padding: 15px 0;
    }
    .btn-secondary {
        color: #fff;
        background-color: #ff5421 !important;
        border-color: #ff5421 !important;
        border-radius: 50px !important;
        padding: -1px 103px !important;
    }

    @media only screen and (max-width: 767px) {
        button.button {
            padding-left: 0px !important;
            padding-right: 0px !important;
            font-size: 12px;
        }
        .product-name {
            font-size: 13px !important;
        }
        .product-image{
            max-width: 80px;
        }
        .log-in {
            text-align: center !important;
        }
        .signup{
            text-align: center !important;
            margin-top: 22px;
        }
        .coupon .input-text {
            max-width: 190px !important;
        }
        .billing {
            margin-top: 20px;
        }
        td {
            padding: 12px 72px 12px 15px;
            font-size: 13px;
        }
    }

    .btn-info {
        color: #fff;
        background-color: red;
        border-color: red;
        padding: 5px 8px !important;
    }

    .btn-info:hover{
        color: #fff;
        background-color: red;
        border-color: red;
        padding: 5px 8px !important;
    }
    .btn-primary {
        color: #000;
        background-color: transparent;
        border-color: #DFDFDF;
        padding: 8px 7px !important;
        padding-top: -16px;
        border-radius: none !important;
    }

    .btn-primary:hover{
        color: #000;
        background-color: transparent;
        border-color: #DFDFDF;
        padding: 8px 7px !important;
        padding-top: -16px;
        border-radius: none !important;
    }

    .product-name {
        font-size: 16px;
        color: #000 !important;
    }

    .log-in {
        text-align: right;
    }
    .signup{
        text-align: left;
    }

    .log-in a {
        background-color: #457d00;
        color: #ffffff;
        font-size: 15px;
        line-height: 30px;
        padding: 12px 120px;
        margin-bottom: 10px;
    }

    .log-in a:hover{
        background-color: #2e5105;
    }

    .signup a{
        background-color: #757575;
        color: #ffffff;
        font-size: 15px;
        line-height: 30px;
        padding: 12px 120px;
        margin-bottom: 10px;
    }

    .signup a:hover{
        background-color: #1f1f1f;
    }

    .buttons {
        margin-top: 28px;
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
                        <h2>Cart</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="{{route('/')}}">HOME</a>/</li>
                            <li><span>Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------- //breadcrumb ------------------->
<section class="cardss">
    <div class="container-fluid">
        <div style="overflow-x:auto;">  
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Course</th>
                        <th>Price </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @php
                    $total=0;
                    @endphp
                    @CSRF
                    
                    @forelse($carts as $cart)
                    @php
                    $total+=$cart->course->price;
                    @endphp
                    <tr>
                        <td>
                            <a href="{{Route('course-details',['id'=>base64_encode($cart->course_id)])}}">
                                <img src="{{ URL::asset('public/uploads/course/'.$cart->course->image) }}" alt="image" class="product-image" width="60px">
                            </a>
                        </td>
                        <td class="product-name">{{$cart->course->name}}</td>
                        <td>₹{{$cart->course->price}}</td>
                        <td>
                            <a href="javascript:void(0);" onclick="removeCart('{{$cart->id}}', this);">
                                <button type="button" class="btn btn-info">Delete</button>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr class="my-wish-body">
                        <td colspan = "4">Your cart is empty</td>

                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</section>
@if(sizeof($carts)>0)
<section>
    <div class="container-fluid">  
        <div class="row cart-actions">
            <div class="col-sm-7">
                <!--<div class="coupon">-->
                <!--<label for="coupon_code">Coupon:</label> -->
                <!--<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code"> -->
                <!--<button type="submit" class="button" name="apply_coupon" value="Apply coupon">Apply coupon</button>-->
                <!--</div>-->
            </div>
            <div class="col-sm-5 billing">
                <div class="Yorder">
                    <h4 class="bill-address-you">CART TOTALS</h4>
                    <table>

                        <tbody>
                            <tr>
                                <td>Item(s) Subtotal</td>
                                <td>₹{{number_format(($total),2)}}</td>
                            </tr>

                            <tr>
                                <td class="total">Amount Payable</td>
                                <td class="total-amount">₹{{number_format(($total),2)}}</td>
                            </tr>

                        </tbody>
                    </table>
                    <br>
                    <div class="place-button text-center">
                        <a href="{{route('checkout')}}"><button type="button" class="btn btn-secondary" >Proceed to checkout</button></a>
                    </div>

                </div><!-- Yorder -->
            </div>
        </div>


    </div>   
</section>
@endif

@stop
@section('js')

@endsection
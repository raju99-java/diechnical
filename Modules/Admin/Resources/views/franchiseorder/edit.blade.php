
@extends('admin::layouts.main')
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
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('franchise-purchase-elements')}}">Element Purchase Lists</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Element Purchase</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Element Purchase of {{$element->name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="element-purchase" method="post" action="{{route('franchise-purchase-element-edit',['id'=>$id])}}" class="form-horizontal" enctype="multipart/form-data">
                    @method('PUT')
                    {{csrf_field()}}
                    <input type="hidden" id="id" name="id" value="{{$id}}">
                    <div class="form-body">
                        
                        <div class="form-group">
                            <div class="col-md-10">
                                
                                <img src="{{ (isset($element->image)) ? URL::asset('public/uploads/element/' . $element->image) : URL::asset('public/backend/no-image.png') }}" style="max-width: 400;max-height: 200px">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-10">
                                <label class="control-label col-md-3"># Order Id : {{ (isset($element->name)) ? $element_order->order_number : 'NA' }}</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-10">
                                <label class="control-label col-md-3">Element Name : {{ (isset($element->name)) ? $element->name : 'NA' }}</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-10">
                                <label class="control-label col-md-3">Price : ₹ {{ (isset($element->price)) ? $element->price : '0' }}</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-10 ">
                                <label class="control-label col-md-3">Order By ALC : {{ (isset($franchise->name)) ? $franchise->name : 'NA' }}</label>
                            </div>
                        </div>
                        
                        
                        <div class="form-group {{ $errors->has('order_status') ? ' has-error' : '' }}">
                            <div class="col-md-10">
                                <label class="control-label col-md-3"> Order Status : <span class="required">*</span></label>
                                <select id="course"  name="order_status"  class="form-control">
                                    <option value="" disabled="" selected>{{ __("Select Order Status") }}</option>
                                    
                                      <label class="control-label col-md-3"><option value="0"  {{ ($element_order->order_status == '0') ? 'selected':'' }}>Order Placed</option></label>
                                      <label class="control-label col-md-3"><option value="1"  {{ ($element_order->order_status == '1') ? 'selected':'' }}>Order Confirmed</option></label>
                                      <label class="control-label col-md-3"><option value="2"  {{ ($element_order->order_status == '2') ? 'selected':'' }}>Out For Delivery</option></label>
                                      <label class="control-label col-md-3"><option value="3"  {{ ($element_order->order_status == '3') ? 'selected':'' }}>Order Delivered</option></label>
                                    
                                </select>
                                @if ($errors->has('order_status'))
                                <span class="help-block"> {{ $errors->first('order_status') }} </span>
                                @endif
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-10 text-center">
                                <a href="{{Route('franchise-purchase-elements')}}" class="btn btn-primary">Cancel</a>
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

@extends('admin::layouts.main')

@section('page_css')
<link href="{{ URL::asset('public/backend/css/jquery-confirm.css') }}" rel="stylesheet" type="text/css" />
<style>
    .jconfirm-content {
        overflow: hidden !important;
    }
</style>
@stop

@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Element Purchase Lists</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Element Purchase Lists</span>
        </div>
        
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-responsive">
                <table class="ui celled table" cellspacing="0" width="100%" id="element-purchase-management">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Id</th>
                            <th>Element Name</th>
                            <th>Element Price</th>
                            <th>Order By ALC</th>
                            <th>Payment Status</th>
                            <th>Date</th>
                            <th>Order Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_js')
<script src="{{ URL::asset('public/backend/js/jquery-confirm.js') }}" type="text/javascript"></script>
<script>

//    $(docuemnt).ready(function () {
//
//    });
    $(function () {
        $('#element-purchase-management').DataTable({
            serverSide: true,
            responsive: true,
            ajax: '{{ route("franchise-purchase-element-list-datatable") }}',
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'order_number', name: 'order_number'},
                {data: 'element_name', name: 'element_name'},
                {data: 'pay_amount', name: 'pay_amount'},
                {data: 'franchise_name', name: 'franchise_name'},
                {data: 'payment_status', name: 'payment_status'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'order_status', name: 'order_status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endsection
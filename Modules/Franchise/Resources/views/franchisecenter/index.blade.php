@extends('franchise::layouts.main')

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
        <a href="{{Route('franchise-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Center List Management</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Center List Management</span>
        </div>
        <div class="pull-right"><a href="{{route('franchise-center-add')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a></div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-responsive">
            <table class="ui celled table" cellspacing="0" width="100%" id="center-request-manager">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> Image </th>
                        <th> Name </th>
                        <th> Email </th>
                        <th> Phone </th>
                        <th> Wallet Amount </th>
                        <th> Joining Date </th>
                        <th> Status </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
                </div>
        </div>
    </div>
</div>
@endsection
@section('page_js')
<script src="{{ URL::asset('public/backend/js/jquery-confirm.js') }}" type="text/javascript"></script>
<script>
    $(function () {
        $('#center-request-manager').DataTable({
//            processing: true,
            serverSide: true,
            ajax: '{!! route("franchise-center-list-datatable") !!}',
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'image', name: 'image', orderable: false, searchable: false},
                {data: 'owner_name', name: 'owner_name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'wallet_amount', name: 'wallet_amount'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'}
            ],
//            drawCallback: function () {
//                $('[data-toggle=confirmation]').confirmation({
//                    rootSelector: '[data-toggle=confirmation]',
//                    container: 'body'
//                });
//            }
        });
    });
</script>
@endsection
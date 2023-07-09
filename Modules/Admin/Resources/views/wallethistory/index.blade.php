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
        <span class="active">Wallet History</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Wallet History</span>
        </div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-responsive">
            <table class="ui celled table" cellspacing="0" width="100%" id="wallet-history-manager">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> Director Name </th>
                        <th> Amount </th>
                        <th> Description </th>
                        <th> Balance </th>
                        <th> Date Time </th>
                        <th> Actions </th>
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
        $('#wallet-history-manager').DataTable({
//            processing: true,
            serverSide: true,
            ajax: '{!! route("wallet-history-list") !!}',
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'amount', name: 'amount'},
                {data: 'description', name: 'description'},
                {data: 'balance', name: 'balance'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
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
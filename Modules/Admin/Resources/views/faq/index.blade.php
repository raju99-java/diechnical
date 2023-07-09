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
        <span class="active">FAQ Management</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">FAQ Management</span>
        </div>
        <div class="pull-right"><a href="{{route('faq-add')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a></div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-responsive">
            <table class="ui celled table" cellspacing="0" width="100%" id="faq-manager">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> Question </th>
                        <th> Answer </th>
                        <th> Date Time </th>
                        <th> Status </th>
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
        $('#faq-manager').DataTable({
//            processing: true,
            serverSide: true,
            ajax: '{!! route("faq-list") !!}',
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'question', name: 'question'},
                {data: 'answer', name: 'answer'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
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
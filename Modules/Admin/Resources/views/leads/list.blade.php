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
        <span class="active">Lead Form Management</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Lead Form Management</span>
        </div>
        <div class="pull-right"><a href="{{route('leads-form-csv')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Download csv</a></div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-responsive">
                <table class="ui celled table" cellspacing="0" width="100%" id="lead-form-management">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Contact No.</th>
                            <th>Country</th>
                            <th>Interested In</th>
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
        $('#lead-form-management').DataTable({
            serverSide: true,
            responsive: true,
            ajax: '{{ route("leads-form-list-datatable") }}',
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'contact_number', name: 'contact_number'},
                {data: 'country', name: 'country'},
                {data: 'interested_in', name: 'interested_in'}
            ]
        });
    });
</script>
@endsection
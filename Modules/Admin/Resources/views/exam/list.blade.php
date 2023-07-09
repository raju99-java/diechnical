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
        <span class="active">Exam Management</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Exam Management</span>
        </div>
        <div class="pull-right"></div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-responsive">
                <table class="ui celled table" cellspacing="0" width="100%" id="exam-management">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>Course Name</th>
                            <th>Status</th>
                            <th>Actions</th>
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
    $('#exam-management').DataTable({
        serverSide: true,
        responsive: true,
        ajax: '{{ route("admin-student-exam-answer-datatables") }}',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'user_id', name: 'user_id'},
            {data: 'course_id', name: 'course_id'},
            {data: 'status', searchable: false, orderable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endsection
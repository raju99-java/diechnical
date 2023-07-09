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
        <span class="active">Uploaded Files</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Uploaded Files</span>
                </div>
                <div class="pull-right"><a href="{{route('franchise-request-add-banners')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a></div>
            </div>
            <div class="portlet-body ">
                <div class="clearfix">
                    <div class="table-responsive">
                        <table class="ui celled table" cellspacing="0" width="100%" id="banners-list">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>File Name</th>
                                    <th>Slug</th>
                                    <th>Date</th>
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
    </div>
</div>
@endsection

@section('page_js')
<script src="{{ URL::asset('public/backend/js/jquery-confirm.js') }}" type="text/javascript"></script>
<script>

    $(function () {
        $('#banners-list').DataTable({
            serverSide: true,
            responsive: true,
            ajax: '{{ route("franchise-request-banners-list") }}',
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'banner_name', name: 'banner_name'},
                {data: 'slug', name: 'slug'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', searchable: false, orderable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endsection
@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Static Pages</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Static Pages</span>
        </div>
        <div class="text-right">
            <!--<a href="javascript:void();" class="btn btn-success"><i class="fa fa-plus"></i> Add</a>-->
        </div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <table class="ui celled table" cellspacing="0" width="100%" id="static-page-table">
                <thead>
                    <tr>
                        <th class="bold"> # </th>
                                <th class="bold"> Page Name </th>
                                <th class="bold"> Content </th>
                                <th class="bold"> Last Updated </th>
                                <th class="bold" width="15%"> Actions </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('page_js')
<script>
    
    $(function () {
        $('#static-page-table').DataTable({
            processing: false,
            serverSide: true,
            order: [[0, "desc"]],
            ajax: full_path + 'static-page',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'page_name', name: 'page_name'},
                {data: 'content', name: 'content'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endsection
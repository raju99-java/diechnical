@extends('admin::layouts.main')


@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">CMS Management</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">CMS Management</span>
        </div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-responsive">
                <table class="ui celled table" cellspacing="0" width="100%" id="cms-manager">
                    <thead>
                        <tr>
                            <th class="bold"> # </th>
                            <th class="bold"> Page Name </th>
                            <th class="bold"> Content Type </th>
                            <th class="bold"> Content Name </th>
                            <th class="bold"> Last Updated </th>
                            <th class="bold"> Actions </th>
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
<script>
    $(function () {
        $('#cms-manager').DataTable({
//            processing: true,
            serverSide: true,
            ajax: '{!! route("cms-list") !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'page_name', name: 'page_name'},
                {data: 'type', name: 'type'},
                {data: 'content_name', name: 'content_name'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
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
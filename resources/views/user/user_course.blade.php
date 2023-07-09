@extends('layouts.main')
@section('css')

@endsection
@section('content')
<!--Start Breadcrumb-->
<!--------------------breadcrumb ---------------------->
<section class="breadcrumb about-us-b">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-title-div">
                    <div class="bread-left-side">
                        <h2>Courses</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="{{route('/')}}">HOME</a>/</li>
                            <li><span>Courses</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------- //breadcrumb ------------------->

<!--------------------------------Main content Start--------------------------->
<section class="main-content">
    <section class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('partials.left')
                <div class="col-md-9 col-sm-9 tab_dsh_2">
                    <div class="dash-right-sec">
                        <div class="successfull">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="user-profile-details">
                                            <div class="account-info">
                                                <div class="header-area">
                                                    <h4 class="title">
                                                        COURSES <span class="desktop"><br/>(Scroll left to see more)</span>
                                                    </h4>
                                                </div>
                                                <div class="edit-info-area">
                                                    <div class="body">
                                                        <div style="overflow-x:auto;">  
                                                            <table class="table table-bordered" id="user-course-management" style="width:100%;">
                                                                <thead class="grey lighten-2">
                                                                    <tr>
                                                                        <th scope="col">Sr No</th>
                                                                        <th scope="col">Course Name</th>
                                                                        <th scope="col">Amount paid</th>
                                                                        <th scope="col">Purchase Date</th>
                                                                        <th scope="col">Status</th>
                                                                        <th scope="col">Action</th>
                                                                        <!-- <th scope="col">Action</th> -->
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</section>
<!----------------------------------Main content End--------------------------->

@stop
@section('js')
<script src="{{ URL::asset('public/backend/js/jquery-confirm.js') }}" type="text/javascript"></script>
<script>

//    $(docuemnt).ready(function () {
//
//    });
$(function () {
    $('#user-course-management').DataTable({
        serverSide: true,
        responsive: true,
        ajax: '{{ route("user-course-datatable") }}',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'course_id', name: 'course_id'},
            {data: 'amount_paid', name: 'amount_paid'},
            {data: 'created_at', name: 'created_at'},
            {data: 'status', name: 'status', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endsection




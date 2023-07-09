@extends('layouts.main')

@section('content')
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
    <section class="courses-div">
        <div class="container">
            <div class="row">
                @forelse($all_courses as $index => $all_course)
                <a href="{{Route('course-details',['id'=>base64_encode($all_course->id)])}}" >
                <div class="col-sm-4">
                    <div class="courses-item">
                        <div class="course-thumbnail">
                            <img src="{{ URL::asset('public/uploads/course/'.$all_course->image) }}" alt="" class="img-fluid">
                        </div>
                        <div class="courses-text">
                            <h4>{{$all_course->name}}</h4>
                            <p> {{$all_course->short_description}}</p>
                            <div class="course-meta">
                                <div class="course-price">
                                    <div class="value ">₹{{$all_course->price}}</div>                    

                                </div>
                            </div>
                            <div class="duration text-center">
                                <p><b>Duration</b> : {{$all_course->time}} Days</p>
                            </div>
                            <div class="courses-apply-btn">
                                <a href="{{Route('course-details',['id'=>base64_encode($all_course->id)])}}" class="btn btn-danger">View Details</a>
                            </div>
                        </div>
                    </div>  
                </div>
                </a>
                @empty
                @endforelse

            </div>


        </div>
    </section>  
</section>
<!----------------------------------Main content End--------------------------->
@stop

@section('js')

@stop    
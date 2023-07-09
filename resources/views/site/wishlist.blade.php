@extends('layouts.main') 
@section('css')
<style>

</style>
@endsection
@section('content')
<!--------------------breadcrumb ---------------------->
<section class="breadcrumb about-us-b">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-title-div">
                    <div class="bread-left-side">
                        <h2>Wishlist</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="{{route('/')}}">HOME</a>/</li>
                            <li><span>Wishlist</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------- //breadcrumb ------------------->

<!---------------------wishlist----------------------->
<section class="wishlist">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-md-10 offset-sm-1 offset-md-1">
                <div style="overflow-x:auto;">
                    <table class="table my-wishlist-table">
                        <thead>
                            <tr class="my-wish-head">
                                <th>My Wishlist <span>({{$total}})</span></th>
                                <th></th>
                                <th></th>
                            </tr> 

                        </thead>
                        <tbody>
                            @forelse($wishlists as $wishlist)
                            <tr class="my-wish-body">
                                <td>
                                    <a href="{{Route('course-details',['id'=>base64_encode($wishlist->course_id)])}}">
                                        <img src="{{ URL::asset('public/uploads/course/'.$wishlist->course->image) }}" alt="image" class="course-image" width="60px">
                                    </a>
                                </td> 
                                <td class="courses-name">
                                    <a href="{{Route('course-details',['id'=>base64_encode($wishlist->course_id)])}}"> <p>{{$wishlist->course->name}}</p></a>
                                    <p class="price">₹{{$wishlist->course->price}}</p>
                                </td> 
                                <td class="remove-product">
                                    <a href="javascript:void(0);" onclick="removeWishlist('{{$wishlist->id}}', this);"><i class="icofont-ui-delete"></i></a>
                                </td> 
                            </tr>
                            @empty
                            <tr class="my-wish-body">
                                <td colspan = "3">Your wishlist is empty</td>

                            </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>    
            </div>
        </div>
    </div>
</section>
<!-------------------//wishlist----------------------->
@stop
@section('js')

@endsection
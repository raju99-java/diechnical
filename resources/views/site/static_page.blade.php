@extends('layouts.main')

@section('content')
<section class="main-body-section inner-page-padding">
    <div class="container">
        <h2 class="section-heading">{{ $model->page_name }}<span>.</span></h2>
        <div class="heading-line"></div>
        <div class="inner-wrap" style="margin:30px; ">
            <div class="inner-cont-area">
                {!! $model->content !!}
            </div>
        </div>
    </div>
</section>
@stop
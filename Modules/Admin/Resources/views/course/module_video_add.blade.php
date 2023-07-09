@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route("admin-course-module", [$coursemodule->course_id])}}">Course Module</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route("admin-course-module-video", [$coursemodule->id])}}">Course Module Video of {{$coursemodule->name}}</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Add </span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Course Module video</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('admin-course-module-video-add',$coursemodule->id)}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="course_id" value="{{ $coursemodule->course_id }}">
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Name<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ (old('name')!="") ? old('name') : ''}}"/>
                                @if ($errors->has('name'))
                                <span class="help-block"> {{ $errors->first('name') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('time') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Time(Minute)<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Time" name="time" value="{{ (old('time')!="") ? old('time') : ''}}"/>
                                @if ($errors->has('time'))
                                <span class="help-block"> {{ $errors->first('time') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('video') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">{{ __('Video') }}</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="video">
                                @if ($errors->has('video'))
                                <span class="help-block"> {{ $errors->first('video') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1"> Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0"> Inactive
                                    </label>
                                    @if ($errors->has('status'))
                                    <div class="help-block">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="offset-md-3 col-md-9">
                                <a href="{{Route("admin-course-module-video", [$coursemodule->id])}}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn green">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
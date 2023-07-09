@extends('franchise::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('franchise-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{route('franchise-course-index')}}">Course</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route("franchise-course-module", [$data->course_id])}}">Course Module</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route("franchise-course-module-video", [$data->module_id])}}">Course Module Video of {{$data->module->name}}</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Update</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Update Course for {{$data->course->name}} of module {{$data->module->name}} of video {{$data->name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('franchise-course-module-video-edit',$data->id)}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-body">
                        
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Name<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ (old('name')!="") ? old('name') : $data->name}}"/>
                                @if ($errors->has('name'))
                                <span class="help-block"> {{ $errors->first('name') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('time') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Time(Minute)<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Time" name="time" value="{{ (old('time')!="") ? old('time') : $data->time}}"/>
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
                        <div class="form-group">
                            <div class="col-md-10">
                                <a href="{{isset($data->video)?URL::asset('public/uploads/course/video/'.$data->video):''}}" class="btn btn-xs btn-primary pull-left" target="_blank"><i class="fa fa-eye"></i>View Video</a><br/>
                            </div>
                        </div>
                        <br>
                        
                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" {{ ($data->status == '1') ? 'checked' : '' }}> Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0" {{ ($data->status == '0') ? 'checked' : '' }}> Inactive
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
                            <div class="col-md-12 text-center">
                                <a href="{{Route("franchise-course-module-video", [$data->module_id])}}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn green"> Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
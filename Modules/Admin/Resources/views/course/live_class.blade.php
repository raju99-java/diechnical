@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('admin-course-index')}}">Course</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('admin-course-live-class-list',$data->id)}}">Live Class Management</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Add Live Class</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Live Class of {{$data->name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('admin-course-live-class',$data->id)}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="course_id" value="{{ $data->id }}">
                    <div class="form-body">
                        
                        <div class="form-group {{ $errors->has('subject') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Online Class Subject <span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Online Class Subject" name="subject"  id="body">{{ (old('subject')!="") ? old('subject') : '' }}</textarea>
                                @if ($errors->has('subject'))
                                <span class="help-block"> {{ $errors->first('subject') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group {{ $errors->has('link') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Online Class Link<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Online Class Link" name="link" value="{{ (old('link')!="") ? old('link') : ''}}"/>
                                @if ($errors->has('link'))
                                <span class="help-block"> {{ $errors->first('link') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('date') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Online Class Date</label>
                            <div class="col-md-10">
                                <input type="date" class="form-control" placeholder="Online Class Dtae" id="date" name="date" value="{{ (old('date')!="") ? old('date') : '' }}"/>
                                <span class="help-block" id="error-date"></span>  
                                    @if ($errors->has('date'))
                                       <span class="help-block"> {{ $errors->first('date') }} </span>
                                    @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('time') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Online Class Time</label>
                            <div class="col-md-10">
                                <input type="time" class="form-control" placeholder="Online Class Time" id="time" name="time" value="{{ (old('time')!="") ? old('time') : '' }}"/>
                                <span class="help-block" id="error-time"></span>  
                                    @if ($errors->has('time'))
                                       <span class="help-block"> {{ $errors->first('time') }} </span>
                                    @endif
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{Route('admin-course-index')}}" class="btn btn-primary">Cancel</a>
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
@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('students')}}">student</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Assign Course</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Assign course Student of {{$user->full_name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('student-assign-course',['id'=>$id])}}" class="form-horizontal" enctype="multipart/form-data">
                    @method('PUT')
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('running_course') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Assign Course<span class="required">*</span></label>
                            <div class="col-md-10">
                                <select id="running_course"  name="running_course"  class="form-control">
                                    <option value="" disabled="" selected>{{ __("Select Course") }}</option>
                                    @foreach($courses as $course)
                                      <option value="{{ $course->id }}"  {{ (old('running_course')!="") ? ($course->id==old('running_course'))?'selected':'' : ''}}>{{ $course->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('running_course'))
                                <span class="help-block"> {{ $errors->first('running_course') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('created_at') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Assign Date</label>
                            <div class="col-md-10">
                                <input type="date" class="form-control" placeholder="Assign Date" name="created_at" value="{{ (old('created_at')!="") ? old('created_at') : '' }}"/>
                                    @if ($errors->has('created_at'))
                                       <span class="help-block"> {{ $errors->first('created_at') }} </span>
                                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{Route('students')}}" class="btn btn-primary">Cancel</a>
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
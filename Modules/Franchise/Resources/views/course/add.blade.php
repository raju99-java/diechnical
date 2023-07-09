@extends('franchise::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('franchise-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('franchise-course-index')}}">Course</a>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Course</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('franchise-course-store')}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
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
                            <label class="control-label col-md-3">Time(Days)<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Time" name="time" value="{{ (old('time')!="") ? old('time') : ''}}"/>
                                @if ($errors->has('time'))
                                <span class="help-block"> {{ $errors->first('time') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('no_of_reviews') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">No of Reviews<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="No of Reviews" name="no_of_reviews" value="{{ (old('no_of_reviews')!="") ? old('no_of_reviews') : ''}}"/>
                                @if ($errors->has('no_of_reviews'))
                                <span class="help-block"> {{ $errors->first('no_of_reviews') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('students_enrolled') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Students Enrolled<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Students Enrolled" name="students_enrolled" value="{{ (old('students_enrolled')!="") ? old('students_enrolled') : ''}}"/>
                                @if ($errors->has('students_enrolled'))
                                <span class="help-block"> {{ $errors->first('students_enrolled') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('course_language') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Course Language<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Course Language" name="course_language" value="{{ (old('course_language')!="") ? old('course_language') : ''}}"/>
                                @if ($errors->has('course_language'))
                                <span class="help-block"> {{ $errors->first('course_language') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('course_level') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Course Level<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Course Level" name="course_level" value="{{ (old('course_level')!="") ? old('course_level') : ''}}"/>
                                @if ($errors->has('course_level'))
                                <span class="help-block"> {{ $errors->first('course_level') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group {{ $errors->has('what_you_will_learn') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">What You Will Learn<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="What You Will Learn" name="what_you_will_learn"  id="what_you_will_learn">{{ (old('what_you_will_learn')!="") ? old('what_you_will_learn') : '' }}</textarea>
                                @if ($errors->has('what_you_will_learn'))
                                <span class="help-block"> {{ $errors->first('what_you_will_learn') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('jobs_that_require_this_skill') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Jobs That Require This Skill<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Jobs That Require This Skill" name="jobs_that_require_this_skill"  id="jobs_that_require_this_skill">{{ (old('jobs_that_require_this_skill')!="") ? old('jobs_that_require_this_skill') : '' }}</textarea>
                                @if ($errors->has('jobs_that_require_this_skill'))
                                <span class="help-block"> {{ $errors->first('jobs_that_require_this_skill') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('requirements') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Requirements<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Requirements" name="requirements"  id="requirements">{{ (old('requirements')!="") ? old('requirements') : '' }}</textarea>
                                @if ($errors->has('requirements'))
                                <span class="help-block"> {{ $errors->first('requirements') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <img id="blah" src="" style="max-width: 400;max-height: 200px">
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">{{ __('Current Featured Image') }}</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="image" onchange="readURL(this);">
                                @if ($errors->has('image'))
                                <span class="help-block"> {{ $errors->first('image') }} </span>
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
                        <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Sale Price<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Price" name="price" value="{{ (old('price')!="") ? old('price') : ''}}"/>
                                @if ($errors->has('price'))
                                <span class="help-block"> {{ $errors->first('price') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('original_price') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Original Price<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Original Price" name="original_price" value="{{ (old('original_price')!="") ? old('original_price') : ''}}"/>
                                @if ($errors->has('original_price'))
                                <span class="help-block"> {{ $errors->first('original_price') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('discount_percentage') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Discount Percentage<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Discount Percentage" name="discount_percentage" value="{{ (old('discount_percentage')!="") ? old('discount_percentage') : ''}}"/>
                                @if ($errors->has('discount_percentage'))
                                <span class="help-block"> {{ $errors->first('discount_percentage') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('hours_left_for_this_price') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Hours Left For This Price<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Hours Left For This Price" name="hours_left_for_this_price" value="{{ (old('hours_left_for_this_price')!="") ? old('hours_left_for_this_price') : ''}}"/>
                                @if ($errors->has('hours_left_for_this_price'))
                                <span class="help-block"> {{ $errors->first('hours_left_for_this_price') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('course_type') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Course Type<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Course Type" name="course_type" value="{{ (old('course_type')!="") ? old('course_type') : ''}}"/>
                                @if ($errors->has('course_type'))
                                <span class="help-block"> {{ $errors->first('course_type') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('short_description') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Short Description<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control" placeholder="Short Description" name="short_description"  id="body">{{ (old('short_description')!="") ? old('short_description') : '' }}</textarea>
                                @if ($errors->has('short_description'))
                                <span class="help-block"> {{ $errors->first('short_description') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('long_description') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Long Description<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Long Description" name="long_description"  id="body">{{ (old('long_description')!="") ? old('long_description') : '' }}</textarea>
                                @if ($errors->has('long_description'))
                                <span class="help-block"> {{ $errors->first('long_description') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('exam_status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Exam Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="exam_status" value="1"> Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="exam_status" value="0"> No
                                    </label>
                                    @if ($errors->has('exam_status'))
                                    <div class="help-block">{{ $errors->first('exam_status') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>



                        <div class="form-group {{ $errors->has('featured') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Featured <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="featured" value="1"> Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="featured" value="0"> No
                                    </label>
                                    @if ($errors->has('featured'))
                                    <div class="help-block">{{ $errors->first('featured') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--<div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">-->
                        <!--    <label class="control-label col-md-3">Status <span class="required">*</span></label>-->
                        <!--    <div class="col-md-10">-->
                        <!--        <div class="radio-list">-->
                        <!--            <label class="radio-inline">-->
                        <!--                <input type="radio" name="status" value="1"> Active-->
                        <!--            </label>-->
                        <!--            <label class="radio-inline">-->
                        <!--                <input type="radio" name="status" value="0"> Inactive-->
                        <!--            </label>-->
                        <!--            @if ($errors->has('status'))-->
                        <!--            <div class="help-block">{{ $errors->first('status') }}</div>-->
                        <!--            @endif-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="offset-md-3 col-md-9">
                                <a href="{{Route('franchise-course-index')}}" class="btn btn-primary">Cancel</a>
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
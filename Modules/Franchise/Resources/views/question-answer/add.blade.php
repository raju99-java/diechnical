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
        <a href="{{Route('franchise-question-answer-index')}}">Question Answer</a>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Question Answer</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('franchise-question-answer-store')}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-body">
                        
                        <div class="form-group {{ $errors->has('course') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Course : {{ $course->name }} </label>
                            <div class="col-md-10">
                                <input type="hidden" class="form-control"  name="course" value="{{ $course->id }}"/>
                                @if ($errors->has('course'))
                                <span class="help-block"> {{ $errors->first('course') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('question') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Question<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" name="question" placeholder="Question">{!! (old('question')!="") ? old('question') : '' !!}</textarea>

                                @if ($errors->has('question'))
                                <span class="help-block"> {{ $errors->first('question') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('option1') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Option 1<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Option 1" name="option1" value="{{ (old('option1')!="") ? old('option1') : ''}}"/>
                                @if ($errors->has('option1'))
                                <span class="help-block"> {{ $errors->first('option1') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('option2') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Option 2<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Option 2" name="option2" value="{{ (old('option2')!="") ? old('option2') : ''}}"/>
                                @if ($errors->has('option2'))
                                <span class="help-block"> {{ $errors->first('option2') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('option1') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Option 3<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Option 3" name="option3" value="{{ (old('option3')!="") ? old('option3') : ''}}"/>
                                @if ($errors->has('option3'))
                                <span class="help-block"> {{ $errors->first('option3') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('option4') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Option 4<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Option 4" name="option4" value="{{ (old('option4')!="") ? old('option4') : ''}}"/>
                                @if ($errors->has('option4'))
                                <span class="help-block"> {{ $errors->first('option4') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group {{ $errors->has('answer') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Answer<span class="required">*</span></label>
                            <div class="col-md-10">
                                <select  name="answer"  class="form-control">
                                    <option value="">{{ __("Select Answer") }}</option>
                                    <option value="option1" {{ (old('answer')!="") ? ('option1'==old('answer'))?'selected':'' : ''}}>Option 1</option>
                                    <option value="option2" {{ (old('answer')!="") ? ('option2'==old('answer'))?'selected':'' : ''}}>Option 2</option>
                                    <option value="option3" {{ (old('answer')!="") ? ('option3'==old('answer'))?'selected':'' : ''}}>Option 3</option>
                                    <option value="option4" {{ (old('answer')!="") ? ('option4'==old('answer'))?'selected':'' : ''}}>Option 4</option>
                                    
                                </select>
                                @if ($errors->has('answer'))
                                <span class="help-block"> {{ $errors->first('answer') }} </span>
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
                                <a href="{{Route('franchise-course-question-answer', [$course->id])}}" class="btn btn-primary">Cancel</a>
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
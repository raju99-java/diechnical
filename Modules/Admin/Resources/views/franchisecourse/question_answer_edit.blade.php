@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('franchise-course-list-index')}}">Franchise Course Management</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Franchise Course Question Answer Update</span>
    </li>
    
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Franchise Course Question Answer Update </span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('franchise-course-ques-ans-update',$data->id)}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-body">
                        
                        <div class="form-group {{ $errors->has('course') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Course Name</label>
                            <div class="col-md-10">
                                <input type="hidden" name="course" value="{{$course->id}}" />
                                <input type="text" class="form-control"  placeholder="{{$course->name}}" disabled />
                                @if ($errors->has('course'))
                                <span class="help-block"> {{ $errors->first('course') }} </span>
                                @endif
                            </div>
                        </div>
                        


                        <div class="form-group {{ $errors->has('question') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Question<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" name="question" placeholder="Question">{!! (old('question')!="") ? old('question') : $data->question !!}</textarea>

                                @if ($errors->has('question'))
                                <span class="help-block"> {{ $errors->first('question') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('option1') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Option 1<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder=">Option 1" name="option1" value="{{ (old('option1')!="") ? old('option1') : $data->option1}}"/>
                                @if ($errors->has('option1'))
                                <span class="help-block"> {{ $errors->first('option1') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('option2') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Option 2<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder=">Option 2" name="option2" value="{{ (old('option2')!="") ? old('option2') : $data->option2}}"/>
                                @if ($errors->has('option2'))
                                <span class="help-block"> {{ $errors->first('option2') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('option3') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Option 3<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder=">Option 3" name="option3" value="{{ (old('option3')!="") ? old('option3') : $data->option3}}"/>
                                @if ($errors->has('option3'))
                                <span class="help-block"> {{ $errors->first('option3') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('option4') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Option 4<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder=">Option 4" name="option4" value="{{ (old('option4')!="") ? old('option4') : $data->option4}}"/>
                                @if ($errors->has('option4'))
                                <span class="help-block"> {{ $errors->first('option4') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Answer<span class="required">*</span></label>
                            <div class="col-md-10">
                                <select  name="answer" required="" class="form-control">
                                    <option value="">{{ __("Select Answer") }}</option>
                                    <option value="option1" {{ (old('answer')!="") ? ('option1'==old('answer'))?'selected':'' : ('option1'==$data->answer)?'selected':''}}>Option 1</option>
                                    <option value="option2" {{ (old('answer')!="") ? ('option2'==old('answer'))?'selected':'' : ('option2'==$data->answer)?'selected':''}}>Option 2</option>
                                    <option value="option3" {{ (old('answer')!="") ? ('option3'==old('answer'))?'selected':'' : ('option3'==$data->answer)?'selected':''}}>Option 3</option>
                                    <option value="option4" {{ (old('answer')!="") ? ('option4'==old('answer'))?'selected':'' : ('option4'==$data->answer)?'selected':''}}>Option 4</option>
                                    
                                </select>
                                @if ($errors->has('type'))
                                <span class="help-block"> {{ $errors->first('type') }} </span>
                                @endif
                            </div>
                        </div>

                        
                        
                        



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
                                <a href="{{Route('franchise-course-list-index')}}" class="btn btn-primary">Cancel</a>
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
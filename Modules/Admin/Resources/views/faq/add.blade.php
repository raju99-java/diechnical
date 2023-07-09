@extends('admin::layouts.main')
@section('page_css')
<style>
   .form-control {
    text-transform: uppercase;
} 
</style>
@stop
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('faq')}}">FAQ Management</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Add FAQ</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Add FAQ</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('faq-add')}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-body">
                        
                        <div class="form-group {{ $errors->has('question') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Question<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" name="question" placeholder="Question">{!! (old('question')!="") ? old('question') : '' !!}</textarea>

                                @if ($errors->has('question'))
                                <span class="help-block"> {{ $errors->first('question') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('answer') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Answer<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" name="answer" placeholder="Answer">{!! (old('answer')!="") ? old('answer') : '' !!}</textarea>

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
                                <a href="{{Route('faq')}}" class="btn btn-primary">Cancel</a>
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
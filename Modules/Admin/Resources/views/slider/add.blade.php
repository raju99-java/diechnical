@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('admin-slider-index')}}">Slider</a>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Slider</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('admin-slider-store')}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('title_text') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Title<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Title" name="title_text" value="{{ (old('title_text')!="") ? old('title_text') : ''}}"/>
                                @if ($errors->has('title_text'))
                                <span class="help-block"> {{ $errors->first('title_text') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('details_text') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Description<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Description" name="details_text"  id="body">{{ (old('details_text')!="") ? old('details_text') : '' }}</textarea>
                                @if ($errors->has('details_text'))
                                <span class="help-block"> {{ $errors->first('details_text') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('link') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Button Link<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Button Link" name="link" value="{{ (old('link')!="") ? old('link') : ''}}"/>
                                @if ($errors->has('link'))
                                <span class="help-block"> {{ $errors->first('link') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group {{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">{{ __('Current Featured Image') }}</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="photo" onchange="readURL(this);">
                                @if ($errors->has('photo'))
                                <span class="help-block"> {{ $errors->first('photo') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <img id="blah" src="" style="max-width: 400;max-height: 200px">
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
                                <a href="{{Route('admin-slider-index')}}" class="btn btn-primary">Cancel</a>
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
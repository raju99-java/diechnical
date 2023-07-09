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
        <a href="{{Route('franchise-request-banners')}}">Uploaded File</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Add File</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Add </span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{Route('franchise-request-add-banners')}}" class="form-horizontal" enctype="multipart/form-data">
                         @method('PUT')
                    {{csrf_field()}}
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('banner_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Name <span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Name" name="banner_name" value="{{ (old('banner_name')!="") ? old('banner_name') : '' }}"/>
                                    @if ($errors->has('banner_name'))
                                       <span class="help-block"> {{ $errors->first('banner_name') }} </span>
                                    @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Slug <span class="required">*</span></label>
                            <div class="col-md-10">
                                
                                <select name="slug" class="form-control">
                                    <option selected disabled class="option selected focus">Select Slug</option>
                                    <option value="franchise" class="option" {{ (old('slug')!="") ? ('franchise'==old('slug'))?'selected':'' : ''}}>Franchise Banners</option>
                                    <option value="prospectus" class="option" {{ (old('slug')!="") ? ('prospectus'==old('slug'))?'selected':'' : ''}}>Prospectus</option>
                                    <option value="admission_form" class="option" {{ (old('slug')!="") ? ('admission_form'==old('slug'))?'selected':'' : ''}}>Student Admission Form</option>
                                    <option value="director" class="option" {{ (old('slug')!="") ? ('director'==old('slug'))?'selected':'' : ''}}>Director Image</option>
                                </select>
                                
                                    @if ($errors->has('slug'))
                                       <span class="help-block"> {{ $errors->first('slug') }} </span>
                                    @endif
                            </div>
                        </div>
                
                
                        <div class="form-group {{ $errors->has('banner_file') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Upload File <span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="banner_file" onchange="readURL(this);">
                                @if ($errors->has('banner_file'))
                                <span class="help-block"> {{ $errors->first('banner_file') }} </span>
                                @endif
                            </div>
                        </div>
                
                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" > Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0" > Inactive
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
                                <a href="{{Route('franchise-request-banners')}}" class="btn btn-primary">Cancel</a>
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
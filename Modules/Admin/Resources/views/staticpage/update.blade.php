@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ Route('static-page.index') }}">Static Pages</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Edit</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-question font-red-sunglo bold uppercase">Edit Static Pages</span>
                </div>
            </div>
            <div class="portlet-answere form">
                <form action="{{ Route('static-page.update', [ base64_encode($model->id)]) }}" method="post" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Slug</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="slug" value="{{ (old('slug') !== NULL) ? old('slug') : $model->slug }}" placeholder="Slug" disabled>
                                @if ($errors->has('slug'))
                                <div class="help-block">{{ $errors->first('slug') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('page_name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Page Name <span class="required">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="page_name" value="{{ (old('page_name') !== NULL) ? old('page_name') : $model->page_name }}" placeholder="Page Name">
                                @if ($errors->has('page_name'))
                                <div class="help-block">{{ $errors->first('page_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Content <span class="required">*</span></label>
                            <div class="col-md-9">
                                <textarea class="form-control ckeditor" name="content" placeholder="Content">{{ (old('content') !== NULL) ? old('content') : $model->content }}</textarea>
                                @if ($errors->has('content'))
                                <div class="help-block">{{ $errors->first('content') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="offset-md-3 col-md-9">
                                <button type="submit" class="btn green"> Submit</button>
                                <a href="{{ Route('static-page.index') }}" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

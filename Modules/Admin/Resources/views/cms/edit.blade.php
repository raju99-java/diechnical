@extends('admin::layouts.main')

@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('cms')}}">CMS Management</a>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Edit</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal form-row-seperated" action="{{ Route('cms-edit', ['id' => base64_encode($model->id)]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="{{ $model->type }}">
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
                        <div class="form-group {{ $errors->has('content_name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Content Name <span class="required">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="content_name" value="{{ (old('content_name') !== NULL) ? old('content_name') : $model->content_name }}" placeholder="Content Name">
                                @if ($errors->has('content_name'))
                                <div class="help-block">{{ $errors->first('content_name') }}</div>
                                @endif
                            </div>
                        </div>
                        @if ($model->type === '2')
                        <div class="form-group {{ $errors->has('content_body') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Image </label>
                            <div class="col-md-9">
                                @if ($model->content_body !== NULL)
                                <img class="img-responsive" src="{{ URL::asset('public/uploads/frontend/cms/pictures/' . $model->content_body) }}" alt="{{ $model->content_body }}">
                                <br/>
                                @endif
                                <input type="file" class="form-control" name="content_body">
                                @if ($errors->has('content_body'))
                                <div class="help-block">{{ $errors->first('content_body') }}</div>
                                @endif
                                @if ($model->instruction !== NULL)
                                <h3><i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" title="{{ $model->instruction }}"></i></h3>
                                @endif
                            </div>
                        </div>
                        @elseif ($model->type === '3')
                        <div class="form-group {{ $errors->has('content_body') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Video </label>
                            <div class="col-md-9">
                                @if ($model->content_body !== NULL)
                                <video controls class="img-responsive" name="content_body">
                                    <source src="{{ URL::asset('public/uploads/frontend/cms/videos/' . $model->content_body) }}" type="video/mp4" alt="{{ $model->content_body }}">
                                </video>
                                <br/>
                                @endif
                                <input type="file" class="form-control" name="content_body">
                                @if ($errors->has('content_body'))
                                <div class="help-block">{{ $errors->first('content_body') }}</div>
                                @endif
                                @if ($model->instruction !== NULL)
                                <br/>
                                <h3><i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" title="{{ $model->instruction }}"></i></h3>
                                @endif
                            </div>
                        </div>
                        @else
                        <div class="form-group {{ $errors->has('content_body') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Content <span class="required">*</span></label>
                            <div class="col-md-9">
                                <textarea class="form-control ckeditor" name="content_body" placeholder="Content">{{ (old('content_body') !== NULL) ? old('content_body') : $model->content_body }}</textarea>
                                @if ($errors->has('content_body'))
                                <div class="help-block">{{ $errors->first('content_body') }}</div>
                                @endif
                                @if ($model->instruction !== NULL)
                                <br/>
                                <h3><i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" title="{{ $model->instruction }}"></i></h3>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">

                                <button type="submit" class="btn green">Submit</button>
                                <a href="{{Route('cms')}}" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

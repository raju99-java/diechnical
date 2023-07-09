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
        <a href="{{Route('elements')}}">Element Management</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Update</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Update Element of {{$element->name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('element-edit',['id'=>$id])}}" class="form-horizontal" enctype="multipart/form-data">
                    @method('PUT')
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $element->id }}">
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Element Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ (old('name')!="") ? old('name') : $element->name}}"/>
                                @if ($errors->has('name'))
                                <span class="help-block"> {{ $errors->first('name') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Price <span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Price" name="price" value="{{ (old('price')!="") ? old('price') : $element->price }}"/>
                                    @if ($errors->has('price'))
                                       <span class="help-block"> {{ $errors->first('price') }} </span>
                                    @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Description <span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Description" name="description" value="{{ (old('description')!="") ? old('description') : $element->description }}"/>
                                    @if ($errors->has('description'))
                                       <span class="help-block"> {{ $errors->first('description') }} </span>
                                    @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Upload Image </label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="image" onchange="readURL(this);">
                                @if ($errors->has('image'))
                                <span class="help-block"> {{ $errors->first('image') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" {{ ($element->status == '1') ? 'checked' : '' }}> Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0" {{ ($element->status == '0') ? 'checked' : '' }}> Inactive
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
                                <a href="{{Route('elements')}}" class="btn btn-primary">Cancel</a>
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
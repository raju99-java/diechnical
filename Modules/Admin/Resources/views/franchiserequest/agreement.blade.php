@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('franchise-request')}}">Franchise List Management</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Upload Agreement</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Upload Agreement File for Franchise : {{ strtoupper($model->name) }}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('franchise-request-upload-agreement',['id'=>$model->id])}}" class="form-horizontal" enctype="multipart/form-data">
                    
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $model->id }}">
                    <div class="form-body">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('agreement_file') ? ' has-error' : '' }}">
                                    <input type="file" class="form-control"  placeholder="Upload File *" name="agreement_file" onchange="readURL(this);">
                                    <span class="help-block" id="error-agreement_file"></span>
                                    @if ($errors->has('agreement_file'))
                                    <span class="help-block"> {{ $errors->first('agreement_file') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <a href="{{isset($model->agreement_file)?URL::asset('public/uploads/bannars/'.$model->agreement_file):''}}" class="btn btn-xs btn-primary pull-left" target="_blank"><i class="fa fa-eye"></i>View</a><br/>
                            </div>
                        </div>
                        <br>
                        
                        
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{Route('franchise-request')}}" class="btn btn-primary">Cancel</a>
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
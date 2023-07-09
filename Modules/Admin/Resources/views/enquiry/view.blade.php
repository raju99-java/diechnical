@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('enquiry')}}">Enquiry</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">View</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">View Enquiry</span>
                </div>
            </div>
            <div class="portlet-body form form-horizontal">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-2">Service:</label>
                        <div class="col-md-10">
                            <p class="form-control-static">
                                @if($model->services == 'Franchise')
                                New Franchise
                                @else
                                {{$model->services}}
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Name:</label>
                        <div class="col-md-10">
                            <p class="form-control-static">
                                {{$model->name}}
                            </p>
                        </div>
                    </div>
                    
                    @if($model->services == 'Franchise')
                    <div class="form-group">
                        <label class="control-label col-md-2">Center Name:</label>
                        <div class="col-md-10">
                            <p class="form-control-static">
                                {{$model->center_name}}
                            </p>
                        </div>
                    </div>
                    @endif
                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Email:</label>
                        <div class="col-md-10">
                            <p class="form-control-static">
                                {{$model->email}}
                            </p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Phone:</label>
                        <div class="col-md-10">
                            <p class="form-control-static">
                                {{$model->phone}}
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Address:</label>
                        <div class="col-md-10">
                            <p class="form-control-static">
                                {{$model->address}}
                            </p>
                        </div>
                    </div>
                    
                    @if($model->services == 'Franchise')
                    <div class="form-group">
                        <label class="control-label col-md-2">City:</label>
                        <div class="col-md-10">
                            <p class="form-control-static">
                                {{$model->city}}
                            </p>
                        </div>
                    </div>
                    @endif
                    
                    @if($model->services == 'Franchise')
                    <div class="form-group">
                        <label class="control-label col-md-2">District:</label>
                        <div class="col-md-10">
                            <p class="form-control-static">
                                {{$model->district}}
                            </p>
                        </div>
                    </div>
                    @endif
                    
                    @if($model->services == 'Franchise')
                    <div class="form-group">
                        <label class="control-label col-md-2">State:</label>
                        <div class="col-md-10">
                            <p class="form-control-static">
                                {{$model->state}}
                            </p>
                        </div>
                    </div>
                    @endif
                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Message:</label>
                        <div class="col-md-10">
                            <p class="form-control-static">
                                {{$model->message}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <a href="{{Route('enquiry')}}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
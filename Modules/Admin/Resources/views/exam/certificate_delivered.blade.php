@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li> <a href="{{Route('admin-student-exam-answer-index')}}">Exam</a>
        <i class="fa fa-circle"></i>
    </li>
    <li> <span class="active">Exam Certificate</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Exam Certificate of student {{$model->user->full_name}} course {{$model->course->name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('certificate-delivered',['id'=>$id])}}" class="form-horizontal" enctype="multipart/form-data">
                    @method('post')
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $model->id }}">
                    <div class="form-body">
                        
                        <div class="form-group {{ $errors->has('certificate_delivered') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Certificate Delivered <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="certificate_delivered" value="1" {{ ($model->certificate_delivered == '1') ? 'checked' : '' }}> Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="certificate_delivered" value="0" {{ ($model->certificate_delivered == '0') ? 'checked' : '' }}> No
                                    </label>
                                    @if ($errors->has('certificate_delivered'))
                                    <div class="help-block">{{ $errors->first('certificate_delivered') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('delivered_date') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Date of Delivered <span class="required">*</span></label>
                            <div class="col-md-5">
                                
                                    <input type="date" class="form-control" placeholder="Date of Delivered" name="delivered_date" value="{{ (old('delivered_date')!="") ? old('delivered_date') : $model->delivered_date }}"/>
                                    @if ($errors->has('delivered_date'))
                                    <div class="help-block">{{ $errors->first('delivered_date') }}</div>
                                    @endif
                                
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{Route('admin-student-exam-answer-index')}}" class="btn btn-primary">Cancel</a>
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

@section('page_js')

<script>

$(document).ready(function(){
    $('#lang').click(function(){
        
    var value = $('select[name="lang"] option:selected').val(); 
    
        if(value == 1){
            $("div.myDiv").hide();
            $("div#language1").show();
        }
        if(value == 2){
            $("div#language1").show();
            $("div#language2").show();
        }
        
    });
});

</script>
@endsection
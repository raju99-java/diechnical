@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('franchise-student-exams')}}">Franchise Exam Management</a>
        <i class="fa fa-circle"></i>
    </li>
    
    <li> <span class="active">Edit</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Franchise Exam Data of student {{$model->user->full_name}} course {{$model->course->name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                
                <form  method="post" action="{{route('franchise-student-exam-post-edit',['id'=>$id])}}" class="form-horizontal" enctype="multipart/form-data">
                    
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $model->id }}">
                    <div class="form-body">
                        @if($model->status=='1')
                            
                            @if($model->course->exam_status == '0')
                                
                                <div class="form-group ">
                                    <label class="control-label col-md-3">Select Number of Language : </label>
                                    <div class="col-md-10">
                                        <select name="lang" id="lang" class="form-control">
                                            <option disabled class="option selected focus">Select</option>
                                            <option value="1" class="option" {{ (old('lang')!="") ? ('1'==old('lang'))?'selected':'' : strcasecmp("1","$model->lang")?'':'selected'}}>ONE</option>
                                            <option value="2" class="option" {{ (old('lang')!="") ? ('2'==old('lang'))?'selected':'' : strcasecmp("2","$model->lang")?'':'selected'}}>TWO</option>
                                        </select>
                                    </div>
                                </div>
                            
                                <div id="language1" class="myDiv">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><h4 style="font-weight: bold;">Language One</h4></label>
                                    </div>
                                    <div class="form-group {{ $errors->has('language') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-3">Language</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" placeholder="Language" name="language" value="{{ (old('language')!="") ? old('language') : $model->language}}"/>
                                            @if ($errors->has('language'))
                                            <span class="help-block"> {{ $errors->first('language') }} </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('speed') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-3">Speed</label>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" placeholder="Speed" name="speed" value="{{ (old('speed')!="") ? old('speed') : $model->speed}}"/>
                                            @if ($errors->has('speed'))
                                            <span class="help-block"> {{ $errors->first('speed') }} </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('accuracy') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-3">Accuracy</label>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" placeholder="Accuracy" name="accuracy" value="{{ (old('accuracy')!="") ? old('accuracy') : $model->accuracy}}"/>
                                            @if ($errors->has('accuracy'))
                                            <span class="help-block"> {{ $errors->first('accuracy') }} </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('time_taken') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-3">Time Taken</label>
                                        <div class="col-md-10">
                                            <input type="number" step="0.01" class="form-control" placeholder="Time Taken" name="time_taken" value="{{ (old('time_taken')!="") ? old('time_taken') : $model->time_taken}}"/>
                                            @if ($errors->has('time_taken'))
                                            <span class="help-block"> {{ $errors->first('time_taken') }} </span>
                                            @endif
                                        </div>
                                    </div>
                                   
                                </div>
                                <hr>
                                
                                <div id="language2" class="myDiv" style="display:none;">
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><h4 style="font-weight: bold;">Language Two</h4></label>
                                    </div>
                                    <div class="form-group {{ $errors->has('language2') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-3">Language</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" placeholder="Language" name="language2" value="{{ (old('language2')!="") ? old('language2') : $model->language2}}"/>
                                            @if ($errors->has('language2'))
                                            <span class="help-block"> {{ $errors->first('language2') }} </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('speed2') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-3">Speed</label>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" placeholder="Speed" name="speed2" value="{{ (old('speed2')!="") ? old('speed2') : $model->speed2}}"/>
                                            @if ($errors->has('speed2'))
                                            <span class="help-block"> {{ $errors->first('speed2') }} </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('accuracy2') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-3">Accuracy</label>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" placeholder="Accuracy" name="accuracy2" value="{{ (old('accuracy2')!="") ? old('accuracy2') : $model->accuracy2}}"/>
                                            @if ($errors->has('accuracy2'))
                                            <span class="help-block"> {{ $errors->first('accuracy2') }} </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('time_taken2') ? ' has-error' : '' }}">
                                        <label class="control-label col-md-3">Time Taken</label>
                                        <div class="col-md-10">
                                            <input type="number" step="0.01" class="form-control" placeholder="Time Taken" name="time_taken2" value="{{ (old('time_taken2')!="") ? old('time_taken2') : $model->time_taken2}}"/>
                                            @if ($errors->has('time_taken2'))
                                            <span class="help-block"> {{ $errors->first('time_taken2') }} </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                
                            @else
                                <div class="form-group {{ $errors->has('theory') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-3">Theory(70)</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="Theory" name="theory" value="{{ (old('theory')!="") ? old('theory') : $model->theory}}"/>
                                        @if ($errors->has('theory'))
                                        <span class="help-block"> {{ $errors->first('theory') }} </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('practical') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-3">Practical(20)</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="Theory" name="practical" value="{{ (old('practical')!="") ? old('practical') : $model->practical}}"/>
                                        @if ($errors->has('practical'))
                                        <span class="help-block"> {{ $errors->first('practical') }} </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('viva') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-3">Viva(10)</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="Viva" name="viva" value="{{ (old('viva')!="") ? old('viva') : $model->viva}}"/>
                                        @if ($errors->has('viva'))
                                        <span class="help-block"> {{ $errors->first('viva') }} </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            
                                <div class="form-group {{ $errors->has('admin_marks_submit') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-3">Certificate Generate</label>
                                    <div class="col-md-10">
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                                <input type="radio" name="admin_marks_submit" value="1" {{ ($model->admin_marks_submit == '1') ? 'checked' : '' }}> Yes
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="admin_marks_submit" value="0" {{ ($model->admin_marks_submit == '0') ? 'checked' : '' }}> No
                                            </label>
                                            @if ($errors->has('admin_marks_submit'))
                                            <span class="help-block"> {{ $errors->first('admin_marks_submit') }} </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        
                        @else
                        <div class="form-group {{ $errors->has('supply_exam_fees') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Supply Exam Fees <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="supply_exam_fees" value="1" {{ ($model->supply_exam_fees == '1') ? 'checked' : '' }}> Paid
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="supply_exam_fees" value="0" {{ ($model->supply_exam_fees == '0') ? 'checked' : '' }}> Not Paid
                                    </label>
                                    @if ($errors->has('supply_exam_fees'))
                                    <div class="help-block">{{ $errors->first('supply_exam_fees') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        
                    </div>
                        
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <a href="{{Route('franchise-student-exams')}}" class="btn btn-primary">Cancel</a>
                                    <button type="submit" class="btn green"> Update</button>
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
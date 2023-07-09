<?php

$PAYU_BASE_URL = $BASE_URL;
$action = '';
$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$posted = array();
$posted = array(
    'key' => $MERCHANT_KEY,
    'txnid' => $txnid,
    'amount' => '',
    'firstname' => 'Akash Sarkar',
    'email' => 'albert@yopmail.com',
    'productinfo' => 'Exam fee',
    'surl' => 'http://ditechnical.in',
    'furl' => 'http://ditechnical.in',
    'service_provider' => 'payu_paisa',
);

if (empty($posted['txnid'])) {
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
    $txnid = $posted['txnid'];
}
$hash = '';
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if (empty($posted['hash']) && sizeof($posted) > 0) {
    $hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';
    foreach ($hashVarsSeq as $hash_var) {
        $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
        $hash_string .= '|';
    }
    $hash_string .= $SALT;
    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
} elseif (!empty($posted['hash'])) {
    $hash = $posted['hash'];
    $action = $PAYU_BASE_URL . '/_payment';
}
?>

@extends('franchise::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('franchise-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li> <a href="{{Route('franchise-student-exam-answer-index')}}">Exam</a>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Exam Answers of student {{$model->user->full_name}} course {{$model->course->name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                @if($model->status=='1')
                
                    @if($model->admin_marks_submit == '0')
                        <form id="exam_data_fees" method="post" action="{{route('franchise-student-exam-answer-edit',['id'=>$id])}}" class="form-horizontal" enctype="multipart/form-data">
                            @method('PUT')
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{ $model->id }}">
                            <div class="form-group {{ $errors->has('theory') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-3">Theory(70)</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="Theory" name="theory" value=""/>
                                        <span class="help-block" id="error-theory"></span>
                                        @if ($errors->has('theory'))
                                        <span class="help-block"> {{ $errors->first('theory') }} </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('practical') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-3">Practical(20)</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="Theory" name="practical" value=""/>
                                        <span class="help-block" id="error-practical"></span>
                                        @if ($errors->has('practical'))
                                        <span class="help-block"> {{ $errors->first('practical') }} </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('viva') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-3">Viva(10)</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="Viva" name="viva" value=""/>
                                        <span class="help-block" id="error-viva"></span>
                                        @if ($errors->has('viva'))
                                        <span class="help-block"> {{ $errors->first('viva') }} </span>
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" name="certificate_fees" value="{{ (old('certificate_fees')!="") ? old('certificate_fees') : $course->certificate_fees}}"/>
                                
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <a href="{{Route('franchise-student-exam-answer-index')}}" class="btn btn-primary">Cancel</a>
                                            <button type="submit" class="btn green"> Submit</button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    @else
                        <form id="exam_data_fees" method="post" action="{{route('franchise-student-exam-answer-edit',['id'=>$id])}}" class="form-horizontal" enctype="multipart/form-data">
                            @method('PUT')
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{ $model->id }}">
                            <div class="form-group">
                                    <div class="col-md-10">
                                        <p style="color:green;">You have already submitted exam data, You can edit .</p>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('theory') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-3">Theory(70)</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="theory" placeholder="{{ (old('theory')!="") ? old('theory') : $model->theory}}" value="" />
                                        <span class="help-block" id="error-theory"></span>
                                        @if ($errors->has('theory'))
                                        <span class="help-block"> {{ $errors->first('theory') }} </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('practical') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-3">Practical(20)</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="practical" placeholder="{{ (old('practical')!="") ? old('practical') : $model->practical}}" value=""/>
                                        <span class="help-block" id="error-practical"></span>
                                        @if ($errors->has('practical'))
                                        <span class="help-block"> {{ $errors->first('practical') }} </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('viva') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-3">Viva(10)</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="viva" placeholder="{{ (old('viva')!="") ? old('viva') : $model->viva}}" value=""/>
                                        <span class="help-block" id="error-viva"></span>
                                        @if ($errors->has('viva'))
                                        <span class="help-block"> {{ $errors->first('viva') }} </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <a href="{{Route('franchise-student-exam-answer-index')}}" class="btn btn-primary">Cancel</a>
                                            <button type="submit" class="btn green"> Update</button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    @endif
                    
                @else
                
                    @if($model->supply_exam_fees == '0')
                        <form id="exam_data_fees" method="post" action="{{route('franchise-student-exam-answer-edit',['id'=>$id])}}" class="form-horizontal" enctype="multipart/form-data">
                            @method('PUT')
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{ $model->id }}">
                            <div class="form-group {{ $errors->has('supply_exam_fees') ? ' has-error' : '' }}">
                                    <label class="control-label col-md-3">Supply Exam Fees <span class="required">*</span></label>
                                    <input type="hidden" class="form-control" name="supply_fees" value="100"/>
                                    <div class="col-md-10">
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                                <input type="checkbox" name="supply_exam_fees" value="1" > Check to Paid Rs: 100 for Supply Exam Fees
                                            </label>
                                            
                                            <span class="help-block" id="error-supply_exam_fees"></span>
                                            @if ($errors->has('supply_exam_fees'))
                                            <div class="help-block">{{ $errors->first('supply_exam_fees') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <a href="{{Route('franchise-student-exam-answer-index')}}" class="btn btn-primary">Cancel</a>
                                            <button type="submit" class="btn green"> Submit</button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    @else
                        <div class="form-group">
                            <label class="control-label col-md-3">Supply Exam Fees</label>
                            <div class="col-md-10">
                                <p style="color:red;">You have already paid Supply Exam Fees!</p>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <a href="{{Route('franchise-student-exam-answer-index')}}" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                @endif
                
                <form action="<?php echo $action; ?>" method="post" name="payuForm">
                    @csrf
                    <input type="hidden" name="key"  value="<?php echo $MERCHANT_KEY ?>" />
                    <input type="hidden" name="hash" id="hash" value="<?php echo $hash ?>"/>
                    <input type="hidden" name="txnid" id="txnid" value="<?php echo $txnid ?>" />
                    <input type="hidden" name="amount" id="amount" value="" /><br />
                    <input type="hidden" name="firstname" id="firstname" value="Akash Sarkar" />
                    <input type="hidden" name="email" id="email" value="albert@yopmail.com" />
                    <input type="hidden" name="phone" id="phone" value=""/>
                    <input type="hidden" name="productinfo" value="Exam fee">
                    <input type="hidden" name="surl" id="surl" value="" />
                    <input type="hidden" name="furl" id="furl" value="" />
                    <input type="hidden" name="service_provider" value="payu_paisa" />
                    <?php if (!$hash) { ?>
                        <input type="submit" value="Submit" />
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')
<script>

function submitPayuForm() {
        var hash = $('input[name=hash]').val();
        if (hash == '') {
            return;
        }
        var payuForm = document.forms.payuForm;
        payuForm.submit();
    }
</script>

@endsection
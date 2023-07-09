@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('affiliation-plan')}}">Affilation Plans Management</a>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Plan</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('affiliation-plan-add')}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-body">
                        
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Name<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ (old('name')!="") ? old('name') : ''}}"/>
                                @if ($errors->has('name'))
                                <span class="help-block"> {{ $errors->first('name') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Price</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Price" name="price" value="{{ (old('price')!="") ? old('price') : ''}}"/>
                                @if ($errors->has('price'))
                                <span class="help-block"> {{ $errors->first('price') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('validity') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Validity (Days)<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Validity" name="validity" value="{{ (old('validity')!="") ? old('validity') : ''}}"/>
                                @if ($errors->has('validity'))
                                <span class="help-block"> {{ $errors->first('validity') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('free_wallet') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Free Wallet Amount (Rs.)</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Free Wallet Amount" name="free_wallet" value="{{ (old('free_wallet')!="") ? old('free_wallet') : ''}}"/>
                                @if ($errors->has('free_wallet'))
                                <span class="help-block"> {{ $errors->first('free_wallet') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('joining_wallet') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Joining Wallet Amount (Rs.)</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Joining Wallet Amount" name="joining_wallet" value="{{ (old('joining_wallet')!="") ? old('joining_wallet') : ''}}"/>
                                @if ($errors->has('joining_wallet'))
                                <span class="help-block"> {{ $errors->first('joining_wallet') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('registration_fee') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Registration Fee (Rs.) <span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Registration Fee" name="registration_fee" value="{{ (old('registration_fee')!="") ? old('registration_fee') : ''}}"/>
                                @if ($errors->has('registration_fee'))
                                <span class="help-block"> {{ $errors->first('registration_fee') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('course_assign_fee') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Course Assign Fee (Rs.) <span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Course Assign Fee" name="course_assign_fee" value="{{ (old('course_assign_fee')!="") ? old('course_assign_fee') : ''}}"/>
                                @if ($errors->has('course_assign_fee'))
                                <span class="help-block"> {{ $errors->first('course_assign_fee') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('certificate_fee') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Certificate Fee (Rs.) <span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Certificate Fee" name="certificate_fee" value="{{ (old('certificate_fee')!="") ? old('certificate_fee') : ''}}"/>
                                @if ($errors->has('certificate_fee'))
                                <span class="help-block"> {{ $errors->first('certificate_fee') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('commission') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Commission (%) <span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Commission" name="commission" value="{{ (old('commission')!="") ? old('commission') : ''}}"/>
                                @if ($errors->has('commission'))
                                <span class="help-block"> {{ $errors->first('commission') }} </span>
                                @endif
                            </div>
                        </div>
                        
                       
                        <div class="form-group {{ $errors->has('details') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Details about Plan<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Details about Plan" name="details"  id="body">{{ (old('details')!="") ? old('details') : '' }}</textarea>
                                @if ($errors->has('details'))
                                <span class="help-block"> {{ $errors->first('details') }} </span>
                                @endif
                            </div>
                        </div>
                        



                        <div class="form-group {{ $errors->has('referral_status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Referred Others <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="referral_status" value="1"> Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="referral_status" value="0"> No
                                    </label>
                                    @if ($errors->has('referral_status'))
                                    <div class="help-block">{{ $errors->first('referral_status') }}</div>
                                    @endif
                                </div>
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
                                <a href="{{Route('affiliation-plan')}}" class="btn btn-primary">Cancel</a>
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
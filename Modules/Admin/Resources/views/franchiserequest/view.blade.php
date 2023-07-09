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
        <span class="active">Edit</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Edit Franchise</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('franchise-request-edit',['id'=>$model->id])}}" class="form-horizontal" enctype="multipart/form-data">
                    @method('PUT')
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $model->id }}">
                    <div class="form-body">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Franchise Name*" name="name" value="{{ (old('name')!="") ? old('name') : $model->name }}" />
                                    <span class="help-block" id="error-name"></span>
                                    @if ($errors->has('name'))
                                       <span class="help-block"> {{ $errors->first('name') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Franchise Address*" name="address" value="{{ (old('address')!="") ? old('address') : $model->address }}" />
                                    <span class="help-block" id="error-address"></span>
                                    @if ($errors->has('address'))
                                       <span class="help-block"> {{ $errors->first('address') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Franchise City*" name="city" value="{{ (old('city')!="") ? old('city') : $model->city }}" />
                                    <span class="help-block" id="error-city"></span>
                                    @if ($errors->has('city'))
                                       <span class="help-block"> {{ $errors->first('city') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('post_office') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Post Office Address*" name="post_office" value="{{ (old('post_office')!="") ? old('post_office') : $model->post_office }}" />
                                    <span class="help-block" id="error-post_office"></span>
                                    @if ($errors->has('post_office'))
                                       <span class="help-block"> {{ $errors->first('post_office') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('district') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Franchise District*" name="district" value="{{ (old('district')!="") ? old('district') : $model->district }}" />
                                    <span class="help-block" id="error-district"></span>
                                    @if ($errors->has('district'))
                                       <span class="help-block"> {{ $errors->first('district') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}"> 
                                    <select name="state" class="form-control" ><option value="" disabled >Franchise State*</option>
        								<option value="Andhra Pradesh" class="option" {{ strcasecmp("Andhra Pradesh","$model->state")?'':'selected'}}>Andhra Pradesh</option>
                                        <option value="Andaman and Nicobar Islands" class="option" {{ strcasecmp("Andaman and Nicobar Islands","$model->state")?'':'selected'}}>Andaman and Nicobar Islands</option>
                                        <option value="Arunachal Pradesh" class="option" {{ strcasecmp("Arunachal Pradesh","$model->state")?'':'selected'}}>Arunachal Pradesh</option>
                                        <option value="Assam" class="option" {{ strcasecmp("Assam","$model->state")?'':'selected'}}>Assam</option>
                                        <option value="Bihar" class="option" {{ strcasecmp("Bihar","$model->state")?'':'selected'}}>Bihar</option>
                                        <option value="Chandigarh" class="option" {{ strcasecmp("Chandigarh","$model->state")?'':'selected'}}>Chandigarh</option>
                                        <option value="Chhattisgarh" class="option" {{ strcasecmp("Chhattisgarh","$model->state")?'':'selected'}}>Chhattisgarh</option>
                                        <option value="Dadar and Nagar Haveli" class="option" {{ strcasecmp("Dadar and Nagar Haveli","$model->state")?'':'selected'}}>Dadar and Nagar Haveli</option>
                                        <option value="Daman and Diu" class="option" {{ strcasecmp("Daman and Diu","$model->state")?'':'selected'}}>Daman and Diu</option>
                                        <option value="Delhi" class="option" {{ strcasecmp("Delhi","$model->state")?'':'selected'}}>Delhi</option>
                                        <option value="Lakshadweep" class="option" {{ strcasecmp("Lakshadweep","$model->state")?'':'selected'}}>Lakshadweep</option>
                                        <option value="Puducherry" class="option" {{ strcasecmp("Puducherry","$model->state")?'':'selected'}}>Puducherry</option>
                                        <option value="Goa" class="option" {{ strcasecmp("Goa","$model->state")?'':'selected'}}>Goa</option>
                                        <option value="Gujarat" class="option" {{ strcasecmp("Gujarat","$model->state")?'':'selected'}}>Gujarat</option>
                                        <option value="Haryana" class="option" {{ strcasecmp("Haryana","$model->state")?'':'selected'}}>Haryana</option>
                                        <option value="Himachal Pradesh" class="option" {{ strcasecmp("Himachal Pradesh","$model->state")?'':'selected'}}>Himachal Pradesh</option>
                                        <option value="Jammu and Kashmir" class="option" {{ strcasecmp("Jammu and Kashmir","$model->state")?'':'selected'}}>Jammu and Kashmir</option>
                                        <option value="Jharkhand" class="option" {{ strcasecmp("Jharkhand","$model->state")?'':'selected'}}>Jharkhand</option>
                                        <option value="Karnataka" class="option" {{ strcasecmp("Karnataka","$model->state")?'':'selected'}}>Karnataka</option>
                                        <option value="Kerala" class="option" {{ strcasecmp("Kerala","$model->state")?'':'selected'}}>Kerala</option>
                                        <option value="Madhya Pradesh" class="option" {{ strcasecmp("Madhya Pradesh","$model->state")?'':'selected'}}>Madhya Pradesh</option>
                                        <option value="Maharashtra" class="option" {{ strcasecmp("Maharashtra","$model->state")?'':'selected'}}>Maharashtra</option>
                                        <option value="Manipur" class="option" {{ strcasecmp("Manipur","$model->state")?'':'selected'}}>Manipur</option>
                                        <option value="Meghalaya" class="option" {{ strcasecmp("Meghalaya","$model->state")?'':'selected'}}>Meghalaya</option>
                                        <option value="Mizoram" class="option" {{ strcasecmp("Mizoram","$model->state")?'':'selected'}}>Mizoram</option>
                                        <option value="Nagaland" class="option" {{ strcasecmp("Nagaland","$model->state")?'':'selected'}}>Nagaland</option>
                                        <option value="Odisha" class="option" {{ strcasecmp("Odisha","$model->state")?'':'selected'}}>Odisha</option>
                                        <option value="Punjab" class="option" {{ strcasecmp("Punjab","$model->state")?'':'selected'}}>Punjab</option>
                                        <option value="Rajasthan" class="option" {{ strcasecmp("Rajasthan","$model->state")?'':'selected'}}>Rajasthan</option>
                                        <option value="Sikkim" class="option" {{ strcasecmp("Sikkim","$model->state")?'':'selected'}}>Sikkim</option>
                                        <option value="Tamil Nadu" class="option" {{ strcasecmp("Tamil Nadu","$model->state")?'':'selected'}}>Tamil Nadu</option>
                                        <option value="Telangana" class="option" {{ strcasecmp("Telangana","$model->state")?'':'selected'}}>Telangana</option>
                                        <option value="Tripura" class="option" {{ strcasecmp("Tripura","$model->state")?'':'selected'}}>Tripura</option>
                                        <option value="Uttar Pradesh" class="option" {{ strcasecmp("Uttar Pradesh","$model->state")?'':'selected'}}>Uttar Pradesh</option>
                                        <option value="Uttarakhand" class="option" {{ strcasecmp("Uttarakhand","$model->state")?'':'selected'}}>Uttarakhand</option>
                                        <option value="West Bengal" class="option" {{ strcasecmp("West Bengal","$model->state")?'':'selected'}}>West Bengal</option>
        							</select>
        							<span class="help-block" id="error-state"></span>
                                    @if ($errors->has('state'))
                                       <span class="help-block"> {{ $errors->first('state') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('pin') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Pin Code*" name="pin" value="{{ (old('pin')!="") ? old('pin') : $model->pin }}" />
                                    <span class="help-block" id="error-pin"></span>
                                    @if ($errors->has('pin'))
                                       <span class="help-block"> {{ $errors->first('pin') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Country*" name="country" value="{{ (old('country')!="") ? old('country') : $model->country }}" />
                                    <span class="help-block" id="error-country"></span>
                                    @if ($errors->has('country'))
                                       <span class="help-block"> {{ $errors->first('country') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                    <input type="file" class="form-control"  placeholder="Upload Image*" name="image" onchange="readURL(this);">
                                    <span class="help-block" id="error-image"></span>
                                    @if ($errors->has('image'))
                                    <span class="help-block"> {{ $errors->first('image') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <a href="{{isset($model->image)?URL::asset('public/uploads/user/'.$model->image):''}}" class="btn btn-xs btn-primary pull-left" target="_blank"><i class="fa fa-eye"></i>View Image</a><br/>
                            </div>
                        </div>
                        <br>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('establish') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control"  placeholder="Year of Establishment*" name="establish" value="{{ (old('establish')!="") ? old('establish') : $model->establish }}" />
                                    <span class="help-block" id="error-establish"></span>
                                    @if ($errors->has('establish'))
                                    <span class="help-block"> {{ $errors->first('establish') }} </span>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group"> 
                                    <p>Information About the Chief Executive/Principal/Director of the Franchise</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('owner_name') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter Your Full Name*" name="owner_name" value="{{ (old('owner_name')!="") ? old('owner_name') : $model->owner_name }}" />
                                    <span class="help-block" id="error-owner_name"></span>
                                    @if ($errors->has('owner_name'))
                                    <span class="help-block"> {{ $errors->first('owner_name') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}"> 
                                    <input type="email" class="form-control" placeholder="Enter Your Email*" name="email" value="{{ (old('email')!="") ? old('email') : $model->email }}" />
                                    <span class="help-block" id="error-email"></span>
                                    @if ($errors->has('email'))
                                    <span class="help-block"> {{ $errors->first('email') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}"> 
                                    <input type="tel" class="form-control" placeholder="Enter Your Contact No.*" name="phone" value="{{ (old('phone')!="") ? old('phone') : $model->phone }}" />
                                    <span class="help-block" id="error-phone"></span>
                                    @if ($errors->has('phone'))
                                    <span class="help-block"> {{ $errors->first('phone') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('designation') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter Your Designation*" name="designation" value="{{ (old('designation')!="") ? old('designation') : $model->designation }}" />
                                    <span class="help-block" id="error-designation"></span>
                                    @if ($errors->has('designation'))
                                    <span class="help-block"> {{ $errors->first('designation') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('qualification') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter Your Qualification*" name="qualification" value="{{ (old('qualification')!="") ? old('qualification') : $model->qualification }}" />
                                    <span class="help-block" id="error-qualification"></span>
                                    @if ($errors->has('qualification'))
                                    <span class="help-block"> {{ $errors->first('qualification') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('experience') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter Your Professional Experience*" name="experience" value="{{ (old('experience')!="") ? old('experience') : $model->experience }}" />
                                    <span class="help-block" id="error-experience"></span>
                                    @if ($errors->has('experience'))
                                    <span class="help-block"> {{ $errors->first('experience') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="control-label col-sm-5" >Your Image</label>
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('owner_image') ? ' has-error' : '' }}">
                                    <input type="file" class="form-control"  placeholder="Upload Image*" name="owner_image" onchange="readURL(this);">
                                    <span class="help-block" id="error-owner_image"></span>
                                    @if ($errors->has('owner_image'))
                                    <span class="help-block"> {{ $errors->first('owner_image') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <a href="{{isset($model->owner_image)?URL::asset('public/uploads/user/'.$model->owner_image):''}}" class="btn btn-xs btn-primary pull-left" target="_blank"><i class="fa fa-eye"></i>View Image</a><br/>
                            </div>
                        </div>
                        <br>
                        
                        <div class="row">
                            <label class="control-label col-sm-5" >ID Proof</label>
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('id_proof') ? ' has-error' : '' }}">
                                    <input type="file" class="form-control"  placeholder="Upload Image*" name="id_proof" onchange="readURL(this);">
                                    <span class="help-block" id="error-owner_image"></span>
                                    @if ($errors->has('id_proof'))
                                    <span class="help-block"> {{ $errors->first('id_proof') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <a href="{{isset($model->id_proof)?URL::asset('public/uploads/user/'.$model->id_proof):''}}" class="btn btn-xs btn-primary pull-left" target="_blank"><i class="fa fa-eye"></i>View Image</a><br/>
                            </div>
                        </div>
                        <br>
                        
                        <div class="row">
                            <label class="control-label col-sm-5">Staff Room</label>
                            
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('staff_room') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter No. of Rooms*" name="staff_room" value="{{ (old('staff_room')!="") ? old('staff_room') : $model->staff_room }}" />
                                    <span class="help-block" id="error-staff_room"></span>
                                    @if ($errors->has('staff_room'))
                                    <span class="help-block"> {{ $errors->first('staff_room') }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('staff_seating') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter No. of Seating Capacity*" name="staff_seating" value="{{ (old('staff_seating')!="") ? old('staff_seating') : $model->staff_seating }}" />
                                    <span class="help-block" id="error-staff_seating"></span>
                                    @if ($errors->has('staff_seating'))
                                    <span class="help-block"> {{ $errors->first('staff_seating') }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('staff_area') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter Total Area (Sq.Ft.)*" name="staff_area" value="{{ (old('staff_area')!="") ? old('staff_area') : $model->staff_area }}" />
                                    <span class="help-block" id="error-staff_area"></span>
                                    @if ($errors->has('staff_area'))
                                    <span class="help-block"> {{ $errors->first('staff_area') }} </span>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        
                        <div class="row">
                            <label class="control-label col-sm-5">Class Room</label>
                            
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('class_room') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter No. of Rooms*" name="class_room" value="{{ (old('class_room')!="") ? old('class_room') : $model->class_room }}" />
                                    <span class="help-block" id="error-class_room"></span>
                                    @if ($errors->has('class_room'))
                                    <span class="help-block"> {{ $errors->first('class_room') }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('class_seating') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter No. of Seating Capacity*" name="class_seating" value="{{ (old('class_seating')!="") ? old('class_seating') : $model->class_seating }}" />
                                    <span class="help-block" id="error-class_seating"></span>
                                    @if ($errors->has('class_seating'))
                                    <span class="help-block"> {{ $errors->first('class_seating') }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('class_area') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter Total Area (Sq.Ft.)*" name="class_area" value="{{ (old('class_area')!="") ? old('class_area') : $model->class_area }}" />
                                    <span class="help-block" id="error-class_area"></span>
                                    @if ($errors->has('class_area'))
                                    <span class="help-block"> {{ $errors->first('class_area') }} </span>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        <div class="row">
                            <label class="control-label col-sm-5" >Computer Lab</label>
                            
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('lab_room') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter No. of Rooms*" name="lab_room" value="{{ (old('lab_room')!="") ? old('lab_room') : $model->lab_room }}" />
                                    <span class="help-block" id="error-lab_room"></span>
                                    @if ($errors->has('lab_room'))
                                    <span class="help-block"> {{ $errors->first('lab_room') }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('lab_seating') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter No. of Seating Capacity*" name="lab_seating" value="{{ (old('lab_seating')!="") ? old('lab_seating') : $model->lab_seating }}" />
                                    <span class="help-block" id="error-lab_seating"></span>
                                    @if ($errors->has('lab_seating'))
                                    <span class="help-block"> {{ $errors->first('lab_seating') }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('lab_area') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter Total Area (Sq.Ft.)*" name="lab_area" value="{{ (old('lab_area')!="") ? old('lab_area') : $model->lab_area }}" />
                                    <span class="help-block" id="error-lab_area"></span>
                                    @if ($errors->has('lab_area'))
                                    <span class="help-block"> {{ $errors->first('lab_area') }} </span>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        
                        <div class="row">
                            <label class="control-label col-sm-5" >Reception</label>
                            
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('reception_room') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter No. of Rooms*" name="reception_room" value="{{ (old('reception_room')!="") ? old('reception_room') : $model->reception_room }}" />
                                    <span class="help-block" id="error-reception_room"></span>
                                    @if ($errors->has('reception_room'))
                                    <span class="help-block"> {{ $errors->first('reception_room') }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('reception_seating') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter No. of Seating Capacity*" name="reception_seating" value="{{ (old('reception_seating')!="") ? old('reception_seating') : $model->reception_seating }}" />
                                    <span class="help-block" id="error-reception_seating"></span>
                                    @if ($errors->has('reception_seating'))
                                    <span class="help-block"> {{ $errors->first('reception_seating') }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('reception_area') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter Total Area (Sq.Ft.)*" name="reception_area" value="{{ (old('reception_area')!="") ? old('reception_area') : $model->reception_area }}" />
                                    <span class="help-block" id="error-reception_area"></span>
                                    @if ($errors->has('reception_area'))
                                    <span class="help-block"> {{ $errors->first('reception_area') }} </span>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        <div class="row">
                            <label class="control-label col-sm-5" >Wash Room</label>
                            
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('wash_room') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter No. of Rooms*" name="wash_room" value="{{ (old('wash_room')!="") ? old('wash_room') : $model->wash_room }}" />
                                    <span class="help-block" id="error-wash_room"></span>
                                    @if ($errors->has('wash_room'))
                                    <span class="help-block"> {{ $errors->first('wash_room') }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('wash_seating') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter No. of Seating Capacity*" name="wash_seating" value="{{ (old('wash_seating')!="") ? old('wash_seating') : $model->wash_seating }}" />
                                    <span class="help-block" id="error-wash_seating"></span>
                                    @if ($errors->has('wash_seating'))
                                    <span class="help-block"> {{ $errors->first('wash_seating') }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('wash_area') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Enter Total Area (Sq.Ft.)*" name="wash_area" value="{{ (old('wash_area')!="") ? old('wash_area') : $model->wash_area }}" />
                                    <span class="help-block" id="error-wash_area"></span>
                                    @if ($errors->has('wash_area'))
                                    <span class="help-block"> {{ $errors->first('wash_area') }} </span>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        <div class="row">
                            <label class="control-label col-sm-5" >Wallet Amount (Rs. {{$model->wallet_amount}})</label>
                            <div class="col-sm-12">
                                <div class="form-group {{ $errors->has('wallet_amount') ? ' has-error' : '' }}"> 
                                    <input type="text" class="form-control" placeholder="Add Wallet Amount*" name="wallet_amount" value="{{ (old('wallet_amount')!="") ? old('wallet_amount') : '' }}" />
                                    <span class="help-block" id="error-wallet_amount"></span>
                                    @if ($errors->has('wallet_amount'))
                                    <span class="help-block"> {{ $errors->first('wallet_amount') }} </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" {{ ($model->status == '1') ? 'checked' : '' }}> Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0" {{ ($model->status == '0') ? 'checked' : '' }}> Inactive
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="2" {{ ($model->status == '2') ? 'checked' : '' }}> Block
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
                                <a href="{{Route('franchise-request')}}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn green"> Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--<div class="portlet-body form form-horizontal">-->
            <!--    <div class="form-body">-->
            <!--        <div class="form-group">-->
            <!--            <label class="control-label col-md-2">Name:</label>-->
            <!--            <div class="col-md-10">-->
            <!--                <p class="form-control-static">-->
            <!--                    {{$model->name}}-->
            <!--                </p>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="form-group">-->
            <!--            <label class="control-label col-md-2">Email:</label>-->
            <!--            <div class="col-md-10">-->
            <!--                <p class="form-control-static">-->
            <!--                    {{$model->email}}-->
            <!--                </p>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="form-group">-->
            <!--            <label class="control-label col-md-2">Phone:</label>-->
            <!--            <div class="col-md-10">-->
            <!--                <p class="form-control-static">-->
            <!--                    {{$model->phone}}-->
            <!--                </p>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="form-group">-->
            <!--            <label class="control-label col-md-2">Address:</label>-->
            <!--            <div class="col-md-10">-->
            <!--                <p class="form-control-static">-->
            <!--                    {{$model->address}}-->
            <!--                </p>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--    <div class="form-actions">-->
            <!--        <div class="row">-->
            <!--            <div class="col-md-offset-2 col-md-9">-->
            <!--                <a href="{{Route('franchise-request')}}" class="btn btn-primary">Back</a>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
    </div>
</div>
@endsection
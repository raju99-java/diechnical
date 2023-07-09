@extends('franchise::layouts.main')



@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('franchise-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('franchise-students')}}">student</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Assign Course</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Assign course Student of {{$user->full_name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                 
               
                <form  method="post" action="{{Route('franchise-student-choose-assign-course',['id'=>$id])}}" class="form-horizontal" >
                    
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    
                    <div class="form-group">
                            <label class="control-label col-md-3">Choose Course<span class="required">*</span></label>
                        <div class="col-md-10">
                            <div>
                                <input type="radio" name="course" value="1" checked>
                                <label for="huey">Course of Admin</label>
                            </div>
        
                            <div>
                              <input type="radio"  name="course" value="2">
                              <label for="dewey">Course of ALC</label>
                            </div>
                        </div>
                    </div>
              
                  
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{Route('franchise-students')}}" class="btn btn-primary">Cancel</a>
                                <input type="submit" class="btn green" value="Submit">
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

</script>

@endsection
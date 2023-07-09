@extends('layouts.main')
@section('css')
<style>
.table-my td{
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
  width: 100%;
}

.table-my th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    width: 100%;
    background: #ff5421;
    color: #fff;
}
</style>
@stop
@section('content')
<!--------------------breadcrumb ---------------------->
<section class="breadcrumb about-us-b">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-title-div">
                    <div class="bread-left-side">
                        <h2>REGISTERED STUDENT</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="/">HOME</a>/</li>
                            <li><span>REGISTERED STUDENT</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------- //breadcrumb ------------------->
<!--------------------------------Main content Start--------------------------->
<section class="main">
    <section class="exam-div">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 mb-3">
                    <div class="result-download">
                        <h2>DI TECHNICAL</h>
                            <h3>Registered Student</h3>
                    </div>
                    <form action="{{ route('registered-students') }}" method="get" >
                        <input type="text" class="enroll form-control" name="registration_id" placeholder="Registration Id" required><br>
                        <span class="help-block" id="error-registration_id"></span>
                        <button class="btn btn-default btn-lg btn btn-success">SUBMIT</button>
                        
                    </form>
                    @if(isset($status))
                    <section class="status-show">
                        @if(!empty($user))
                        <h3>Registered Student Details</h3>
                        
                        <div style="width: 100%;">
                           <table class="status-show-table">
                              <tbody>
                                  
                                <tr>
                  	                <td class="name-td">Student Name:</td>
                                    <td>{{$user->full_name}}</td>
                                    <th rowspan="4">
                                    <img src="{{($user->image!='')? URL::asset('public/uploads/user').'/'.$user->image:URL::asset('public/frontend/images/profile.jpg') }}" style="float: right;width: 115px !important; height: 135px !important; margin-left:55px;"><br/>
                					</th>
                                </tr>
                                <tr>
                                    <td class="name-td">Father Name:</td>
                                    <td>{{$user->father_name}}</td>
                                </tr>
                                <tr>
                                    <td class="name-td">Mother Name:</td>
                                    <td>{{$user->mother_name}}</td>
                                </tr>
                                <tr>
                                    <td class="name-td">Registration Id:</td>
                                    <td>{{$user->registration_id}}</td>
                                </tr>
                                
                              </tbody> 
                           </table>       
                        </div>
                        <?php
                        $courses= App\Model\AssignCourse::where('user_id','=',$user->id)->get();
                        
                        ?>
                        
                        <div style="width: 100%;">
                            <table class="table-my mt-5">
                                <tbody>
                                    <tr>
                                        <th>Enrolled Course</th>
                                        <th>Status</th>
                                    </tr>
                                    @forelse($courses as $course)
                                    <tr>
                                        <td>{{$course->course->name}}</td>
                                        <td>
                                            @if($course->status=='0')
                                            Pursuing
                                            @else
                                            Completed
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2">No enrolled course found!</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        @else
                        <h3>No Registered Student Details Found!</h3>
                        @endif
                    </section>
                    @endif
                    
                </div>
                <div class="col-sm-5">
                    <div class="side-bar-page">
                        <div class="enqir-sec">
                            <h3 class="quick-title-sec">Quick Enquiry</h3>
                            <form class="quick-enquiry-form" id="enquiry-form" action="{{route('post-enquiry')}}" method="POST">
                                @csrf
                                <div class="form-group q-grp">
                                    <label class="quick-label">Services*</label>
                                    <select id="services" class="form-control" name="services">
                						<option value="">Select Services</option>
                						<option value="New Franchise">New Franchise</option>
                						<option value="Admission">Admission</option>
                						<option value="Student">Student</option>
                						<option value="ALC">ALC</option>
                						<option value="Other">Other</option>
                					</select>
                                    <span class="help-block" id="error-services"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Full Name*</label>
                                    <input type="text" name="name" class="form-control quick-input" placeholder="Enter Your Full Name.." > 
                                    <span class="help-block" id="error-name"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Contact No*</label>
                                    <input type="tel" name="phone" class="form-control quick-input" placeholder="Enter Your Contact No.." >	
                                    <span class="help-block" id="error-phone"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Email Id*</label>
                                    <input type="email" name="email" class="form-control quick-input" placeholder="Enter Your Email Id..">	
                                    <span class="help-block" id="error-email"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Address*</label>
                                    <textarea name="address" cols="20" rows="2" class="form-control quick-textaeea" placeholder="Address"></textarea>	
                                    <span class="help-block" id="error-address"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Message*</label>
                                    <textarea name="message" cols="20" rows="2" class="form-control quick-textaeea" placeholder="Message"></textarea>	
                                    <span class="help-block" id="error-message"></span>
                                </div>
                                <button type="submit" class="quick-submit">Submit</button>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>  
        </div>
    </section>
</section>




<!----------------------------------Main content End--------------------------->

@stop
@section('js')

@stop
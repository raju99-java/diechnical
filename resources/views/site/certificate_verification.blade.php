@extends('layouts.main')
@section('css')
<style>

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
                        <h2>CERTICATE VERIFICATION</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="/">HOME</a>/</li>
                            <li><span>CERTICATE VERIFICATION</span></li>
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
    
    <script src="{{ URL::asset('public/frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <section class="exam-div">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 mb-3">
                    <div class="result-download">
                        <h2>DI TECHNICAL</h>
                            <h3>Certificate Verification</h3>
                    </div>
                    <form action="{{ route('verify-certificate-verification') }}" method="get" >
                        <input type="text" class="enroll form-control" name="certificate_no" placeholder="Certificate Number" required><br>
                        <span class="help-block" id="error-certificate_no"></span>
                        <button class="btn btn-default btn-lg btn btn-success">SUBMIT</button>
                        
                    </form>
                    @if(isset($status))
                    <section class="status-show">
                        @if(!empty($assigncourse))
                            <h3>Certificate Verification Details</h3>
                            
                            <div style="width: 100%;">
                               <table class="status-show-table">
                                  <tbody>
                                      <?php
                                        
                                        $user = App\Model\UserMaster::where('id','=',$assigncourse->user_id)->first();
                                        ?>
                                    <tr>
                      	                <td class="name-td">Registration No:</td>
                                        <td>{{$user->registration_id}}</td>
                                        <th rowspan="10">
                                        <img src="{{($user->image!='')? URL::asset('public/uploads/user').'/'.$user->image:URL::asset('public/frontend/images/profile.jpg') }}" class="student-img"><br/>
                    					</th>
                                    </tr>
                                    <tr>
                                        <td class="name-td">Enrollment No:</td>
                                        <td>{{$assigncourse->enrollment_id}}</td>
                                    </tr>
                                    <!--<tr>-->
                                    <!--    <td class="name-td">Certificate No:</td>-->
                                    <!--    <td>DITECH0051</td>-->
                                    <!--</tr>-->
                                    <tr>
                      	                <td class="name-td">Mr./Mrs./Miss.</td>
                                        <td>{{$user->full_name}}</td>
                                    </tr>
                                    <tr>
                      	                <td class="name-td">Father's Name</td>
                                        <td>{{$user->father_name}}</td>
                                    </tr>
                                    <tr>
                      	                <td class="name-td">Mother's Name</td>
                                        <td>{{$user->mother_name}}</td>
                                    </tr>
                                    
                                    @if($assigncourse->course->exam_status == '1')
                                    <tr>
                                        
                      	                <td class="name-td">Grade</td>
                                        <td>
                                                                           
                                                                           @if(($model->theory+$model->practical+$model->viva)>=91 && ($model->theory+$model->practical+$model->viva)<=100)
                                               O
                                               @elseif(($model->theory+$model->practical+$model->viva)>=81 && ($model->theory+$model->practical+$model->viva)<=90)
                                               A++
                                               @elseif(($model->theory+$model->practical+$model->viva)>=71 && ($model->theory+$model->practical+$model->viva)<=80)
                                               A+
                                               @elseif(($model->theory+$model->practical+$model->viva)>=61 && ($model->theory+$model->practical+$model->viva)<=70)
                                               A
                                               @elseif(($model->theory+$model->practical+$model->viva)>=51 && ($model->theory+$model->practical+$model->viva)<=60)
                                               A-
                                               @elseif(($model->theory+$model->practical+$model->viva)>=40 && ($model->theory+$model->practical+$model->viva)<=50)
                                               B+
                                               @else
                                               c
                                               @endif
                                        </td>
                                        
                                        
                                    </tr>
                                    @else
                                    
                                    <tr>
                                        
                      	                <td class="name-td">Speed</td>
                      	                
                      	                @if($model->lang == '1')
                                        <td>
                                             {{strtoupper($model->language)}} - {{$model->speed}} WPM
                                        </td>
                                        @endif
                                        
                                        @if($model->lang == '2')
                                        <td>
                                             {{strtoupper($model->language)}} - {{$model->speed}} WPM / {{strtoupper($model->language2)}} - {{$model->speed2}} WPM
                                             
                                        </td>
                                        @endif
                                        
                                        
                                    </tr>
                                        
                                    @endif
                                    
                                    <tr>
                                        <td class="name-td">Course Name:</td>
                                        <td>{{$assigncourse->course->name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="name-td">Center Name:</td>
                                        <td>DHURWA, RANCHI</td>
                                    </tr>
                                        <?php
                                            $purchase_date = $assigncourse->created_at;
                                            $futureDate = date('Y-m-d', strtotime($purchase_date . '+' . $assigncourse->course->time . 'days'));
                                        ?>
                                    <tr>
                                        <td class="name-td">Course Duration:</td>
                                        <td>{{(!empty($assigncourse->created_at)) ? \Carbon\Carbon::parse($assigncourse->created_at)->format('d/m/Y') : 'Not Given'}} to {{(!empty($futureDate)) ? \Carbon\Carbon::parse($futureDate)->format('d/m/Y') : 'Not Given'}} </td>
                                    </tr>
                                    <tr>
                                        <td class="name-td">Course Status:</td>
                                        <td>
                                            @if($assigncourse->status=='0')
                                            <span class="badge badge-warning"><i class="icofont-warning"></i>Persuing</span>
                                            @else
                                            <span class="badge badge-success"><i class="icofont-check"></i>Completed</span>
                                            @endif
                                        </td>
                                    </tr>
                                  </tbody> 
                               </table>       
                            </div>
                        
                                @if($msg_status == '1')
                                    <input type="hidden" id="success_msg" value="{{$success}}"/>
                                    
                                    <script>
                                        var success_msg = $('#success_msg').val();
                                        swal({
                                         icon: "success",
                                         text: success_msg,
                                         timer: 5000,
                                         button:false
                                       });
                                    </script>
                                @endif
                        
                        @else
                            <h3>No Student Certificate Details Found!</h3>
                            
                                @if($msg_status == '0')
                                    <input type="hidden" id="error_msg" value="{{$error}}"/>
                                    
                                    <script>
                                        var error_msg = $('#error_msg').val();
                                        swal({
                                          icon: "error",
                                          text: error_msg,
                                          timer: 5000,
                                          button:false
                                        });
                                    </script>
                                @endif    
                        
                        @endif
                    </section>
                    @endif
                    
                    
                    <div class="di-table-image text-center mt-3">
                        <img src="{{ URL::asset('public/frontend/images/Screenshot (13).png') }}" class="img-fluid" alt="">
                    </div>
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
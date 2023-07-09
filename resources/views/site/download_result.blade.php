
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
                                    <img src="{{($user->image!='')? URL::asset('public/uploads/user').'/'.$user->image:URL::asset('public/frontend/images/profile.jpg') }}" style="float: right;width: 115px !important; height: 135px !important; margin-left:55px;"><br/>
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
                                
                                <tr>
                                    <td class="name-td">Course Name:</td>
                                    <td>{{$assigncourse->course->name}}</td>
                                </tr>
                                <tr>
                                    <td class="name-td">Center Name:</td>
                                    <td>Ranchi</td>
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
                                <tr>
                                    <td class="name-td">Download:</td>
                                    <td>
                                        <a href="{{$pdf}}" target="_blank"><button class="btn btn-success"><i class="fa fa-eye"></i>View Certificate</button></a>
                                    </td>
                                </tr>
                              </tbody> 
                           </table>       
                        </div>
                        @else
                        <h3>No Student Certificate Details Found!</h3>
                        @endif
                    </section>

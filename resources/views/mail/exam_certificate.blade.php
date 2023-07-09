<?php
use App\Model\UserMaster;

$usermaster = UserMaster::where('type_id','=','1')->first();
?>

<div class="container" style="width: 100%; height: auto; background-color: #FEFDDF; border: 3px solid #2A1772; border-radius: 15px; background-image: url(https://ditechnical.in/public/frontend/images/bg.png); background-position: center center; background-size: cover; background-repeat: no-repeat;" >

<table style="width: 100%; padding-top: 0px !important; padding-bottom: 0px !important;">
	<tbody>
     <tr style="margin: 0px !important;">
      <td style="text-align: left !important;">
		<img src="{{$qrcode}}" alt="" style="width: 132.28px; height: 132.28px; margin-top: 8px !important;">
	  </td>
       <td style="text-align: center !important;">
		<img src="{{URL::asset('public/frontend/images/3logo.png')}}" alt="">
	  </td>
       <td style="text-align: right !important;">
		<img src="{{($assigncourse->user->image!='')? URL::asset('public/uploads/user').'/'.$assigncourse->user->image:URL::asset('public/frontend/images/profile.jpg') }}" alt="" style="width: 114px; height: 132.28px; margin-top: 8px !important;">
	  </td>
     </tr>
    </tbody> 
</table>
<h1 style="text-align: center; color: #757336; font-size: 44px; padding: 0px !important; margin: 0px 0px 0px 0px !important;">
    DI TECHNICAL
</h1>
<h2 style="font-style: italic !important; text-align: center; color: #000; font-size: 17px; padding: 0px !important; margin: 0px 0px 0px 0px !important; ">(Digital Information of Technology)</h2>
<h2 style="font-style: italic !important; text-align: center; color: #000; font-size: 17px; padding: 0px !important; margin: 0px 0px 0px 0px !important; ">Dhurwa Bus Stand Ranchi, Jharkhand</h2>
<h2 style="text-align: center; color: #4398B5; font-size: 15px; padding: 0px !important; margin: 0px 0px 0px 0px !important; ">Certificate Verification: www.ditechnical.in/certificate-verification</h2>

<table style="width: 100%; padding-top: 0px !important;">
	<tbody>
     <tr style="margin: 0px !important;">
      <td style="text-align: Center !important;">
		<img src="{{URL::asset('public/frontend/images/certificated-img.png')}}" alt="">
	  </td>
     </tr>
    </tbody> 
</table>
<p style="text-align: center; color: #1f0a85; font-size: 16px; padding: 0px !important; margin: -10px 0px 0px 0px !important;">Certificate No: <b>{{$assigncourse->certificate_no}}</b></p>
<h2 style="font-style: italic !important; text-align: left; color: #000; font-size: 22px; font-weight: bold; padding: 0px 0px 0px 10px !important; margin: 0px 0px 0px 0px !important; ">Authorized Learning Center: <span>{{($assigncourse->franchise_id <> '0') ? strtoupper($assigncourse->franchise->name) : "DI TECHNICAL" }}</span></h2>
<table style="width: 100%; padding-top: 0px !important;">
	<tbody>
     <tr style="margin: 0px 0px 0px 10px !important;">
      <td style="color: #000; font-size: 18px; font-weight: 400; padding: 0px 0px 0px 10px !important;">To,</td>
     </tr>
     <tr style="margin: 0px 0px 0px 10px !important;">
      <td style="color: #000; font-size: 18px; font-weight: 400; padding: 0px 0px 0px 10px !important;">Registration No <span style="padding-left: 0px !important;">:</span> <span>{{$assigncourse->user->registration_id}}</span></td>
     </tr>
     <tr style="margin: 0px 0px 0px 10px !important;">
      <td style="color: #000; font-size: 18px; font-weight: 400; padding: 0px 0px 0px 10px !important;">Enrollment No <span style="padding-left: 6px !important;">:</span> <span>{{$assigncourse->enrollment_id}}</span></td>
     </tr>
     <tr style="margin: 0px 0px 0px 10px !important;">
      <td style="color: #000; font-size: 18px; font-weight: 400; padding: 0px 0px 0px 10px !important;">Mr./Mrs./Miss <span style="padding-left: 10px !important;">:</span> <span>{{$assigncourse->user->full_name}}</span></td>
     </tr>
     <tr style="margin: 0px 0px 0px 10px !important;">
      <td style="color: #000; font-size: 18px; font-weight: 400; padding: 0px 0px 0px 10px !important;">Father's Name <span style="padding-left: 10px !important;">:</span> <span>{{$assigncourse->user->father_name}}</span></td>
     </tr>
     <tr style="margin: 0px 0px 0px 10px !important;">
      <td style="color: #000; font-size: 18px; font-weight: 400; padding: 0px 0px 0px 10px !important;">Mother's Name <span style="padding-left: 4px !important;">:</span> <span>{{$assigncourse->user->mother_name}}</span></td>
     </tr>
     @if($assigncourse->course->exam_status == '1')
     <tr style="margin: 0px 0px 0px 10px !important;">
      <td style="color: #000; font-size: 18px; font-weight: 400; padding: 0px 0px 0px 10px !important;">Grade Description <span style="padding-left: 4px !important;">:</span> <span>
          @if(($model->theory+$model->practical+$model->viva)>=91 && ($model->theory+$model->practical+$model->viva)<=100)
           Outstanding
           @elseif(($model->theory+$model->practical+$model->viva)>=81 && ($model->theory+$model->practical+$model->viva)<=90)
           Excellent
           @elseif(($model->theory+$model->practical+$model->viva)>=71 && ($model->theory+$model->practical+$model->viva)<=80)
           Very Good
           @elseif(($model->theory+$model->practical+$model->viva)>=61 && ($model->theory+$model->practical+$model->viva)<=70)
           Good
           @elseif(($model->theory+$model->practical+$model->viva)>=51 && ($model->theory+$model->practical+$model->viva)<=60)
           Fair
           @elseif(($model->theory+$model->practical+$model->viva)>=40 && ($model->theory+$model->practical+$model->viva)<=50)
           Average
           @else
           Below Average
           @endif
          </span></td>
     </tr>
     @endif
     
    </tbody> 
</table>
<?php
    $purchase_date = $assigncourse->created_at;
    $futureDate = date('Y-m-d', strtotime($purchase_date . '+' . $assigncourse->course->time . 'days'));
?>
<h2 style="text-align: left; color: #2A1772; font-weight: 400; font-size: 18px; padding: 0px 0px 0px 10px !important; margin: 0px 0px 0px 0px !important;">Having successfully qualified all the theory and practical modules. </h2>


<p style="padding: 0px 0px 0px 10px !important; font-size:18px; font-style: italic !important;">Has been awarded <span class="underline-1" style="border-bottom: 1px solid #000; width: 76%; display: inline-block; text-align: center; font-weight:bold;">{{$assigncourse->course->name}}</span></p>
<p style="padding: 0px 0px 0px 10px !important; font-size:18px; font-style: italic !important;">Course In <span class="underline-1" style="border-bottom: 1px solid #000; width: 85%; display: inline-block; text-align: center;">{{$assigncourse->course->course_type}}</span></p>
<p style="padding: 0px 0px 0px 10px !important; font-size:18px; font-style: italic !important;">having completed the curriculum from <span class="underline-1" style="border-bottom: 1px solid #000; width: 45%; display: inline-block; text-align: center;">{{($assigncourse->franchise_id <> '0') ? strtoupper($assigncourse->franchise->district).", ".strtoupper($assigncourse->franchise->state) : " DHURWA, RANCHI" }}</span> center</p>
<p style="padding: 0px 0px 0px 10px !important; font-size:18px; font-style: italic !important;">with 
 @if($assigncourse->course->exam_status == '1')

Grade <span class="underline-1" style="border-bottom: 1px solid #000; width: 18%; display: inline-block; text-align: center;">
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
    </span> and 
 @endif
 
 <span class="underline-1" style="border-bottom: 1px solid #000; width: 18%; display: inline-block; text-align: center;">{{$assigncourse->course->time*1.2}}</span> contact hours and course duration</p>
<p style="padding: 0px 0px 0px 10px !important; font-size:18px; font-style: italic !important;"><span class="underline-1" style="border-bottom: 1px solid #000; width: 15%; display: inline-block; text-align: center;">{{(!empty($assigncourse->created_at)) ? \Carbon\Carbon::parse($assigncourse->created_at)->format('d/m/Y') : 'Not Given'}}</span> to <span class="underline-1" style="border-bottom: 1px solid #000; width: 25%; display: inline-block; text-align: center;">{{(!empty($futureDate)) ? \Carbon\Carbon::parse($futureDate)->format('d/m/Y') : 'Not Given'}}</span>.</p>
<table style="width: 100%; overflow-x:auto; padding: 0px !important;">
		<tbody>
			<tr style="padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">
				<td style="text-align: center!important; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">
				    @if($assigncourse->franchise_id <> '0')
					<img src="{{ URL::asset('public/uploads/sign/'.$assigncourse->franchise->owner_sign)}}" alt="" style="border-radius: 50%; width: 120px; height: 108px; margin: 0px 0px 0px 0px !important; padding: 0px 0px 0px 0px !important; line-height: 0px !important;">
				    @else
				    <img src="{{URL::asset('public/uploads/sign/'.$usermaster->center_incharge_image)}}" alt="" style="border-radius: 50%; width: 120px; height: 117px; margin: 0px 0px 0px 0px !important; padding: 0px 0px 0px 0px !important; line-height: 0px !important;">
				    @endif
				</td>
				<td style="text-align: center!important; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">
					<img src="{{URL::asset('public/frontend/images/Alka.png')}}" alt="" style="width: 150px; height: 50px; margin: 0px 0px 0px 0px !important; padding: 0px 0px 0px 0px !important; line-height: 0px !important;">
				</td>
				<td style="text-align: center!important; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">
					<img src="{{URL::asset('public/frontend/images/dir.png')}}" alt="" style="width: 200px; height: 80px; margin: 0px 0px 0px 0px !important; padding: 0px 0px 0px 0px !important; line-height: 0px !important;">
				</td>
			</tr>
			<tr style="padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">
				<td style="padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">
					<p style="text-align: center!important; font-weight: bold; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important; font-size: 18px; color: #2A1772; font-style: italic !important;">Center Incharge</p>
				</td>
				<td style="padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">
					<p style="text-align: center!important; font-weight: bold; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important; font-size: 18px; color: #2A1772; font-style: italic !important;">Controller Of Examination</p>
				</td>
				<td style="padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">
					<p style="text-align: center!important; font-weight: bold; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important; font-size: 18px; color: #2A1772; font-style: italic !important;">Document Certificate By Director<br>(ANIL KUMAR)</p>
				</td>
			</tr>
			
		</tbody>
	</table>
	
<table style="width: 100%; padding-top: 8px !important; padding-bottom: 25px !important;">
	<tbody>
	 <!--<tr style="margin: 0px 0px 0px 0px !important;">-->
  <!--    <td style="color: #000; font-size: 13px; text-align:center; font-weight: 500; padding: 0px 0px 0px 0px !important;">Grading System<span style="padding-left: 0px !important;">:</span> <span>91> = to 100- O | 81> = to 90- A++ | 71> = to 80- A+ | 61> = to 70- A | 51> = to 60- A- | 40> = to 50- B+</span></td>-->
  <!--   </tr> -->
     
	</tbody>
</table>	
</div> 
<!-------------------//exam-certificate----------------->


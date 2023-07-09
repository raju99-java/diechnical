<?php
use App\Model\UserMaster;

$usermaster = UserMaster::where('type_id','=','1')->first();
?>



<!-------------------Result----------------->
<div class="container" style="width: 100%; height: auto; background-color: #fff; border: 3px solid #2A1772; border-radius: 50px; background-image: url(https://ditechnical.in/public/frontend/images/bg.png); background-position: center center; background-size: cover; background-repeat: no-repeat;" >
<table style="width: 100%; padding-top: 20px !important;">
	<tbody>
     <tr style="margin: 0px !important;">
       <td style="text-align: center !important;">
		<img src="{{$qrcode}}" alt="qrcode" style="height:120px; width:120px;">
	  </td>
     </tr>
    </tbody> 
</table>
<h1 style="text-align: center; color: #757336; font-size: 46px; padding: 0px !important; margin: 0px 0px 0px 0px !important;">
   DI TECHNICAL
</h1>
<h2 style="font-style: italic !important; text-align: center; color: #000; font-size: 20px; padding: 0px !important; margin: 0px 0px 0px 0px !important; ">(Digital Information of Technology)</h2>
<h2 style="font-style: italic !important; text-align: center; color: #000; font-size: 20px; padding: 0px !important; margin: 0px 0px 0px 0px !important; ">Dhurwa Bus Stand Ranchi, Jharkhand</h2>
<h2 style="font-style: italic !important; text-align: center; color: #000; font-size: 27px; padding: 0px !important; margin: 10px 0px 0px 0px !important; ">Performance Statement</h2>
<?php
    $purchase_date = $assigncourse->created_at;
    $futureDate = date('Y-m-d', strtotime($purchase_date . '+' . $assigncourse->course->time . 'days'));
?>
<p style="padding: 10px 0px 0px 10px !important; font-weight: 600; font-size: 18px;">Name <span style="padding-left: 110px !important;">:</span> <span class="underline-1" style="border-bottom: 1px solid #000; width: 60%; display: inline-block; text-align: center;">{{$assigncourse->user->full_name}}</span></p>    
<p style="padding: 0px 0px 0px 10px !important;font-weight: 600; font-size: 18px;">Enrollment No. <span style="padding-left: 28px !important;">:</span> <span class="underline-1" style="border-bottom: 1px solid #000; width: 60%; display: inline-block; text-align: center;">{{$assigncourse->enrollment_id}}</span></p>
<p style="padding: 0px 0px 0px 10px !important;font-weight: 600; font-size: 18px;">Center Name <span style="padding-left: 46px !important;">:</span> <span class="underline-1" style="border-bottom: 1px solid #000; width: 60%; display: inline-block; text-align: center;">{{($assigncourse->franchise_id <> '0') ?  strtoupper($assigncourse->franchise->name).", ". strtoupper($assigncourse->franchise->district).", ".strtoupper($assigncourse->franchise->state) : "DHURWA, RANCHI"}}</span></p>
<p style="padding: 0px 0px 0px 10px !important;font-weight: 600; font-size: 18px;">Course Duration <span style="padding-left: 16px !important;">:</span> <span class="underline-1" style="border-bottom: 1px solid #000; width: 60%; display: inline-block; text-align: center;">{{(!empty($assigncourse->created_at)) ? \Carbon\Carbon::parse($assigncourse->created_at)->format('d-F-Y') : 'Not Given'}} to {{(!empty($futureDate)) ? \Carbon\Carbon::parse($futureDate)->format('d-F-Y') : 'Not Given'}}</span></p>


<table style="width: 100%; padding: 20px 0px 0px 0px!important; margin:40px 10px 10px 10px!important; border: 1px solid #000;">
	<tbody>
     <tr style="margin: 0px !important; ">
       <td style="text-align: left !important; font-weight: 600; font-size: 22px;">Course Name:</td>
     </tr>
     <tr style="margin: 0px !important; ">
       <td style="text-align: left !important; font-weight: 400; font-size: 18px; line-height: 30px !important;">{{$assigncourse->course->name}}: {{$assigncourse->course->course_type}}</td>
     </tr>
     
     @if($assigncourse->course->exam_status == '1')
     <tr>
	     <th style="text-align: left !important; font-weight: 600; font-size: 18px;  border: 1px solid #000;">Particulars</th>
	     <th style="text-align: left !important; font-weight: 600; font-size: 18px;  border: 1px solid #000;">Total Marks</th>
	     <th style="text-align: left !important; font-weight: 600; font-size: 18px;  border: 1px solid #000;">Marks Obtained</th>
	 </tr> 
     <tr style="margin: 0px !important;">
       <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">Theory</td>
       <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">70</td>
       <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">{{$model->theory}}</td>
     </tr>
     
     <tr style="margin: 0px !important;">
       <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">Practical</td>
       <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">20</td>
       <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">{{$model->practical}}</td>
     </tr>
     
     <tr style="margin: 0px !important;">
       <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">Viva</td>
       <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">10</td>
       <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">{{$model->viva}}</td>
     </tr>
     
     <tr style="margin: 0px !important;">
       <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">Sum of</td>
       <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">100</td>
       <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">{{$model->theory+$model->practical+$model->viva}}</td>
     </tr>
     
     <!--<tr style="margin: 0px !important;">-->
     <!--  <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">Full Marks</td>-->
     <!--  <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">70</td>-->
     <!--  <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">100</td>-->
     <!--</tr>-->
      <tr style="margin: 0px !important;">
       <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">Grading Description</td>
       <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;"></td>
       <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">
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
       </td>
     </tr>
     @else
     
        @if($model->lang == '1')
         
         <tr>
    	     <th style="text-align: left !important; font-weight: 600; font-size: 18px;  border: 1px solid #000;">Language</th>
    	     <th style="text-align: left !important; font-weight: 600; font-size: 18px;  border: 1px solid #000;">{{strtoupper($model->language)}}</th>
    	 </tr>
         <tr style="margin: 0px !important;">
           <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">Speed</td>
           <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">{{$model->speed}} WPM</td>
         </tr>
         <tr style="margin: 0px !important;">
           <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">Accuracy</td>
           <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">{{$model->accuracy}} %</td>
         </tr>
         <tr style="margin: 0px !important;">
           <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">Time Taken</td>
           <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">{{$model->time_taken}} M</td>
         </tr>
         
        @endif
        
        @if($model->lang == '2')
         
         <tr>
    	     <th style="text-align: left !important; font-weight: 600; font-size: 18px;  border: 1px solid #000;">Language</th>
    	     <th style="text-align: left !important; font-weight: 600; font-size: 18px;  border: 1px solid #000;">{{strtoupper($model->language)}}</th>
    	     <th style="text-align: left !important; font-weight: 600; font-size: 18px;  border: 1px solid #000;">{{strtoupper($model->language2)}}</th>
    	 </tr>
         <tr style="margin: 0px !important;">
           <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">Speed</td>
           <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">{{$model->speed}} WPM</td>
           <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">{{$model->speed2}} WPM</td>
         </tr>
         <tr style="margin: 0px !important;">
           <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">Accuracy</td>
           <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">{{$model->accuracy}} %</td>
           <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">{{$model->accuracy2}} %</td>
         </tr>
         <tr style="margin: 0px !important;">
           <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">Time Taken</td>
           <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">{{$model->time_taken}} M</td>
           <td style="text-align: left !important; font-weight: 400; font-size: 18px;  border: 1px solid #000;">{{$model->time_taken2}} M</td>
         </tr>
        @endif
        
     @endif
     
    </tbody> 
</table>
<!--<table style="width: 100%; overflow-x:auto; padding: 0px !important;">-->
<!--		<tbody>-->
<!--			<tr style="padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">-->
<!--				<td style="text-align: center!important; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">-->
<!--					<img src="{{URL::asset('public/frontend/images/Center.png')}}" alt="" style="width: 85px; height: 85px; margin: 0px 0px 0px 0px !important; padding: 0px 0px 0px 0px !important;">-->
<!--				</td>-->
<!--				<td style="text-align: center!important; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">-->
<!--					<img src="{{URL::asset('public/frontend/images/Alka.png')}}" alt="" style="width: 142px; height: 28px; margin: 0px 0px 0px 0px !important; padding: 0px 0px 0px 0px !important;">-->
<!--				</td>-->
<!--				<td style="text-align: center!important; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">-->
<!--					<img src="{{URL::asset('public/frontend/images/dir.png')}}" alt="" style="width: 198px; height: 66px; margin: 0px 0px 0px 0px !important; padding: 0px 0px 0px 0px !important;">-->
<!--				</td>-->
<!--			</tr>-->
<!--			<tr style="padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">-->
<!--				<td style="padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">-->
<!--					<p style="text-align: center!important; font-weight: bold; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important; font-size: 18px; color: #2A1772; font-style: italic !important;">Center Incharge</p>-->
<!--				</td>-->
<!--				<td style="padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">-->
<!--					<p style="text-align: center!important; font-weight: bold; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important; font-size: 18px; color: #2A1772; font-style: italic !important;">Controller Of Examination</p>-->
<!--				</td>-->
<!--				<td style="padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">-->
<!--					<p style="text-align: center!important; font-weight: bold; padding: 30px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important; font-size: 18px; color: #2A1772; font-style: italic !important;">Document Certificate By Director<br>(ANIL KUMAR)</p>-->
<!--				</td>-->
<!--			</tr>-->
			
<!--		</tbody>-->
<!--	</table>	-->

    <table style="width: 100%; overflow-x:auto; padding: 0px !important;">
		<tbody>
			<tr style="padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">
				<td style="text-align: center!important; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">
				    @if($assigncourse->franchise_id <> '0')
					<img src="{{URL::asset('public/uploads/sign/'.$assigncourse->franchise->owner_sign)}}" alt="" style="width: 97px; height: 85px; margin: 0px 0px 0px 0px !important; padding: 0px 0px 0px 0px !important; line-height: 0px !important;">
				    @else
				    <img src="{{URL::asset('public/uploads/sign/'.$usermaster->center_incharge_image) }}" alt="" style="width: 90px; height: 90px; margin: 0px 0px 0px 0px !important; padding: 0px 0px 0px 0px !important; line-height: 0px !important;">
				    @endif
				</td>
				<td style="text-align: center!important; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">
					<img src="{{URL::asset('public/frontend/images/Alka.png')}}" alt="" style="width: 152px; height: 48px; margin: 0px 0px 0px 0px !important; padding: 0px 0px 0px 0px !important; line-height: 0px !important;">
				</td>
				<td style="text-align: center!important; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">
					<img src="{{URL::asset('public/frontend/images/dir.png')}}" alt="" style="width: 210px; height: 86px; margin: 0px 0px 0px 0px !important; padding: 0px 0px 0px 0px !important; line-height: 0px !important;">
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
	
	<table style="width: 100%; padding-top: 0px !important; padding-bottom: 2px !important;">
	<tbody>
	 <!--<tr style="margin: 0px 0px 0px 10px !important;">-->
  <!--    <td style="color: #000; font-size: 12px; text-align:center; font-weight: 500; padding: 0px 0px 0px 0px !important;">Grading System<span style="padding-left: 0px !important;">:</span> <span>91> = to 100- O | 81> = to 90- A++ | 71> = to 80- A+ | 61> = to 70- A | 51> = to 60- A- | 40> = to 50- B+</span></td>-->
  <!--   </tr> -->
     
	</tbody>
</table>
</div>    
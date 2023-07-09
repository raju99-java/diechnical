<div class="container" style="width: 100%; height: auto; background-color: #fefefe; border: 5px solid #291a5b; border-radius: 15px; background-image: url(https://ditechnical.in/public/frontend/images/bg.png); background-position: center center; background-size: cover; background-repeat: no-repeat;" >
<p style="text-align: center; line-height: 30px; padding: 0px !important; margin: 0px 0px 0px 0px !important;"><img src="{{URL::asset('public/frontend/images/hindi.png')}}" alt=""></p>
<h1 style="text-align: center; color: #6e1c18; font-size: 45px; font-weight: bold !important; padding: 0px !important; margin: 0px 0px 0px 0px !important;">
    DI TECHNICAL <span style="font-size: 30px !important;">Pvt. Ltd.</span>
</h1>
<h2 style="font-style: italic !important; text-align: center; color: #32246e; font-size: 22px; font-weight: bold !important; line-height: 38px; padding: 0px !important; margin: 0px 0px 0px 0px !important; ">(Digital Information of Technology)</h2>
<h3 style="font-style: italic !important; text-align: center; color: #000; font-size: 22px; font-weight: bold !important; line-height: 38px;padding: 0px !important; margin: 0px 0px 0px 0px !important; ">Head Office: Dhurwa Bus Stand Ranchi, Jharkhand</h2>
<h4 style="font-style: italic !important; text-align: center; color: #000; font-size: 22px; font-weight: bold !important; line-height: 38px; padding: 0px !important; margin: 0px 0px 0px 0px !important;">Website: <span style="color: #32246e 1important;">www.ditechnical.in</span></h2>
<h5 style="text-align: center; color: #32246e; font-size: 38px; line-height: 30px !important; padding: 0px !important; margin: 0px 0px 0px 0px !important;">Certificate Of</h5>
<h6 style="text-align: center; color: #32246e; font-size: 38px; line-height: 30px !important; padding: 0px !important; margin: 0px 0px 0px 0px !important;">Authorization</h6>
<p style="font-style: italic !important; text-align: center; color: #000; font-size: 25px; font-weight: bold !important; line-height: 38px;padding: 0px !important; margin: 0px 0px 0px 0px !important; ">This is Certificate that</p>

<p style="padding: 0px 0px 0px 10px !important; font-size:20px; font-size: 25px; font-style: italic !important; text-align: center;"><span class="underline-1" style="border-bottom: 1px solid #000; width: 95%; display: inline-block; text-align: center;">{{strtoupper($model->owner_name)}}</span></p>
<h2 style="text-align: center; color: #32246e; font-weight: bold; font-size: 25px; font-weight: bold !important; line-height: 20px; padding: 10px 0px 0px 10px !important; margin: 0px 0px 0px 0px !important;">Has meet all required standard and has appointment as a Study Center of DI TECHNICAL Pvt. Ltd.</h2>
<p style="padding: 0px 0px 0px 10px !important; font-size:20px; font-size: 20px;  text-align: center;"><span class="underline-1" style="border-bottom: 1px solid #000; width: 95%; display: inline-block; text-align: center;"><b> Authorized Center Name :</b> {{strtoupper($model->name)}} <br>
<b>Address :</b> {{ucfirst($model->address)}} , {{ucfirst($model->city)}}, {{ucfirst($model->district)}}, {{ucfirst($model->state)}}
</span></p>

<p style="padding: 0px 0px 0px 10px !important; font-size:20px; font-size: 20px; color: #32246e; line-height: 25px;">Franchise Code &nbsp; &nbsp; &nbsp; &nbsp; : &nbsp; <span class="underline-1" style="border-bottom: 1px solid #000; width: 30%; display: inline-block; text-align: center;">{{$model->registration_id}}</span></p>
<p style="padding: 0px 0px 0px 10px !important; font-size:20px; font-size: 20px; color: #32246e;">Dated &nbsp; &nbsp; &nbsp; : &nbsp;<span class="underline-1" style="border-bottom: 1px solid #000; width: 28%; display: inline-block; text-align: center;">{{date('jS M Y', strtotime($model->created_at))}}
</span> Validity &nbsp; &nbsp;: &nbsp;<span class="underline-1" style="border-bottom: 1px solid #000; width: 28%; display: inline-block; text-align: center;">{{($model->days_left > 0) ? $model->days_left." Days Left" : "Expired"}} </span></p>

<table style="width: 100%; padding-top: 0px !important; padding-bottom: 10px !important; margin-bottom: 10px; border-bottom: 1px solid #ccc;">
	<tbody>
     <tr style="margin: 0px !important;">
      <td style="text-align: center !important;">
		<img src="{{URL::asset('public/frontend/images/4logos.png')}}" alt="">
	  </td>
     </tr>
    </tbody> 
</table>

<table style="width: 100%; overflow-x:auto; padding: 0px !important;">
		<tbody>
			<tr style="padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">
				<td style="text-align: center!important; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">
					<img src="{{ URL::asset('public/uploads/sign/'.$model->owner_sign) }}" alt="" style="width: 120px; height: 120px; margin: 0px 0px 0px 0px !important; padding: 0px 0px 0px 0px !important; line-height: 0px !important;">
				</td>
				<td style="text-align: center!important; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">
					<img src="{{ URL::asset('public/frontend/images/Alka.png') }}" alt="" style="width: 150px; height: 50px; margin: 0px 0px 0px 0px !important; padding: 0px 0px 0px 0px !important; line-height: 0px !important;">
				</td>
				<td style="text-align: center!important; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px !important;">
					<img src="{{ URL::asset('public/frontend/images/dir.png') }}" alt="" style="width: 200px; height: 80px; margin: 0px 0px 0px 0px !important; padding: 0px 0px 0px 0px !important; line-height: 0px !important;">
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
</div> 
<!-------------------//exam-certificate----------------->
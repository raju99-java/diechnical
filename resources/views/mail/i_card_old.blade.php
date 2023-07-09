<?php
use App\Model\UserMaster;

$usermaster = UserMaster::where('type_id','=','1')->first();
?>

<div class="container" style="width:100%;height: auto;">
 <div class="background" style="width:377px;height: 302px;background-color: #D3EFFB; padding-bottom: 0px; border-radius: 20px !important; background-image: url(https://ditechnical.in/public/frontend/images/di-icard-bg.png);  opacity: 1.0 !important; background-position: center center; background-size: cover; background-repeat: no-repeat;">
   <!--<img src="{{URL::asset('public/frontend/images/new-logo-di-2.png') }}" style="float: left; width: 80px; height:80px; margin:2px 0px 0px 8px !important;"> -->
   <div class="heading">
        <p style="text-align: center; color: #02194B; font-size: 25px;
           padding: 0px !important; font-weight: bold; margin: 0px 0px 0px 0px!important;;">{{($assigncourse->franchise_id <> '0')? strtoupper($assigncourse->franchise->name) : 'DI TECHNICAL'}}</p>
        <p style="text-align: center; color: #FED20D; font-size: 16px;font-weight: bold; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px!important;">(Digital Information of Technology)</p>
        @if($assigncourse->franchise_id <> '0')
            <p style="text-align: center; color: #000; font-size: 12px;font-weight: bold; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px!important;">{{ ucfirst($assigncourse->franchise->address).", ".ucfirst($assigncourse->franchise->city).", ".ucfirst($assigncourse->franchise->state) }}</p>
        @else
            <p style="text-align: center; color: #000; font-size: 16px;font-weight: bold; padding: 0px 0px 0px 0px !important; margin: 0px 0px 0px 0px!important;">Dhurwa Bus Stand Ranchi, Jharkhand</p>
        @endif
        
        <p style="text-align: center; color: #FF5421; font-size: 12px;font-weight: bold; padding: 0px 0px 10px 0px !important; margin: 0px 0px 0px 0px!important; border-bottom: 3px solid #00ACED;">Ph No: +91 {{($assigncourse->franchise_id <> '0') ? $assigncourse->franchise->phone : "8210066756"}} | Email: {{($assigncourse->franchise_id <> '0') ? $assigncourse->franchise->email : " anilv1615@gmail.com"}}</p> 
    </div>
    
    <div class="data-section" style="width: 100%;">
        
        
        <table style="width: 100%; padding-top: 10px; padding-left: 10px; ">
            <tbody>
            <tr>
               <td style=" font-family: 'Rubik', sans-serif;font-size: 7px !important; font-weight: 500; line-height: 9px !important; color: #A4427F !important; text-transform: uppercase !important; padding-top: 5px !important;">Reg. No:</td>
               <td style=" font-family: 'Rubik', sans-serif;font-size: 7px !important; line-height: 9px !important; color: #000 !important; text-transform: uppercase !important; padding-top: 5px !important;">{{$assigncourse->user->registration_id}}</td>
               <th rowspan="5">
                    <img src="{{($assigncourse->user->image!='')? URL::asset('public/uploads/user').'/'.$assigncourse->user->image:URL::asset('public/frontend/images/profile.jpg') }}" style="float: right; width: 90px !important; height: 90px !important; margin: 0px 0px 0px 0px !important; padding-left: 0px !important; padding-right: 0px !important; padding-top: 0px !important;"><br>
                    
                    
                </th> 
                
            
            </tr>
            <tr>
               <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; font-weight: 500; line-height: 9px !important; color: #A4427F !important; text-transform: uppercase !important; padding-top: 5px !important;">Name:</td>
               <td style=" font-family: 'Rubik', sans-serif;font-size: 7px !important; line-height: 9px !important; color: #000 !important; text-transform: uppercase !important; padding-top: 5px !important;">{{$assigncourse->user->full_name}}</td>
               
            </tr>
            <tr>
               <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; font-weight: 500; line-height: 9px !important; color: #A4427F !important; text-transform: uppercase !important; padding-top: 5px !important;">Email:</td>
               <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; line-height: 9px !important; color: #000 !important; text-transform: uppercase !important; padding-top: 5px !important;">{{$assigncourse->user->email}}</td>
               
            </tr>
            <tr>
               <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; font-weight: 500; line-height: 9px !important; color: #A4427F !important; text-transform: uppercase !important;">C/O:</td>
               <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; line-height: 9px !important; color: #000 !important; text-transform: uppercase !important;">{{$assigncourse->user->father_name}}</td>
            </tr>
            <!--<tr>-->
            <!--   <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; font-weight: 500; line-height: 9px !important; color: #A4427F !important; text-transform: uppercase !important;">Mother's Name:</td>-->
            <!--   <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; line-height: 9px !important; color: #000 !important; text-transform: uppercase !important;">{{$assigncourse->user->mother_name}}</td>-->
            <!--</tr>-->
            <tr>
               <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; font-weight: 500; line-height: 9px !important; color: #A4427F !important; text-transform: uppercase !important;">Course Name:</td>
               <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; line-height: 9px !important; color: #000 !important; text-transform: uppercase !important;">{{$assigncourse->course->name}}<</td>
                
            </tr>
            <tr>
               <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; font-weight: 500; line-height: 9px !important; color: #A4427F !important; text-transform: uppercase !important;">Course Start:</td>
               <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; line-height: 9px !important; color: #000 !important; text-transform: uppercase !important;">{{date('jS M Y', strtotime($assigncourse->created_at))}}<</td>
                <th rowspan="7" style="text-align: right!important; padding: 0px 0px 0px 0px !important;">
                  <img src="{{ ($assigncourse->franchise_id <> '0') ? URL::asset('public/uploads/sign/'.$assigncourse->franchise->owner_sign)  :  URL::asset('public/uploads/sign/'.$usermaster->center_incharge_image) }}" alt="" style="width: 50px; height: 50px; margin: 0px !important; padding-top: 30px !important;">
                  <p style="text-align: right!important; font-weight: bold; padding: 0px !important; margin: 0px !important; font-size: 10px; color: #A4427F; font-style: italic !important;">Center Incharge</p>  
                </th> 
            </tr>
            <tr>
               <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; font-weight: 500; line-height: 9px !important; color: #A4427F !important; text-transform: uppercase !important;">Enroll. No:</td>
               <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; line-height: 9px !important; color: #000 !important; text-transform: uppercase !important;">{{$assigncourse->enrollment_id}}</td>
            </tr>
            <tr>
               <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; font-weight: 500; line-height: 9px !important; color: #A4427F !important; text-transform: uppercase !important;">Address:</td>
               <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; line-height: 9px !important; color: #000 !important; text-transform: uppercase !important;">{{$assigncourse->user->address}}</td>
            </tr>
            <!--<tr>-->
            <!--   <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; font-weight: 500; line-height: 9px !important; color: #A4427F !important; text-transform: uppercase !important;">State:</td>-->
            <!--   <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; line-height: 9px !important; color: #000 !important; text-transform: uppercase !important;">{{$assigncourse->user->state}}</td>-->
            <!--</tr>-->
            <!--<tr>-->
            <!--   <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; font-weight: 500; line-height: 9px !important; color: #A4427F !important; text-transform: uppercase !important;">District:</td>-->
            <!--   <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; line-height: 9px !important; color: #000 !important; text-transform: uppercase !important;">{{$assigncourse->user->district}}</td>-->
            <!--</tr>-->

            <tr> 
               <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; font-weight: 500; line-height: 9px !important; color: #A4427F !important; text-transform: uppercase !important; padding-top: 5px !important;">Contact No:</td>
               <td style="font-family: 'Rubik', sans-serif;font-size: 7px !important; line-height: 9px !important; color: #000 !important; text-transform: uppercase !important; padding-top: 5px !important;">{{$assigncourse->user->phone}}</td>
            </tr>
            </tbody>
        </table>
    </div>    
 </div>        
</div>    
    
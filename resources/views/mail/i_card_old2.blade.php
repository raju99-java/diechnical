<?php
use App\Model\UserMaster;

$usermaster = UserMaster::where('type_id','=','1')->first();
?>

<style>
.container {
    display: table;
    }
.row  {
    display: table-row;
    }
.left, .right, .middle {
    display: table-cell;
    padding-right: 5px;
    }
    
    .left{
        width: 70%;
    }
    .right{
        width: 30%;
    }
.left p, .right p, .middle p {
    margin: 1px 1px;
   }
</style>

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
        
        <div class="container" style="width: 100%; padding-top: 10px; padding-left: 10px; ">
            
          <div class="row">
            <div class="left">
              <p style=" font-family: 'Rubik', sans-serif;font-size: 8px !important; font-weight: 500; line-height: 8px !important; color: #A4427F !important; text-transform: uppercase !important; padding-top: 5px !important;">Reg. No: &nbsp;&nbsp;<nobr style="color: #000 !important;">{{$assigncourse->user->registration_id}}</nobr></p>
            </div>
            <div class="right">
              <p><img src="{{($assigncourse->user->image!='')? URL::asset('public/uploads/user').'/'.$assigncourse->user->image:URL::asset('public/frontend/images/profile.jpg') }}" style="float: right; width: 90px !important; height: 90px !important; margin: 0px 0px 0px 0px !important; padding-left: 0px !important; padding-right: 0px !important; padding-top: 0px !important;"><br>
                    </p>
                    
              
                    
            </div>
          </div>
          
          <div class="row">
            <div class="left">
              <p style=" font-family: 'Rubik', sans-serif;font-size: 8px !important; font-weight: 500; line-height: 8px !important; color: #A4427F !important; text-transform: uppercase !important; padding-top: 5px !important;">Name: &nbsp;&nbsp;<nobr style="color: #000 !important;">{{$assigncourse->user->full_name}}</nobr></p>
            </div>
            <div class="right">
              <p><img src="{{ ($assigncourse->franchise_id <> '0') ? URL::asset('public/uploads/sign/'.$assigncourse->franchise->owner_sign)  :  URL::asset('public/uploads/sign/'.$usermaster->center_incharge_image) }}" alt="" style="width: 60px; height: 52px; margin: 0px !important; padding-top: 90px !important;padding-left: 60px !important;"> </p>
            </div>
          </div>
          
          <div class="row">
            <div class="left">
              <p style=" font-family: 'Rubik', sans-serif;font-size: 8px !important; font-weight: 500; line-height: 8px !important; color: #A4427F !important; text-transform: uppercase !important; padding-top: 5px !important;">Email: &nbsp;&nbsp;<nobr style="color: #000 !important;">{{$assigncourse->user->email}}</nobr></p>
            </div>
            <div class="right">
              <p></p>
            </div>
          </div>
          
          <div class="row">
            <div class="left">
              <p style=" font-family: 'Rubik', sans-serif;font-size: 8px !important; font-weight: 500; line-height: 8px !important; color: #A4427F !important; text-transform: uppercase !important; padding-top: 5px !important;">C/O: &nbsp;&nbsp;<nobr style="color: #000 !important;">{{$assigncourse->user->father_name}}</nobr></p>
            </div>
            <div class="right">
              <p style="font-family: 'Rubik', sans-serif;font-size: 8px !important; font-weight: 500; line-height: 8px !important; color: #A4427F !important; text-transform: uppercase !important; padding-top: 5px !important;padding-left: 50px !important;">Center Incharge</p>
            </div>
          </div>
          
          <div class="row">
            <div class="left">
              <p style=" font-family: 'Rubik', sans-serif;font-size: 8px !important; font-weight: 500; line-height: 12px !important; text-transform: uppercase !important; padding-top: 5px !important;"><span style="color: #A4427F !important">Course Name:</span> &nbsp;&nbsp;<span style="width: 20px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;color:#000 !important;line-height:20px;">{{$assigncourse->course->name}}</span></p>
            </div>
            
            <div class="right">
              <p></p>
            </div>
          </div>
          
          <div class="row">
            <div class="left">
              <p style=" font-family: 'Rubik', sans-serif;font-size: 8px !important; font-weight: 500; line-height: 8px !important; color: #A4427F !important; text-transform: uppercase !important; padding-top: 5px !important">Course Start: &nbsp;&nbsp;<nobr style="color: #000 !important;">{{date('jS M Y', strtotime($assigncourse->created_at))}}</nobr></p>
            </div>
            <div class="right">
              
            </div>
          </div>
          
          <div class="row">
            <div class="left">
              <p style=" font-family: 'Rubik', sans-serif;font-size: 8px !important; font-weight: 500; line-height: 8px !important; color: #A4427F !important; text-transform: uppercase !important; padding-top: 5px !important;">Enroll. No: &nbsp;&nbsp;<nobr style="color: #000 !important;">{{$assigncourse->enrollment_id}}</nobr></p>
            </div>
            <div class="right">
              
            </div>
          </div>
          
          <div class="row">
            <div class="left">
                <p style=" font-family: 'Rubik', sans-serif;font-size: 8px !important; font-weight: 500; line-height: 12px !important; text-transform: uppercase !important; padding-top: 5px !important;"><span style="color: #A4427F !important">Address:</span> &nbsp;&nbsp;<span style="width: 25px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;color:#000 !important;">{{$assigncourse->user->address}}</span></p>
            </div>
            <div class="right">
              <p></p>
            </div>
          </div>
          
          <div class="row">
            <div class="left">
              <p style=" font-family: 'Rubik', sans-serif;font-size: 8px !important; font-weight: 500; line-height: 8px !important; color: #A4427F !important; text-transform: uppercase !important; padding-top: 5px !important;">Contact No: &nbsp;&nbsp;<nobr style="color: #000 !important;">{{$assigncourse->user->phone}}</nobr></p>
            </div>
            <div class="right">
                
             </div>
          </div>
          
          <div class="row">
            <div class="left">
             </div>
            <div class="right">
                <p><img src="{{ ($assigncourse->franchise_id <> '0') ? URL::asset('public/uploads/sign/'.$assigncourse->franchise->owner_sign)  :  URL::asset('public/uploads/sign/'.$usermaster->center_incharge_image) }}" alt="" style="width: 60px; height: 52px; margin: 0px !important; padding-top: -40px !important;padding-left: 60px !important;"> </p>
              <p style="font-family: 'Rubik', sans-serif;font-size: 8px !important; font-weight: 500; line-height: 8px !important; color: #A4427F !important; text-transform: uppercase !important; padding-top: 5px !important;padding-left: 50px !important;">Center Incharge</p>
            
             </div>
          </div>
          
        </div>
      
        
        <table style="width: 100%; padding-top: 10px; padding-left: 10px; ">
            
            
            <tbody>
            
            

            
            </tbody>
        </table>
    </div>    
 </div>        
</div>    
    
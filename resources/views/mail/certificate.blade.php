<div class="container" style="width: 100%; height: auto; padding: 0px; background-image: url(https://whrpc.org/wp-content/uploads/2021/07/whrpc-certificate-bg.png);background-repeat: no-repeat; background-size: cover; ">
        <table style="width: 100%; padding-top: 50px  !important;">
			<tbody>
            <tr style="margin: 0px !important;">
              <td style="text-align: left!important; padding-top: -20px  !important; padding-bottom: 0px  !important; padding-right: 0px  !important;padding-left: 40px  !important;"><p class="sl-no" style="color:black; font-size: 15px; font-weight: bold;  margin: 0px !important;">SL NO: {{$user->serial_number}}</p></td>
              
              <td style="text-align: right!important; padding-top: 0px  !important; padding-bottom: 0px  !important; padding-left: 0px  !important;padding-right: 40px  !important;margin:30px !important;"><img src="https://whrpc.org/process/public//frontend/images/qrcode.png" alt="" style="width: 80px; height: 80px;"></td>
              
             
            </tr>
            <tr style="margin: 0px !important;">
              <td style="text-align: left!important;padding-top: -40px  !important; padding-bottom: 0px  !important; padding-right: 0px  !important;padding-left: 40px  !important;"><p class="reg-no" style="color:black; font-size: 15px; font-weight: bold;  margin: 0px !important;">REG NO: {{$user->registration_number}}</p></td>
            </tr>
           </tbody>
           </table>

        <div class="whrpc-header" style="text-align:center; ">
           <h2 style="text-align: center; font-family: fantasy; padding: 0px !important;margin: 5px 0px 5px 0px !important;"><img src="https://whrpc.org/wp-content/uploads/2021/07/New-Project-1.png" alt=""></h2>
        </div>
        <div class="whrpc-logo" style="text-align: center; ">
            <img src="https://whrpc.org/wp-content/uploads/2021/07/logo.png" alt="" style="width: 100px; height: 100px; margin-top: 20px !important;">
            <p style="color:black; font-size: 16px; font-weight: bold; padding: 0px !important; margin: 0px !important;">Internationl Organization</p>
            <h3 style="color:#393359; font-size: 32px; font-weight: bold; padding: 0px !important; margin: 0px !important;">Certificate of Membership</h3>
        </div>
        <div class="picture" style="text-align: center; margin-top: 10px;">
            <img src="https://whrpc.org/process/public//uploads/user/{{$user->photo}}" alt="" style="width: 100px; height: 115px; border: 3px solid #B82726;">
        </div>
        <div class="info" style="text-align: center;">
            <p style="color:black; font-size: 16px; font-weight: 300; padding: 0px !important; margin: 5px 0px 5px 0px !important;">This is to certify that</p>
            <h3 style="color:#393359; font-size: 28px; font-weight: 600; padding: 0px !important; margin: 8px 0px 8px 0px !important;">{{$user->first_name.' '.$user->last_name}}</h3>
            <p style="color:black; font-size: 16px; font-weight: 300; padding: 0px !important; margin: 5px 0px 5px 0px !important;">is in an active member of the</p>
            <h6 style="color:#000; font-size: 20px; font-weight: bold; padding: 0px !important; margin: 5px 0px 5px 0px !important;">World Human Rights Protection Commission(WHRPC)</h6>
            <p style="color:black; font-size: 20px; font-weight: 300; padding: 0px 20px 0px 20px !important; margin: 0px !important; line-height: 28px;">This certificate also serves as recognition of this commitment to the development of social working worldwide</p>
            <p style="color:#000; font-size: 17px; font-weight: 700; padding: 0px !important; margin: 5px 0px 5px 0px !important;">Date of issue: {{(!empty($user->created_at)) ? \Carbon\Carbon::parse($user->created_at)->format('d-F-Y') : 'Not Given'}}</p>
        </div>

        <table style="width: 100%; overflow-x:auto; padding: 0px 20px 0px 20px !important;">

            <tbody>
            <tr>
              <td style="text-align: center!important;"><img src="https://whrpc.org/wp-content/uploads/2021/07/maxime.png" alt="" style="width: 100px; height: 69px; margin: 0px !important;"></td>
              <td style="text-align: center!important;"><img src="https://whrpc.org/wp-content/uploads/2021/07/Francisco.png" alt="" style="width: 100px; height: 69px; margin: 0px !important;"></td>
              <td style="text-align: center!important;"><img src="https://whrpc.org/wp-content/uploads/2021/07/tapan.png" alt="" style="width: 100px; height: 69px; margin: 0px !important;"></td>
            </tr>
            <tr>
              <td><p style="text-align: center!important; font-weight: bold; padding: 0px !important; margin: 0px !important; font-size: 15px;">Maxime NSENGIYUMVA</p></td>
              <td><p style="text-align: center!important; font-weight: bold; padding: 0px !important; margin: 0px !important; font-size: 15px;">Shri Francisco Sardinha</p></td>
              <td><p style="text-align: center!important; font-weight: bold; padding: 0px !important; margin: 0px !important; font-size: 15px;">Dr. Kumar Tapan Rautaray</p></td>
            </tr>
            <tr>
              <td><p style="text-align: center!important; padding: 0px !important; margin: 0px !important; font-size: 13px;">General Secretary Of WHRPC</p></td>
              <td><p style="text-align: center!important; padding: 0px !important; margin: 0px !important; font-size: 13px;">Parlamentary Chairman Of WHRPC</p></td>
              <td><p style="text-align: center!important; padding: 0px !important; margin: 0px !important; font-size: 13px;">International Chairman</p></td>
            </tr>

            <tr>
                <td><p style="text-align: center!important; padding: 0px !important; margin: 0px !important; font-size: 13px;">Ambassador</p></td>
                <td><p style="text-align: center!important; padding: 0px !important; margin: 0px !important; font-size: 13px;">Member Of Parliament</p></td>
            </tr>

            <tr>
                <td><p style="text-align: center!important; padding: 0px !important; margin: 0px !important; font-size: 13px;">First Secretury of Burundi Country</p></td>
                <td><p style="text-align: center!important; padding: 0px !important; margin: 0px !important; font-size: 13px;">(Lok Sabha) Ex C.M & Speaker Of Goa</p></td>
            </tr>  
            </tbody>
        </table>
        
        

        <div style="display: inline-block !important; margin-top: 20px !important; padding-left: 50px !important; padding-bottom: 35px !important;margin-left:250px;">
          <img src="https://whrpc.org/wp-content/uploads/2021/07/p-1.png" alt="" style="margin: 0px !important;">
          <img src="https://whrpc.org/wp-content/uploads/2021/07/p-2.png" alt="" style="margin: 0px !important;">
        </div>


    </div>
 
<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

//use Laravel\Cashier\Billable;

class Plan extends Model {
	
    
    protected $table = 'plans';
    protected $fillable = [
        'name','price','renew_price','details','free_wallet','joining_wallet','validity','registration_fee','course_assign_fee','certificate_fee','commission',
        'referral_status','status','created_at','updated_at'
    ];
  
    

}

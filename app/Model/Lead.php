<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

//use Laravel\Cashier\Billable;

class Lead extends Model {
	
    
    protected $table = 'leads';
    protected $fillable = [
        'first_name','last_name','email','contact_number','country','interested_in'
    ];
  
    

}

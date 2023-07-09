<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

//use Laravel\Cashier\Billable;

class Subscriber extends Model {
	
    
    protected $table = 'subscribers';
    protected $fillable = [
        'email'
    ];
  
    

}

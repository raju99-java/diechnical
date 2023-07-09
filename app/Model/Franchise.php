<?php

namespace App\Model;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

//use Laravel\Cashier\Billable;

class Franchise extends Model implements Authenticatable {

    use \Illuminate\Auth\Authenticatable;

    public $confirm_password;
    protected $table = 'franchises';
    protected $fillable = [
        'type_id','registration_id', 'name','owner_name','email','phone','designation','qualification','experience','image','owner_image','owner_sign','id_proof','agreement_file',
        'address','city','post_office','district','state','pin','country',
        'password','wallet_amount','establish','staff_room','staff_seating','staff_area','class_room','class_seating','class_area','lab_room','lab_seating','lab_area',
        'reception_room','reception_seating', 'reception_area', 'wash_room','wash_seating','wash_area',
        'plan_id','joining_by_alc','referral_code','days_left','payment_status','status','reset_password_token'
    ];
    protected $hidden = [
        'password', 'hash_password'
    ];
    
    public function plan() {
        return $this->belongsTo('App\Model\Plan', 'plan_id', 'id');
    }

}

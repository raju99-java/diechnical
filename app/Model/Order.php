<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_number','user_id','course_id','full_name','email','phone','expiry_date','pay_amount','payment_id','status'];
//    public $timestamps = false;
    
    public function user() {
        return $this->belongsTo('App\Model\UserMaster', 'user_id', 'id');
    }
    public function course() {
        return $this->belongsTo('App\Model\Course', 'course_id', 'id');
    }
}

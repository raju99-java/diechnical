<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $fillable = ['user_id','course_id','status'];
//    public $timestamps = false;
    
    public function user() {
        return $this->belongsTo('App\Model\UserMaster', 'user_id', 'id');
    }
    public function course() {
        return $this->belongsTo('App\Model\Course', 'course_id', 'id');
    }
}

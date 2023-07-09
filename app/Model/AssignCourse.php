<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

//use Laravel\Cashier\Billable;

class AssignCourse extends Model {
	
    
    protected $table = 'assign_course';
    protected $fillable = [
        'enrollment_id','certificate_no','user_id','course_id','franchise_id','amount_paid','status','created_at','updated_at'
    ];
    public function user() {
        return $this->belongsTo('App\Model\UserMaster', 'user_id', 'id');
    }
    public function course() {
        return $this->belongsTo('App\Model\Course', 'course_id', 'id');
    }
    public function franchise() {
        return $this->belongsTo('App\Model\Franchise', 'franchise_id', 'id');
    }
    

}

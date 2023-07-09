<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

//use Laravel\Cashier\Billable;

class LiveClass extends Model {
	
    
    protected $table = 'live_class';
    protected $fillable = [
        'course_id','franchise_id','subject','link','date','time','status'
    ];
    public function course() {
        return $this->belongsTo('App\Model\Course', 'course_id', 'id');
    }
    public function franchise() {
        return $this->belongsTo('App\Model\Franchise', 'franchise_id', 'id');
    }
    

}
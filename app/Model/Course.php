<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name','no_of_reviews','students_enrolled','course_language','course_level','what_you_will_learn','jobs_that_require_this_skill'
        ,'requirements','image','price','original_price','discount_percentage','hours_left_for_this_price','course_type','short_description'
        ,'long_description','time','featured','video','created_by','certificate_fees','franchise_paid_price','exam_status','live','status'];
    protected $table = 'courses';
    // public $timestamps = false;

    

    
}

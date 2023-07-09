<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{
    protected $table = 'course_modules';
    protected $fillable = ['name','course_id','status'];
//    public $timestamps = false;

    public function course() {
        return $this->belongsTo('App\Model\Course', 'course_id', 'id');
    }
}

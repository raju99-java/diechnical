<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CourseModuleVideo extends Model
{
    protected $table = 'course_module_videos';
    protected $fillable = ['name','course_id','module_id','video','time','status'];
//    public $timestamps = false;

    public function course() {
        return $this->belongsTo('App\Model\Course', 'course_id', 'id');
    }
    public function module() {
        return $this->belongsTo('App\Model\CourseModule', 'module_id', 'id');
    }
}

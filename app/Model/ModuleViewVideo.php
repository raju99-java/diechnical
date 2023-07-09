<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ModuleViewVideo extends Model
{
    protected $table = 'module_view_video';
    protected $fillable = ['user_id','video_id'];
//    public $timestamps = false;

    
    public function video() {
        return $this->belongsTo('App\Model\CourseModuleVideo', 'video_id', 'id');
    }
}

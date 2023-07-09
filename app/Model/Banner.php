<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model {

    protected $table = 'banners';
    protected $fillable = ['banner_name', 'banner_file','slug', 'status', 'created_at', 'updated_at'];

}

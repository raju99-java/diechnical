<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cms extends Model {

    protected $table = 'cms';
    protected $fillable = [
        'page_name', 'content_name', 'content_body',
    ];

}

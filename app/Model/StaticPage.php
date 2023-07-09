<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model {

    protected $fillable = [
        'page_name', 'content',
    ];

}

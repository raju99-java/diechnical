<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['details_text','title_text','link','photo','status'];
    public $timestamps = false;
}

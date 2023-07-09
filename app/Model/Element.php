<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    
    protected $table = 'elements';
    
    protected $fillable = ['name','image','price','description','status'];
    
    
    
}
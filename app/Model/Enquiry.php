<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model {

    protected $table = 'enquiry';
    protected $fillable = ['services','name','center_name', 'email', 'phone', 'address','city','district','state', 'message', 'status'];

}

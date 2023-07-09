<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model {

    protected $table = 'contact_us';
    protected $fillable = ['services','name', 'email', 'phone', 'subject', 'message', 'status'];

}

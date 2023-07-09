<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FranchiseRequest extends Model {

    protected $table = 'franchise_request';
    protected $fillable = ['name', 'email', 'phone', 'address'];

}

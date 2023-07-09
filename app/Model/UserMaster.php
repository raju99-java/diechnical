<?php

namespace App\Model;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

//use Laravel\Cashier\Billable;

class UserMaster extends Model implements Authenticatable {

    use \Illuminate\Auth\Authenticatable;

    public $confirm_password;
    protected $table = 'user_master';
    protected $fillable = [
        'id', 'type_id','student_type','registration_id','franchise_id','full_name','father_name','mother_name', 'email', 'password', 'phone','gurdian_name','dob','address'
        ,'last_qualification','year_of_passing','school_college_name','marks','id_proof','state','district',
        'gender','category','specialization','image','center_incharge_image', 'status','payment_status','approve_status', 'running_course','course_status',
        'remember_token', 'reset_password_token', 'activation_token', 'created_at', 'updated_at'
    ];
    protected $hidden = [
        'password', 'hash_password'
    ];

}

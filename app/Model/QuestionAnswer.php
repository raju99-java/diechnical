<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

//use Laravel\Cashier\Billable;

class QuestionAnswer extends Model {
	
    
    protected $table = 'questions_answers';
    protected $fillable = [
        'course','question','option1','option2','option3','option4','answer','status'
    ];
  
    

}

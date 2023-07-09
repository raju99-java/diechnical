<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

//use Laravel\Cashier\Billable;

class Exam extends Model {
	
    
    protected $table = 'exams';
    protected $fillable = [
        'user_id','course_id','next_exam_date','supply_exam_fees','status','certificate_delivered','delivered_date','theory','practical','viva','lang', 'language','speed','accuracy','time_taken', 'language2','speed2','accuracy2','time_taken2', 'admin_marks_submit'
        ,'q1_id','q1_answer','q2_id','q2_answer','q3_id','q3_answer','q4_id','q4_answer','q5_id','q5_answer','q6_id','q6_answer','q7_id','q7_answer'
        ,'q8_id','q8_answer','q9_id','q9_answer','q10_id','q10_answer','q11_id','q11_answer','q12_id','q12_answer','q13_id','q13_answer','q14_id','q14_answer'
        ,'q15_id','q15_answer','q16_id','q16_answer','q17_id','q17_answer','q18_id','q18_answer','q19_id','q19_answer','q20_id','q20_answer','q21_id','q21_answer'
        ,'q22_id','q22_answer','q23_id','q23_answer','q24_id','q24_answer','q25_id','q25_answer','q26_id','q26_answer','q27_id','q27_answer','q28_id','q28_answer'
        ,'q29_id','q29_answer','q30_id','q30_answer','q31_id','q31_answer','q32_id','q32_answer','q33_id','q33_answer','q34_id','q34_answer','q35_id','q35_answer'
        
    ];
  
     
    public function user() {
        return $this->belongsTo('App\Model\UserMaster', 'user_id', 'id');
    }
    public function course() {
        return $this->belongsTo('App\Model\Course', 'course_id', 'id');
    }

}

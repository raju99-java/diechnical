<?php

namespace Modules\Franchise\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\AssignCourse;
use App\Model\Settings;

class PaymentRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     
    public function rules() {
        $valid_date = '';
        $date = Settings::where('slug', 'course_assigning_date')->first();
        
        if($date->value == '0'){
           $valid_date = 'required|date|after:yesterday|before:tomorrow';
        }else{
           $valid_date = 'required|date';
        }
        
        return [
            'running_course' => 'required',
            'created_at' => $valid_date,
            'wallet' => 'required'
        ];
    }
    
    public function withValidator($validator) {
        
        $validator->after(function ($validator) {
            $check = AssignCourse::where('user_id', $this->id)->where('course_id', $this->running_course)->first();
            if (!empty($check)) {
                $validator->errors()->add('running_course', 'This user have already purchase this course.');
            }
        });
    }

}

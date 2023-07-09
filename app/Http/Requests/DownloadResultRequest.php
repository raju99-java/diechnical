<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\AssignCourse;
use App\Model\Exam;

class DownloadResultRequest extends FormRequest {

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
        return [
            
            'enrollment_id' => 'required',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            if (isset($this->enrollment_id)) {
                $check = AssignCourse::where('enrollment_id', $this->enrollment_id)->first();
                if (empty($check)) {
                    $validator->errors()->add('enrollment_id', 'Enrollment No. not found!');
                }else{
                    $exam=Exam::where('user_id', $check->user_id)->where('course_id', $check->course_id)->first();
                    if($exam->admin_marks_submit=='0'){
                        $validator->errors()->add('enrollment_id', 'Result Not Published!');
                    }
                }
            }
            
        });
    }

}

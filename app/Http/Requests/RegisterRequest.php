<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\UserMaster;

class RegisterRequest extends FormRequest {

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
            'full_name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'image' => 'required|mimes:jpeg,jpg,png|max:10000',
            // 'id_proof' => 'required|mimes:jpeg,jpg,png|max:10000',
            // 'gurdian_name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'nullable',
            // 'dob' => 'required',
            // 'gender' => 'required',
            // 'category' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            // 'address' => 'required',
            'state' => 'required',
            // 'district' => 'required',
            // 'last_qualification' => 'required',
            // 'specialization' => 'required',
            // 'year_of_passing' => 'required',
            // 'school_college_name' => 'required',
            // 'marks' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            if (isset($this->email)) {
                $checkUser = UserMaster::where('email', $this->email)->where('status', '<>', '3')->count();
                if ($checkUser > 0) {
                    $validator->errors()->add('email', 'Email already in use.');
                }
            }
            $checkUserPhone = UserMaster::where('phone', $this->phone)->where('status', '<>', '3')->count();
            if ($checkUserPhone > 0)
                $validator->errors()->add('phone', 'Phone Number already in use.');
        });
    }

}

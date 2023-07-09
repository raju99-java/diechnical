<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\UserDetails;
use App\Model\Lead;

class LeadsRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'first_name' => 'required|max:50|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|max:50|regex:/^[a-zA-Z\s]+$/',
            'contact_number' => 'required|numeric|',
            'country' => 'required',
            'interested_in' => 'required',
            'email' => 'required|email',
            
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            $checkUser = Lead::where('email', $this->email)->count();
            if ($checkUser > 0){
                $validator->errors()->add('email', 'Email already in use.');
            }    
            $checkMobile = Lead::where('contact_number', $this->contact_number)->count();
            if ($checkMobile > 0){
                $validator->errors()->add('contact_number', 'Contact Number already in use.');    
            }
        });
    }

}

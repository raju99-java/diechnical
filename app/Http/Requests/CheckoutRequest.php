<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'full_name' => 'required|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|min:10|max:20',
            'gst' => 'nullable',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            
        });
    }

}

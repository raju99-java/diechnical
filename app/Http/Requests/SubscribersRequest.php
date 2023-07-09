<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\Subscriber;
class SubscribersRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'subscribe_email' => 'required|email|max:255',
        ];
    }
    public function withValidator($validator) {
        $validator->after(function ($validator) {
            $checkUser = Subscriber::where('email', $this->subscribe_email)->count();
            if ($checkUser > 0)
                $validator->errors()->add('subscribe_email', 'Email already subscribed.');
            
        });
    }

}

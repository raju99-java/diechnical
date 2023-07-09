<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use App\Model\UserMaster;

class ResetRequest extends FormRequest {

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
            'password' => 'required|min:6',
            'retype_password' => 'required|same:password',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            $user_id = Session::get('user_id');
            $forgot_token = Session::get('forgot_token');
            $model = UserMaster::where([['id', '=', $user_id], ['reset_password_token', '=', $forgot_token]])->first();
            if (empty($model))
                $validator->errors()->add('retype_password', 'User Not Found.');
        });
    }

}

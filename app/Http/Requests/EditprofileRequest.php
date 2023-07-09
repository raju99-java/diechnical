<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Model\UserMaster;

class EditprofileRequest extends FormRequest {

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
            // 'full_name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'gurdian_name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'category' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'state' => 'required',
            'district' => 'required',
            'last_qualification' => 'required',
            'specialization' => 'required',
            'year_of_passing' => 'required',
            'school_college_name' => 'required',
            'marks' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:10000',
            'id_proof' => 'nullable|mimes:jpeg,jpg,png|max:10000',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            if (!empty($this->phone) && !preg_match('/^[1-9][0-9]*$/', $this->phone)) {
                $validator->errors()->add('phone', 'Please give a proper phone number.');
            }

            $user = UserMaster::findOrFail(Auth::guard('frontend')->user()->id);
            if ($user->email !== $this->email) {
                $checkUser = UserMaster::where('email', $this->email)->first();
                if (!empty($checkUser)) {
                    $validator->errors()->add('email', 'This email address already taken.');
                }
            }
            
        });
    }

}

<?php

namespace Modules\Franchise\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use App\Model\UserMaster;
use App\Model\Franchise;
use App\Model\Settings;
use App\Model\Plan;

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
            'image' => 'required|mimes:jpeg,jpg,png|max:10',
            'id_proof' => 'required|mimes:jpeg,jpg,png|max:50',
            'gurdian_name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'nullable',
            'dob' => 'required',
            'gender' => 'required',
            'category' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:10,15',
            'address' => 'required',
            'state' => 'required',
            'district' => 'required',
            'last_qualification' => 'required',
            'specialization' => 'required',
            'year_of_passing' => 'required',
            'school_college_name' => 'required',
            'marks' => 'required',
            'status' => 'required',
            'wallet' => 'required'
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
                
            if($this->wallet == '1'){
                $fid = Auth()->guard('franchise')->user()->id;
                $model = Franchise::where('id',$fid)->where('status','=','1')->first();
                $amt = Plan::where('id', $model->plan_id)->first();
                $amount =  $amt->registration_fee;
                if(empty($model)){
                    $validator->errors()->add('wallet', 'Franchise Not Found !');
                }else{    
                    if($model->wallet_amount < $amount){
                        $validator->errors()->add('wallet', 'Wallet Amount Insufficient !');
                    }
                }
            }
            
        });
    }

}

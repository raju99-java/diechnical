<?php

namespace Modules\Franchise\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Model\Franchise;

class ApplyOnlineRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'plan_id' => 'required',
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'address' => 'required',
            'city' => 'required',
            'post_office' => 'required',
            'district' => 'required',
            'state'  => 'required',
            'pin' => 'required|numeric|min:6',
            'country' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:10000',
            'establish' => 'required',
            'owner_name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            
            
            'designation' => 'required',
            'qualification' => 'required',
            'experience' => 'required',
            'owner_image' => 'required|mimes:jpeg,jpg,png|max:10000',
            'id_proof' => 'required|mimes:jpeg,jpg,png|max:10000',
            
            'staff_room' => 'required|numeric|max:100',
            'staff_seating' => 'required|numeric|max:100',
            'staff_area' => 'required|numeric|max:100',
            'class_room' => 'required|numeric|max:100',
            'class_seating' => 'required|numeric|max:100',
            'class_area' => 'required|numeric|max:100',
            'lab_room' => 'required|numeric|max:100',
            'lab_seating' => 'required|numeric|max:100',
            'lab_area' => 'required|numeric|max:100',
            'reception_room' => 'required|numeric|max:100',
            'reception_seating' => 'required|numeric|max:100',
            'reception_area' => 'required|numeric|max:100',
            'wash_room' => 'required|numeric|max:100',
            'wash_seating' => 'required|numeric|max:100',
            'wash_area' => 'required|numeric|max:100',
            'wallet' => 'required',
            
        ];
    }
    
    
     public function withValidator($validator) {
        $validator->after(function ($validator) {
            if (isset($this->email)) {
                $checkUser = Franchise::where('email', $this->email)->where('status', '<>', '3')->count();
                if ($checkUser > 0) {
                    $validator->errors()->add('email', 'Email already in use.');
                }
            }
            $checkUserPhone = Franchise::where('phone', $this->phone)->where('status', '<>', '3')->count();
            if ($checkUserPhone > 0)
                $validator->errors()->add('phone', 'Phone Number already in use.');
                
                
            // if($this->wallet == '1'){
            //     $fid = Auth()->guard('franchise')->user()->id;
            //     $model = Franchise::where('id',$fid)->where('status','=','1')->first();
            //     if(empty($model)){
            //         $validator->errors()->add('wallet', 'Franchise Not Found !');
            //     }else{    
            //         if($model->wallet_amount < '100'){
            //             $validator->errors()->add('wallet', 'Wallet Amount Insufficient !');
            //         }
            //     }
            // }
            
        });
    }
    

}

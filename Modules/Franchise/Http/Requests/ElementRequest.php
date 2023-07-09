<?php

namespace Modules\Franchise\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use App\Model\Franchise;

class ElementRequest extends FormRequest {

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
            'wallet' => 'required'
        ];
    }
    
    public function withValidator($validator) {
        
        $validator->after(function ($validator) {
            
            if($this->wallet == '1'){
                $fid = Auth()->guard('franchise')->user()->id;
                $model = Franchise::where('id',$fid)->where('status','=','1')->first();
                if(empty($model)){
                    $validator->errors()->add('wallet', 'Franchise Not Found !');
                }else{    
                    if($model->wallet_amount < $this->pay_amount){
                        $validator->errors()->add('wallet', 'Wallet Amount Insufficient !');
                    }
                }
            }
            
        });
    }

}

<?php

namespace Modules\Franchise\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Model\Franchise;

class RechargeRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            
            'wallet_amount' => 'required|numeric',
            
        ];
    }
    
    

}
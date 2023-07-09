<?php

namespace Modules\Franchise\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Model\Franchise;

class RenewRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'plan_id' => 'required',
            'wallet' => 'required',
            
        ];
    }
    
    

}

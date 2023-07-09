<?php

namespace Modules\Franchise\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\Exam;
use App\Model\Franchise;
use App\Model\Plan;

class ExamFeeRequest extends FormRequest {

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
    public function rules(){
        // $validator->after(function ($validator) {
        //     $checkExam = Exam::where('id', $this->id)->first();
        //     if($checkExam['status'] == '1'){
        //         return [
        //             'theory' => 'required',
        //             'practical' => 'required',
        //             'viva' => 'required'
        //         ];
        //     }
        // });
        return [];
    }
    
    public function withValidator($validator) {
        
        $validator->after(function ($validator) {
            
            $checkExam = Exam::where('id', $this->id)->first();
            // print_r($checkExam->course->id);exit;
            
            if($checkExam['status'] == '0'){
                
                if($checkExam['supply_exam_fees'] == '0'){
                
                    if($this->supply_exam_fees == ''){
                        $validator->errors()->add('supply_exam_fees', 'This feild is required!');
                    }
                    if($this->wallet == ''){
                        $validator->errors()->add('wallet', 'This feild is required!');
                    }
                    
                    if($this->wallet == '1'){
                        $fid=Auth()->guard('franchise')->user()->id;
                        $franchise = Franchise::where('id',$fid)->where('status','=','1')->first();
                        if(empty($franchise)){
                            $validator->errors()->add('wallet', 'Franchise Not Found !');
                        }else{    
                            if($franchise->wallet_amount < $this->supply_fees){
                                $validator->errors()->add('wallet', 'Wallet Amount Insufficient !');
                            }
                        }
                    }
                    
                }
                
            }else{
                
                if($checkExam['admin_marks_submit'] == '0'){
                    
                    if($checkExam->course->exam_status == '1'){
                        
                        if($this->theory == ''){
                            $validator->errors()->add('theory', 'This field is required!');
                        }
                        if($this->practical == ''){
                            $validator->errors()->add('practical', 'This field is required!');
                        }
                        if($this->viva == ''){
                            $validator->errors()->add('viva', 'This field is required!');
                        }
                        
                        if($this->wallet == ''){
                            $validator->errors()->add('wallet', 'This feild is required!');
                        }
                        
                        if($this->wallet == '1'){
                            $fid=Auth()->guard('franchise')->user()->id;
                            $franchise = Franchise::where('id',$fid)->where('status','=','1')->first();
                            if(empty($franchise)){
                                $validator->errors()->add('wallet', 'Franchise Not Found !');
                            }else{    
                                if($franchise->wallet_amount <  $this->certificate_fees){
                                    $validator->errors()->add('wallet', 'Wallet Amount Insufficient !');
                                }
                            }
                        }
                        
                    }else{
                        
                        if($this->lang == '1'){
                            
                                if($this->language == ''){
                                    $validator->errors()->add('language', 'This field is required!');
                                }
                                if($this->speed == ''){
                                    $validator->errors()->add('speed', 'This field is required!');
                                }
                                if($this->accuracy == ''){
                                    $validator->errors()->add('accuracy', 'This field is required!');
                                }
                                if($this->time_taken == ''){
                                    $validator->errors()->add('time_taken', 'This field is required!');
                                }
                                
                                if($this->wallet == ''){
                                    $validator->errors()->add('wallet', 'This feild is required!');
                                }
                                
                                if($this->wallet == '1'){
                                    $fid=Auth()->guard('franchise')->user()->id;
                                    $franchise = Franchise::where('id',$fid)->where('status','=','1')->first();
                                    if(empty($franchise)){
                                        $validator->errors()->add('wallet', 'Franchise Not Found !');
                                    }else{    
                                        if($franchise->wallet_amount <  $this->certificate_fees){
                                            $validator->errors()->add('wallet', 'Wallet Amount Insufficient !');
                                        }
                                    }
                                }
                                
                        }
                        
                        if($this->lang == '2'){
                            
                                if($this->language == ''){
                                    $validator->errors()->add('language', 'This field is required!');
                                }
                                if($this->speed == ''){
                                    $validator->errors()->add('speed', 'This field is required!');
                                }
                                if($this->accuracy == ''){
                                    $validator->errors()->add('accuracy', 'This field is required!');
                                }
                                if($this->time_taken == ''){
                                    $validator->errors()->add('time_taken', 'This field is required!');
                                }
                            
                                if($this->language2 == ''){
                                    $validator->errors()->add('language2', 'This field is required!');
                                }
                                if($this->speed2 == ''){
                                    $validator->errors()->add('speed2', 'This field is required!');
                                }
                                if($this->accuracy2 == ''){
                                    $validator->errors()->add('accuracy2', 'This field is required!');
                                }
                                if($this->time_taken2 == ''){
                                    $validator->errors()->add('time_taken2', 'This field is required!');
                                }
                                
                                if($this->wallet == ''){
                                    $validator->errors()->add('wallet', 'This feild is required!');
                                }
                                
                                if($this->wallet == '1'){
                                    $fid=Auth()->guard('franchise')->user()->id;
                                    $franchise = Franchise::where('id',$fid)->where('status','=','1')->first();
                                    if(empty($franchise)){
                                        $validator->errors()->add('wallet', 'Franchise Not Found !');
                                    }else{    
                                        if($franchise->wallet_amount <  $this->certificate_fees){
                                            $validator->errors()->add('wallet', 'Wallet Amount Insufficient !');
                                        }
                                    }
                                }
                            
                        }
                        
                    }   
                        
                    
                }else{
                    
                    if($checkExam->course->exam_status == '1'){
                        
                        if($this->theory == ''){
                            $validator->errors()->add('theory', 'This field is required!');
                        }
                        if($this->practical == ''){
                            $validator->errors()->add('practical', 'This field is required!');
                        }
                        if($this->viva == ''){
                            $validator->errors()->add('viva', 'This field is required!');
                        }
                        
                    }else{
                        
                        if($this->lang == '1'){
                            
                                if($this->language == ''){
                                    $validator->errors()->add('language', 'This field is required!');
                                }
                                if($this->speed == ''){
                                    $validator->errors()->add('speed', 'This field is required!');
                                }
                                if($this->accuracy == ''){
                                    $validator->errors()->add('accuracy', 'This field is required!');
                                }
                                if($this->time_taken == ''){
                                    $validator->errors()->add('time_taken', 'This field is required!');
                                }
                                
                        }
                        
                        if($this->lang == '2'){
                            
                                if($this->language == ''){
                                    $validator->errors()->add('language', 'This field is required!');
                                }
                                if($this->speed == ''){
                                    $validator->errors()->add('speed', 'This field is required!');
                                }
                                if($this->accuracy == ''){
                                    $validator->errors()->add('accuracy', 'This field is required!');
                                }
                                if($this->time_taken == ''){
                                    $validator->errors()->add('time_taken', 'This field is required!');
                                }
                            
                                if($this->language2 == ''){
                                    $validator->errors()->add('language2', 'This field is required!');
                                }
                                if($this->speed2 == ''){
                                    $validator->errors()->add('speed2', 'This field is required!');
                                }
                                if($this->accuracy2 == ''){
                                    $validator->errors()->add('accuracy2', 'This field is required!');
                                }
                                if($this->time_taken2 == ''){
                                    $validator->errors()->add('time_taken2', 'This field is required!');
                                }
                            
                        }
                        
                    } 
                    
                }
                
            }
            
        });
    }

}

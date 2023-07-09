<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ElementOrder extends Model
{
    protected $table = 'element_orders';
    
    protected $fillable = ['order_number','element_id','franchise_id','pay_amount','payment_status','order_status'];
				
    
    public function element() {
        return $this->belongsTo('App\Model\Element', 'element_id', 'id');
    }
    public function course() {
        return $this->belongsTo('App\Model\Frabchise', 'franchise_id', 'id');
    }
}
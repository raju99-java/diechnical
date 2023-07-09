<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WalletHistory extends Model {

    protected $table = 'wallet_history';
    protected $fillable = [
        'franchise_id','wallet_in',	'wallet_out', 'description','balance'
    ];
    
    public function franchise() {
        return $this->belongsTo('App\Model\Franchise', 'franchise_id', 'id');
    }

}
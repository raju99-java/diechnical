<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WalletRecharge extends Model {

    protected $table = 'wallet_recharge';
    protected $fillable = [
        'franchise_id','wallet_amount',	'payment_status'
    ];

}
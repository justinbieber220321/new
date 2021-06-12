<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class CoinAddress extends AuthTmp
{
    protected $table = 'coin_address';

    protected $fillable = [
        'id', 'address', 'currency'
    ];

    public $timestamps = false;

}




















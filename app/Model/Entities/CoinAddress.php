<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class CoinAddress extends AuthTmp
{
    protected $table = 'coin_address';

    protected $fillable = [
        'id', 'address', 'status', 'private_key'
    ];

    public $timestamps = false;

}




















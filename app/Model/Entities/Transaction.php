<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class Transaction extends AuthTmp
{
    protected $table = 'transaction';

    protected $fillable = [
        'id', 'user_id', 'code_otp', 'end_time', 'del_flag'
    ];

    public $timestamps = false;
}
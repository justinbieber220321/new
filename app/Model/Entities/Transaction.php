<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class Transaction extends AuthTmp
{
    protected $table = 'transaction';

    protected $fillable = [
        'id', 'user_id', 'code_otp', 'end_time', 'del_flag'
        // user_id = user.user_id
    ];

    public $timestamps = false;
}
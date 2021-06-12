<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class Bet extends AuthTmp
{
    protected $table = 'bet';

    protected $fillable = [
        'id', 'user_id', 'time'
    ];

    public $timestamps = false;
}
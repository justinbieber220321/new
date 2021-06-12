<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class Package extends AuthTmp
{
    protected $table = 'package';

    protected $fillable = [
        'id', 'type', 'rate', 'ins_date', 'ins_date', 'del_flag'
    ];

    public $timestamps = false;
}
<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class Deposit extends AuthTmp
{
    protected $table = 'deposit';

    protected $fillable = [
        'id', 'user_id', 'from', 'currency', 'link', 'message', 'number', 'created_at', 'del_flag'
    ];

    public $timestamps = false;

    public function userDepositFrom()
    {
        return $this->belongsTo(User::class, 'from', 'user_id');
    }
}
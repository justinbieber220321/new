<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class Withdraw extends AuthTmp
{
    protected $table = 'withdraw';

    protected $fillable = [
        'id', 'user_id', 'to', 'currency', 'link', 'message', 'number', 'created_at', 'del_flag', 'type', 'address_to'
    ];

    public $timestamps = false;

    public function userWithdrawToUser()
    {
        return $this->belongsTo(User::class, 'to', 'user_id');
    }
}
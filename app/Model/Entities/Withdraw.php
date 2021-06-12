<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class Withdraw extends AuthTmp
{
    protected $table = 'withdraw';

    protected $fillable = [
        'id', 'user_id', 'to', 'currency', 'link', 'message', 'number', 'created_at', 'del_flag'
    ];

    public $timestamps = false;

    public function userWithdraw()
    {
        return $this->belongsTo(User::class, 'to', 'id');
    }
}
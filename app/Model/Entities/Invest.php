<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class Invest extends AuthTmp
{
    protected $table = 'invest';

    protected $fillable = [
        'id', 'user_id', 'package_id', 'date_start', 'date_end', 'ins_date', 'del_flag', 'number'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
}
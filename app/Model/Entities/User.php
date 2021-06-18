<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;
use App\Model\Presenters\UserPresenter;

class User extends AuthTmp
{
    use UserPresenter;

    protected $table = 'user';

    protected $fillable = [
        'id', 'username', 'email', 'phone', 'password', 'birthday', 'gender', 'address', 'short_description', 'avatar', 'parent_id',
        'status', 'ins_date', 'upd_date', 'del_flag', 'affiliate', 'balance', 'player_code'
    ];

    public function children()
    {
        return $this->hasMany(User::class, 'player_code', 'user_id');
    }


    public function parent()
    {
        return $this->belongsTo(User::class, 'player_code', 'user_id');
    }

    // recursive, loads all descendants
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
}












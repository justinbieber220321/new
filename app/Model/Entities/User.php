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
        'status', 'ins_date', 'upd_date', 'del_flag', 'affiliate', 'balance'
    ];

    public function children()
    {
        return $this->hasMany(User::class, 'parent_id', 'user_id');
    }


    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id', 'user_id');
    }

    // recursive, loads all descendants
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
}












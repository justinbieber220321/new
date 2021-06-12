<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class Category extends AuthTmp
{
    protected $table = 'category';

    protected $fillable = [
        'id', 'name', 'slug', 'parent_id', 'level',
        'ins_date', 'upd_date', 'del_flag'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    // recursive, loads all descendants
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive')->where('del_flag', delFlagOn());
    }
}












<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class Post extends AuthTmp
{
    protected $table = 'post';

    protected $fillable = [
        'id', 'category_id', 'slug', 'title', 'content', 'meta_title', 'meta_description',
        'ins_date', 'upd_date', 'del_flag'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}












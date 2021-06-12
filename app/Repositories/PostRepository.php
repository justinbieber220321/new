<?php

namespace App\Repositories;

use App\Model\Entities\Post;
use App\Repositories\Base\BaseRepository;
use App\Validators\PostValidator;

class PostRepository extends BaseRepository
{
    public function model()
    {
        return Post::class;
    }

    public function validator()
    {
         return PostValidator::class;
    }

//    public function getListForBackend()
//    {
//        $query = $this->where('del_flag', delFlagOn())->orderBy('id', 'desc');
//
//        // search
//
//        return $query->paginate(getBackendPagination());
//    }
}
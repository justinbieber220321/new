<?php

namespace App\Repositories;

use App\Model\Entities\Category;
use App\Repositories\Base\BaseRepository;
use App\Validators\CategoryValidator;

class CategoryRepository extends BaseRepository
{
    public function model()
    {
        return Category::class;
    }

    public function validator()
    {
         return CategoryValidator::class;
    }

    public function getListForBackend()
    {
        return $this->with('childrenRecursive')
            ->where('del_flag', delFlagOn())
            ->where('parent_id', 0)
            ->paginate(getBackendPagination());
    }

    public function findByParentId($parentId)
    {
        return $this->where('parent_id', $parentId)->where('del_flag', delFlagOn())->first();
    }
}
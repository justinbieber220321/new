<?php

namespace App\Repositories;

use App\Model\Entities\Package;
use App\Repositories\Base\BaseRepository;

class PackageRepository extends BaseRepository
{
    public function model()
    {
        return Package::class;
    }

    public function validator()
    {
        // @todo
    }

    public function getList()
    {
        return $this->delFlagOn()->get(); // Don't paginate
    }

    public function findById($id)
    {
        return $this->delFlagOn()->where('id', $id)->first();
    }
}
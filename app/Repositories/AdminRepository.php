<?php

namespace App\Repositories;

use App\Model\Entities\Admin;
use App\Repositories\Base\BaseRepository;
use App\Validators\AdminValidator;

class AdminRepository extends BaseRepository
{
    public function model()
    {
        return Admin::class;
    }

    public function validator()
    {
         return AdminValidator::class;
    }
}
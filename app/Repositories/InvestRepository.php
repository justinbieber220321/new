<?php

namespace App\Repositories;

use App\Model\Entities\Invest;
use App\Repositories\Base\BaseRepository;
use App\Validators\InvestValidator;

class InvestRepository extends BaseRepository
{
    public function model()
    {
        return Invest::class;
    }

    public function validator()
    {
        return InvestValidator::class;
    }

    public function getListForFrontend()
    {
        return $this->delFlagOn()->orderBy('id', 'desc')->where('user_id', frontendCurrentUserId())->paginate(getFrontendPagination());
    }
}
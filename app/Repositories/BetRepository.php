<?php

namespace App\Repositories;

use App\Model\Entities\Bet;
use App\Repositories\Base\BaseRepository;

class BetRepository extends BaseRepository
{
    public function model()
    {
        return Bet::class;
    }

    public function validator()
    {
         // return TransferValidator::class;
    }
}
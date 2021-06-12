<?php

namespace App\Repositories;

use App\Model\Entities\Transaction;
use App\Repositories\Base\BaseRepository;

class TransactionRepository extends BaseRepository
{
    public function model()
    {
        return Transaction::class;
    }

    public function validator()
    {
         // return TransferValidator::class;
    }

    public function findByUserId($userId)
    {
        return $this->where('user_id', $userId)->first();
    }
}
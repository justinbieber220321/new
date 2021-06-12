<?php

namespace App\Repositories;

use App\Model\Entities\Withdraw;
use App\Repositories\Base\BaseRepository;
use App\Validators\TransferValidator;

class WithdrawRepository extends BaseRepository
{
    public function model()
    {
        return Withdraw::class;
    }

    public function validator()
    {
         return TransferValidator::class;
    }

    public function getHistory($id)
    {
        return $this->where('user_id', $id)->orderBy('id', 'desc')->with('userWithdraw')->paginate(getConfig('pagination.frontend'));
    }
}
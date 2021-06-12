<?php

namespace App\Repositories;

use App\Model\Entities\Deposit;
use App\Repositories\Base\BaseRepository;
use App\Validators\TransferValidator;

class DepositRepository extends BaseRepository
{
    public function model()
    {
        return Deposit::class;
    }

    public function validator()
    {
         return TransferValidator::class;
    }

    public function getHistory($id)
    {
        return $this->where('user_id', $id)->orderBy('id', 'desc')->with('userDeposit')->paginate(getConfig('pagination.frontend'));
    }

    public function findByLink($link)
    {
        return $this->where('link', $link)->where('del_flag', delFlagOn())->first();
    }
}
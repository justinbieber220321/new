<?php

namespace App\Model\Presenters\Base;

use Carbon\Carbon;

trait BasePresenter
{
    public function isStatusOn()
    {
        return $this->status == statusOn();
    }

    public function isDelFlagOn()
    {
        return $this->del_flag == delFlagOn();
    }

    public function isUserBoy()
    {
        return $this->gender == genderBoy();
    }

    public function isUserGirl()
    {
        return $this->gender == genderGirl();
    }

    public function getNewCreated()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y H:i');
    }
}
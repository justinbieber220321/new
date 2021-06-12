<?php

namespace App\Model\Scopes\Base;

// Local scope
trait BaseScope
{
    public function scopeDelFlagOn($query)
    {
        return $query->where('del_flag', '=', delFlagOn())->orWhereNull('del_flag');
    }

    public function scopeStatusOn($query)
    {
        return $query->where('status', statusOn());
    }
}
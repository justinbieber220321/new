<?php

namespace App\Model\Base;

use App\Model\Presenters\Base\BasePresenter;
use App\Model\Scopes\Base\BaseScope;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use BasePresenter;
    use BaseScope;

    public $timestamps = true;

    const CREATED_AT = 'ins_date';
    const UPDATED_AT = 'upd_date';


    public function tryGet($relation)
    {
        if (empty($this->{$relation})) {
            $instance = $this->$relation()->getRelated();
            $data = array_combine(
                $instance->getFillable(),
                array_fill(0, count($instance->getFillable()), null)
            );
            return $instance->fill($data);
        }
        return $this->{$relation};
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
<?php

namespace App\Repositories;

use App\Model\Entities\User;
use App\Repositories\Base\BaseRepository;
use App\Validators\UserValidator;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    public function validator()
    {
         return UserValidator::class;
    }

    public function getListForBackend()
    {
        $query = $this->where('del_flag', delFlagOn());

        $search = trimValuesArray(request()->all());
        if(arrayGet($search, 'id')) {
            $query->where('id', arrayGet($search, 'id'));
        }

        if(!is_null(arrayGet($search, 'status')) && arrayGet($search, 'status') != -1) {
            $query->where('status', arrayGet($search, 'status'));
        }

        if(!is_null(arrayGet($search, 'gender')) && arrayGet($search, 'gender') != -1) {
            $query->where('gender', arrayGet($search, 'gender'));
        }

        if(arrayGet($search, 'name')) {
            $query->where('name', 'like', '%' . arrayGet($search, 'name') . '%');
        }

        return $query->orderBy('id', 'desc')->paginate(getBackendPagination());
    }

    public function frontendGetAffiliatesForRegister()
    {
        return $this->_builder()->get();
    }


    /**
     * @param $id : current user id login
     * @return
     */
    public function getListForTransfer($id)
    {
        return $this->_builder()->where('id', '!=', $id)->get();
    }

    public function getParentUser($id)
    {
        return $this->_builder()->where('id', $id)->first();
    }
}
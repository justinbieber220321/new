<?php

namespace App\Repositories\Base;

use Illuminate\Container\Container as Application;
use Prettus\Repository\Eloquent\BaseRepository as BaseRepo;

abstract class BaseRepository extends BaseRepo
{
    protected $_repository;

    public function __construct(Application $app)
    {
        $this->setValidator(app($this->validator()));
        parent::__construct($app);
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function setValidator($validator)
    {
        return $this->validator = $validator;
    }

    public function getRepository()
    {
        return $this->_repository;
    }

    public function setRepository($repository)
    {
        return $this->_repository = $repository;
    }

    public function model()
    {
        return "";
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        return $this->model = $model;
    }

    public function getListForBackend()
    {
        $query = $this->where('del_flag', delFlagOn())->orderBy('id', 'desc');

        $search = trimValuesArray(request()->all());
        if(arrayGet($search, 'id')) {
            $query->where('id', arrayGet($search, 'id'));
        }

        if(arrayGet($search, 'name')) {
            $query->where('name', 'like', '%' . arrayGet($search, 'name') . '%');
        }

        if(!is_null(arrayGet($search, 'status')) && arrayGet($search, 'status') != -1) {
            $query->where('status', arrayGet($search, 'status'));
        }

        // Filter module post
        if(arrayGet($search, 'title')) {
            $query->where('title', 'like', '%' . arrayGet($search, 'title') . '%')->orWhere('slug', 'like', '%' . arrayGet($search, 'slug') . '%');
        }
        if(!empty(arrayGet($search, 'category_id'))) {
            $query->where('category_id', arrayGet($search, 'category_id'));
        }
        // End filter module post

        return $query->paginate(getBackendPagination());
    }

    public function getListForFrontend()
    {
        return $this->where('del_flag', delFlagOn())->orderBy('id', 'desc')->paginate(getFrontendPagination());
    }

    public function getListForFormSearchBackend()
    {
        return $this->_builder()->orderBy('id', 'desc')->get();
    }

    public function __call($method, $params)
    {
        return call_user_func_array([$this->getModel(), $method], $params);
    }

    public function findById($id)
    {
        return $this->where('id', $id)->where('del_flag', delFlagOn())->first();
    }

    public function countModuleStatusOn()
    {
        return $this->_builder()->count();
    }

    public function countModuleStatusOff()
    {
        return $this->where('del_flag', delFlagOn())->where('status', statusOff())->count();
    }

    public function getNextEntityFrontend($id)
    {
        return $this->_builder()->where('id', '>', $id)->orderBy('id')->first();
    }

    public function getPreviousEntityFrontend($id)
    {
        return $this->_builder()->where('id', '<', $id)->orderBy('id','desc')->first();
    }

    public function findByACondition($field, $condition, $value, $getOne = true)
    {
        $query = $this->where('del_flag', delFlagOn())->where($field, $condition, $value);
        return $getOne ? $query->first() : $query->get();
    }

    /**
     * @param $email
     * @return mixed
     * Find by email
     */
    public function findByEmailForForgotPassword($email)
    {
        return $this->_builder()->where('email', $email)->first();
    }

    // ========== PROTECTED AREA ==========

    protected function _builder()
    {
        return $this->where('del_flag', delFlagOn())->where('status', statusOn());
    }
}

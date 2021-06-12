<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Base\BackendController;
use App\Model\Entities\User;
use App\Model\Entities\Users;
use App\Repositories\CoursesRepository;
use App\Repositories\CtDethiRepository;
use App\Repositories\LessionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends BackendController
{
    public function __construct(UserRepository $userRepository)
    {
        $this->setRepository($userRepository);
    }

    public function index()
    {
        $this->_clearSessionForm();
        $entities = $this->getRepository()->getListForBackend();

        $viewData = [
            'entities' => $entities
        ];

        return view('backend.user.index', $viewData);
    }

    public function edit($id)
    {
        try {
            $entity = $this->findEntityForUpdate($id);

            if (empty($entity)) {
                return backSystemError();
            }
            $viewData = [
                'entity' => $entity
            ];
            return view('backend.user.edit', $viewData);
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function update($id)
    {
        try {
            $entity = $this->getRepository()->findById($id);
            if (empty($entity)) {
                return backSystemError();
            }

            $params = request()->all();

            /** @var \App\Validators\UserValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->backendValidateStoreUser($params, $entity->getKey());

            if (!$isValid) {
                $this->setFormData($params);
                return $this->_inValid($validator->errors());
            }

            $entity->fill($params);
            $entity->save();
            $this->afterStoreUpdateCommit();
            return backRouteSuccess('backend.user.list', transMessage('update_success'));
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function changePassword($id)
    {
        $entity = User::where('del_flag', delFlagOn())->where('status', statusOn())->where('id', $id)->first();

        if (empty($entity)) {
            return abort(404);
        }
        $viewData = [
            'entity' => $entity
        ];

        return view('backend.user.change-password', $viewData);
    }

    public function postChangePassword($id)
    {
        try {
            $entity = $this->getRepository()->findById($id);
            if (empty($entity)) {
                return backSystemError();
            }

            $params = request()->all();

            /** @var \App\Validators\UserValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->backendValidateUpdatePassword($params);

            if (!$isValid) {
                $this->setFormData($params);
                return $this->_inValid($validator->errors());
            }

            $params['password'] = bcrypt(arrayGet($params, 'password'));
            $entity->fill($params);
            $entity->save();
            $this->afterStoreUpdateCommit();
            return backRouteSuccess('backend.user.list', transMessage('update_success'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }
}

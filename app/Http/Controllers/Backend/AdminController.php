<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Base\BackendController;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\File;

class AdminController extends BackendController
{
    /**
     * Create a new controller instance.
     *
     * @param AdminRepository $adminRepository
     */
    public function __construct(AdminRepository $adminRepository)
    {
        $this->setRepository($adminRepository);
    }

    public function show()
    {
        $this->_clearSessionForm();
        return view('backend.admin.show');
    }

    public function getUpdateAccount()
    {
        $id = backendCurrentUser()->id;
        try {
            $entity = $this->findEntityForUpdate($id);

            if (empty($entity)) {
                return backSystemError();
            }

            $viewData = [
                'entity' => $entity
            ];

            return view('backend.admin.update-info', $viewData);
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function updateAccount()
    {
        try {
            $entity = backendCurrentUser();
            $params = request()->all();

            /** @var \App\Validators\AdminValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->validateStoreAdmin($params);

            if (!$isValid) {
                unset($params['avatar']);
                $this->setFormData($params);
                return $this->_inValid($validator->errors());
            }

            $entity->fill($params);
            $entity->save();
            $this->afterStoreUpdateCommit();

            return backRouteSuccess(backendRouterName('account'), transMessage('update_success'));
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function getUpdateAvatar()
    {
        return view('backend.admin.update-avatar');
    }

    public function postUpdateAvatar()
    {
        try {
            $entity = backendCurrentUser();
            $params = request()->all();

            /** @var \App\Validators\AdminValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->validateUpdateAvatar($params);

            if (!$isValid) {
                unset($params['avatar']);
                $this->setFormData($params);
                return $this->_inValid($validator->errors());
            }

            if (request()->hasFile('avatar')) {
                $fileName = time() . "_"  . request()->file('avatar')->getClientOriginalName();
                $pathTmp = 'backend/uploads/admin/'  . frontendCurrentUserId() . '/' . date('Y-m-d');
                $uploadPath  = public_path($pathTmp); // Folder upload path

                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                request()->file('avatar')->move($uploadPath, $fileName);
                $params['avatar'] = $pathTmp . '/' . $fileName;

                // Remove old file
                $oldImage = $entity->avatar;
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }

            $entity->fill($params);
            $entity->save();
            $this->afterStoreUpdateCommit();
            return backSuccess(transMessage('update_success'));
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function showFormChangePassword()
    {
        return view('backend.admin.change-password');
    }

    public function postChangePassword()
    {
        $params = request()->all();

        try {
            /** @var \App\Validators\AdminValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->validateChangePassword($params);

            if (!$isValid) {
                $this->setFormData($params);
                return $this->_inValid($validator->errors());
            }

            $user = backendCurrentUser();
            $user->password = bcrypt(arrayGet($params, 'new_password'));
            $user->save();
            return backSuccess(transMessage('update_password_success'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }
}

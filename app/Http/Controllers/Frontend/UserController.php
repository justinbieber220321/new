<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\Bet;
use App\Model\Entities\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UserController extends FrontendController
{
    /**
     * Create a new controller instance.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->setRepository($userRepository);
    }

    public function account()
    {
        $this->_clearSessionForm();

        $viewData = [
            'user' => frontendCurrentUser()
        ];

        return view('frontend.user.account', $viewData);
    }

    public function updateAccountEmail2()
    {
        try {
            $user = frontendCurrentUser();
            $user->email2 = request('email2');
            $user->save();
            return backSuccess();
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }

    /**
     * @param string $id: user id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function getAffiliate($id = null)
    {
        $this->_clearSessionForm();

        $id = is_null($id) ? frontendCurrentUserId() : $id;

        $linkAff = frontendRouter('register.get') . '?r=' . encode($id, getConfig('key_encode'));
        $userAffiliate = User::with('childrenRecursive')->where('id', '=', $id)->first();

        if (empty($userAffiliate)) {
            return abort(404);
        }

        $allIds = userAllChildsIds($userAffiliate);

        $myBetEntity = Bet::select('*', DB::raw('SUM(number) AS bet'))->where('user_id', $id)
            ->whereRaw( "time > (SELECT DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY))")->first();

        $myBetTeamEntity = Bet::select('*', DB::raw('SUM(number) AS bet'))->whereIn('user_id', $allIds)
            ->whereRaw( "time > (SELECT DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY))")->first();

        $viewData = [
            'linkAff' => $linkAff,
            'userAffiliate' => $userAffiliate,
            'myBet' => empty($myBetEntity->id) ? 0 : $myBetEntity->bet,
            'myBetTeam' => empty($myBetTeamEntity->id) ? 0 : $myBetTeamEntity->bet,
        ];

        return view('frontend.affiliate.index', $viewData);
    }

    public function getUpdateAccount()
    {
        $id = frontendCurrentUser()->id;
        try {
            $entity = $this->findEntityForUpdate($id);

            if (empty($entity)) {
                return backSystemError();
            }

            $viewData = [
                'entity' => $entity
            ];

            return view('frontend.user.update-info', $viewData);
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function updateAccount()
    {
        try {
            $entity = frontendCurrentUser();
            $params = request()->all();

            /** @var \App\Validators\UserValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->frontendValidateStoreUser($params);

            if (!$isValid) {
                unset($params['avatar']);
                $this->setFormData($params);
                return $this->_inValid($validator->errors());
            }

            $entity->fill($params);
            $entity->save();
            $this->afterStoreUpdateCommit();

            return redirect()->route(frontendRouterName('account'))->with('notification_success', transMessage('update_success'));
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function getUpdateAvatar()
    {
        return view('frontend.user.update-avatar');
    }

    public function postUpdateAvatar()
    {
        try {
            $entity = frontendCurrentUser();
            $params = request()->all();

            /** @var \App\Validators\UserValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->frontendValidateUpdateAvatar($params);

            if (!$isValid) {
                unset($params['avatar']);
                $this->setFormData($params);
                return $this->_inValid($validator->errors());
            }

            if (request()->hasFile('avatar')) {
                $fileName = time() . "_"  . request()->file('avatar')->getClientOriginalName();
                $pathTmp = 'frontend/uploads/user/'  . frontendCurrentUserId() . '/' . date('Y-m-d');
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

    public function getUpdatePassword()
    {
        return view('frontend.user.update-password');
    }

    public function postUpdatePassword()
    {
        $params = request()->all();

        try {
            /** @var \App\Validators\UserValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->frontendValidateChangePassword($params);

            if (!$isValid) {
                $this->setFormData($params);
                return $this->_inValid($validator->errors());
            }

            $user = frontendCurrentUser();
            $user->password = bcrypt(arrayGet($params, 'new_password'));
            $user->save();
            return backSuccess(transMessage('update_password_success'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }
}

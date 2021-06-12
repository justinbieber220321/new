<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Backend\Base\BackendController;
use App\Model\Entities\Admin;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Browser;

class AuthController extends BackendController
{
    public function __construct(AdminRepository $adminRepository)
    {
        $this->setRepository($adminRepository);
    }

    public function showFormLogin()
    {
        if (backendIsLogin()) {
            return redirect()->route(backendRouterName('dashboard'));
        }

        return view('backend.auth.login');
    }

    public function postLogin()
    {
        $credentials = [
            'email' => trim(request('email')),
            'password' => trim(request('password')),
            'status' => statusOn(),
            'del_flag' => delFlagOn()
        ];

        $checkLogin = backendGuard()->attempt($credentials);

        if ($checkLogin) {
            return redirect()->route(backendRouterName('dashboard'));
        }

        return redirect()->back()->withErrors(transMessage('account_not_found'))->withInput(request()->all());
    }

    public function logout()
    {
        backendGuard()->logout();
        return redirect()->route(backendRouterName('login'));
    }

    public function forgotPassword()
    {
        return view('backend.auth.forgot-password');
    }

    public function postForgotPassword()
    {
        DB::beginTransaction();
        try {
            $email = request('email');
            $params = request()->all();

            /** @var \App\Validators\AdminValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->backendValidateForgotPassword($params);

            if (!$isValid) {
                return $this->_inValid($validator->errors());
            }

            $admin = $this->getRepository()->findByEmailForForgotPassword($email);

            if (empty($admin)) {
                return backSystemError(transMessage('account_not_found'));
            }

            $name = extractNameFromEmail($email);
            $rememberPassword = bcrypt($name . '_' . now());
            $admin->remember_password = $rememberPassword;
            $admin->save();

            // send email recovery password
            $link = backendRouter('recovery-password') . '?code=' . $rememberPassword;
            $data = [
                'name' => $name,
                'link' => $link
            ];
            try {
                Mail::send('backend.email_template.password-recovery', $data, function($message) use ($email, $name)
                {
                    $message->to($email, $name)->subject(transMessage('send_mail_recovery_password', ['send-mail' => getSiteName()]));
                });

                if( count(Mail::failures()) > 0 ) {
                    logError("Email $email not exits for recovery password");
                    return backSystemError(transMessage('system_error'));

                }
            } catch (\Exception $e) {
                logError($e);
                return backSystemError(transMessage('system_error'));
            }

            DB::commit();  // all good
            $this->afterStoreUpdateCommit();
            return backSuccess(trans('messages.access_email', ['email' => $email]));
        } catch (\Exception $e) {
            DB::rollback(); // something went wrong
            logError($e);
        }

        return backSystemError(transMessage('system_error'));
    }

    public function getRecoveryPassword()
    {
        $code = request('code');

        if (empty($code)) {
            return view('backend.auth.password-recovery-not-found');
        }

        $admin = Admin::where('del_flag', delFlagOn())->where('remember_password', $code)->first();

        if (empty($admin)) {
            return view('backend.auth.password-recovery-not-found');
        }

        $viewData = [
            'admin' => $admin
        ];

        return view('backend.auth.password-recovery', $viewData);
    }

    public function postRecoveryPassword()
    {
        try {
            $params = request()->all();

            /** @var \App\Validators\AdminValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->backendValidatePasswordRecovery($params);

            if (!$isValid) {
                return $this->_inValid($validator->errors());
            }

            $admin = $this->getRepository()->findById(request('id'));

            if (empty($admin)) {
                return backSystemError(transMessage('system_error'));
            }

            $admin->password = bcrypt(request('password'));
            $admin->remember_password = null;
            $admin->status = getConfig('user.status.active');
            $admin->save();

            return backRouteSuccess(backendRouterName('login'), transMessage('update_password_success'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError(transMessage('system_error'));
    }
}
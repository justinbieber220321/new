<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Base\BackendController as BaseBackendController;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;

class BackendController extends BaseBackendController
{
    public function __construct(AdminRepository $adminRepository)
    {
        $this->setRepository($adminRepository);
    }

    public function deleteCache()
    {
        try {
            $this->_deleteCache();

            return redirect()->back()->with('notification_success', transMessage('success'));
        } catch (\Exception $exception) {
            logError($exception);
        }
        return backSystemError();
    }

    public function settingSystem()
    {
        return view('backend.system.system-basic');
    }

    public function postSettingSystem()
    {
        try {
            $params = request()->all();

            /** @var \App\Validators\AdminValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->validateSystemInfoBasic($params);

            if (!$isValid) {
                $this->setFormData($params);
                return $this->_inValid($validator->errors());
            }

            $this->_replace('SITE_NAME', arrayGet($params, 'site_name'));
            $this->_replace('SITE_PHONE', arrayGet($params, 'phone'));
            $this->_replace('SITE_TITLE', arrayGet($params, 'title'));
            $this->_replace('META_TITLE', arrayGet($params, 'meta_title'));
            $this->_replace('META_DESCRIPTION', arrayGet($params, 'meta_description'));
            $this->_replace('LOGIN_CONFIRM_OTP', arrayGet($params, 'required-otp-login'));
            $this->_replace('RATE_RPS', arrayGet($params, 'rate_rps'));

            // Upload favicon
            if (request()->hasFile('favicon')) {
                $fileName = time() . "_"  . request()->file('favicon')->getClientOriginalName();
                $pathTmp = 'backend/uploads/system/' . date('Y-m-d');
                $uploadPath  = public_path($pathTmp); // Folder upload path

                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                request()->file('favicon')->move($uploadPath, $fileName);
                $params['favicon'] = $pathTmp . '/' . $fileName;
                $this->_replace('SITE_FAVICON', arrayGet($params, 'favicon'));

                // Remove old file
                $oldImage = getEnvX('SITE_FAVICON');
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }

            // Upload logo
            if (request()->hasFile('logo')) {
                $fileName = time() . "_"  . request()->file('logo')->getClientOriginalName();
                $pathTmp = 'backend/uploads/system/' . date('Y-m-d');
                $uploadPath  = public_path($pathTmp); // Folder upload path

                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                request()->file('logo')->move($uploadPath, $fileName);
                $params['logo'] = $pathTmp . '/' . $fileName;
                $this->_replace('SITE_LOGO', arrayGet($params, 'logo'));

                // Remove old file
                $oldImage = getEnvX('SITE_LOGO');
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }

            // Delete cache
            $this->_deleteCache();

            return backSystemSuccess();
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function settingSendMail()
    {
        return view('backend.system.send-mail');
    }

    public function postSettingSendMail()
    {
        try {
            $params = request()->all();

            /** @var \App\Validators\AdminValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->validateSystemSendMail($params);

            if (!$isValid) {
                $this->setFormData($params);
                return $this->_inValid($validator->errors());
            }

            $this->_replace('MAIL_DRIVER', arrayGet($params, 'mail_driver'));
            $this->_replace('MAIL_HOST', arrayGet($params, 'mail_host'));
            $this->_replace('MAIL_PORT', arrayGet($params, 'mail_port'));
            $this->_replace('MAIL_ENCRYPTION', arrayGet($params, 'mail_encryption'));
            $this->_replace('MAIL_USERNAME', arrayGet($params, 'mail_username'));
            $this->_replace('MAIL_PASSWORD', arrayGet($params, 'mail_password'));
            $this->_replace('MAIL_FROM_NAME', arrayGet($params, 'mail_from_name'));

            // Delete cache
            $this->_deleteCache();

            return backSystemSuccess();
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function getTestSendMail()
    {
        return view('backend.system.test-send-mail');
    }

    public function postTestSendMail()
    {
        $data = [];
        $email = request('email');
        $name = extractNameFromEmail($email);
        $params = request()->all();

        /** @var \App\Validators\AdminValidator $validator */
        $validator = $this->getRepository()->getValidator();
        $isValid = $validator->validateSystemTestSendMail($params);

        if (!$isValid) {
            $this->setFormData($params);
            return $this->_inValid($validator->errors());
        }

        try {
            Mail::send('backend.email_template.test-send-mail', $data, function($message) use ($email, $name)
            {
                $message->to($email, $name)->subject(getSiteName() . ' test send mail');
            });

            if( count(Mail::failures()) > 0 ) {
                logError("Email $email không tồn tại");
                return backSystemError(transMessage('setting_send_mail_error'));
            }

            return backSuccess(transMessage('test_send_mail_success'));
        } catch (\Exception $e) {
            logError($e);
            return backSystemError(transMessage('system_error'));
        }
    }

    public function getOtpLogin()
    {
        return view('backend.system.login-otp');
    }

    public function postOtpLogin()
    {
        try {
            $params = request()->all();

            /** @var \App\Validators\AdminValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->validateOtpLogin($params);

            if (!$isValid) {
                $this->setFormData($params);
                return $this->_inValid($validator->errors());
            }

            $this->_replace('LOGIN_CONFIRM_OTP', arrayGet($params, 'required-otp-login'));

            // Delete cache
            $this->_deleteCache();

            return backSystemSuccess();
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    protected function _replace($key, $value)
    {
        $old = getConfig('system.' . $key);
        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key=". '\'' . $old . '\'',  "$key=". '\'' . $value . '\'', file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                "$key=$old",  "$key=". '\'' . $value . '\'', file_get_contents($path)
            ));
        }
    }

    protected function _deleteCache()
    {
        $commands = [
            'cache:clear',
            'config:clear',
            'config:cache',
            'route:clear',
            'view:clear',
        ];

        foreach ($commands as $command) {
            Artisan::call($command);
        }
    }
}
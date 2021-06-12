<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

class AdminValidator extends BaseValidator
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    // ========== BACKEND ==========
    public function backendValidateChangePassword($params = [])
    {
        $rules = [
            'old_password' => 'required|backend_check_password',
            'new_password' => 'bail|required|string|min:6|max:64|confirmed',
        ];

        return $this->validate($rules, $params);
    }

    public function backendValidateForgotPassword($params = [])
    {
        $rules = [
            'email' => 'bail|required|email'
        ];

        return $this->validate($rules, $params);
    }

    public function backendValidatePasswordRecovery($params = [])
    {
        $rules = [
            'password' => 'bail|required|string|min:6|max:64|nullable|confirmed',
        ];

        return $this->validate($rules, $params);
    }

    public function validateSystemInfoBasic($params = [])
    {
        $rules = [
            'site_name' => 'bail|nullable|max:65',
            'title' => 'bail|nullable|max:65',
            'meta_title' => 'bail|nullable|max:65',
            'meta_description' => 'bail|max:255|nullable',
            'favicon' => 'bail|nullable|mimes:jpeg,jpg,png,gif|max:1024', // 100KB, 1024kb = 1 MB
        ];

        return $this->validate($rules, $params);
    }

    public function validateSystemSendMail($params = [])
    {
        $rules = [
            'mail_host' => 'bail|nullable|max:65',
            'mail_port' => 'bail|nullable|max:65',
            'mail_encryption' => 'bail|nullable|max:65',
            'mail_username' => 'bail|nullable|max:65',
            'mail_password' => 'bail|nullable|max:65',
            'mail_from_name' => 'bail|nullable|max:65',
        ];

        return $this->validate($rules, $params);
    }

    public function validateSystemTestSendMail($params = [])
    {
        $rules = [
            'email' => 'bail|required|email'
        ];

        return $this->validate($rules, $params);
    }

    public function validateUpdateAvatar($params = [])
    {
        $rules = [
            'avatar' => 'bail|nullable|mimes:jpeg,jpg,png,gif|max:1024', // 100KB, 1024kb = 1 MB
        ];

        return $this->validate($rules, $params);
    }

    public function validateChangePassword($params = [])
    {
        $rules = [
            'old_password' => 'required|backend_check_password',
            'new_password' => 'bail|required|string|min:6|max:64|confirmed',
        ];

        return $this->validate($rules, $params);
    }

    public function validateStoreAdmin($params = [])
    {
        $userId = backendCurrentUser()->id;
        $rules = [
            'username' => 'bail|required|max:255',
            'email' => 'bail|required|max:64|unique:admin,email,' . $userId,
        ];

        return $this->validate($rules, $params);
    }

    public function validateOtpLogin($params = [])
    {
        $rules = [
            'required-otp-login' => 'bail|nullable|in:' . getConfig('otp-login.on') . ',' . getConfig('otp-login.off'),
        ];

        return $this->validate($rules, $params);
    }
}
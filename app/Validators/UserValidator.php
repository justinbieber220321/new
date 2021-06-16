<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

class UserValidator extends BaseValidator
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
    public function backendValidateStoreUser($params = [])
    {
        $userId = arrayGet($params, 'user_id');

        $rules = [
            'username' => 'bail|required|max:255',
            'email' => 'bail|required|max:64|unique:user,email,' . $userId,
//            'avatar' => 'bail|nullable|mimes:jpeg,jpg,png,gif|max:1024', // 100KB, 1024kb = 1 MB
            'phone' => 'bail|nullable|unique:user,phone,' . $userId,
            'gender' => 'bail|nullable|in:' . genderBoy() . ',' . genderGirl(),
        ];

        return $this->validate($rules, $params);
    }

    public function backendValidateUpdatePassword($params = [])
    {
        $rules = [
            'password' => 'bail|string|min:6|max:64|nullable|confirmed',
        ];

        return $this->validate($rules, $params);
    }

    // ========== FRONTEND ==========
    public function frontendValidateForgotPassword($params = [ ])
    {
        $rules = [
        'email' => 'bail|required|email'
    ];

        return $this->validate($rules, $params);
    }

    public function frontendValidatePasswordRecovery($params = [])
    {
        $rules = [
            'password' => 'bail|required|string|min:6|max:64|nullable|confirmed',
        ];

        return $this->validate($rules, $params);
    }

    public function frontendValidateStoreUser($params = [])
    {
        $userId = frontendCurrentUserId();
        $rules = [
            'username' => 'bail|required|max:255',
            'email' => 'bail|required|max:64|unique:user,email,' . $userId,
            'phone' => 'bail|nullable|numeric|unique:user,phone,' . $userId,
            'birthday' => 'bail|nullable|date',
            'password' => 'bail|nullable|string|min:6|max:64|confirmed',
        ];

        return $this->validate($rules, $params);
    }

    public function frontendValidateRegisterUser($params = [])
    {
        $userId = frontendCurrentUserId();
        $rules = [
            'username' => 'bail|required|max:255',
            'email' => 'bail|required|max:64|unique:user,email,' . $userId,
            'phone' => 'bail|nullable|unique:user,phone,' . $userId,
            'gender' => 'bail|nullable|in:' . genderBoy() . ',' . genderGirl(),
            'birthday' => 'bail|nullable|date',
            'password' => 'bail|string|min:6|max:64|confirmed',
        ];

        return $this->validate($rules, $params);
    }

    public function frontendValidateChangePassword($params)
    {
        $rules = [
            'old_password' => 'required|frontend_check_password',
            'new_password' => 'bail|required|string|min:6|max:64|confirmed',
        ];

        return $this->validate($rules, $params);
    }

    public function frontendValidateUpdateAvatar($params = [])
    {
        $rules = [
            'avatar' => 'bail|nullable|mimes:jpeg,jpg,png,gif|max:1024', // 100KB, 1024kb = 1 MB
        ];

        return $this->validate($rules, $params);
    }

    public function frontendValidateDeposit($params = [])
    {
        $rules = [
            'user_id' => 'bail|required',
            'message' => 'bail|required|string|max:64',
            'number' => 'bail|required|number_deposit:' . arrayGet($params, 'number'),
        ];

        return $this->validate($rules, $params);
    }

    public function frontendValidateWithdrawal($params = [])
    {
        $rules = [
            'address' => 'bail|required|string|min:34|max:34',
            'number' => 'bail|required|number_withdrawal:' . arrayGet($params, 'number'),
        ];

        return $this->validate($rules, $params);
    }
}
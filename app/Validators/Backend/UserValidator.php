<?php

namespace App\Validators\Backend;

use App\Validators\Base\BaseValidator;
//use Illuminate\Support\Carbon;
use Carbon\Carbon;

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

    public function validateStoreUser($params = [], $id = '')
    {
        $rulePassword = empty($id) ? 'required' : 'nullable';
        $rules = [
            'name' => 'bail|required|max:255',
            'first_name' => 'bail|required|max:255',
            'phone_number' => 'bail|required|unique:users,phone_number,' . $id,
            'email' => 'bail|required|max:64|unique:users,email,' . $id,
            'password' => 'bail|string|min:6|max:64|' . $rulePassword,
            'date_of_birth' => 'bail|nullable|date_format:Y-m-d|before:' . date('Y-m-d'),
            'avatar' => 'bail|nullable|mimes:jpeg,jpg,png,gif|max:1024', // 100KB, 1024kb = 1 MB,
            'status' => 'bail|nullable|in:0,1',
            'gender' => 'bail|nullable|in:0,1'
        ];

        return $this->validate($rules, $params);
    }

    public function frontendValidateStoreUser($params = [], $id = '')
    {
        $rules = [
            'name' => 'bail|required|max:255',
            'first_name' => 'bail|required|max:255',
            'phone_number' => 'bail|required|unique:users,phone_number,' . $id,
            'email' => 'bail|required|max:64|unique:users,email,' . $id,
            'password' => 'bail|string|min:6|max:64|nullable|confirmed',
            'date_of_birth' => 'bail|nullable|date_format:Y-m-d|before:' . date('Y-m-d'),
            'avatar' => 'bail|nullable|mimes:jpeg,jpg,png,gif|max:1024', // 100KB, 1024kb = 1 MB,
            'status' => 'bail|nullable|in:0,1',
            'gender' => 'bail|nullable|in:0,1'
        ];

        return $this->validate($rules, $params);
    }

    protected function _setCustomAttributes()
    {
        return [
            'name' => 'Tên',
            'first_name' => 'Tên viết tắt',
            'phone_number' => 'Số điện thoại',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'date_of_birth' => 'Ngày sinh',
            'avatar' => 'Ảnh đại diện',
            'status' => 'Trạng thái',
            'gender' => 'Giới tính',
        ];
    }
}
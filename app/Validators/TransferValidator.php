<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

class TransferValidator extends BaseValidator
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

    public function validateStoreTransfer($params)
    {
        $coin = arrayGet($params, 'currency');
        $rules = [
            'currency' => 'bail|required',
            'user_to' => 'bail|required',
            'message' => 'bail|max:255',
            'number' => 'bail|required|numeric|min:0|limit_coin_number:' . $coin,
        ];

        return $this->validate($rules, $params);
    }

    public function validateConfirmTransfer($params)
    {
        $coin = arrayGet($params, 'currency');
        $rules = [
            'currency' => 'bail|required',
            'user_to' => 'bail|required',
            'message' => 'bail|max:65',
            'number' => 'bail|required|numeric|min:1|limit_coin_number:' . $coin,
            'random_str_otp' => 'bail|required',
        ];

        return $this->validate($rules, $params);
    }
}

<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

class InvestValidator extends BaseValidator
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

    public function validateMakeInvest($params = [])
    {
        $rules = [
            'package_id' => 'bail|required',
            'number' => 'bail|required|number_invest:' . arrayGet($params, 'number'),
        ];

        return $this->validate($rules, $params);
    }
}
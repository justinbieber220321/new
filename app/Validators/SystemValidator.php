<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

class SystemValidator extends BaseValidator
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
}
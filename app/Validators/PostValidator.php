<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

class PostValidator extends BaseValidator
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
    public function backendValidateStorePost($params = [])
    {
        $rules = [
            'title' => 'bail|required|max:65',
            'meta_title' => 'bail|required|max:65',
            'meta_description' => 'bail|max:255',
        ];

        return $this->validate($rules, $params);
    }


    protected function _setCustomAttributes()
    {
        return [];
    }
}
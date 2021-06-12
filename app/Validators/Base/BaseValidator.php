<?php

namespace App\Validators\Base;

use Prettus\Validator\LaravelValidator;

class BaseValidator extends LaravelValidator
{
    protected $_model;

    public function getModel()
    {
        return $this->_model;
    }

    public function setModel($model)
    {
        return $this->_model = $model;
    }

    /**
     * @param array $params
     * @return bool
     * validate default for create/update a record
     */
    public function validateDefault($params = [])
    {
        $params = !empty($params) ? $params : request()->all();
        $this->rules = $this->_getRulesDefault();
        $customAttributes = $this->_setCustomAttributes();
        $customMessages   = $this->_setCustomMessage();
        return $this->with($params)->setAttributes($customAttributes)->setMessages($customMessages)->passes();
    }

    public function validate($rules= [], $params  = [])
    {
        $params = !empty($params) ? $params : request()->input();
        return $this->with($params)->setRules($rules)->setAttributes($this->_setCustomAttributes())->setMessages($this->_setCustomMessage())->passes();
    }

    /**
     * Set Custom error attributes for Validation
     * @param array $attributes
     * @return $this
     */
    public function setAttributes($attributes = [])
    {
        $this->attributes = $this->attributes + $attributes;
        return $this;
    }

    protected function _setCustomAttributes()
    {
        return [];
    }

    /**
     * Set Custom error messages for Validation
     * @param array $messages
     * @return $this
     */
    public function setMessages($messages = [])
    {
        $this->messages = $this->messages + $messages;
        return $this;
    }

    protected function _setCustomMessage()
    {
        return [];
    }
}
<?php

namespace App\Http\Controllers\Frontend\Base;

use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function findOrNewEntityForCreate()
    {
        $module = $this->getRepository()->getModel();
        $entity = new $module();

        if (!session()->has(getConfig('key_form_data_old'))) {
            return $entity;
        }

        $inputOld = session(getConfig('key_form_data_old'));
        $entity->fill($inputOld);

        return $entity;
    }

    /**
     * @param $errors
     * redirect to back url with submit form error validate and store session input old
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function _inValid($errors)
    {
        $data = $this->getFormData();
        session([getConfig('key_form_data_old') => $data]);
        return redirect()->back()->withErrors($errors);
    }

    public function afterStoreUpdateCommit()
    {
        if (session('entity')) {
            session()->forget('entity');
        }

        if (session(getConfig('key_form_data_old'))) {
            session()->forget(getConfig('key_form_data_old'));
        }
    }

    public function findEntityForUpdate($id)
    {
        $entity = $this->getRepository()->findOrFail($id);

        if (!session()->has(getConfig('key_form_data_old'))) {
            return $entity;
        }

        $inputOld = session(getConfig('key_form_data_old'));
        $entity->fill($inputOld);

        return $entity;
    }

    protected function _clearSessionForm()
    {
        if (session(getConfig('key_form_data_old'))) {
            session()->forget(getConfig('key_form_data_old'));
        }
    }
}
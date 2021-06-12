<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    protected $_repository;
    protected $_formData; // data form submit

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getRepository()
    {
        return $this->_repository;
    }

    public function setRepository($repository)
    {
        return $this->_repository = $repository;
    }

    public function setFormData($data = [])
    {
        $this->_formData = $data;
    }

    public function getFormData()
    {
        return $this->_formData;
    }

    public function setLang()
    {
        try {
            $lang = strtolower(request('lang'));

            if (in_array(trim($lang), getConfig('lang'))) {
                session()->put('lang', $lang);
            }

            $response = [
                'status' => 200,
                'data' => [],
                'message' => transMessage('success'),
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            logError($e);
        }

        $response = [
            'status' => 500,
            'data' => [],
            'message' => transMessage('error'),
        ];

        return response()->json($response);
    }
}

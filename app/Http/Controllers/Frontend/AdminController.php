<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;

class AdminController extends FrontendController
{
    public function setting()
    {
        return view('frontend.admin-setting.index');
    }

    public function postSetting()
    {
        echo 123;die;
    }
}
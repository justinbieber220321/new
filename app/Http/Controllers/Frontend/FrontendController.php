<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController as BaseFrontendController;

class FrontendController extends BaseFrontendController
{
    public function index()
    {
        return view('frontend.user.account');
    }

    public function support()
    {
        return view('frontend.support.index');
    }
}
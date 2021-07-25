<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;

class DashboardController extends FrontendController
{
    public function index()
    {
        $infoBet = getBet(frontendCurrentUser());

        $viewData = [
            'infoBet' => $infoBet,
            'level' => arrayGet($infoBet, 'level'),
        ];

        return view('frontend.dashboard.index', $viewData);
    }
}

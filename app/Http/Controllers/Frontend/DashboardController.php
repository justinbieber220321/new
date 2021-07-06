<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\User;

class DashboardController extends FrontendController
{
    public function index()
    {
        $infoBet = getBet(frontendCurrentUser());
        $viewData = [
            'infoBet' => $infoBet
        ];

        return view('frontend.dashboard.index', $viewData);
    }
}

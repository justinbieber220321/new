<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Repositories\UserRepository;
use App\Services\CoinService;
use Illuminate\Support\Facades\File;

class DashboardController extends FrontendController
{
    public function index()
    {
        return view('frontend.dashboard.index');
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\User;

class DashboardController extends FrontendController
{
    public function index()
    {
        $user = frontendCurrentUser();

        $countUserDirect = User::delFlagOn()->statusOn()->where('parent_id', $user->user_id)->count();
        $countUser = userAllChildsIds($user);

        $viewData = [
            'countUserDirect' => $countUserDirect,
            'countUser' => $countUser ? count($countUser) : 0
        ];

        return view('frontend.dashboard.index', $viewData);
    }
}

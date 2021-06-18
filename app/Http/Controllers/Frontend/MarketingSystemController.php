<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\User;

class MarketingSystemController extends FrontendController
{
    public function referrals()
    {
        $user = frontendCurrentUser();

        $countUserDirect = User::delFlagOn()->statusOn()->where('parent_id', $user->user_id)->count();
        $countUser = userAllChildsIds($user);

        $viewData = [
            'countUserDirect' => $countUserDirect,
            'countUser' => $countUser ? count($countUser) : 0
        ];

        return view('frontend.marketing-system.referral', $viewData);
    }

    public function affiliateTree()
    {
        $user = frontendCurrentUser();
        $f1 = User::delFlagOn()->statusOn()->where('parent_id', $user->user_id)->get();

        $viewData = [
            'f1' => $f1
        ];

        return view('frontend.marketing-system.affiliate-tree', $viewData);
    }
}

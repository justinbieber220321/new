<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\User;

class MarketingSystemController extends FrontendController
{
    public function referrals()
    {
        $user = frontendCurrentUser();

        $countUserDirect = User::delFlagOn()->statusOn()->where('player_code', $user->user_id)->count();
        $countUser = userAllChildsIds($user);

        $viewData = [
            'countUserDirect' => $countUserDirect,
            'countUser' => $countUser ? count($countUser) : 0
        ];

        return view('frontend.marketing-system.referral', $viewData);
    }

    public function affiliateTree($userId = null)
    {
        $isNotRoot = false;
        $f1 = [];

        $root = User::delFlagOn()->statusOn()->where('user_id', frontendCurrentUser()->user_id)->first();

        if (!is_null($userId)) {
            $isNotRoot = true;
            $f1 = User::delFlagOn()->statusOn()->where('user_id', $userId)->first();
            $fn = User::with('children')->delFlagOn()->statusOn()->where('player_code', $userId)->get();
            $countFn = User::delFlagOn()->statusOn()->where('player_code', $userId)->count();
        } else {
            $fn = User::with('children')->delFlagOn()->statusOn()->where('player_code', frontendCurrentUser()->user_id)->get();
            $countFn = User::delFlagOn()->statusOn()->where('player_code', frontendCurrentUser()->user_id)->count();
        }

        $viewData = [
            'isNotRoot' => $isNotRoot,
            'root' => $root,
            'fn' => empty($fn) ? [] : $fn,
            'f1' => empty($f1) ? [] : $f1,
            'countFn' => $countFn,
        ];

        return view('frontend.marketing-system.affiliate-tree', $viewData);
    }
}

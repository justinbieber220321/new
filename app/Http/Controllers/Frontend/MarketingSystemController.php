<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\User;

class MarketingSystemController extends FrontendController
{
    public function referrals()
    {
        $infoBet = getBet(frontendCurrentUser());

        $lv = 0;
        $myBet = arrayGet($infoBet, 'myBet');
        $teamBet = arrayGet($infoBet, 'totalTeamBet');
        $countF1Bet500 = arrayGet($infoBet, 'countF1Bet500');


        if ($myBet >= 1000 && $teamBet >= 50000){
            $lv = 1;
        }
        if ($myBet >= 2000 && $teamBet >= 150000){
            $lv = 2;
        }

        if ($myBet >= 3000 && $teamBet >= 350000 && $countF1Bet500 >= 6){
            $lv = 3;
        }
        if ($myBet >= 5000 && $teamBet >= 1200000 && $countF1Bet500 >= 9){
            $lv = 4;
        }
        if ($myBet >= 10000 && $teamBet >= 3000000 && $countF1Bet500 >=15){
            $lv = 5;
        }

        if (in_array(frontendCurrentUser()->user_id, getConfig('level5'))){
            $lv = 5;
        }

        $user = frontendCurrentUser();
        $user->floor = $lv;
        $user->save();

        $viewData = [
            'infoBet' => $infoBet,
            'level' => $lv,
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
            // user dang login
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

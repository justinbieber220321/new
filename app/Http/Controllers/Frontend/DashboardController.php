<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\User;

class DashboardController extends FrontendController
{
    public function index()
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

        return view('frontend.dashboard.index', $viewData);
    }
}

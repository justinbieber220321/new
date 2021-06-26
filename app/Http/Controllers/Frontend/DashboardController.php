<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\User;

class DashboardController extends FrontendController
{
    public function index()
    {
        $user = frontendCurrentUser();

        $countUserDirect = User::delFlagOn()->statusOn()->where('player_code', $user->user_id)->count();
        $countUserTmp = userAllChildsIds($user);

        $listUserActive = User::delFlagOn()->statusOn()->whereIn('user_id', $countUserTmp)->get();

        $countUser = 0;
        $dataApi = getDataApi();
        foreach ($listUserActive as $item) {
            $getBet = arrayGet(getBet($item, $dataApi), 'myBet') - $item->number_bet_old;
            if ($getBet >= 100) {
                $countUser++;
            }
        }

        $viewData = [
            'countUserDirect' => $countUserDirect,
            'countUser' => $countUser
        ];

        return view('frontend.dashboard.index', $viewData);
    }
}

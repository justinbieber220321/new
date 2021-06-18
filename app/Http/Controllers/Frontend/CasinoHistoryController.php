<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CasinoHistoryController extends FrontendController
{
    public function getCasinoReport()
    {
        $dateTo = date('Y-m-d', strtotime('+1 day', time()));
        $date = date_create(date('Y-m-d'));
        date_sub($date, date_interval_create_from_date_string("7 days"));
        $past = date_format($date, "Y-m-d");
        $link = "https://login.nuxgame.com/api/stat/casino_report?company_id=a37c5f23-7181-44cb-9702-35886ef7b696&date_from=$past&date_to=$dateTo";
        $r = callApi($link);
        $data = empty($r) ? [] : $r;
        $userId = frontendCurrentUser()->user_id;

        foreach ($data as $item) {
            if (arrayGet($item, 'user_id') == $userId) {
                array_push($data, $item);
            }
        }

        $viewData = [
            'data' => $data
        ];

        return view('frontend.casino-history.casino-report', $viewData);
    }

    public function getBetHistory()
    {
        return view('frontend.casino-history.bet-history');
    }
}

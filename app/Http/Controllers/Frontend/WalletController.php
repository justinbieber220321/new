<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;

class WalletController extends FrontendController
{
    public function requestDeposit()
    {
        return view('frontend.wallet.deposit');
    }

    public function walletTransfer()
    {
        return view('frontend.wallet.transfer');
    }

    public function walletHistory()
    {
        return view('frontend.wallet.history');
    }

    public function requestWithdrawal()
    {
        return view('frontend.wallet.withdrawal');
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;

class MarketingSystemController extends FrontendController
{
    public function referrals()
    {
        return view('frontend.marketing-system.referral');
    }

    public function affiliateTree()
    {
        return view('frontend.marketing-system.affiliate-tree');
    }
}

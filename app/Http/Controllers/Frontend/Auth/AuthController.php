<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\CoinAddress;
use App\Model\Entities\User;
use App\Repositories\UserRepository;
use App\Services\CoinService;
use Carbon\Carbon;
use Browser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends FrontendController
{
    public $coinService;

    /**
     * @return mixed
     */
    public function getCoinService()
    {
        return $this->coinService;
    }

    /**
     * @param mixed $coinService
     */
    public function setCoinService($coinService)
    {
        $this->coinService = $coinService;
    }

    public function __construct(UserRepository $userRepository, CoinService $coinService)
    {
        $this->setRepository($userRepository);
        $this->setCoinService($coinService);
    }

    public function showFormLogin()
    {
        if (frontendIsLogin()) {
            return redirect()->route(frontendRouterName('home'));
        }

        return view('frontend.auth.login');
    }

    public function postLogin()
    {
        DB::beginTransaction();
        try {
            $email = request('email');

            $user = User::delFlagOn()->statusOn()->where('email', $email)->first();
            if (empty($user)) {
                return redirect()->back()->withErrors(transMessage('account_not_found'))->withInput(request()->all());
            }

            $otpCode = genOtp();
            $this->_sendMailOtp($user, $otpCode);

            $user->code_otp = $otpCode;
            $user->save();

            DB::commit();

            $link = frontendRouter('login.confirm-opt') . "?id=$user->id&otp=" . bcrypt($otpCode);
            return redirect()->to($link);
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }

        return backSystemError();
    }

    /**
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function showFormLoginConfirmOtp()
    {
        $matchThese = [
            'status' => statusOn(),
            'del_flag' => delFlagOn(),
            'id' => request('id')
        ];

        $user = User::where($matchThese)->first();

        if (empty($user)) {
            return view('frontend.auth.login-confirm-otp-not-found');
        }

        if (!checkHash($user->code_otp, request('otp'))) {
            return view('frontend.auth.login-confirm-otp-not-found');
        }

        $viewData = [
            'userId' => request('id'),
        ];

        return view('frontend.auth.login-confirm-otp', $viewData);
    }

    public function postLoginConfirmOtp()
    {
        DB::beginTransaction();
        try {
            $id = request('user_id');
            $otp = request('code_otp');

            $user = User::delFlagOn()->statusOn()->where('id', $id)->where('code_otp', $otp)->first();
            if (empty($user)) {
                return redirect()->back()->withInput(request()->all())->withErrors(transMessage('code_otp_invalid'));
            }

            frontendGuard()->login($user);

            $user->code_otp = '';
            $user->save();

            // $this->_sendMailInfoLogin($user->email); // @todo confirm
            // $this->_addNewCoinAddressAfterLogin(); // @todo confirm

            DB::commit();

            return redirect()->route(frontendRouterName('home'));
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }

        return redirect()->back()->withInput(request()->all())->withErrors(transMessage('system_error'));
    }

    public function logout()
    {
        frontendGuard()->logout();
        return redirect()->route(frontendRouterName('login.get'));
    }

    protected function _sendMailInfoLogin($email)
    {
        //   $name = frontendCurrentUser()->username;
        $name = "test";

        $data = [
            'ip' => request()->ip(),
            'now' => Carbon::now()->toDayDateTimeString(),
            'device' => Browser::browserFamily() . ' in ' . Browser::platformName(),
            'name' => $name
        ];

        try {
            // send email
            Mail::send('frontend.email_template.login-notification-success', $data, function ($message) use ($email, $name) {
                $message->to($email, $name)->subject(transMessage('send_mail_login_success', ['site-name' => getSiteName()]));
            });

            return true;
        } catch (\Exception $e) {
            logError($e);
        }

        return false;
    }

    protected function _sendMailOtp($user, $otp)
    {
        $name = $user->username;
        $email = $user->email;

        $data = ['otp' => $otp];

        try {
            // send email
            Mail::send('frontend.email_template.login-confirm-otp', $data, function ($message) use ($email, $name) {
                $message->to($email, $name)->subject(transMessage('send_mail_otp', ['site-name' => getSiteName()]));
            });

            return true;
        } catch (\Exception $e) {
            logError($e);
        }

        return false;
    }

    /**
     * auto insert to coin_address table when register new user
     */
    protected function _insertCoinAddress()
    {
        try {
            $currentXrp = getConfig('coin_base.xrp');
            $currentEth = getConfig('coin_base.eth');
            $currentBtc = getConfig('coin_base.btc');

            $btc1 = $this->getCoinService()->createAccountAddress('');
            $eth1 = $this->getCoinService()->getAddress($currentEth);
            $xrp1 = $this->getCoinService()->getAddress($currentXrp);

            $btc2 = $this->getCoinService()->createAccountAddress('');
            $eth2 = $this->getCoinService()->getAddress($currentEth);
            $xrp2 = $this->getCoinService()->getAddress($currentXrp);

            $params = [
                ['address' => $btc1, 'currency' => $currentBtc],
                ['address' => $eth1, 'currency' => $currentEth],
                ['address' => $xrp1, 'currency' => $currentXrp],

                ['address' => $btc2, 'currency' => $currentBtc],
                ['address' => $eth2, 'currency' => $currentEth],
                ['address' => $xrp2, 'currency' => $currentXrp],
            ];

            CoinAddress::insert($params);
        } catch (\Exception $e) {
            logError($e);
        }
    }

    /**
     * Add coin address after login if the user does not have a coin address
     */
    protected function _addNewCoinAddressAfterLogin()
    {
        try {
            $user = frontendCurrentUser();
            $ids = [];

            // insert coin address rps @todo

            // insert coin address xrp
            if (!$user->coin_address_xrp) {
                $xrp = CoinAddress::where('currency', 'XRP')->first();
                if (!empty($xrp)) {
                    $user->coin_address_xrp = $xrp->address;
                    array_push($ids, $xrp->id);
                }
            }

            // insert coin address btc
            if (!$user->coin_address_btc) {
                $btc = CoinAddress::where('currency', 'BTC')->first();
                if (!empty($btc)) {
                    $user->coin_address_btc = $btc->address;
                    array_push($ids, $btc->id);
                }
            }
            // insert coin address eth
            if (!$user->coin_address_eth) {
                $eth = CoinAddress::where('currency', 'ETH')->first();
                if (!empty($eth)) {
                    $user->coin_address_eth = $eth->address;
                    array_push($ids, $eth->id);
                }
            }

            // insert coin address usdt
            if (!$user->coin_address_usdt) {
                $user->coin_address_usdt = env('COINBASE_USDT_ADDRESS');
            }

            $user->save();
            CoinAddress::whereIn('id', $ids)->delete();
        } catch (\Exception $e) {
            logError($e);
        }
    }

    protected function _addNewCoinAddressAfterRegister(&$params)
    {
        try {
            $ids = [];

            $xrp = CoinAddress::where('currency', 'XRP')->first();
            if (!empty($xrp)) {
                $params['coin_address_xrp'] = $xrp->address;
                array_push($ids, $xrp->id);
            }

            $btc = CoinAddress::where('currency', 'BTC')->first();
            if (!empty($btc)) {
                $params['coin_address_btc'] = $btc->address;
                array_push($ids, $btc->id);
            }

            $eth = CoinAddress::where('currency', 'ETH')->first();
            if (!empty($eth)) {
                $params['coin_address_eth'] = $eth->address;
                array_push($ids, $eth->id);
            }

            $params['coin_address_usdt'] = env('COINBASE_USDT_ADDRESS');
            CoinAddress::whereIn('id', $ids)->delete();
        } catch (\Exception $e) {
            logError($e);
        }
    }

    /**
     * @param $params
     * @return string|void
     */
    protected function _getAffiliates($params)
    {
        $userId = arrayGet($params, 'parent_user_id');
        if (!$userId) {
            return;
        }

        $user = User::where('id', $userId)->delFlagOn()->statusOn()->first();

        if (empty($user)) {
            return;
        }

        return extractNameFromEmail($user->email) . '_' . $userId;
    }
}
<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\CoinAddress;
use App\Model\Entities\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Browser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends FrontendController
{
    public $coinService;

    public function __construct(UserRepository $userRepository)
    {
        $this->setRepository($userRepository);
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
            $email = trim(request('email'));
            $user = User::delFlagOn()->statusOn()->where('email', $email)->first();
            $dataUser = [];
            if (empty($user)) {
                $dataApi = $this->_getDataFromApi();
                $isExistsEmail = false;
                foreach ($dataApi as $item) {
                    if (arrayGet($item, 'email') == $email) {
                        $isExistsEmail = true;
                        $dataUser = $item;
                        break;
                    }
                }

                if (!$isExistsEmail) {
                    return redirect()->back()->withErrors(transMessage('account_not_found'))->withInput(request()->all());
                }

                $user = new User();
                $user->user_id = arrayGet($dataUser, 'user_id');
                $user->username = arrayGet($dataUser, 'username') ? arrayGet($dataUser, 'username') : extractNameFromEmail(arrayGet($dataUser, 'email'));
                $user->email = arrayGet($dataUser, 'email');
                $user->balance = arrayGet($dataUser, 'balance');
                $user->parent_id = arrayGet($dataUser, 'parent_id');
                $user->player_code = (int)arrayGet($dataUser, 'player_code');
                $user->status = statusOn();
            } else {
                $dataUser = $user->toArray();
            }

            $otpCode = genOtp();
            $user->code_otp = $otpCode;
            $user->save();
            DB::commit();

            $this->_sendMailOtp(arrayGet($dataUser, 'username'), arrayGet($dataUser, 'email'), $otpCode);

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
        $name = frontendCurrentUser()->username;

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

    protected function _sendMailOtp($userName, $userEmail, $otp)
    {
        $name = $userName;
        $email = $userEmail;

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

    protected function _getDataFromApi()
    {
        try {
            $dateTo = date('Y-m-d', strtotime('+1 day', time()));
            $date = date_create(date('Y-m-d'));
            date_sub($date, date_interval_create_from_date_string("30 days"));
            $past = date_format($date, "Y-m-d");
            $endpoint = "https://login.nuxgame.com/api/stat/user_list?company_id=a37c5f23-7181-44cb-9702-35886ef7b696&date_from=$past&date_to=$dateTo";
            return callApi($endpoint);
        } catch (\Exception $e) {
            logError($e);
        }

        return [];
    }
}
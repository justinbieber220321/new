<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\Deposit;
use App\Model\Entities\Transaction;
use App\Model\Entities\Withdraw;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\Services\TRXService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class WalletController extends FrontendController
{
    protected $_trxService;
    protected $_transactionRepository;

    public function __construct(UserRepository $userRepository, TRXService $TrxService, TransactionRepository $transactionRepository)
    {
        $this->setRepository($userRepository);
        $this->_trxService = $TrxService;
        $this->_transactionRepository = $transactionRepository;
    }

    public function requestDeposit()
    {
        return view('frontend.wallet.deposit');
    }

    public function postCheckDeposit()
    {
        try {
            $listTransactions = $this->_trxService->getListTransactionsbyAddress(frontendCurrentUser()->address);
            $userId = frontendCurrentUser()->user_id; // = user id dang login thi moi cong them vao bang deposit
            $currency = getConfig('coin-default');

            $listTransactionNew = [];
            foreach ($listTransactions as $tran) {
                $tranId = arrayGet($tran, 'transaction_id');
                $depositEntity = Deposit::delFlagOn()->where('message', $tranId)->first();
                if ($depositEntity) {
                    continue;
		        }

	        	if (arrayGet($tran, 'to') != frontendCurrentUser()->address){
                    continue;
                }
                array_push($listTransactionNew, $tran);
            }

//            dd($listTransactionNew);

            if (empty($listTransactions) || empty($listTransactionNew)) {
                DB::rollBack();
                return redirect()->back()->with('notification_error', 'No transaction exists');
            }

            $depositTypeHash = getConfig('deposit-type.hash', 3);
            foreach ($listTransactionNew as $trann) {
                DB::beginTransaction();
                $amount = arrayGet($trann, 'value') / 1000000;
                try {
                    // insert db
                    $deposit = new Deposit();
                    $deposit->user_id = $userId;
                    $deposit->from = $userId;
                    $deposit->currency = $currency;
                    $deposit->message = arrayGet($trann, 'transaction_id');
                    $deposit->number = $amount;
                    $deposit->type = $depositTypeHash;
                    $deposit->save();

                    // call api
                    $hash = md5($userId . $amount . "W36CvhErO1YR8vGd");
                    $apiDeposit = "https://login.nuxgame.com/api/stat/make_deposit?company_id=a37c5f23-7181-44cb-9702-35886ef7b696&user_id=$userId&amount=$amount&hash=$hash";
                    $r1 = callApi($apiDeposit);
                    if (arrayGet($r1, 'status')) {
                        DB::commit(); // all good
                        return redirect()->back()->with('notification_success', 'Success. Please check the deposit history');
                    }

                    DB::rollBack();
                } catch (\Exception $e1) {
                    DB::rollBack();
                    logError($e1);
                }
            }
            return backSystemError();
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function walletTransfer()
    {
        $this->_clearSessionFormTransfer();
        $listAffiliates = $this->getRepository()->getListForTransfer(frontendCurrentUserId());

        $viewData = [
            'listAffiliates' => $listAffiliates
        ];

        return view('frontend.wallet.transfer', $viewData);
    }

    public function postTransfer()
    {
        try {
            $params = request()->all();

            /** @var \App\Validators\UserValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->frontendValidateDeposit($params);

            if (!$isValid) {
                $this->setFormData($params);
                return redirect()->back()->withErrors($validator->errors())->withInput($params);
            }

            $tran = $this->_handleTransactionOtp();
            if (!$tran) {
                return redirect()->back()->with('notification_error', 'Handle transaction otp code error')->withInput($params);
            }

            // Send mail for current user with otp code to confirm transfer
            $email = frontendCurrentUser()->email_send_mail;
            try {
                Mail::send('frontend.email_template.transfer-random-otp', ['otpRandom' => $tran->code_otp], function ($message) use ($email) {
                    $message->to($email)->subject(transMessage('transfer_code_success', ['site-name' => getSiteName()]));
                });
            } catch (\Exception $e) {
                logError($e);
                DB::rollBack();
                return backRouteError(frontendRouterName('transfer'));
            }

            $params['end_time'] = $tran->end_time;
            session(['for_transfer' => $params]);
            return redirect()->route(frontendRouterName('transfer-confirm'))->with(['entity' => $params]);
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }

    public function getTransferConfirm()
    {
        try {
            if (!session()->has('for_transfer')) {
                 return redirect()->route(frontendRouterName('transfer'));
            }

            $dataTransfer = session()->get('for_transfer');
            $viewData = [
                'dataTransfer' => $dataTransfer
            ];

            return view('frontend.wallet.transfer-confirm', $viewData);
        } catch (\Exception $e) {
            logError($e);

        }

        return backSystemError();
    }

    public function postTransferConfirm()
    {
        DB::beginTransaction();
        try {
            $params = request()->all();

            $userTransaction = $this->_transactionRepository->findByUserId(frontendCurrentUser()->user_id);
            if (empty($userTransaction)) {
                return redirect()->back()->with('notification_error', 'No transaction exists')->withInput($params);
            }

            /** @var \App\Validators\UserValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->frontendValidateDeposit($params);

            if (!$isValid) {
                $this->setFormData($params);
                return redirect()->back()->withErrors($validator->errors())->withInput($params);
            }

            if (request('random_str_otp') != $userTransaction->code_otp) {
                return redirect()->back()->with('notification_error', transMessage('transfer_failed_with_error_code_otp'))->withInput($params);
            }

            if (now()->greaterThan($userTransaction->end_time)) {
                return redirect()->back()->with('notification_error', transMessage('transfer_timeout'))->withInput($params);
            }
            // Store deposit table
            $depositEntity = new Deposit();
            $depositEntity->user_id = arrayGet($params, 'user_id');
            $depositEntity->from = frontendCurrentUser()->user_id;
            $depositEntity->message = arrayGet($params, 'message');
            $depositEntity->number = arrayGet($params, 'number');
            $depositEntity->save();

            // Store withdraw table
            $withDrawEntity = new Withdraw();
            $withDrawEntity->user_id = frontendCurrentUser()->user_id;
            $withDrawEntity->to = arrayGet($params, 'user_id');
            $withDrawEntity->message = arrayGet($params, 'message');
            $withDrawEntity->number = 100.5 * arrayGet($params, 'number') / 100.0;;
            $withDrawEntity->save();

            $userTransaction->delete();

            $amount = arrayGet($params, 'number');
            $amountw = 100.5 * arrayGet($params, 'number') / 100.0;
            $userIdDeposit = arrayGet($params, 'user_id');
            $userIdWithdraw = frontendCurrentUser()->user_id;
            $hashDeposit = md5($userIdDeposit . $amount . "W36CvhErO1YR8vGd");
            $hashWithdraw = md5($userIdWithdraw . $amountw . "W36CvhErO1YR8vGd");

            $apiDeposit = "https://login.nuxgame.com/api/stat/make_deposit?company_id=a37c5f23-7181-44cb-9702-35886ef7b696&user_id=$userIdDeposit&amount=$amount&hash=$hashDeposit";
            $apiWithdrawal = "https://login.nuxgame.com/api/stat/make_withdrawal?company_id=a37c5f23-7181-44cb-9702-35886ef7b696&user_id=$userIdWithdraw&amount=$amountw&hash=$hashWithdraw";

            $r2 = callApi($apiWithdrawal);
            if (arrayGet($r2, 'status')) {
                $r1 = callApi($apiDeposit);
                if (arrayGet($r1, 'status') ) {
                    DB::commit(); // all good
                    return backRouteSuccess(frontendRouterName('transfer'));
                }
            }

            return  backRouteError(frontendRouterName('transfer'));
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }

        return backSystemError();
    }

    public function walletHistory()
    {
        $limit = getFrontendPagination();

        $listWithdrawBuilder = Withdraw::with('userWithdrawToUser')->delFlagOn()
            ->where('user_id', frontendCurrentUser()->user_id)->orderBy('id', 'desc');

        $listDepositBuilder = Deposit::with('userDepositFrom')->delFlagOn()
            ->where('user_id', frontendCurrentUser()->user_id)->orderBy('id', 'desc');


        $listWithdraw = $listWithdrawBuilder->limit($limit)->get();
        $listDeposit = $listDepositBuilder->limit($limit)->get();

        $countWithdraw = $listWithdrawBuilder->count();
        $countDeposit = $listDepositBuilder->count();

        $viewData = [
            'listDeposit' => $listDeposit,
            'countDeposit' => $countDeposit,
            'listWithdraw' => $listWithdraw,
            'countWithdraw' => $countWithdraw,
        ];

        return view('frontend.wallet.history', $viewData);
    }

    public function walletHistoryDeposit()
    {
        $listDeposit = Deposit::with('userDepositFrom')->delFlagOn()
            ->where('user_id', frontendCurrentUser()->user_id)->orderBy('id', 'desc')->paginate(getFrontendPagination());

        $viewData = [
            'listDeposit' => $listDeposit
        ];

        return view('frontend.wallet.history-deposit', $viewData);
    }

    public function walletHistoryWithdraw()
    {
        $listWithdraw = Withdraw::with('userWithdrawToUser')->delFlagOn()
            ->where('user_id', frontendCurrentUser()->user_id)->orderBy('id', 'desc')->paginate(getFrontendPagination());

        $viewData = [
            'listWithdraw' => $listWithdraw
        ];

        return view('frontend.wallet.history-withdraw', $viewData);
    }

    public function requestWithdrawal()
    {
        $this->_clearSessionFormTransfer();
        $max = getConfig('max-day-withdraw');
        $balance = getBalanceRealtime();
        $maxAmount = $max > $balance ? $balance : $max;

        $viewData = [
            'maxAmount' => $maxAmount
        ];

        return view('frontend.wallet.withdrawal', $viewData);
    }

    public function postWithdrawal()
    {
        try {
            $params = request()->all();
            $userId = frontendCurrentUser()->user_id;

            /** @var \App\Validators\UserValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->frontendValidateWithdrawal($params);

            if (!$isValid) {
                $this->setFormData($params);
                return redirect()->back()->withErrors($validator->errors())->withInput($params);
            }

            $address = trim(arrayGet($params, 'address'));
            if (strtoupper(substr($address, 0, 1)) != 'T') {
                return redirect()->back()->with('notification_error', 'The address field must begin with the character "T"')->withInput($params);
            }

            // validate max withdraw on day
            $typeHash = getConfig('withdraw-type.withdraw');
            $raw = "SELECT SUM(`number`) as totalWithdraw FROM `withdraw` WHERE user_id = $userId and type = $typeHash
                    and ins_date <= now() and ins_date > date_SUB(now(), INTERVAL 24 HOUR)";

            $totalWithdraw = DB::select($raw);
            if (!empty($totalWithdraw)) {
                $totalWithdraw = arrayGet($totalWithdraw, 0, []);
                $totalWithdraw = (int)$totalWithdraw->totalWithdraw;
                if ($totalWithdraw > getConfig('max-day-withdraw')) {
                    return redirect()->back()->withInput($params)
                        ->with('notification_error', 'You have withdrawn more than the allowed amount in 24 hours. Please try again.');
                }
            }

            if (!$this->_checkTotalDeposit15Days((int)arrayGet($params, 'number'))) {
                return redirect()->back()->withInput($params)->with('notification_error', 'Invalid withdrawal amount');
            }

            $tran = $this->_handleTransactionOtp();
            if (!$tran) {
                return redirect()->back()->with('notification_error', 'Handle transaction otp code error')->withInput($params);
            }

            // Send mail for current user with otp code to confirm withdraw
            $email = frontendCurrentUser()->email_send_mail;
            try {
                Mail::send('frontend.email_template.transfer-random-otp', ['otpRandom' => $tran->code_otp], function ($message) use ($email) {
                    $message->to($email)->subject(transMessage('transfer_code_success', ['site-name' => getSiteName()]));
                });
            } catch (\Exception $e) {
                logError($e);
                DB::rollBack();
                return backRouteError(frontendRouterName('transfer'));
            }

            $params['end_time'] = $tran->end_time;
            session(['for_withdraw_confirm' => $params]);
            return redirect()->route(frontendRouterName('withdrawal-confirm'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }

    public function getWithdrawalConfirm()
    {
        try {
            if (!session()->has('for_withdraw_confirm')) {
                 return redirect()->route(frontendRouterName('transfer'));
            }

            $dataWithdrawConfirm = session()->get('for_withdraw_confirm');
            $viewData = [
                'dataWithdrawConfirm' => $dataWithdrawConfirm
            ];

            return view('frontend.wallet.withdrawal-confirm', $viewData);
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }

    public function postWithdrawalConfirm()
    {
        DB::beginTransaction();
        try {
            $params = request()->all();
            $number = (int)request('number');
            $userId = frontendCurrentUser()->user_id;

            $userTransaction = $this->_transactionRepository->findByUserId(frontendCurrentUser()->user_id);
            if (empty($userTransaction)) {
                return redirect()->back()->with('notification_error', 'No transaction exists')->withInput($params);
            }

            // check code otp
            if (request('random_str_otp') != $userTransaction->code_otp) {
                return redirect()->back()->with('notification_error', transMessage('transfer_failed_with_error_code_otp'))->withInput($params);
            }


            /** @var \App\Validators\UserValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->frontendValidateWithdrawal($params);

            if (!$isValid) {
                $this->setFormData($params);
                return redirect()->back()->withErrors($validator->errors())->withInput($params);
            }

            $address = trim(arrayGet($params, 'address'));
            if (strtoupper(substr($address, 0, 1)) != 'T') {
                return redirect()->back()->with('notification_error', 'The address field must begin with the character "T"');
            }

            // validate max withdraw on day
            $typeHash = getConfig('withdraw-type.withdraw');
            $raw = "SELECT SUM(`number`) as totalWithdraw FROM `withdraw` WHERE user_id = $userId and type = $typeHash
                    and ins_date <= now() and ins_date > date_SUB(now(), INTERVAL 24 HOUR)";

            $totalWithdraw = DB::select($raw);
            if (!empty($totalWithdraw)) {
                $totalWithdraw = arrayGet($totalWithdraw, 0, []);
                $totalWithdraw = (int)$totalWithdraw->totalWithdraw;
                if ($totalWithdraw > getConfig('max-day-withdraw')) {
                    return redirect()->back()->with('notification_error', 'You have withdrawn more than the allowed amount in 24 hours. Please try again.');
                }
            }


            // check time for otp code
            if (now()->greaterThan($userTransaction->end_time)) {
                return redirect()->back()->with('notification_error', transMessage('transfer_timeout'))->withInput($params);
            }

            if (!$this->_checkTotalDeposit15Days((int)arrayGet($params, 'number'))) {
                return redirect()->back()->withInput($params)->with('notification_error', 'Invalid withdrawal amount');
            }

            $userTransaction->delete();

            DB::commit();

            // call api withdraw
            $amount = (100.0 + getConfig('fee-withdraw', 1.8)) * $number / 100.0;
            $hash = md5($userId . $amount . "W36CvhErO1YR8vGd");

            $apiWithdrawal = "https://login.nuxgame.com/api/stat/make_withdrawal?company_id=a37c5f23-7181-44cb-9702-35886ef7b696&user_id=$userId&amount=$amount&hash=$hash";
            $r = callApi($apiWithdrawal);
            if (!arrayGet($r, 'status')) {
                return redirect()->back()->with('notification_error', 'Failure. Please check your balance again and try again later.');
            }

            $transfer = $this->_trxService->transfer(arrayGet($params, 'address'), $number);
            if ($transfer == 1) {
                // revert make withdraw when transfer Failure
                $apiDeposit = "https://login.nuxgame.com/api/stat/make_deposit?company_id=a37c5f23-7181-44cb-9702-35886ef7b696&user_id=$userId&amount=$amount&hash=$hash";
                callApi($apiDeposit);
                return redirect()->back()->with('notification_error', 'Sorry. The system is busy. Please try again later');
            }

            $hash = arrayGet($transfer, 'txid');
            $dataWithdraw = [
                'user_id' => $userId,
                'to' => $userId,
                'message' => $hash,
                'number' => $number,
                'address_to' => $address,
                'type' => getConfig('withdraw-type.withdraw'),
            ];
            $obj = new Withdraw();
            $obj->fill($dataWithdraw);
            $obj->save();

            $userIdAdmin = getConfig('user_id-admin');

            // store withdraw fee
            $dataWithdraw2 = [
                'user_id' => $userId,
                'to' => $userIdAdmin,
                'message' => 'Withdrawal fee',
                'number' => $number  * getConfig('fee-withdraw', 1.8) / 100,
                'type' => getConfig('withdraw-type.fee'),
            ];
            $obj2 = new Withdraw();
            $obj2->fill($dataWithdraw2);
            $obj2->save();

            // store deposit fee
            $dataDeposit = [
                'user_id' => $userIdAdmin,
                'from' => $userId,
                'message' => 'Withdrawal fee',
                'number' => $number * getConfig('fee-withdraw', 1.8) / 100
            ];
            $obj3 = new Deposit();
            $obj3->fill($dataDeposit);
            $obj3->save();

            $userTransaction->delete();

            DB::commit();
            return backRouteSuccess(frontendRouterName('withdrawal'));
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }

        return backSystemError();
    }

    protected function _clearSessionFormTransfer()
    {
        if (session('for_transfer')) {
            session()->forget('for_transfer');
        }

        if (session('for_withdraw_confirm')) {
            session()->forget('for_withdraw_confirm');
        }
    }

    /**
     * @return Transaction|bool
     * Handle transaction table: insert or update
     */
    protected function _handleTransactionOtp()
    {
        try {
            $otpExpireTime = Carbon::now()->addMinutes(getConfig('time_limit_otp_code'));
            $otpExpireTime = $otpExpireTime->toDateTimeString();
            $otp = genOtp();

            $tran = $this->_transactionRepository->findByUserId(frontendCurrentUser()->user_id);
            if (empty($tran)) {
                // Insert new transaction
                $tran = new Transaction();
                $transData = [
                    'user_id' => frontendCurrentUser()->user_id,
                    'code_otp' => $otp,
                    'end_time' => $otpExpireTime
                ];
                $tran->fill($transData);
                $tran->save();
            } else {
                // Update
                $tran->code_otp = $otp;
                $tran->end_time = $otpExpireTime;
                $tran->save();
            }

            return $tran;
        } catch (\Exception $e) {
            logError($e);
            return false;
        }

        return false;
    }

    protected function _checkTotalDeposit15Days($inputWithdraw)
    {
        $sql = "select * from user where ins_date > date_SUB(now(), INTERVAL 7 DAY) and id = " . frontendCurrentUser()->id;
        $myAccountCreatedAt = DB::select($sql);
        if (!arrayGet($myAccountCreatedAt, 0)) {
            return true;
        }

        // select total withdraw hash
        $totalWithdrawHash = Withdraw::selectRaw('SUM(number) AS tmp')
            ->where('type', getConfig('withdraw-type.withdraw'))
            ->where('user_id', frontendCurrentUser()->user_id)
            ->whereRaw('ins_date > date_SUB(now(), INTERVAL 15 DAY)')->first();
        $totalWithdrawHash = (int)$totalWithdrawHash->tmp;

        // select total deposit hash
        $totalDepositHash = Deposit::selectRaw('SUM(number) AS totalDepositHash')
            ->where('type', getConfig('deposit-type.hash'))
            ->where('from', frontendCurrentUser()->user_id)
            ->whereRaw('ins_date > date_SUB(now(), INTERVAL 15 DAY)')->first();
        $totalDepositHash =(int)$totalDepositHash->totalDepositHash;

        $totalWithdrawHash += $inputWithdraw;
        return $totalWithdrawHash <= $totalDepositHash;
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\Deposit;
use App\Model\Entities\Withdraw;
use App\Repositories\UserRepository;
use App\Services\TRXService;
use Illuminate\Support\Facades\DB;

class WalletController extends FrontendController
{
    protected $_trxService;

    public function __construct(UserRepository $userRepository, TRXService $TrxService)
    {
        $this->setRepository($userRepository);
        $this->_trxService = $TrxService;
    }

    public function requestDeposit()
    {
        return view('frontend.wallet.deposit');
    }

    public function postCheckDeposit()
    {
        try {
            $listTransaction = $this->_trxService->getListTransactions();
            $userId = frontendCurrentUser()->user_id; // = user id dang login thi moi cong them vao bang deposit
            $currency = "USDT";

            $listTransaction2 = [];
            foreach ($listTransaction as $tran) {
                $tranId = arrayGet($tran, 'transaction_id');
                $depositEntity = Deposit::delFlagOn()->where('message', $tranId)->first();
                if ($depositEntity) {
                    continue;
                }
                array_push($listTransaction2, $tran);
            }

            $listTransaction3 = [];
            foreach ($listTransaction2 as $tran2) {
                $hash2 = arrayGet($tran2, 'transaction_id');
                $result2 = callApi("https://apilist.tronscan.org/api/transaction-info?hash=$hash2");
                if ($userId != arrayGet($result2, 'data')) {
                    continue;
                }
                array_push($listTransaction3, $tran2);
            }

            if (empty($listTransaction) || empty($listTransaction2) || empty($listTransaction3)) {
                DB::rollBack();
                return redirect()->back()->with('notification_error', 'No transaction exists');
            }

            foreach ($listTransaction3 as $tran3) {
                DB::beginTransaction();
                $amount = arrayGet($tran3, 'value') / 1000000;
                try {
                    // insert db
                    $deposit = new Deposit();
                    $deposit->user_id = $userId;
                    $deposit->from = $userId;
                    $deposit->currency = $currency;
                    $deposit->message = arrayGet($tran3, 'transaction_id');
                    $deposit->number = $amount;
                    $deposit->save();

                    // call api
                    $hash = md5($userId . $amount . "W36CvhErO1YR8vGd");
                    $apiDeposit = "https://login.nuxgame.com/api/stat/make_deposit?company_id=a37c5f23-7181-44cb-9702-35886ef7b696&user_id=$userId&amount=$amount&hash=$hash";
                    $r1 = callApi($apiDeposit);
                    if (arrayGet($r1, 'status')) {
                        DB::commit(); // all good
                        return backSystemSuccess();
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
        $listAffiliates = $this->getRepository()->getListForTransfer(frontendCurrentUserId());

        $viewData = [
            'listAffiliates' => $listAffiliates
        ];

        return view('frontend.wallet.transfer', $viewData);
    }

    public function postTransfer()
    {
        DB::beginTransaction();
        try {
            $params = request()->all();

            /** @var \App\Validators\UserValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->frontendValidateDeposit($params);

            if (!$isValid) {
                $this->setFormData($params);
                return redirect()->back()->withErrors($validator->errors())->withInput($params);
            }

            $this->_storeDepositTable($params);
            $this->_storeWithdrawTable($params);

            $amount = arrayGet($params, 'number');
            $userId = frontendCurrentUser()->user_id;
            $hash = md5($userId . $amount . "W36CvhErO1YR8vGd");

            $apiDeposit = "https://login.nuxgame.com/api/stat/make_deposit?company_id=a37c5f23-7181-44cb-9702-35886ef7b696&user_id=$userId&amount=$amount&hash=$hash";
            $apiWithdrawal = "https://login.nuxgame.com/api/stat/make_withdrawal?company_id=a37c5f23-7181-44cb-9702-35886ef7b696&user_id=$userId&amount=$amount&hash=$hash";

            $r1 = callApi($apiDeposit);
            $r2 = callApi($apiWithdrawal);

            if (arrayGet($r1, 'status') && arrayGet($r2, 'status')) {
                DB::commit(); // all good
                return backSystemSuccess();
            }
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
        $max = 2000;
        $balance = getBalanceRealtime();
        $maxAmount = $max > $balance ? $balance : $max;

        $viewData = [
            'maxAmount' => $maxAmount
        ];

        return view('frontend.wallet.withdrawal', $viewData);
    }

    public function postWithdrawal()
    {
        DB::beginTransaction();
        try {
            $params = request()->all();
            $number = (int)request('number');
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

            // store withdraw
            $transfer = $this->_trxService->transfer(arrayGet($params, 'address'), $number);
            if ($transfer == 1) {
                return redirect()->back()->with('notification_error', 'Sorry. The system is busy. Please try again later');
            }

            // call api withdraw
            $amount = 101.5 * $number / 100;
            $hash = md5($userId . $amount . "W36CvhErO1YR8vGd");

            $apiWithdrawal = "https://login.nuxgame.com/api/stat/make_withdrawal?company_id=a37c5f23-7181-44cb-9702-35886ef7b696&user_id=$userId&amount=$amount&hash=$hash";
            $r = callApi($apiWithdrawal);

            if (!arrayGet($r, 'status')) {
                return redirect()->back()->with('notification_error', 'Failure. Please check your balance again and try again later.');
            }

            $hash = arrayGet($transfer, 'txid');
            $userId = frontendCurrentUser()->user_id;
            $dataWithdraw = [
                'user_id' => $userId,
                'to' => $userId,
                'currency' => 'USDT',
                'message' => $hash,
                'number' => $number,
            ];
            $obj = new Withdraw();
            $obj->fill($dataWithdraw);
            $obj->save();

            $userIdAdmin = getConfig('user_id-admin');

            // store withdraw fee
            $dataWithdraw2 = [
                'user_id' => $userId,
                'to' => $userIdAdmin,
                'currency' => 'USDT',
                'message' => 'Withdrawal fee',
                'number' => $number  * 1.5 / 100
            ];
            $obj2 = new Withdraw();
            $obj2->fill($dataWithdraw2);
            $obj2->save();

            // store deposit fee
            $dataDeposit = [
                'user_id' => $userIdAdmin,
                'from' => $userId,
                'currency' => 'USDT',
                'message' => 'Withdrawal fee',
                'number' => $number * 1.5 / 100
            ];
            $obj3 = new Deposit();
            $obj3->fill($dataDeposit);
            $obj3->save();

            DB::commit();
            return backSystemSuccess();
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }

        return backSystemError();
    }

    /* ========== FUNCTION PROTECTED AREA ========== */
    /**
     * @param $params
     * Store withdraw table when transfer success
     */
    protected function _storeWithdrawTable($params)
    {
        $withDrawEntity = new Withdraw();
        $paramStoreWithdraw = [
            'user_id' => frontendCurrentUser()->user_id,
            'to' => arrayGet($params, 'user_id'),
            'message' => arrayGet($params, 'message'),
            'number' => arrayGet($params, 'number'),
            'currency' => 'USDT',
        ];
        $withDrawEntity->fill($paramStoreWithdraw);
        $withDrawEntity->save();
    }

    /**
     * @param $params
     * Store deposit table when transfer success
     */
    protected function _storeDepositTable($params)
    {
        $depositEntity = new Deposit();
        $paramStoreDeposit = [
            'user_id' => arrayGet($params, 'user_id'),
            'from' => frontendCurrentUser()->user_id,
            'message' => arrayGet($params, 'message'),
            'number' => arrayGet($params, 'number'),
            'currency' => 'USDT',
        ];
        $depositEntity->fill($paramStoreDeposit);
        $depositEntity->save();
    }
}

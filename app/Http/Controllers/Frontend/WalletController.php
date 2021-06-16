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

            foreach ($listTransaction3 as $tran3) {
                DB::beginTransaction();
                $amount = arrayGet($tran3, 'value') / 1000000;
                try {
                    // insert db
                    $deposit = new Deposit();
                    $deposit->user_id = $userId;
                    $deposit->from = $userId;
                    $deposit->currency = $currency;
                    $deposit->message = $tranId;
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
        return view('frontend.wallet.history');
    }

    public function requestWithdrawal()
    {
        return view('frontend.wallet.withdrawal');
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
            'user_id' => frontendCurrentUserId(),
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
            'from' => frontendCurrentUserId(),
            'message' => arrayGet($params, 'message'),
            'number' => arrayGet($params, 'number'),
            'currency' => 'USDT',
        ];
        $depositEntity->fill($paramStoreDeposit);
        $depositEntity->save();
    }
}

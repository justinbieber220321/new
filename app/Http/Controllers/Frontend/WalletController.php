<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\Deposit;
use App\Model\Entities\Withdraw;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class WalletController extends FrontendController
{
    public function __construct(UserRepository $userRepository)
    {
        $this->setRepository($userRepository);
    }

    public function requestDeposit()
    {
        $listAffiliates = $this->getRepository()->getListForTransfer(frontendCurrentUserId());

        $viewData = [
            'listAffiliates' => $listAffiliates
        ];

        return view('frontend.wallet.deposit', $viewData);
    }

    public function postDeposit()
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

            // todo call api

            DB::commit(); // all good
            return backSystemSuccess();
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }

        return backSystemError();
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

    /* ========== FUNCTION PROTECTED AREA ========== */
    /**
     * @param $params
     * Store withdraw table when transfer success
     */
    protected function _storeWithdrawTable($params)
    {
        $withDrawEntity = new Withdraw();
        $paramStoreWithdraw  = [
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
        $paramStoreDeposit  = [
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

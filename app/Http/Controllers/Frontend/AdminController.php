<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;
use App\Model\Entities\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class AdminController extends FrontendController
{
    public function __construct()
    {
        if (frontendCurrentUser() && frontendCurrentUser()->user_id != 13608) {
            return backSystemError();
        }
    }

    public function setting()
    {
        return view('frontend.admin-setting.index');
    }

    public function postSetting()
    {
        try {
            $params = request()->all();

            $this->_replace('MAIL_DRIVER', arrayGet($params, 'mail_driver'));
            $this->_replace('MAIL_HOST', arrayGet($params, 'mail_host'));
            $this->_replace('MAIL_PORT', arrayGet($params, 'mail_port'));
            $this->_replace('MAIL_ENCRYPTION', arrayGet($params, 'mail_encryption'));
            $this->_replace('MAIL_USERNAME', arrayGet($params, 'mail_username'));
            $this->_replace('MAIL_PASSWORD', arrayGet($params, 'mail_password'));
            $this->_replace('MAIL_FROM_NAME', arrayGet($params, 'mail_from_name'));

            $this->_replace('TRX_ADDRESS_WITHDRAW', arrayGet($params, 'trx_address_withdraw'));
            $this->_replace('TRX_ADDRESS_DEPOSIT', arrayGet($params, 'trx_address_deposit'));
            $this->_replace('TRX_PRIMARY_KEY', arrayGet($params, 'trx_primary_key'));

            // Delete cache
            $this->_deleteCache();

            return backSystemSuccess();
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function deleteCache()
    {
        try {
            $this->_deleteCache();

            return redirect()->back()->with('notification_success', transMessage('success'));
        } catch (\Exception $exception) {
            logError($exception);
        }

        return backSystemError();
    }

    public function rewardSystem()
    {
        DB::beginTransaction();
        try {
            $dateTo = date('Y-m-d', strtotime('+1 day', time()));
            $date = date_create(date('Y-m-d'));
            date_sub($date, date_interval_create_from_date_string("365 days"));
            $past = date_format($date, "Y-m-d");
            $dataApi = callApi("https://login.nuxgame.com/api/stat/casino_report?company_id=a37c5f23-7181-44cb-9702-35886ef7b696&date_from=$past&date_to=$dateTo");

            foreach ($dataApi as $item) {
                $user = User::delFlagOn()->statusOn()->where('user_id', arrayGet($item, 'user_id'))->first();
                if (empty($user)) {
                    continue;
                }
                $user->number_bet_old_2 = $user->number_bet_old;
                $user->number_bet_old = arrayGet($item, 'turnover');
                $user->save();
            }

            $listUsers =  User::delFlagOn()->statusOn()->get();
            foreach ($listUsers as $item) {
                $item->team_bet_old_2 = $item->team_bet_old;
                $item->team_bet_old = getTeamBet($item);
                $item->save();
            }

            DB::commit();
            return backSystemSuccess();
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }

        return backSystemError();
    }

    protected function _replace($key, $value)
    {
        $oldValue = env($key);
        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key=". '\'' . $oldValue . '\'',  "$key=". '\'' . $value . '\'', file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                "$key=$oldValue",  "$key=". '\'' . $value . '\'', file_get_contents($path)
            ));
        }
    }

    protected function _deleteCache()
    {
        $commands = [
            'cache:clear',
            'config:clear',
            'route:clear',
            'view:clear',
        ];

        foreach ($commands as $command) {
            Artisan::call($command);
        }
    }
}
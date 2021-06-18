<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Base\FrontendController;
use Illuminate\Support\Facades\Artisan;

class AdminController extends FrontendController
{
    public function setting()
    {
        if (frontendCurrentUser()->user_id != 13608) {
            return redirect()->route(frontendRouterName('home'));
        }

        return view('frontend.admin-setting.index');
    }

    public function postSetting()
    {
        if (frontendCurrentUser()->user_id != 13608) {
            return backSystemError();
        }

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
        if (frontendCurrentUser()->user_id != 13608) {
            return backSystemError();
        }

        try {
            $this->_deleteCache();

            return redirect()->back()->with('notification_success', transMessage('success'));
        } catch (\Exception $exception) {
            logError($exception);
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
            'config:cache',
            'route:clear',
            'view:clear',
        ];

        foreach ($commands as $command) {
            Artisan::call($command);
        }
    }
}
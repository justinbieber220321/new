<?php

namespace App\Providers;

use App\Model\Entities\Deposit;
use App\Model\Entities\Withdraw;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider   extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->extend('frontend_check_password', function ($attribute, $value, $parameters) {
            return Hash::check($value, frontendCurrentUser()->password);
        });

        $this->app['validator']->extend('backend_check_password', function ($attribute, $value, $parameters) {
            return Hash::check($value, backendCurrentUser()->password);
        });

        $this->app['validator']->extend('limit_coin_number', function ($attribute, $value, $parameters) {
            $currency = arrayGet($parameters, '0');
            $balance = getBalance(frontendCurrentUserId(), $currency);
            return $balance >= $value;
        });

        // Validate the number to invest
        $this->app['validator']->extend('number_invest', function ($attribute, $value, $parameters) {
            $number = arrayGet($parameters, '0');
            $balance = getBalance(frontendCurrentUserId());
            return $balance >= $number && $number >= getConfig('min_invest_rps');
        });

        // Validate the number to deposit: 0 < number < balance
        $this->app['validator']->extend('number_deposit', function ($attribute, $value, $parameters) {
            $number = arrayGet($parameters, '0');

            $dateTo = date('Y-m-d', strtotime('+1 day', time()));
            $date = date_create(date('Y-m-d'));
            date_sub($date, date_interval_create_from_date_string("365 days"));
            $past = date_format($date, "Y-m-d");
            $endpoint = "https://login.nuxgame.com/api/stat/user_list?company_id=a37c5f23-7181-44cb-9702-35886ef7b696&date_from=$past&date_to=$dateTo";
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $endpoint);
            $dataApi = json_decode($response->getBody(), true);
            $dataUser = [];
            $email = frontendCurrentUser()->email;
            foreach ($dataApi as $item) {
                if (arrayGet($item, 'email') == $email) {
                    $dataUser = $item;
                    break;
                }
            }
            $balance = arrayGet($dataUser, 'balance', 0);

            return $balance >= $number && $number > 0;
        });
    }
}
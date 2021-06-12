<?php

namespace App\Services;

use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration;
use Coinbase\Wallet\Resource\Account;
use Coinbase\Wallet\Resource\Address;

class CoinService
{
    public $client;

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    public function __construct()
    {
        $apiKey = env('COINBASE_API_KEY');
        $apiSecret = env('COINBASE_API_SECRET');
        $configuration = Configuration::apiKey($apiKey, $apiSecret);
        $client = Client::create($configuration);
        $this->setClient($client);
    }

    public function getAccountById($id)
    {
        return $this->getClient()->getAccount($id);
    }

    public function getCurrentUser()
    {
        return $this->getClient()->getCurrentUser();
    }

    public function createNewBtcAccount()
    {
        $account = new Account([
            'name' => 'New Account'
        ]);
        return $this->getClient()->createAccount($account);
    }

    public function getAllAccounts()
    {
        return $this->getClient()->getAccounts();
    }

    public function getAddressBtc($account = '')
    {
        $account = empty($account) ? $this->getClient()->getPrimaryAccount() : $account;
        try {
            $addresses = $this->getClient()->getAccountAddresses($account);
            $addresses = arrayGet($addresses, 0);
            return $addresses->getAddress();
        } catch (\Exception $e) {
            logError($e);
        }
        return '';
    }

    public function createAccountAddress($email)
    {
        $account = $this->getClient()->getPrimaryAccount();
        $address = new Address([
            'name' => $email
        ]);
        $this->getClient()->createAccountAddress($account, $address);
        return $address->getAddress();
    }

    public function getAddress($currency)
    {
        $currency = strtoupper($currency);
        $accounts = $this->getClient()->getAccounts();
        $accountId = null;
        foreach ($accounts as $account) {
            if (strtoupper($account->getCurrency()) == $currency) {
                $accountId = $account->getId();
                break;
            }
        }
        if (is_null($accountId)) {
            return '';
        }

        $account = $this->getClient()->getAccount($accountId);
        $address = new Address([
            'name' => 'New Address'
        ]);

        $add = $this->getClient()->createAccountAddress($account, $address);
        $addressId = $this->getClient()->getAccountAddresses($account);
        $addresses = $this->getClient()->getAccountAddress($account, $addressId->getFirstId());
        $addo = json_encode($addresses->getAddress());
        $addoo = str_replace('"', "", $addo);

        return $addoo;
    }

    public function getSpotPrice($currency, $priceDefault = '')
    {
        try {
            $money = $this->getClient()->getSpotPrice($currency);
            return $money->getAmount();
        } catch (\Exception $e) {
            return $priceDefault;
        }
    }

    public function test()
    {
        $a = $this->getClient()->getAccounts();
        dd($a);
        return;
    }
}
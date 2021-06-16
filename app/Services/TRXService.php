<?php

namespace App\Services;

class TRXService
{
    private $tron;

    public function __construct()
    {
        $fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
        $solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
        $eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');

        try {
            $this->tron = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
        } catch (\IEXBase\TronAPI\Exception\TronException $e) {
            exit($e->getMessage());
        }
        $this->tron->setAddress(env('TRX_ADDRESS_WITHDRAW'));
        $this->tron->setPrivateKey(env('TRX_PRIMARY_KEY'));
    }

    public function getBalanceUSDT()
    {
        // Tether USDT https://tronscan.org/#/token20/TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t
        $contract = $this->tron->contract('TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');
        $data = $contract->getTransactions(env('TRX_ADDRESS_DEPOSIT'));
        $d = $contract->getTransaction('f669327feee3364696d8328f76c825da18251b676b3ed7472d34908f67adbe72');
        return $data;
//        return $contract->balanceOf();
    }

    public function getListTransactions()
    {
        $contract = $this->tron->contract('TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');
        $result = $contract->getTransactions(env('TRX_ADDRESS_DEPOSIT'));
        return arrayGet($result, 'data', []);
    }


    public function getTransaction($TxId)
    {
        return $this->tron->getTransaction($TxId);
    }

    public function getBalance()
    {
        return $this->tron->getBalance(null, true);
    }

    public function getHistory()
    {
        return 1;
    }

    public function transfer($address)
    {
        // Tether USDT https://tronscan.org/#/token20/TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t
        $contract = $this->tron->contract('TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');
        $r = $contract->transfer($address, 0.0001, null);
        return $r;
    }
}
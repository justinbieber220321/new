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
        return $contract->balanceOf();
    }

    public function getListTransactions()
    {
        $contract = $this->tron->contract('TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');
        $result = $contract->getTransactions(env('TRX_ADDRESS_DEPOSIT'));
        return arrayGet($result, 'data', []);
    }

    public function getListTransactionsbyAddress($address)
    {
        $contract = $this->tron->contract('TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');
        $result = $contract->getTransactions($address);
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

    public function transfer($address, $amount = 0.0001)
    {
        $balanceOwner = $this->getBalanceUSDT();
        if ($balanceOwner <= $amount) {
            return 1;
        }
        // Tether USDT https://tronscan.org/#/token20/TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t
        $contract = $this->tron->contract('TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');
        $r = $contract->transfer($address, $amount, null);
        return $r;
    }

    public function getListAddress()
    {
        return $this->tron->generateAddress();
    }

    public function getBalanceByA($address, $private){

        $fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
        $solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
        $eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');

        try {
            $trn = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
        } catch (\IEXBase\TronAPI\Exception\TronException $e) {
            exit($e->getMessage());
        }
        $trn->setAddress($address);
        $trn->setPrivateKey($private);
        $contract = $trn->contract('TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');
        return $contract->balanceOf();

    }

    public function sendToDEP($address, $private){

        $fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
        $solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
        $eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');

        try {
            $trn = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
        } catch (\IEXBase\TronAPI\Exception\TronException $e) {
            exit($e->getMessage());
        }
        $trn->setAddress($address);
        $trn->setPrivateKey($private);
        $contract = $trn->contract('TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');
        $balance = $contract->balanceOf();
        $contracts = $trn->contract('TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');
        $r = $contracts->transfer(env('TRX_ADDRESS_DEPOSIT'), $balance, null);
    }

    public function feeTRX($address){
        return $this->tron->send( $address, 8);
    }


}


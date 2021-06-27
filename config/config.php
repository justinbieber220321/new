<?php

return [
    // Config common
    'del_flag' => [
        'active' => 0,
        'disable' => 1,
    ],

    'status' => [
        'active' => 0,
        'disable' => 1,
    ],

    'status_alias' => [
        'active' => "Active",
        'disable' => "Block",
    ],

    'gender' => [
        'boy' => 1,
        'girl' => 2,
    ],

    'gender_alias' => [
        'girl' => 'Female',
        'boy' => 'Male',
    ],

    'pagination' => [
        'backend' => 20,
        'frontend' => 10,
    ],

    'key_form_data_old' => '_formDataOld',
    'parent_id_default' => 0,
    'category_level_default' => 1,

    'system' => [
        // system
        'SITE_NAME' => env('SITE_NAME'),
        'SITE_PHONE' => env('SITE_PHONE'),
        'SITE_FAVICON' => env('SITE_FAVICON'),
        'SITE_LOGO' => env('SITE_LOGO'),
        'SITE_TITLE' => env('SITE_TITLE'),
        'META_TITLE' => env('META_TITLE'),
        'META_DESCRIPTION' => env('META_DESCRIPTION'),
        'LOGIN_CONFIRM_OTP' => env('LOGIN_CONFIRM_OTP', 1),
        'RATE_RPS' => env('RATE_RPS', 1),

        // send mail
        'MAIL_DRIVER' => env('MAIL_DRIVER'),
        'MAIL_HOST' => env('MAIL_HOST'),
        'MAIL_PORT' => env('MAIL_PORT'),
        'MAIL_USERNAME' => env('MAIL_USERNAME'),
        'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
        'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
        'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
        'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
    ],

    'lang' => ['vn', 'jp', 'en'],
    'otp-login' => ['on' => 1, 'off' => 2],
    'key_encode' => 'Acb@123456!#$',
    'time_limit_otp_code' => 2, // minutes
    'package' => [
        '6m' => ['type' => 6, 'name' => '6m'], // m: month
        '9m' => ['type' => 9, 'name' => '9m'],
        '12m' => ['type' => 12, 'name' => '12m'],
        '18m' => ['type' => 18, 'name' => '18m'],
        '24m' => ['type' => 24, 'name' => '24m'],
        '36m' => ['type' => 36, 'name' => '36m']
    ],

    'user_id_default' => 1,
    'currency_default' => "USDT",
    'min_invest_rps' => 500,
    'rate_invest_level_1' => 0.08,
    'rate_invest_level_2' => 0.03,
    'rate_invest_level_3' => 0.03,

    // BACKEND AREA

    // FRONTEND AREA
    'user' => [
        'status' => [
            'active' => 1,
            'block' => 2,
            'waiting_active_email' => 3,
        ]
    ],
    'coin_base' => [
        'eth' => 'ETH',
        'xrp' => 'XRP',
        'btc' => 'BTC',
        'addressXrp' => env('COINBASE_XRP_ADDRESS'),
    ],
    'coin-deposit' => [
        1 => 'BTC',
        2 => 'ETH',
        3 => 'XTG',
        4 => 'RPS',
        5 => 'USDT',
    ],
    'coin-btc' => 1,
    'coin-etg' => 2,
    'coin-xrp' => 3,
    'coin-rps' => 4,
    'coin-usdt' => 5,

    'coin-default' => 'USDT',

    'user_id-admin' => 19455, // user.user_id
    'max-day-withdraw' => 1500,
    'withdraw-type' => [
        'transfer' => 1,
        'fee' => 2,
        'withdraw' => 3 // for hash
    ],
    'deposit-type' => [
        'transfer' => 1,
        'hash' => 3
    ],

    'deposit_type_default' => 1,
    'withdraw_type_default' => 1,

    'fee-withdraw' => 1,5,
    'coin_address_status_used' => 1,
    'coin_address_status_not_used' => 2,
];

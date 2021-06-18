<?php

Route::post('lang', ['as' => 'set-lang', 'uses' => 'Controller@setLang']);

// ========== FRONTEND AREA ==========
Route::group(['prefix'=>'/', 'as'=>'frontend.', 'namespace' => 'Frontend', 'middleware' => ['frontend-lang']], function(){
    Route::get('/login', ['as' => 'login.get', 'uses' => 'Auth\AuthController@showFormLogin']);
    Route::post('/login', ['as' => 'login.post', 'uses' => 'Auth\AuthController@postLogin']);
    Route::get('login/confirm-otp', ['as' => 'login.confirm-opt', 'uses' => 'Auth\AuthController@showFormLoginConfirmOtp']);
    Route::post('login/confirm-otp', ['as' => 'login.confirm-opt.post', 'uses' => 'Auth\AuthController@postLoginConfirmOtp']);

    Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

    Route::group(['middleware' => ['authFrontend']], function(){
        Route::get('/', ['as' => 'home', 'uses' => 'DashboardController@index'])->middleware('authFrontend');

        Route::get('account', ['as' => 'account', 'uses' => 'UserController@account']);
        Route::get('account/update', ['as' => 'account.update.get', 'uses' => 'UserController@getUpdateAccount']);
        Route::post('account/update', ['as' => 'account.update.post', 'uses' => 'UserController@updateAccount']);

        Route::get('deposit', ['as' => 'deposit', 'uses' => 'WalletController@requestDeposit']);
        Route::post('deposit', ['as' => 'check-deposit.post', 'uses' => 'WalletController@postCheckDeposit']);
        Route::get('transfer', ['as' => 'transfer', 'uses' => 'WalletController@walletTransfer']);
        Route::post('transfer', ['as' => 'transfer.post', 'uses' => 'WalletController@postTransfer']);
        Route::get('transfer/confirm', ['as' => 'transfer-confirm', 'uses' => 'WalletController@getTransferConfirm']);
        Route::post('transfer/confirm', ['as' => 'transfer-confirm.post', 'uses' => 'WalletController@postTransferConfirm']);
        Route::get('wallet-history', ['as' => 'wallet-history', 'uses' => 'WalletController@walletHistory']);
        Route::get('history-deposit', ['as' => 'wallet-history-deposit', 'uses' => 'WalletController@walletHistoryDeposit']);
        Route::get('history-withdraw', ['as' => 'wallet-history-withdraw', 'uses' => 'WalletController@walletHistoryWithdraw']);
        Route::get('withdrawal', ['as' => 'withdrawal', 'uses' => 'WalletController@requestWithdrawal']);
        Route::post('withdrawal', ['as' => 'request-withdrawal.post', 'uses' => 'WalletController@postWithdrawal']);
        Route::get('withdrawal/confirm', ['as' => 'withdrawal-confirm', 'uses' => 'WalletController@getWithdrawalConfirm']);
        Route::post('withdrawal/confirm', ['as' => 'withdrawal-confirm.post', 'uses' => 'WalletController@postWithdrawalConfirm']);

        Route::get('referrals', ['as' => 'referrals', 'uses' => 'MarketingSystemController@referrals']);
        Route::get('affiliate-tree/{userId?}', ['as' => 'affiliate-tree', 'uses' => 'MarketingSystemController@affiliateTree']);

//        Route::get('casino-report', ['as' => 'casino-report', 'uses' => 'CasinoHistoryController@getCasinoReport']);
//        Route::get('bet-history', ['as' => 'bet-history', 'uses' => 'CasinoHistoryController@getBetHistory']);

        Route::get('support', ['as' => 'support', 'uses' => 'FrontendController@support']);

        Route::get('admin-setting', ['as' => 'admin-setting', 'uses' => 'AdminController@setting']);
        Route::post('admin-setting', ['as' => 'admin-setting.post', 'uses' => 'AdminController@postSetting']);
        Route::post('delete-cache', ['as' => 'delete-cache', 'uses' => 'AdminController@deleteCache']);
    });
});



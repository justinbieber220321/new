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

        Route::get('request-deposit', ['as' => 'deposit', 'uses' => 'WalletController@requestDeposit']);
        Route::post('request-deposit', ['as' => 'check-deposit.post', 'uses' => 'WalletController@postCheckDeposit']);
        Route::get('wallet-transfer', ['as' => 'wallet-transfer', 'uses' => 'WalletController@walletTransfer']);
        Route::post('wallet-transfer', ['as' => 'transfer.post', 'uses' => 'WalletController@postTransfer']);
        Route::get('wallet-history', ['as' => 'wallet-history', 'uses' => 'WalletController@walletHistory']);
        Route::get('wallet-history-deposit', ['as' => 'wallet-history-deposit', 'uses' => 'WalletController@walletHistoryDeposit']);
        Route::get('wallet-history-withdraw', ['as' => 'wallet-history-withdraw', 'uses' => 'WalletController@walletHistoryWithdraw']);
        Route::get('request-withdrawal', ['as' => 'request-withdrawal', 'uses' => 'WalletController@requestWithdrawal']);
        Route::post('request-withdrawal', ['as' => 'request-withdrawal.post', 'uses' => 'WalletController@postWithdrawal']);

        Route::get('referrals', ['as' => 'referrals', 'uses' => 'MarketingSystemController@referrals']);
        Route::get('affiliate-tree', ['as' => 'affiliate-tree', 'uses' => 'MarketingSystemController@affiliateTree']);

        Route::get('support', ['as' => 'support', 'uses' => 'FrontendController@support']);
    });
});



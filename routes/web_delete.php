<?php

Route::post('lang', ['as' => 'set-lang', 'uses' => 'Controller@setLang']);

// ========== FRONTEND AREA ==========
Route::group(['prefix'=>'/', 'as'=>'frontend.', 'namespace' => 'Frontend', 'middleware' => ['frontend-lang']], function(){
    Route::get('/', ['as' => 'home', 'uses' => 'DashboardController@index'])->middleware('authFrontend');
    Route::get('/login', ['as' => 'login.get', 'uses' => 'Auth\AuthController@showFormLogin']);
    Route::post('/login', ['as' => 'login.post', 'uses' => 'Auth\AuthController@postLogin']);
    Route::get('login/confirm-otp', ['as' => 'login.confirm-opt', 'uses' => 'Auth\AuthController@showFormLoginConfirmOtp']);
    Route::post('login/confirm-otp', ['as' => 'login.confirm-opt.post', 'uses' => 'Auth\AuthController@postLoginConfirmOtp']);
    Route::get('/register', ['as' => 'register.get', 'uses' => 'Auth\AuthController@showFormRegister']);
    Route::post('/register', ['as' => 'register.post', 'uses' => 'Auth\AuthController@postRegister']);
    Route::get('/register/success', ['as' => 'register.success', 'uses' => 'Auth\AuthController@showFormRegisterSuccess']);
    Route::get('register/confirm-email/{id}', ['as' => 'register.confirm-active-email', 'uses' => 'Auth\AuthController@getConfirmEmail']);
    Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
    Route::get('/forgot-password', ['as' => 'forgot-password', 'uses' => 'Auth\AuthController@getForgotPassword']);
    Route::post('/forgot-password', ['as' => 'forgot-password.post', 'uses' => 'Auth\AuthController@postForgotPassword']);
    Route::get('password/recovery', ['as' => 'get.password.recovery', 'uses' => 'Auth\AuthController@getPasswordRecover']);
    Route::post('password/recovery', ['as' => 'post.password.recovery', 'uses' => 'Auth\AuthController@postPasswordRecover']);

    Route::group(['prefix'=>'/', 'middleware' => ['authFrontend']], function(){
        Route::get('account', ['as' => 'account', 'uses' => 'UserController@account']);
        Route::get('account/update', ['as' => 'account.update.get', 'uses' => 'UserController@getUpdateAccount']);
        Route::post('account/update', ['as' => 'account.update.post', 'uses' => 'UserController@updateAccount']);
        Route::get('account/update-avatar', ['as' => 'account.update-avatar.get', 'uses' => 'UserController@getUpdateAvatar']);
        Route::post('account/update-avatar', ['as' => 'account.update-avatar.post', 'uses' => 'UserController@postUpdateAvatar']);
        Route::get('account/update-password', ['as' => 'account.update-password.get', 'uses' => 'UserController@getUpdatePassword']);
        Route::post('account/update-password', ['as' => 'account.update-password.post', 'uses' => 'UserController@postUpdatePassword']);
        Route::get('affiliate/{id?}', ['as' => 'affiliate', 'uses' => 'UserController@getAffiliate']);

        Route::get('transfer', ['as' => 'transfer', 'uses' => 'TransferController@getTransfer']);
        Route::post('transfer', ['as' => 'transfer.post', 'uses' => 'TransferController@postTransfer']);
        Route::get('transfer/confirm', ['as' => 'transfer.confirm', 'uses' => 'TransferController@getTransferConfirm']);
        Route::post('transfer/confirm', ['as' => 'transfer.confirm.post', 'uses' => 'TransferController@postTransferConfirm']);
        Route::get('transfer/success', ['as' => 'transfer.success', 'uses' => 'TransferController@getTransferSuccess']);
        Route::get('transfer/history-deposit', ['as' => 'transfer.history-deposit', 'uses' => 'TransferController@getHistoryDeposit']);
        Route::get('transfer/history-withdraw', ['as' => 'transfer.history-withdraw', 'uses' => 'TransferController@getHistoryWithdraw']);
        Route::get('deposit', ['as' => 'deposit', 'uses' => 'WalletController@getDeposit']);
        Route::post('deposit', ['as' => 'deposit-transaction.post', 'uses' => 'WalletController@getDepositTransaction']);
        Route::get('my-invest', ['as' => 'my-invest', 'uses' => 'InvestController@getMyInvest']);
        Route::get('make-invest', ['as' => 'make-invest', 'uses' => 'InvestController@getMakeMyInvest']);
        Route::post('make-invest', ['as' => 'make-invest.post', 'uses' => 'InvestController@postMakeMyInvest']);
    });

    Route::get('post', ['as' => 'post', 'uses' => 'PostController@index']);
    Route::get('post/{id}', ['as' => 'post.show', 'uses' => 'PostController@show']);
});

// ========== BACKEND AREA ==========
Route::group(['prefix'=>'ad-admin/', 'as'=>'backend.',  'namespace' => 'Backend'], function(){
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@showFormLogin']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\AuthController@postLogin']);
    Route::get('forgot-password', ['as' => 'forgot-password', 'uses' => 'Auth\AuthController@forgotPassword']);
    Route::post('forgot-password', ['as' => 'forgot-password.post', 'uses' => 'Auth\AuthController@postForgotPassword']);
    Route::get('recovery-password', ['as' => 'recovery-password', 'uses' => 'Auth\AuthController@getRecoveryPassword']);
    Route::post('recovery-password', ['as' => 'recovery-password.post', 'uses' => 'Auth\AuthController@postRecoveryPassword']);
});

Route::group(['prefix'=>'ad-admin/', 'as'=>'backend.', 'namespace' => 'Backend', 'middleware' => ['authBackend']], function(){
    Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

    Route::post('delete-cache', ['as' => 'delete-cache', 'uses' => 'BackendController@deleteCache']);
    Route::get('otp-login', ['as' => 'otp-login', 'uses' => 'BackendController@getOtpLogin']);
    Route::post('otp-login', ['as' => 'otp-login.post', 'uses' => 'BackendController@postOtpLogin']);
    Route::get('/setting-system', ['as' => 'setting-system', 'uses' => 'BackendController@settingSystem']);
    Route::post('/setting-system', ['as' => 'setting-system.post', 'uses' => 'BackendController@postSettingSystem']);
    Route::get('/setting-send-mail', ['as' => 'setting-send-mail', 'uses' => 'BackendController@settingSendMail']);
    Route::post('/setting-send-mail', ['as' => 'setting-send-mail.post', 'uses' => 'BackendController@postSettingSendMail']);
    Route::get('/test-send-mail', ['as' => 'test-send-mail', 'uses' => 'BackendController@getTestSendMail']);
    Route::post('/test-send-mail', ['as' => 'test-send-mail.post', 'uses' => 'BackendController@postTestSendMail']);

    // ========== Module Admin/Profile ==========
    Route::get('account/', ['as' => 'account', 'uses' => 'AdminController@show']);
    Route::group(['prefix'=>'account/', 'as'=>'account.'], function(){
        Route::get('update', ['as' => 'update.get', 'uses' => 'AdminController@getUpdateAccount']);
        Route::post('update', ['as' => 'update.post', 'uses' => 'AdminController@updateAccount']);
        Route::get('change-avatar', ['as' => 'update-avatar.get', 'uses' => 'AdminController@getUpdateAvatar']);
        Route::post('change-avatar', ['as' => 'update-avatar.post', 'uses' => 'AdminController@postUpdateAvatar']);
        Route::get('change-password', ['as' => 'update-password.get', 'uses' => 'AdminController@getUpdatePassword']);
        Route::post('change-password', ['as' => 'update-password.post', 'uses' => 'AdminController@postUpdatePassword']);
    });

    // ========== Module Admin ==========
    Route::group(['prefix'=>'admin/', 'as'=>'admin.'], function(){
        Route::get('/change-password', ['as' => 'change-password', 'uses' => 'AdminController@showFormChangePassword']);
        Route::post('/change-password', ['as' => 'change-password.post', 'uses' => 'AdminController@postChangePassword']);

        // @todo
        // Route::get('/update-avatar', ['as' => 'update-avatar', 'uses' => 'AdminController@updateAvatar']);
        // Route::post('/update-avatar', ['as' => 'change-password.post', 'uses' => 'AdminController@postUpdateAvatar']);
    });

    // ========== Module User ==========
    Route::group(['prefix'=>'user/', 'as'=>'user.'], function(){
        Route::get('/', ['as' => 'list', 'uses' => 'UserController@index']);
        Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'UserController@edit']);
        Route::post('/{id}', ['as' => 'update', 'uses' => 'UserController@update']);
        Route::delete('/{id}', ['as' => 'destroy', 'uses' => 'UserController@destroy']);
        Route::get('/change-password/{id}', ['as' => 'change-password', 'uses' => 'UserController@changePassword']);
        Route::post('/change-password/{id}', ['as' => 'change-password.post', 'uses' => 'UserController@postChangePassword']);
    });

    // ========== Module User ==========
    Route::group(['prefix'=>'category/', 'as'=>'category.'], function(){
        Route::get('/', ['as' => 'list', 'uses' => 'CategoryController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'CategoryController@create']);
        Route::post('/store', ['as' => 'store', 'uses' => 'CategoryController@store']);
        Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'CategoryController@edit']);
        Route::post('/{id}', ['as' => 'update', 'uses' => 'CategoryController@update']);
        Route::delete('/{id}', ['as' => 'destroy', 'uses' => 'CategoryController@destroy']);
        Route::get('test/{id}', ['as' => 'test', 'uses' => 'CategoryController@test']);
    });

    Route::group(['prefix'=>'post/', 'as'=>'post.'], function(){
        Route::get('/', ['as' => 'list', 'uses' => 'PostController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'PostController@create']);
        Route::post('/store', ['as' => 'store', 'uses' => 'PostController@store']);
        Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'PostController@edit']);
        Route::post('/{id}', ['as' => 'update', 'uses' => 'PostController@update']);
        Route::delete('/{id}', ['as' => 'destroy', 'uses' => 'PostController@destroy']);
    });
});
// ========== END BACKEND AREA ==========



<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {
    Route::group(['middleware' => ['auth:api', 'XssSanitizer', 'throttle:100,1']], function () {
        // Permissions
        Route::apiResource('permissions', 'PermissionsApiController');

        // Roles
        Route::apiResource('roles', 'RolesApiController');

        // Users
        Route::apiResource('users', 'UsersApiController');

        // Regionals
        Route::apiResource('regionals', 'RegionalApiController');

        // Witels
        Route::apiResource('witels', 'WitelApiController');

        // Notels
        Route::get('notels', 'NotelsApiController@index')->name('notels');

        // Detail Provisioning
        Route::apiResource('detail-provisioning', 'DetailProvisioningApiController');
    });
    // Tagihan
    Route::apiResource('tagihan', 'TagihanApiController')->middleware(['XssSanitizer']);

    // ODP
    Route::apiResource('odpmaster', 'OdpApiController')->middleware(['XssSanitizer']);

    // SVM
    Route::apiResource('checksvm', 'SvmApiController')->middleware(['XssSanitizer']);

    // Cek HVC
    Route::apiResource('checksegmenhvc', 'CekHvcApiController')->middleware(['XssSanitizer']);
    // Route::apiResource('tagihan','TagihanApiController')->middleware(['checkIp']);
});

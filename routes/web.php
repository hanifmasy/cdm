<?php

Route::redirect('/', '/epic/login');
Route::get('/dashboard', function () {
    if (session('status')) {
        return redirect()->route('admin.dashboard')->with('status', session('status'));
    }

    return redirect()->route('admin.dashboard');
});

Auth::routes(['middleware' => ['XssSanitizer','throttle:30,1']]);
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth','XssSanitizer','throttle:100,1']], function () {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Pra NPC
    Route::get('pra-npc','EpicController@pra_npc')->name('pra_npc');
    Route::get('pra-npc/detail','EpicController@pra_npc_detail')->name('pra_npc_detail');
    Route::post('pra-npc/detail/download','EpicController@pra_npc_detail_download')->name('pra_npc_detail_download');
    // Pra Pra NPC
    Route::get('pra-pra-npc','EpicController@pra_pra_npc')->name('pra_pra_npc');
    Route::get('pra-pra-npc/detail','EpicController@pra_pra_npc_detail')->name('pra_pra_npc_detail');
    Route::post('pra-pra-npc/detail/download','EpicController@pra_pra_npc_detail_download')->name('pra_pra_npc_detail_download');


});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});

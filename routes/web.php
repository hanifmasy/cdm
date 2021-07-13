<?php

Route::redirect('/', '/cdm/login');
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

    // Regionals
    Route::delete('regionals/destroy', 'RegionalController@massDestroy')->name('regionals.massDestroy');
    Route::post('regionals/parse-csv-import', 'RegionalController@parseCsvImport')->name('regionals.parseCsvImport');
    Route::post('regionals/process-csv-import', 'RegionalController@processCsvImport')->name('regionals.processCsvImport');
    Route::resource('regionals', 'RegionalController');

    // Target Addon
    Route::delete('targetAddon/destroy', 'TargetAddonController@massDestroy')->name('targetAddon.massDestroy');
    Route::post('targetAddon/parse-csv-import', 'TargetAddonController@parseCsvImport')->name('targetAddon.parseCsvImport');
    Route::post('targetAddon/process-csv-import', 'TargetAddonController@processCsvImport')->name('targetAddon.processCsvImport');
    Route::resource('targetAddon', 'TargetAddonController');

    // Master Data TREG6
    Route::resource('masterData', 'MasterDataController');
    Route::post('masterData/show', 'MasterDataController@show')->name('masterData.account');
    Route::get('customer/assets', 'MasterDataController@assets')->name('customer.assets');
    Route::get('customer/history-provisioning', 'MasterDataController@histProvisioning')->name('customer.histProvisioning');

    // Pelanggan Normal
    Route::get('ticket-normal', 'TicketController@ticketNormal')->name('ticket.normal');
    Route::get('order-normal', 'OrderController@orderNormal')->name('order.normal');

    // Pelanggan Abnormal
    Route::get('ticket-abnormal', 'TicketController@ticketAbnormal')->name('ticket.abnormal');
    Route::get('order-abnormal', 'OrderController@orderAbnormal')->name('order.abnormal');

    // Lokasi Pelanggan
    Route::get('customer-location', 'LocationController@index')->name('location.customer');
    Route::get('customer-location-dapros', 'LocationController@dapros')->name('location.customerDapros');

    // Prospect
    Route::get('prospect', 'ProspectController@index')->name('prospect.index');
    Route::get('prospect/getWitel', 'ProspectController@getWitel')->name('prospect.getwitel');
    Route::get('prospect/getIndihome', 'ProspectController@getIndihome')->name('prospect.getindihome');
    Route::get('prospect/getResult', 'ProspectController@getResult')->name('prospect.getresult');
    Route::get('prospect/getexcel', 'ProspectController@downloadexcel')->name('prospect.getexcel');

    // Performansi Addon -> All
    Route::resource('performAddon', 'PerformansiAddonController');

    // Performansi Addon -> Kaubis
    Route::resource('performKaubis', 'PerformansiKaubisController');

    // Performansi Addon -> STO 
    Route::resource('performSto', 'PerformansiStoController');

    // Performansi -> Reward Kaubis
    Route::resource('rewardKaubis', 'RewardKaubisController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Witels
    Route::delete('witels/destroy', 'WitelController@massDestroy')->name('witels.massDestroy');
    Route::post('witels/parse-csv-import', 'WitelController@parseCsvImport')->name('witels.parseCsvImport');
    Route::post('witels/process-csv-import', 'WitelController@processCsvImport')->name('witels.processCsvImport');
    Route::resource('witels', 'WitelController');

    // Prorata Sales Churns
    Route::resource('prorata-sales-churns', 'ProrataSalesChurnController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);
    
    //Minipack
    Route::resource('minipack', 'MinipackController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);
    
    //Stb
    Route::resource('stb', 'StbController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);
    
    //Upgrade
    Route::resource('upgrade', 'UpgradeController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);
    
    //Migrasi 1P - 2P
    Route::resource('mighwp2', 'Mighwp2Controller', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);
    
    //Migrasi 2P - 3P
    Route::resource('mighwp3', 'Mighwp3Controller', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Reporting Customer
    Route::get('reporting/arpu', 'ReportingCustomerController@arpu')->name('reporting.arpu');
    Route::get('reporting/mig2p3p', 'ReportingCustomerController@mig2p3p')->name('reporting.mig2p3p');
    Route::get('reporting/speed', 'ReportingCustomerController@speed')->name('reporting.speed');
    Route::get('reporting/speed/detail/{datel}/{speed_pcrf}','ReportingCustomerController@speed_detail')->name('reporting.speed_detail');
    Route::get('reporting/pscabut', 'ReportingCustomerController@pscabut')->name('reporting.pscabut');
    Route::get('reporting/performaddon', 'ReportingCustomerController@performaddon')->name('reporting.performaddon');
    Route::get('reporting/sfgopro', 'ReportingCustomerController@sfgopro')->name('reporting.sfgopro');
    Route::get('reporting/show/sfgopro/{witel}/{channel}/{addon}/{dapros}', 'ReportingCustomerController@show_sfgopro')->name('reporting.show_sfgopro');
    Route::get('reporting/download-sfgopro/{witel}/{channel}/{addon}/{dapros}', 'ReportingCustomerController@download_sfgopro')->name('reporting.download_sfgopro');
    Route::get('reporting/achaddon', 'ReportingCustomerController@achaddon')->name('reporting.achaddon');
    Route::get('reporting/plasa', 'ReportingCustomerController@plasa')->name('reporting.plasa');
    Route::get('reporting/ct0', 'ReportingCustomerController@ct0')->name('reporting.ct0');

    // Performance
    Route::get('performance/addon', 'PerformanceController@addon')->name('performance.addon');
    Route::get('performance/racing_mic', 'PerformanceController@racing_mic')->name('performance.racing_mic');
    Route::get('performance/show/racing_mic/{blnpsb}/{witel}/{svm}', 'PerformanceController@show_mic')->name('performance.show_mic');
    Route::get('performance/download-racingsvm/{blnpsb}/{witel}/{svm}', 'PerformanceController@downloadRacingSvm')->name('performance.downloadRacingsvm');
    Route::get('performance/provisioning', 'PerformanceController@provisioning')->name('performance.provisioning');
    Route::get('performance/show/provisioning/{addon}/{segmen}/{witel}/{status}', 'PerformanceController@show_provisioning')->name('performance.show_provisioning');
    Route::post('performance/provisioning/search', 'PerformanceController@searchProvisioning')->name('performance.searchProvisioning');
    Route::get('performance/download-provisioning/{addon}/{segmen}/{witel}/{status}', 'PerformanceController@downloadProvisioning')->name('performance.downloadProvisioning');

    Route::get('performance/provisioning/plasa', 'PerformanceController@provisioning_plasa')->name('performance.provisioning_plasa');
    Route::get('performance/show/provisioning/plasa/{order}/{periode}/{witel}/{status}', 'PerformanceController@show_provisioning_plasa')->name('performance.show_provisioning_plasa');
    Route::post('performance/provisioning/plasa/search', 'PerformanceController@search_provisioning_plasa')->name('performance.search_provisioning_plasa');
    Route::get('performance/download-provisioning-plasa/{order}/{periode}/{witel}/{status}', 'PerformanceController@download_provisioning_plasa')->name('performance.download_provisioning_plasa');

    Route::get('performance/plasa/rekapwitel', 'PerformanceController@plasa_rekapwitel')->name('performance.plasa_rekapwitel');
    Route::get('performance/plasa/rekap/{periode}/{witel}/{plasa}', 'PerformanceController@plasa_rekap')->name('performance.plasa_rekap');
    Route::get('performance/plasa/rekap/detail/{periode}/{witel}/{plasa}/{addon}', 'PerformanceController@plasa_rekapdetail')->name('performance.plasa_rekapdetail');
    Route::get('performance/plasa/rekap/csr/{periode}/{witel}/{plasa}/{addon}/{csr}', 'PerformanceController@plasa_rekapcsr')->name('performance.plasa_rekapcsr');

    Route::get('performance/plasa/download-rekap/{periode}/{witel}/{plasa}', 'PerformanceController@plasa_downloadRekap')->name('performance.plasa_downloadRekap');
    Route::get('performance/plasa/download-rekap/detail/{periode}/{witel}/{plasa}/{addon}', 'PerformanceController@plasa_downloadRekapdetail')->name('performance.plasa_downloadRekapdetail');
    Route::get('performance/plasa/download-rekap/csr/{periode}/{witel}/{plasa}/{addon}/{csr}', 'PerformanceController@plasa_downloadRekapcsr')->name('performance.plasa_downloadRekapcsr');
    
    Route::get('performance/ped', 'PerformanceController@ped')->name('performance.ped');
    Route::get('performance/ped/show', 'PerformanceController@show_ped')->name('performance.show_ped');
    Route::get('performance/ped/download-ped', 'PerformanceController@download_ped')->name('performance.download_ped');
    
    Route::get('performance/pda', 'PerformanceController@pda')->name('performance.pda');
    Route::get('performance/pda/show', 'PerformanceController@show_pda')->name('performance.show_pda');
    Route::get('performance/pda/download-pda', 'PerformanceController@download_pda')->name('performance.download_pda');

    //Dapros CRM
    Route::get('caring-ct0','DaprosCrmController@index')->name('caring-ct0.index');
    Route::get('edukasi-pelanggan','DaprosCrmController@edukasi')->name('edukasi-pelanggan.edukasi');
    Route::post('download-edukasi','DaprosCrmController@downloadEdukasi')->name('edukasi-pelanggan.downloadEdukasi');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});

<?php

Route::group(['namespace' => 'Admin','middleware'=>['auth','admin'],'prefix'=>'admin','as'=>'admin.'], function () {
    Route::get ('/', 'HomeController@index')->name ('home');        
    Route::get ('test', 'TestController@index');
    Route::get ('masterimport', 'MasterImportController@index');        
    Route::get ('orderimport', 'OrderItemImportController@index');   
    Route::get ('script', 'Test1Controller@index');        

    Route::resource('profile', 'UserController',['only' => ['edit','update']]);
    Route::post('user/changepassword/{id}', ['as' => 'user.changepassword','uses' => 'UserController@changePassword']);
    Route::patch('updatecompanyinfo/{id}', ['as' => 'updatecompanyinfo','uses' => 'UserController@updateCompanyINFO']);
    Route::post('storecompanyinfo', ['as' => 'storecompanyinfo','uses' => 'UserController@storeCompanyINFO']);

    Route::resource('items', 'ItemController',['except' => ['show']]);
    Route::get('items/openmodal', 'ItemController@openModal')->name('items.openmodal');
    Route::post('items/savemodal', 'ItemController@saveModal')->name('items.savemodal');

    Route::resource('item-marka', 'MarkaController',['except' => ['show']]);
    Route::get('item-marka/openmodal', 'MarkaController@openModal')->name('item-marka.openmodal');
    Route::post('item-marka/savemodal', 'MarkaController@saveModal')->name('item-marka.savemodal');
    Route::get('item-marka/getAll', 'MarkaController@getAll');
    Route::get('item-marka/{id}',['as' => 'item-marka','uses' => 'MarkaController@show']);

    Route::group(['middleware' => ['role']], function () {
        Route::get('admins/create', ['as' => 'admins.create','uses' => 'UserController@create']);
        Route::post('admins/store', ['as' => 'admins.store','uses' => 'UserController@store']);
        Route::get('admins', ['as' => 'admins','uses' => 'UserController@index']);
        Route::get('admins/edit/{id}', 'UserController@editAdmin')->name('admins.edit');
        Route::delete('admins/destroy/{id}', 'UserController@destroy')->name('admins.destroy');
        Route::patch('admins/update/{id}', 'UserController@updateAdmin')->name('admins.update');
        
        Route::get('trash/orders', ['as' => 'trash.orders','uses' => 'OrderTrashController@index']);
        Route::delete('trash/orders/destroy/{id}', 'OrderTrashController@destroy')->name('trash.orders.destroy');
        Route::post('trash/orders/restore/{id}', 'OrderTrashController@restoreOrder')->name('trash.orders.restore');

        Route::post('admins/changepass/{id}', ['as' => 'admins.changepass','uses' => 'UserController@changeAdminPassword']);
    });

    Route::resource('customers', 'CustomerController',['except' => ['show']]);
    Route::get('customers/openmodal', 'CustomerController@openModal')->name('customers.openmodal');
    Route::post('customers/savemodal', 'CustomerController@saveModal')->name('customers.savemodal');
    Route::patch('customers/update-invoice/{id}', 'CustomerController@updateInvoice')->name('customers.update-invoice');

    Route::get('user/create/{id}', 'CustomerController@createUser')->name('user.create');
    Route::post('user/store', 'CustomerController@storeUser')->name('user.store');
    Route::get('user/edit/{id}', 'CustomerController@editUser')->name('user.edit');
    Route::patch('user/update/{id}', 'CustomerController@updateUser')->name('user.update');
    Route::post('user/changepass/{id}', ['as' => 'user.changepass','uses' => 'CustomerController@changePassword']);
    Route::delete('user/destroy/{id}', 'CustomerController@destroyUser')->name('user.destroy');
    //Route::get('customers/getcustomer', 'CustomerController@getCustomer');

    Route::resource('inwards', 'InwardsController',['except' => ['show']]);
    Route::get('inwards/{id}/receipt',['as' => 'inwards.showReceipt','uses' => 'InwardsController@showReceipt']);
    Route::get('inwards/getInward', 'InwardsController@getInward');  
    Route::get('inwards/print',['as' => 'inwards.print','uses' => 'InwardsController@print']);  

    Route::resource('outwards', 'OutwardsController',['except' => ['show']]);
    Route::get('outwards/{id}/receipt',['as' => 'outwards.showReceipt','uses' => 'OutwardsController@showReceipt']);
    Route::get('outwards/print',['as' => 'outwards.print','uses' => 'OutwardsController@print']);  

    //Route::get('stock-report', 'StockReportsController',['except' => ['show']]);
    Route::get('reports/full-ledger',['as' => 'reports.full-ledger.show','uses' => 'FullLedgerReportController@show']);
    Route::get('reports/stock-report',['as' => 'reports.stock-report.show','uses' => 'StockReportsController@show']);
    Route::post('reports/full-ledger/export',['as' => 'reports.full-ledger.export','uses' => 'FullLedgerReportController@export']);    
    Route::get('reports/insurance-report',['as' => 'reports.insurance-report.show','uses' => 'InsuranceReportsController@show']);

    Route::post ('dashboard', 'HomeController@show')->name ('dashboard');  
    Route::post ('outstanding-payments', 'HomeController@showOutstandingPayment')->name ('outstanding-payments');   
});
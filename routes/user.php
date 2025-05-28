<?php

Route::group(['namespace' => 'Web','middleware'=>['auth','user'],'prefix'=>'user','as'=>'user.'], function () {
    Route::get ('/', 'HomeController@index')->name ('home');        
    Route::post ('dashboard', 'HomeController@show')->name ('dashboard');   
    
    Route::resource('inwards', 'InwardsController',['except' => ['show','update']]);
    Route::get('inwards/{id}/receipt',['as' => 'inwards.showReceipt','uses' => 'InwardsController@showReceipt']);
    Route::get('inwards/getInward', 'InwardsController@getInward');  
    Route::get('inwards/print',['as' => 'inwards.print','uses' => 'InwardsController@print']);  

    Route::resource('outwards', 'OutwardsController',['except' => ['show']]);
    Route::get('outwards/{id}/receipt',['as' => 'outwards.showReceipt','uses' => 'OutwardsController@showReceipt']);
    Route::get('outwards/print',['as' => 'outwards.print','uses' => 'OutwardsController@print']);  

    //Route::get('stock-report', 'StockReportsController',['except' => ['show']]);
    Route::get('reports/full-ledger',['as' => 'reports.full-ledger.show','uses' => 'FullLedgerReportController@show']);
    //Route::get('reports/stock-report',['as' => 'reports.stock-report.show','uses' => 'StockReportsController@show']);
    Route::post('reports/full-ledger/export',['as' => 'reports.full-ledger.export','uses' => 'FullLedgerReportController@export']);    
    Route::get('reports/insurance-report',['as' => 'reports.insurance-report.show','uses' => 'InsuranceReportsController@show']);

    Route::resource('profile', 'UserController',['only' => ['update']]);
    Route::get('profile/edit', ['as' => 'profile.edit','uses' => 'UserController@edit']);
    Route::post('changepassword/{id}', ['as' => 'changepassword','uses' => 'UserController@changePassword']);
});
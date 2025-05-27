<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['namespace' => 'Api','as'=>'api.'], function () {
    Route::post('inwards/search','InwardsController@Search');
    Route::get('item-marka/fetchMarka', 'MarkaController@fetchMarka');
    Route::get('item-marka/fetchCustomerMarka', 'MarkaController@fetchCustomerMarka');
    Route::get('customers/getCustomer', 'CustomerController@getCustomer');
    Route::post('inwards/getInward', 'InwardsController@getInward');
});
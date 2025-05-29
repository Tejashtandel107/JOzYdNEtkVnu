<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
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

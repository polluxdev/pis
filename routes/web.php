<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => '/', 'middleware' => ['auth']], function(){
    Route::get('home', 'MenuController@index')->name('home');

    Route::get('dashboard', 'HomeController@index')->name('dashboard');

    Route::get('profile', 'UserController@showProfile');
    Route::get('profile/change-password', 'UserController@getUser');
    Route::post('profile/change-password/{id}', 'UserController@changePassword');

    Route::get('payment-gateway', 'PaymentGatewayController@index');
    Route::get('payment-gateway/single', 'PaymentGatewayController@getSingle');

    Route::get('payment-channel', 'PaymentChannelController@index');
    Route::get('payment-channel/single', 'PaymentChannelController@getSingle');

    Route::get('merchant', 'MerchantController@index');
    Route::get('merchant/single', 'MerchantController@getSingle');

    Route::get('merchant-channel', 'MerchantChannelController@index');
    Route::get('merchant-channel/single', 'MerchantChannelController@getSingle');

    Route::get('transaction', 'TransactionController@index');
    Route::get('transaction/detail', 'TransactionController@showDetail');

    Route::get('report/transaction', 'ReportController@index');
    Route::get('report/transaction/table', 'ReportController@getReport');

    Route::get('role', 'RoleController@index');

    Route::resource('user', 'UserController');

    Route::get('edit-password', 'UserController@showUsers');
    Route::get('edit-password/get-user', 'UserController@getUser');
    Route::post('edit-password/{id}', 'UserController@editPassword');
});

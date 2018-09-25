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

Auth::routes();

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/transactions', 'TransactionsController@index');

    Route::get('/deposit', function () {
        return view('deposit');
    });

    Route::get('/depositByCard', function(){
        return view('depositByCard');
    });

    Route::post('/depositsaveaddress', 'DepositController@saveaddress');
    Route::post('/depositByCard', 'depositByCardController@depositBycard');

    Route::get('/withdraw', function () {
        return view('withdraw');
    });

    Route::get('/withdrawtobank', 'WithdrawToBankController@index');
    Route::post('/withdrawToBankAttempt', 'WithdrawToBankController@withdraw');

    Route::get('/withdrawtopaypal', 'WithdrawToPaypalController@index');
    Route::post('/withdrawToPayPalAttempt', 'WithdrawToPaypalController@withdraw');
    
    Route::post('/send', 'SendController@send');
    Route::get('/send', 'SendController@index');

    Route::get('/card', function () {
        return view('card');
    });

    Route::post('/cardapplied', 'CardApplicationController@store');

    Route::get('/settings', function () {
        return view('settings');
    });

    Route::get('/profile', function () {
        return view('profile');
    });

    //simulate win
    Route::get('/stake', 'WinController@stake');
    Route::get('/win', 'WinController@win');

    //reset users data
    Route::get('/reset', 'WinController@resetusersdata');
});

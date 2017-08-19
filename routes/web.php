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

Route::group(['middleware' => ['web']], function () {

    // Wallet's routes.
    Route::resource('transactions', 'TransactionController');

    // Transactions page.
    Route::get('/', array('uses' => 'TransactionController@transactions', 'as' => 'transactions.transactions'));

    // User's routes.
    Route::resource('user', 'UserController');

    Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'TransactionController@autocomplete'));
});

// User's routes.
Route::resource('user', 'UserController');

// Logout.
Route::get('auth/logout', 'Auth\LoginController@logout');
Auth::routes();

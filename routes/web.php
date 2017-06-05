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
    Route::resource('wallets', 'WalletController');

    // Transactions page.
    Route::get('/', array('uses' => 'WalletController@transactions', 'as' => 'wallets.transactions'));

    // User's routes.
    Route::resource('user', 'UserController');

    // Group's routes.
    Route::resource('group', 'GroupController');

    Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'WalletController@autocomplete'));
    Route::get('autocompletegroup',array('as'=>'autocompletegroup','uses'=>'GroupController@autocomplete'));
});

Route::group(['middleware' => ['group']], function() {

    // User's routes.
    Route::resource('user', 'UserController');
});

// Logout.
Route::get('auth/logout', 'Auth\LoginController@logout');
Auth::routes();

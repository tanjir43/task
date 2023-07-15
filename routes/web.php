<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Register Routes
Route::get('register', 'Auth\RegisterController@index')->name('auth.register');
Route::post('register-store', 'Auth\RegisterController@register')->name('auth.register.store');

//Login Routes
Route::get('login', 'Auth\LoginController@index')->name('auth.login');
Route::post('login-store', 'Auth\LoginController@login')->name('auth.login.store');


//Home Routes
Route::middleware(['auth'])->group(function () {

Route::get('home', 'HomeController@index')->name('home');
Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');

//deposit

Route::get('deposit', 'DepositController@index')->name('deposit'); 
Route::post('deposit-store', 'DepositController@store')->name('deposit.store');

//withdraw  
Route::get('withdraw', 'WithdrawController@index')->name('withdraw');
Route::post('withdraw-store', 'WithdrawController@store')->name('withdraw.store');
});

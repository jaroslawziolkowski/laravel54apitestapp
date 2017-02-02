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

Route::post('/user/create', 'Api\UserController@postCreate');
Route::put('/user/edit', 'Api\UserController@putEdit');
Route::post('/banking/deposit', 'Api\BankingController@postDeposit');
Route::post('/banking/withdraw', 'Api\BankingController@postWithdraw');
Route::post('/report', 'Api\ReportController@postReport');

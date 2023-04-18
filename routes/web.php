<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => '/'], function () {
	Route::get('/','creditors@dashboard')->name('credit.dashboard');
	Route::get('list','creditors@all')->name('credit.all');
	Route::get('list/paid','creditors@paid')->name('credit.paid');
	Route::get('list/add','creditors@add')->name('credit.add');
	Route::get('list/{id}','creditors@show')->name('credit.show');
	Route::get('list/update/{id}','creditors@update')->name('credit.update');
    Route::post('list/payment/{id}','creditors@payment')->name('credit.payment');
	Route::get('report','creditors@report')->name('credit.report');
});

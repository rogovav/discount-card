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


use Illuminate\Support\Facades\Route;

Route::get('/', 'CustomerController@index')->name('customers');
Route::post('/', 'CustomerController@store');
Route::post('/xml', 'XMLController@update')->name('updateCustomers');
Route::get('/getXML', 'XMLController@getXML')->name('getXML');
Route::get('/shops', 'ShopController@index')->name('shops');
Route::get('/conditions', 'ConditionController@index')->name('conditions');


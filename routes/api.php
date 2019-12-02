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

Route::group(['prefix' => 'promocode'], function () {
    Route::put('store', 'PromocodeController@store')->name('promocode.store');
    Route::get('use', 'PromocodeController@get')->name('promocode.get');
});

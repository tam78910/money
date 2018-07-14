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


Route::group(['prefix' => 'v1', 'namespace' => 'api\v1'], function() {

    Route::middleware(['auth:api'])->group(function () {
        Route::group(['prefix' => 'pays'], function() {
            Route::get('/', 'PayController@index')->name('api.pays.index');
            Route::get('kinds', 'PayController@kinds')->name('api.pays.kinds');
            Route::post('/', 'PayController@save')->name('api.pays.save');
        });    
    });

});

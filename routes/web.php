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

    Route::get('payments/orders/{order}', 'PaymentsController@handlePaymentResponse')->name('payments.response.success');
    Route::post('payments/orders/{order}', 'PaymentsController@handlePaymentResponse')->name('payments.response.success');

    Route::get('test','PaymentsController@test');

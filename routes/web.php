<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'activation', 'as' => 'activation.', 'middleware' => ['guest']], function () {

    Route::get('/resend', 'Auth\ActivationResendController@index')->name('resend');

    Route::post('/resend', 'Auth\ActivationResendController@store')->name('resend.store');

    Route::get('/{confirmation_token}', 'Auth\ActivationController@activate')->name('activate');

});

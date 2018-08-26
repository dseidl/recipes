<?php

use Illuminate\Http\Request;

Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('register', 'Auth\RegisterController@register')->name('register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

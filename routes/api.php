<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/taklim', 'TaklimController',['only'=>['index','store']]);
Route::post('/taklim/update', 'TaklimController@update');
Route::get('/taklim/delete', 'TaklimController@delete');
Route::get('/taklim/mytaklim', 'TaklimController@myTaklim');
Route::resource('/user', 'UserController');
Route::post('user/login', 'UserController@login');
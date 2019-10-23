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

Auth::routes();

Route::get('/{id?}', 'PostController@index');
Route::resource('post', 'PostController');

Route::group(['middleware' => 'auth'], function(){

    Route::put('/user/edit', 'UserController@profileUpdate');
    Route::get('/settings/account', 'UserController@accountEdit');
    Route::put('/settings/account', 'UserController@accountUpdate');
    Route::view('/settings/password', '/settings/password/edit');
    Route::put('/settings/password', 'UserController@passwordUpdate');
    Route::view('/settings/account/confirm_deactivation', '/settings/account/confirm_deactivation/index');
    Route::delete('/settings/account/confirm_deactivation', 'UserController@delete');

});

Route::post('/like', 'AjaxLikeController@update');
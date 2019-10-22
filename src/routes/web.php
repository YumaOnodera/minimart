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

Route::put('/user/{id}', 'UserController@update');

Route::get('/setting/account', 'AccountSettingController@edit');
Route::put('/setting/account', 'AccountSettingController@update');

Route::get('/setting/password', 'PasswordSettingController@edit');
Route::put('/setting/password', 'PasswordSettingController@update');

Route::get('/setting/account/confirm_deactivation', 'DeactivationController@index');
Route::delete('/setting/account/confirm_deactivation', 'DeactivationController@delete');

Route::post('/like', 'AjaxLikeController@update');

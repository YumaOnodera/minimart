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

Route::get('/', 'HomeController@index')->name('home');
Route::resource('home', 'HomeController');

Route::get('/mypage', 'MypageController@index')->name('mypage');
Route::resource('mypage', 'MypageController');

Route::get('/setting/account', 'AccountSettingController@edit');
Route::put('/setting/account', 'AccountSettingController@update');

Route::get('/setting/password', 'PasswordSettingController@edit');
Route::put('/setting/password', 'PasswordSettingController@update');

Route::get('/setting/account/confirm_deactivation', 'DeactivationController@index');
Route::delete('/setting/account/confirm_deactivation', 'DeactivationController@delete');

Route::get('/goods/{id}', 'GoodsController@show');
Route::post('/like', 'AjaxLikeController@store');

Auth::routes();

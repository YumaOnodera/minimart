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
Route::get('/mypage', 'MypageController@index');
Route::resource('mypage', 'MypageController');
Route::get('/goods/{id}', 'GoodsController@show')->name('goods');
Route::resource('goods', 'GoodsController');
Route::post('/like', 'AjaxLikeController@store');

Auth::routes();

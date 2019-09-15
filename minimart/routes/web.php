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

Auth::routes();

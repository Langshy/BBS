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

Route::get('/', function () {
    return view('welcome');
});

Route::post('Admin/createAdmin','Admin\SessionController@create');
Route::post('Admin/login','Admin\SessionController@login');
Route::get('getAllSession','Admin\SessionController@getAllSession');
Route::get('Admin/loginOut/{id}','Admin\SessionController@loginOut');




//验证邮箱
Route::get('Admin/confirm_email', 'Admin\SessionController@confirmEmail')->name('confirm_email');
//密码找回
Route::post('Admin/password_email','Admin\SessionController@resetPassword');
Route::get('Admin/confirm_password_email','Admin\SessionController@updatePassword')->name('confirm_password_email');


<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'admin'], function(){
	//비로그인 상태에서 접근.
	Route::get('login', 'Admin\Auth\LoginController@login')->name('adminLogin');
	Route::get('logout', 'Admin\Auth\LoginController@logout')->name('adminLogout');
	
	Route::get('regist', 'Admin\Auth\RegisterController@regist')->name('adminRegist');
	Route::post('signIn', 'Admin\Auth\RegisterController@signIn')->name('adminSignIn');
	
	//인증 미들웨어 확인
	Route::group(['middleware' => ['auth:admin']], function() {
		Route::get('/', 'Admin\IndexController@index');
	});
});
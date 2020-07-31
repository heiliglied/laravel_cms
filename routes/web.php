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
	Route::post('signIn', 'Admin\Auth\LoginController@signIn')->name('adminSignIn');
	
	Route::get('regist', 'Admin\Auth\RegisterController@regist')->name('adminRegist');
	Route::post('signUp', 'Admin\Auth\RegisterController@signUp')->name('adminSignUp');
	
	//인증 미들웨어 확인
	Route::group(['middleware' => ['auth:admin']], function() {
		Route::get('/', 'Admin\IndexController@index');
		
		Route::group(['prefix' => 'settings'], function(){
			Route::get('/rank', 'Admin\Settings\RankController@list');
			Route::get('/member', 'Admin\Settings\MemberController@adminList');
			Route::get('/member/write', 'Admin\Settings\MemberController@adminWrite');
			Route::post('/member/create', 'Admin\Settings\MemberController@adminCreate');
		});
		
		Route::group(['prefix' => 'ajax'], function(){
			Route::get('/rankList', 'Ajax\AdminRankController@getList');
			Route::post('/rankInsert', 'Ajax\AdminRankController@insert');
			Route::delete('/rankDelete', 'Ajax\AdminRankController@delete');
			Route::patch('/rankUpdate', 'Ajax\AdminRankController@update');
			
			Route::post('/idCheck', 'Ajax\AdminMemberController@idCheck');
			Route::get('/adminList', 'Ajax\AdminMemberController@adminList');
		});
	});
});

Auth::routes();
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
    return view('home');
});

Route::group(['prefix' => 'admin'], function(){
	//비로그인 상태에서 접근.
	Route::get('login', 'Admin\Auth\LoginController@login')->name('adminLogin');
	Route::get('logout', 'Admin\Auth\LoginController@logout')->name('adminLogout');
	Route::post('signIn', 'Admin\Auth\LoginController@signIn')->name('adminSignIn');
	
	Route::get('regist', 'Admin\Auth\RegisterController@regist')->name('adminRegist');
	Route::post('signUp', 'Admin\Auth\RegisterController@signUp')->name('adminSignUp');
	
	//인증 미들웨어 확인
	Route::group(['middleware' => ['auth:admin', 'admin.permission']], function() {
		Route::get('/', 'Admin\IndexController@index');
		
		Route::group(['prefix' => 'settings'], function(){
			Route::get('/site', 'Admin\Settings\SiteSettingController@view');
			Route::post('/setSettings', 'Admin\Settings\SiteSettingController@set');
			Route::get('/rank', 'Admin\Settings\RankController@list');
			Route::get('/member', 'Admin\Settings\MemberController@adminList');
			Route::get('/member/write', 'Admin\Settings\MemberController@adminWrite');
			Route::get('/member/modify/{id}', 'Admin\Settings\MemberController@adminModify');
			Route::post('/member/create', 'Admin\Settings\MemberController@adminCreate');
			Route::patch('/member/update', 'Admin\Settings\MemberController@adminUpdate');
			Route::get('/permission', 'Admin\Settings\PermissionController@list');
			Route::get('/permission/write', 'Admin\Settings\PermissionController@write');
			Route::post('/permission/create', 'Admin\Settings\PermissionController@create');
			Route::get('/permission/modify/{id}', 'Admin\Settings\PermissionController@modify');
			Route::patch('/permission/update', 'Admin\Settings\PermissionController@update');
		});
		
		Route::group(['prefix' => 'users'], function(){
			Route::get('/rank', 'Admin\Users\RankController@list');
			Route::get('/users', 'Admin\Users\UserController@list');
			Route::get('/users/write', 'Admin\Users\UserController@userWrite');
			Route::get('/users/modify/{id}', 'Admin\Users\UserController@userModify');
			
			Route::post('/users/create', 'Admin\Users\UserController@userCreate');
			Route::patch('/users/update', 'Admin\Users\UserController@userUpdate');
			Route::delete('/userDelete/', 'Admin\Users\UserController@userDelete');
		});
		
		Route::group(['prefix' => 'ajax'], function(){
			Route::get('/adminRankList', 'Ajax\AdminRankController@getList');
			Route::post('/adminRankInsert', 'Ajax\AdminRankController@insert');
			Route::delete('/adminRankDelete', 'Ajax\AdminRankController@delete');
			Route::patch('/adminRankUpdate', 'Ajax\AdminRankController@update');
			
			Route::post('/adminIdCheck', 'Ajax\AdminMemberController@idCheck');
			Route::get('/adminList', 'Ajax\AdminMemberController@adminList');
			Route::delete('/adminDelete/{id}', 'Ajax\AdminMemberController@adminDelete');
			
			Route::get('/permissionList', 'Ajax\AdminPermissionController@permissionList');
			Route::delete('/permissionDelete/{id}', 'Ajax\AdminPermissionController@permissionDelete');
			
			Route::get('/userRankList', 'Ajax\UserRankController@getList');
			Route::post('/userRankInsert', 'Ajax\UserRankController@insert');
			Route::delete('/userRankDelete', 'Ajax\UserRankController@delete');
			Route::patch('/userRankUpdate', 'Ajax\UserRankController@update');
			Route::patch('/userRankSetDefault', 'Ajax\UserRankController@setDefault');
			
			
			Route::post('/userIdCheck', 'Ajax\UserMemberController@idCheck');
			Route::get('/userList', 'Ajax\UserMemberController@userList');
			Route::patch('/userExcept/{id}', 'Ajax\UserMemberController@userExcept');
		});
	});
});

//Auth::routes();
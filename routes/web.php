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
	Route::get('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('adminLogin');
	Route::get('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('adminLogout');
	Route::post('signIn', [App\Http\Controllers\Admin\Auth\LoginController::class, 'signIn'])->name('adminSignIn');
	
	Route::get('regist', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'regist'])->name('adminRegist');
	Route::post('signUp', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'signUp'])->name('adminSignUp');
	
	//인증 미들웨어 확인
	Route::group(['middleware' => ['auth:admin', 'admin.permission']], function() {
		Route::get('/', [App\Http\Controllers\Admin\IndexController::class, 'index']);
		
		Route::group(['prefix' => 'settings'], function(){
			Route::get('/site', [App\Http\Controllers\Admin\Settings\SiteSettingController::class, 'view']);
			Route::post('/setSettings', [App\Http\Controllers\Admin\Settings\SiteSettingController::class, 'set']);
			Route::get('/rank', [App\Http\Controllers\Admin\Settings\RankController::class, 'list']);
			Route::get('/member', [App\Http\Controllers\Admin\Settings\MemberController::class, 'adminList']);
			Route::get('/member/write', [App\Http\Controllers\Admin\Settings\MemberController::class, 'adminWrite']);
			Route::get('/member/modify/{id}', [App\Http\Controllers\Admin\Settings\MemberController::class, 'adminModify']);
			Route::post('/member/create', [App\Http\Controllers\Admin\Settings\MemberController::class, 'adminCreate']);
			Route::patch('/member/update', [App\Http\Controllers\Admin\Settings\MemberController::class, 'adminUpdate']);
			Route::get('/permission', [App\Http\Controllers\Admin\Settings\PermissionController::class, 'list']);
			Route::get('/permission/write', [App\Http\Controllers\Admin\Settings\PermissionController::class, 'write']);
			Route::post('/permission/create', [App\Http\Controllers\Admin\Settings\PermissionController::class, 'create']);
			Route::get('/permission/modify/{id}', [App\Http\Controllers\Admin\Settings\PermissionController::class, 'modify']);
			Route::patch('/permission/update', [App\Http\Controllers\Admin\Settings\PermissionController::class, 'update']);
		});
		
		Route::group(['prefix' => 'users'], function(){
			Route::get('/rank', [App\Http\Controllers\Admin\Users\RankController::class, 'list']);
			Route::get('/users', [App\Http\Controllers\Admin\Users\UserController::class, 'list']);
			Route::get('/users/write', [App\Http\Controllers\Admin\Users\UserController::class, 'userWrite']);
			Route::get('/users/modify/{id}', [App\Http\Controllers\Admin\Users\UserController::class, 'userModify']);
			
			Route::post('/users/create', [App\Http\Controllers\Admin\Users\UserController::class, 'userCreate']);
			Route::patch('/users/update', [App\Http\Controllers\Admin\Users\UserController::class, 'userUpdate']);
			Route::delete('/userDelete/', [App\Http\Controllers\Admin\Users\UserController::class, 'userDelete']);
		});
		
		Route::group(['prefix' => 'ajax'], function(){
			Route::get('/adminRankList', [App\Http\Controllers\Ajax\AdminRankController::class, 'getList']);
			Route::post('/adminRankInsert', [App\Http\Controllers\Ajax\AdminRankController::class, 'insert']);
			Route::delete('/adminRankDelete', [App\Http\Controllers\Ajax\AdminRankController::class, 'delete']);
			Route::patch('/adminRankUpdate', [App\Http\Controllers\Ajax\AdminRankController::class, 'update']);
			
			Route::post('/adminIdCheck', [App\Http\Controllers\Ajax\AdminMemberController::class, 'idCheck']);
			Route::get('/adminList', [App\Http\Controllers\Ajax\AdminMemberController::class, 'adminList']);
			Route::delete('/adminDelete/{id}', [App\Http\Controllers\Ajax\AdminMemberController::class, 'adminDelete']);
			
			Route::get('/permissionList', [App\Http\Controllers\Ajax\AdminPermissionController::class, 'permissionList']);
			Route::delete('/permissionDelete/{id}', [App\Http\Controllers\Ajax\AdminPermissionController::class, 'permissionDelete']);
			
			Route::get('/userRankList', [App\Http\Controllers\Ajax\UserRankController::class, 'getList']);
			Route::post('/userRankInsert', [App\Http\Controllers\Ajax\UserRankController::class, 'insert']);
			Route::delete('/userRankDelete', [App\Http\Controllers\Ajax\UserRankController::class, 'delete']);
			Route::patch('/userRankUpdate', [App\Http\Controllers\Ajax\UserRankController::class, 'update']);
			Route::patch('/userRankSetDefault', [App\Http\Controllers\Ajax\UserRankController::class, 'setDefault']);
			
			
			Route::post('/userIdCheck', [App\Http\Controllers\Ajax\UserMemberController::class, 'idCheck']);
			Route::get('/userList', [App\Http\Controllers\Ajax\UserMemberController::class, 'userList']);
			Route::patch('/userExcept/{id}', [App\Http\Controllers\Ajax\UserMemberController::class, 'userExcept']);
		});
	});
});

//Auth::routes();
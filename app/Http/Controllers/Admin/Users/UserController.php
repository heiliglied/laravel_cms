<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\AsideMenuInterface;
use App\Services\AdminPermissionService;

class UserController extends Controller implements AsideMenuInterface 
{
    public function __construct() {}
	
	public function activeMenuList(String $open_menu, String $active_menu) : array {
		return [
			'open' => $open_menu,
			'active' => $active_menu,
		];
	}
	
	protected function list(Request $request)
	{
		$menu_view = $this->activeMenuList('users', 'users');
		return view('admin.users.users.list', ['menu' => $menu_view]);
	}
	
	protected function userModify(Request $request)
	{
		/*
		$adminPermissionService = AdminPermissionService::getInstance();
		$menu_view = $this->activeMenuList('users', 'users');
		$user = $adminPermissionService->getOneRow('id', $request->id);
		return view('admin.users.users.modify', ['menu' => $menu_view, 'user', $user]);
		*/
	}
}

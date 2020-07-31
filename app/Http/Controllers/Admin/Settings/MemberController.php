<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Interfaces\AsideMenuInterface;
use App\Services\AdminRankService;
use App\Services\AdminService;

class MemberController extends Controller implements AsideMenuInterface 
{
    public function __construct() {}
	
	public function activeMenuList(String $open_menu, String $active_menu) : array {
		return [
			'open' => $open_menu,
			'active' => $active_menu,
		];
	}
	
	protected function adminList(Request $request)
	{
		$adminRankService = AdminRankService::getInstance();		
		$menu_view = $this->activeMenuList('settings', 'admin_member');
		return view('admin.member.list', ['menu' => $menu_view]);
	}
	
	protected function adminWrite(Request $request)
	{
		$adminRankService = AdminRankService::getInstance();		
		$menu_view = $this->activeMenuList('settings', 'admin_member');
		$rank_list = $adminRankService->getList(1, 1000);
		
		return view('admin.member.write', ['menu' => $menu_view, 'rank' => $rank_list]);
	}
	
	protected function adminCreate(Request $request)
	{
		$validation = $this->validator($request);
		
		if($validation->fails()) {
			return redirect()->back()->withErrors($validation)->withInput();
		} else {
			$adminService = AdminService::getInstance();
			try{ 
				$adminService->createAuth($request->all());
			} catch(\Exception $e) {
				abort(500);
			}
			return redirect('/admin/settings/member');
		}
	}
	
	protected function validator(Request $request)
	{
		$rules = [
			'user_id' => 'unique:admin|required|max:20|min:5',
			'password' => 'required|confirmed|min:6',
			'email' => 'required|email',
		];
		
		return Validator::make($request->all(), $rules);
	}
}

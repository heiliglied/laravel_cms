<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\AsideMenuInterface;
use App\Services\AdminRankService;
use App\Services\AdminPermissionService;

class PermissionController extends Controller implements AsideMenuInterface 
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
		$menu_view = $this->activeMenuList('settings', 'admin_permission');
		return view('admin.settings.permission.list', ['menu' => $menu_view]);
	}
	
	protected function write(Request $request)
	{
		$adminRankService = AdminRankService::getInstance();
		$rank_list = $adminRankService->getList(1, 1000);
		$menu_view = $this->activeMenuList('settings', 'admin_permission');
		return view('admin.settings.permission.write', ['menu' => $menu_view, 'rank' => $rank_list]);
	}
	
	protected function create(Request $request)
	{
		if($request->uri == '') {
			return redirect()->back()->withErrors(['message' => 'URI를 입력해 주세요.']);
		} else {
			$adminPermissionService = AdminPermissionService::getInstance();
			
			$datas = [
				'rank' => $request->rank,
				'uri' => str_replace(env('APP_URL'), '', $request->uri),
			];
			
			try {
				$adminPermissionService->permissionCreate($datas);
			} catch(\Exception $e) {
				return redirect()->back()->withErrors(['message' => '권한 작성에 실패했습니다.']);
			}
			
			return redirect('/admin/settings/permission');
		}
	}
}

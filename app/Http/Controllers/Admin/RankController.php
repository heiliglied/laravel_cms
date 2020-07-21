<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\AsideMenuInterface;

class RankController extends Controller implements AsideMenuInterface 
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
		$menu_view = $this->activeMenuList('settings', 'admin_rank');
		return view('admin.rank.list', ['menu' => $menu_view]);
	}
	
	protected function write(Request $request)
	{
		$menu_view = $this->activeMenuList('settings', 'admin_rank');
		return view('admin.rank.write', ['menu' => $menu_view]);
	}
	
	protected function create(Request $request)
	{
		if($request->rank == 0) {
			return back()->withErrors(['msg' => '0은 설정할 수 없는 등급입니다.']);
		}
	}
}

<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Admin;

class LoginController extends Controller
{
    public function __construct() 
	{
		
	}
	
	protected function login(Request $request)
	{
		$admin_cnt = Admin::where('rank', 0)->count();
		if($admin_cnt < 1) {
			return redirect(route('adminRegist'));
		} else {
			return view('admin.auth.login');
		}
	}
	
	private function validator(Request $request)
	{
		
	}
}

<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct() 
	{
		
	}
	
	protected function regist(Request $request)
	{
		return view('admin.auth.regist');
	}
	
	protected function signIn(Request $request)
	{
		
	}
	
	protected function validator(Request $request) 
	{
		
	}
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct() {}
	
	protected function index(Request $request) {
		return view('admin.index');
	}
}

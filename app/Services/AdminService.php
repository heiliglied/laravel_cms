<?php

namespace App\Services;

use App\Admin;

class AdminService
{
	static private $instance = null;
	
	static function getInstance() 
	{
		if(self::$instance == null) {
			self::$instance = new AdminService();
		}
		
		return self::$instance;
	}
	
	function adminTotalCount() {
		return Admin::count();
	}
	
	function createAuth(array $data) {
		return Admin::create($data);
	}
}
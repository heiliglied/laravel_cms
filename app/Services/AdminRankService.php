<?php

namespace App\Services;

use App\Models\AdminRank;

class AdminRankService
{
	static private $instance = null;
	
	static function getInstance() 
	{
		if(self::$instance == null) {
			self::$instance = new AdminRankService();
		}
		
		return self::$instance;
	}
	
	function createRank(array $data) {
		return AdminRank::create($data);
	}
}
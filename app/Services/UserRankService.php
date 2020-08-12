<?php

namespace App\Services;

use App\Models\UserRank;

class UserRankService
{
	static private $instance = null;
	
	static function getInstance() 
	{
		if(self::$instance == null) {
			self::$instance = new UserRankService();
		}
		
		return self::$instance;
	}
	
	function getTotalRecordCount()
	{
		return UserRank::count();
	}
	
	function createRank(array $data)
	{
		return UserRank::insert($data);
	}
	
	function getList(int $page, int $limit)
	{
		return UserRank::where('rank', '>', 0)->skip(($page - 1 * $limit))->take($limit)->orderBy('rank', 'asc')->get();
	}
	
	function deleteRank(int $rank)
	{
		return UserRank::where('rank', $rank)->delete();
	}
	
	function updateRank(int $rank, String $name)
	{
		return UserRank::where('rank', $rank)->update(['name' => $name]);
	}
}
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
	
	function adminTotalCount() 
	{
		return Admin::count();
	}
	
	function createAuth(array $data) 
	{
		return Admin::create($data);
	}
	
	function dupilcate(String $user_id) : String
	{
		if(Admin::where('user_id', $user_id)->count() > 0) {
			return "duplicate";
		} else {
			return "not_null";
		}
	}
	
	function getAdminFilteredCount(array $parameters)
	{
		return Admin::count();
	}
	
	function getAdminList(array $parameters)
	{
		return Admin::skip($parameters['skip'])->take($parameters['take'])->orderBy($parameters['order']['column'], $parameters['order']['sort'])->get();
	}
}
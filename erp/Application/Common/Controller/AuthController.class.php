<?php

namespace Common\Controller;
use Think\Controller;

/**
* 验证类
*/
class AuthController extends Controller
{
	
	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_name']))
		{
			$this->redirect('Admin/Login/index');
		}
	}
}
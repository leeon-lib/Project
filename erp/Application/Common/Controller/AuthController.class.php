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
			$this->success('未登录或长时间未操作',U('Admin/Login/index'));
		}
	}
}
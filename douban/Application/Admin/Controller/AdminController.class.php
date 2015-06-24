<?php

/**
* 后台管理控制器
*/
class AdminController extends AuthController
{
	/**
	 * 后台首页
	 */
	public function index()
	{
		$this->display();
	}
	
}
<?php

namespace Storage\Controller;
use Common\Controller\AuthController;

/**
* 库房规则管理控制器
*/
class RuleController extends AuthController
{
	
	/**
	 * 规则列表
	 */
	public function index()
	{
		$this->display();
	}
	
}
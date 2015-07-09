<?php

namespace Storage\Controller;
use Common\Controller\AuthController;

/**
* 快递管理控制器
*/
class ExpressController extends AuthController
{
	
	/**
	 * 
	 */
	public function index()
	{
		$this->display();
	}
}
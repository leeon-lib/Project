<?php

/**
* 采购管理控制器
*/
class PurchaseController extends AuthController
{
	
	/**
	 * 采购单列表
	 */
	public function index()
	{
		$this->display();
	}
}
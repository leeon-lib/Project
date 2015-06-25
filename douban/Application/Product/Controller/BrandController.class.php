<?php

/**
* 品牌管理控制器
*/
class BrandController extends AuthController
{
	
	/**
	 * 品牌列表
	 */
	public function index()
	{
		$this->display();
	}

	/**
	 * 添加品牌
	 */
	public function add()
	{
		$this->display();
	}
}
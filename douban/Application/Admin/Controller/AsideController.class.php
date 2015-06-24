<?php

/**
* 边栏菜单控制器
*/
class AsideController extends AuthController
{
	/**
	 * 商品模块
	 */
	public function product()
	{
		$this->display();
	}

	/**
	 * 设置模块
	 */
	public function settings()
	{
		$this->display();
	}
	
}
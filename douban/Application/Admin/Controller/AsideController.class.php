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
	 * 订单管理模块
	 */
	public function order()
	{
		$this->display();
	}

	/**
	 * 采购管理模块
	 */
	public function purchase()
	{
		$this->display();
	}

	/**
	 * 库存管理模块
	 */
	public function stock()
	{
		$this->display();
	}

	/**
	 * 商城管理模块
	 */
	public function mall()
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
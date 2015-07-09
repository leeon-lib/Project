<?php

namespace Admin\Controller;
use Common\Controller\AuthController;

/**
* 后台管理控制器
*/
class IndexController extends AuthController
{
	/**
	 * 后台首页
	 */
	public function index()
	{
		$this->display();
	}
	
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
	 * 库房管理模块
	 */
	public function storage()
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
	public function admin()
	{
		$this->display();
	}
}
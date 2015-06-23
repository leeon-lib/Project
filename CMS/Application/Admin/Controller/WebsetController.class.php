<?php

/**
* 网站配置控制器
*/
class WebsetController extends AuthController
{
	private $model;
	function __construct()
	{
		parent::__construct();
		$this->model = K('config');
	}

	public function index()
	{
		$info = $this->model->all();
		// p($info);
		$this->assign('info',$info);
		$this->display();
	}

	/**
	 * 修改网站配置
	 * @return [type] [description]
	 */
	public function save()
	{

	}
}
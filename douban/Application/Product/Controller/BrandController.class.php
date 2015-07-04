<?php

/**
* 品牌管理控制器
*/
class BrandController extends AuthController
{
	private $model = null;

	public function __construct()
	{
		parent::__construct();
		$this->model = K('Brand');
	}

	/**
	 * 品牌列表
	 */
	public function index()
	{
		$info = $this->model->all();
		$this->assign('info',$info);
		$this->display();
	}

	/**
	 * 添加品牌
	 */
	public function add()
	{
		if (IS_POST) {
			// p($_POST);
			if (!$this->model->intoBrand()) {
				$this->error($this->model->error);
			} else {
				$this->success('添加成功',U('Product/Brand/index'));
			}
		}
		$this->display();
	}

	/**
	 * 编辑
	 */
	public function edit()
	{
		$bid = (int)$_GET['id'];
		$info = $this->model->where("id={$bid}")->find();
		// p($info);die;
		$this->assign('info',$info);
		$this->display();
	}
}
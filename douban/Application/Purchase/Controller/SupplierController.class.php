<?php

/**
* 供应商管理控制器
*/
class SupplierController extends AuthController
{
	private $model = null;

	public function __construct()
	{
		parent::__construct();
		$this->model = K('Supplier');
	}


	/**
	 * 供应商列表
	 */
	public function index()
	{
		$supplierList = $this->model->getList();
		$this->assign('supplierList', $supplierList);
		$this->display();
	}

	/**
	 * 添加
	 */
	public function add()
	{
		$cityList = C('CITY_LIST');
		$this->assign('cityList', $cityList);
		$this->display();
	}

	/**
	 * 修改供应商信息
	 */
	public function edit()
	{
		$id = (int)Q('get.id');
		$oldInfo = $this->model->getOne($id);
		$this->assign('oldInfo', $oldInfo);
		$this->display();
	}


	/**
	 * 操作
	 */
	public function operate()
	{
		$name = Q('post.name');
		$manager = Q('post.manager');
		$mobile = (int)Q('post.mobile');
		$qq = (int)Q('post.qq');
		$email = (int)Q('post.email');
		$kindId = (int)Q('post.kind_id');

		if (empty($kindId) || (-1 == $kindId))
		{
			$this->error('请选择经营类别！');
		}
		if (empty($name))
		{
			$this->error('供应商名称不可为空！');
		}

		$argv = array(
			'name' => $name,
			'manager' => $manager,
			'mobile' => $mobile,
			'qq' => $qq,
			'email' => $email,
			'kind_id' => $kindId
		);
		if (!isset($_POST['id']))
		{// 添加
			$this->model->_insert($argv);
			$this->success('添加成功', 'index');
		} else {//编辑
			$id = (int)Q('post.id');
			$this->model->_update($argv, $id);
			$this->success('修改成功', 'index');
		}
	}
}
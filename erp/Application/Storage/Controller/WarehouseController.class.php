<?php

namespace Storage\Controller;
use Common\Controller\AuthController;

/**
* 库房管理控制器
*/
class WarehouseController extends AuthController
{
	private $model = null;

	public function __construct()
	{
		parent::__construct();
		$this->model = D('Warehouse');
	}


	/**
	 * 库房列表
	 */
	public function index()
	{
		$warehouseList = $this->model->getList();
		$this->assign('warehouseList', $warehouseList);
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
	 * 编辑修改
	 */
	public function edit()
	{
		$id = (int)I('get.id');
		$oldData = $this->model->getOne($id);
		$cityList = C('CITY_LIST');
		$this->assign('cityList', $cityList);
		$this->assign('oldData', $oldData);
		$this->display();
	}

	/**
	 * 操作
	 */
	public function operate()
	{
		$city = (int)I('post.city_id');
		$name = trim(I('post.name'));
		$address = trim(I('post.address'));
		$manager = trim(I('post.manager'));
		$mobile = trim(I('post.mobile'));
		$warehouseId = I('post.id', 'intval', 0);
		// 表单数据验证
		if (!$this->model->create())
		{
			$this->error($this->model->getError());
		}

		$argv = array(
			'city_id' => $city,
			'name' => $name,
			'address' => $address,
			'manager' => $manager,
			'mobile' => $mobile
		);
		if (0 == $warehouseId)
		{	
			// 添加
			if ($this->model->isExists($name))
			{
				$this->error('添加失败，该库房名称已存在');
			} else {
				$argv['key_id'] = $this->model->makeKey();
				$this->model->doInsert($argv);
				$this->success('添加成功', U('index'));
			}
		} else {
			// 编辑
			$oldName = $this->model->getOne($warehouseId, 'name', true);
			if (($name != $oldName) && ($this->model->isExists($name)))
			{
				$this->error('修改失败，该库房名称已存在');
			} else {
				$this->model->doUpdate($argv, $warehouseId);
				$this->success('修改成功', U('index'));
			}
		}
	}

	/**
	 * 删除
	 */
	public function del()
	{
		echo 'Waiting construction...';
	}

}
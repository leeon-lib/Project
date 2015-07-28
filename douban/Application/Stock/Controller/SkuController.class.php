<?php

/**
* SKU管理控制器
*/
class SkuController extends AuthController
{
	private $model = null;

	public function __construct()
	{
		parent::__construct();
		$this->model = K('Sku');
	}


	/**
	 * sku列表
	 */
	public function index()
	{
		$supplierList = $this->model->getList();
		$this->assign('supplierList', $supplierList);
		$this->display();
	}

	/**
	 * 添加sku
	 */
	public function add()
	{
		$cityList = C('CITY_LIST');
		$this->assign('cityList', $cityList);
		$this->display();
	}

	/**
	 * 修改sku信息
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
		$goods = Q('post.goods');
		$size = Q('post.size');
		$barCode = Q('post.bar_code');

		if (empty($goods))
		{
			$this->error('货号不能为空！');
		}
		if (empty($size))
		{
			$this->error('尺码不能为空！');
		}
		if (empty($barCode))
		{
			$this->error('条形码不能为空！');
		}

		$argv = array(
			'goods' => $goods,
			'size' => $size,
			'bar_code' => $barCode,
			'admin_name' => 
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
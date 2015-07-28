<?php

namespace Purchase\Controller;
use Common\Controller\AuthController;

/**
* 供应商管理控制器
*/
class SupplierController extends AuthController
{
	private $model = null;
	private $brandModel = null;

	public function __construct()
	{
		parent::__construct();
		$this->model = D('Supplier');
		$this->brandModel = D('Product/Brand');
	}


	/**
	 * 供应商列表
	 */
	public function index()
	{
		// 获取列表信息，关联出品牌名称
		$supplierList = $this->model->getList();
		foreach ($supplierList as $key => $value) {
			$brandIdArr = explode(',', $value['brand_id']);
			foreach ($brandIdArr as $id) {
				$supplierList[$key]['brand_name'][] = $this->brandModel->getOne($id, 'name', true);
			}
			unset($supplierList[$key]['brand_id']);
		}
		$this->assign('supplierList', $supplierList);
		$this->display();
	}

	/**
	 * 添加
	 */
	public function add()
	{
		$brandList = $this->brandModel->getList(['field'=>'id,name']);
		$this->assign('brandList', $brandList);
		$this->display();
	}

	/**
	 * 修改供应商信息
	 */
	public function edit()
	{
		$id = (int)I('get.id');
		$oldDate = $this->model->getOne($id);
		$this->assign('oldDate', $oldDate);
		$this->display();
	}


	/**
	 * 操作
	 */
	public function operate()
	{
		$name = trim(I('post.name'));
		$kindId = (int)I('post.kind_id');
		$brandId = (array)I('post.brand_id');
		$manager = trim(I('post.manager'));
		$mobile = trim(I('post.mobile'));
		$qq = trim(I('post.qq'));
		$email = trim(I('post.email'));
		$supplierId = I('post.id', 'intval', 0);
		// 表单数据验证
		if (!$this->model->create())
		{
			$this->error($this->model->getError());
		}
		// 组合用于插入供应商表的数据
		$argv = array(
			'name' => $name,
			'kind_id' => $kindId,
			'manager' => $manager,
			'mobile' => $mobile,
			'qq' => $qq,
			'email' => $email,
			'brand_id' => implode(',', $brandId)
		);
		// p($argv);die;
		if (0 == $supplierId)
		{	
			// 供应商表的添加
			$this->model->doInsert($argv);
			$this->success('添加成功', 'index');
		} else {
			// 编辑修改
			$id = (int)I('post.id');
			$this->model->doUpdate($argv, $id);
			$this->success('修改成功', 'index');
		}
	}

	/**
	 * 操作
	 */
	public function operate1()
	{
		$name = trim(I('post.name'));
		$kindId = (int)I('post.kind_id');
		$brandId = I('post.brand_id');
		$manager = trim(I('post.manager'));
		$mobile = trim(I('post.mobile'));
		$qq = trim(I('post.qq'));
		$email = trim(I('post.email'));
		$supplierId = I('post.id', 'intval', 0);
		// 表单数据验证
		if (!$this->model->create())
		{
			$this->error($this->model->getError());
		}
		// 组合用于插入供应商表的数据
		$argv = array(
			'name' => $name,
			'kind_id' => $kindId,
			'manager' => $manager,
			'mobile' => $mobile,
			'qq' => $qq,
			'email' => $email
		);
		// 实例化供应商品牌表对象
		$supplierBrandModel = D('SupplierBrand');
		if (0 == $supplierId)
		{	
			// 供应商表的添加
			$keyId = $this->model->doInsert($argv);
			// 供应商品牌表的添加
			if (is_array($brandId))
			{
				foreach ($brandId as $v)
				{
					$supplierBrandModel->doInsert(['supplier_id'=>$keyId, 'brand_id'=>$v]);
				}
			} else {
				$supplierBrandModel->doInsert(['supplier_id'=>$keyId, 'brand_id'=>$brandId]);
			}
			$this->success('添加成功', 'index');
		} else {
			// 编辑修改
			$id = (int)I('post.id');
			$this->model->doUpdate($argv, $id);
			$this->success('修改成功', 'index');
		}
	}

}
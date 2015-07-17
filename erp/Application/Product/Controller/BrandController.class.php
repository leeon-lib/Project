<?php

namespace Product\Controller;
use Common\Controller\AuthController;

/**
* 品牌管理控制器
*/
class BrandController extends AuthController
{
	private $model = null;

	public function __construct()
	{
		parent::__construct();
		$this->model = D('Brand');
	}

	/**
	 * 品牌列表
	 */
	public function index()
	{
		$brandList = $this->model->getList();
		$this->assign('brandList',$brandList);
		$this->display();
	}

	/**
	 * 添加品牌
	 */
	public function add()
	{
		
		$this->display();
	}

	/**
	 * 编辑
	 */
	public function edit()
	{
		$id = (int)I('get.id');
		$oldData = $this->model->getOne($id);
		$this->assign('oldData',$oldData);
		$this->display();
	}

	/**
	 * 操作
	 */
	public function operate()
	{
		$name = trim(I('post.name'));
		$enName = trim(I('post.en_name'));
		$brandId = I('post.id', 'intval', 0);
		// 表单数据验证
		if (!$this->model->create())
		{
			$this->error($this->model->getError());
		}
		$argv = array(
			'name' => $name,
			'en_name' => $enName,
		);
		if (0 == $brandId)
		{// 添加
			if ($this->model->isExists($name))
			{
				$this->error('添加失败，该品牌已存在');
			}
			// Logo上传处理
			if (isset($_FILES['logo']) && (4 != $_FILES['logo']['error']))
			{
				$argv['logo'] = upload('Brand/', true);
			}
			$this->model->doInsert($argv);
			$this->success('添加成功', U('index'));
		} else {// 编辑
			$oldName = $this->model->getOne($brandId, 'name', true);
			// 如果名称被修改，但修改后的名称已存在
			if (($name != $oldName) && ($this->model->isExists($name)))
			{
				$this->error('修改失败，该品牌名称已存在');
			} else {
				if (isset($_FILES['logo']) && (4 != $_FILES['logo']['error']))
				{
					$argv['logo'] = upload('Brand/', true);
				}
				$this->model->doUpdate($argv, $brandId);
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
<?php


/**
* 品牌类型管理
*/
class BrandTypeController extends AuthController
{
	private $model = null;

	public function __construct()
	{
		parent::__construct();
		$this->model = K('BrandType');
	}

	/**
	 * 品牌类型列表
	 */
	public function index()
	{
		$typeList = $this->model->getList();
		// p($typeList);
		$this->assign('typeList', $typeList);
		$this->display();
	}


	/**
	 * 添加品牌类型
	 */
	public function add()
	{
		$this->display();
	}

	/**
	 * 编辑修改
	 */
	public function edit()
	{
		$id = (int)Q('get.id');
		$oldData = $this->model->getOne($id);
		$this->assign('oldData', $oldData);
		$this->display();
	}

	/**
	 * 添加、修改操作
	 */
	public function operate()
	{
		$id = Q('post.id', 'intval', 0);
		$typeName = trim(Q('post.type_name'));

		if (!$this->model->create())
		{
			$this->error($this->model->error);
		}
		$argv = [
			'type_name' => $typeName
		];

		// 添加与修改操作
		if (0 == $id)
		{
			if ($this->model->isExists($typeName, 'type_name'))
			{
				$this->error('添加失败，该类型名称已存在');
			} else {
				$this->model->doInsert($argv);
				$this->success('添加成功', 'index');
			}
		} else {
			// 获取旧数据
			$oldName = $this->model->getOne($id, 'type_name', true);
			if (($typeName != $oldName) && ($this->model->isExists($typeName)))
			{
				$this->error('修改失败，该类型名称已存在');
			} else {
				$this->model->doInsert($argv);
				$this->success('修改成功', 'index');
			}
		}
	}

	/**
	 * 删除
	 */
	public function del()
	{
		$id = (int)Q('get.id');
		$this->model->doDelete($id);
		$this->success('删除成功', 'index');
	}
}
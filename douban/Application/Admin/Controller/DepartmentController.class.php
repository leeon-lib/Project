<?php

/**
* 部门管理控制器
*/
class DepartmentController extends AuthController
{
	private $model = null;

	public function __construct()
	{
		parent::__construct();
		$this->model = K('Department');
	}
	
	/**
	 * 部门列表
	 */
	public function index()
	{
		$where = '1 ';
		$argv = array(
			'where' => $where
		);
		$deptList = $this->model->getList($argv);
		$this->assign('deptList', $deptList);
		$this->display();
	}

	/**
	 * 添加部门
	 */
	public function add()
	{
		$deptList = Data::tree($this->model->getList(), 'name', 'id');
		$this->assign('deptList', $deptList);
		$this->display();
	}

	/**
	 * 编辑
	 */
	public function edit()
	{
		$id = (int)Q('get.id');
		$oldInfo = $this->model->getOne($id);
		$deptList = Data::tree($this->model->getList(), 'name', 'id');
		$this->assign('deptList', $deptList);
		$this->assign('oldInfo', $oldInfo);
		$this->display();
	}

	/**
	 * 部门的操作
	 */
	public function operate()
	{
		$pid = (int)Q('post.pid');
		$name = (Q('post.name'));
		// 添加与编辑的前台模板中的name不一样，添加时name为数组
		if (is_array($name))
		{
			$name = $this->rmEmpty($name);
		}
		if (empty($name))
		{
			$this->error('请填写部门！');
		}
		// 编辑
		if (isset($_POST['id']))
		{
			$id = (int)Q('post.id');
			$argv = array(
				'name' => $name,
				'pid'  => $pid
			);
			$this->model->_update($argv, $id);
			$this->success('修改成功', 'index');
		} else {//添加
			$argv = array();
			foreach ($name as $v)
			{
				$argv = array(
					'name' => $v,
					'pid' => $pid
				);
				$this->model->_insert($argv);
			}
			$this->success('添加成功', 'index');
		}
	}



	/**
	 * 去除数组空值
	 * @param  [array] $arr [description]
	 * @return [array]      [description]
	 */
	public function rmEmpty($arr)
	{
		foreach ($arr as $key => $val)
		{
			if (!is_array($val))
			{
				if (empty(trim($val)))
				{
					unset($arr[$key]);
				} else {
					$arr[$key] = $val;
				}
			} else {
				$arr[$key] = $this->rmEmpty($val);
			}
		}
		return $arr;
	}
}
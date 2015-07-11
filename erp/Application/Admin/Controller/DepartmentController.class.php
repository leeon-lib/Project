<?php

namespace Admin\Controller;
use Common\Controller\AuthController;

/**
* 部门管理控制器
*/
class DepartmentController extends AuthController
{
	private $deptModel = null;

	public function __construct()
	{
		parent::__construct();
		$this->deptModel = D('Department');
	}
	
	/**
	 * 部门列表
	 */
	public function index()
	{
		$where = '1 ';
		$argv = [
			'where' => $where
		];
		$deptList = $this->deptModel->getList($argv);
		$this->assign('deptList', $deptList);
		$this->display();
	}

	/**
	 * 添加部门
	 */
	public function add()
	{
		// 分配变量
		$deptList = $this->deptModel->getList();
		$this->assign('deptList', $deptList);
		$this->display();
	}

	/**
	 * 编辑
	 */
	public function edit()
	{
		$id = (int)I('get.id');
		$oldData = $this->deptModel->getOne($id);
		$deptList = $this->deptModel->getList();
		// p($oldData);
		// p($deptList);
		$this->assign('deptList', $deptList);
		$this->assign('oldData', $oldData);
		$this->display();
	}

	/**
	 * 部门的操作
	 * 添加、修改
	 */
	public function operate()
	{
		// 获取输入内容
		$pid = (int)I('post.pid');
		$name = rmEmpty(I('post.name'));		// 添加操作时，去除空值
		$deptId = (int)I('post.id', 'intval', 0);
		// 表单内容检测
		if (!$this->deptModel->create())
		{
			$this->error($this->deptModel->getError());
		}
		// 组合数据
		$argv = array(
			'name' => $name,
			'pid'  => $pid
		);
		// 添加与修改
		if (0 == $deptId)
		{	
			// 检测内容是否重复，如果有重复，则比对出未重复的部分，执行未重复部分的添加
			$repeatStr = $this->deptModel->isExists($name);
			if ($repeatStr)
			{
				$repeatArr = explode(',', $repeatStr);
				$name = array_diff($name, $repeatArr);
			}
			foreach ($name as $v)
			{
				$argv['name'] = $v;
				$this->deptModel->doInsert($argv);
			}
			// 重复与否的执行结果提示
			if ($repeatStr && (empty($name)))
			{
				$this->error("添加失败，'{$repeatStr}'已存在", U('index'));
			} elseif ($repeatStr && (!empty($name))) {
				$this->success("部分添加成功，'{$repeatStr}'已存在", U('index'));
			} else {
				$this->success('添加成功', U('index'));
			}
		} else {
			// 比对原值与用户输入值，如果名称与原值不同，则判断是否重复
			$oldData = $this->deptModel->getOne($deptId, 'name,pid');
			if (!array_diff($oldData, $argv))
			{
				$this->success('您未作任何修改', U('index'));
			}
			if ($name != $oldData['name'])
			{
				$res = $this->deptModel->isExists($name);
				if ($res){
					$this->error("修改失败，'{$res}'已存在");
				} else {
					// 非重复，执行修改
					$this->deptModel->doUpdate($argv, $deptId);
					$this->success('修改成功', U('index'));
				}
			}
			
		}
	}

	/**
	 * 删除部门
	 */
	public function del()
	{
		$id = (int)I('get.id');
		$this->deptModel->doDelete('id', $id);
		$this->success('删除成功', U('index'));
	}

}
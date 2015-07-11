<?php

namespace Admin\Controller;
use Common\Controller\AuthController;

/**
* 角色管理控制器
*/
class RoleController extends AuthController
{
	private $roleModel = null;
	private $roleList = null;
	private $deptList = null;

	public function __construct()
	{
		parent::__construct();
		$this->roleModel = D('Role');
		$this->roleList = $this->roleModel->getList();
		$this->deptList = D('Department')->getList(); 
	}
	
	/**
	 * 角色列表
	 */
	public function index()
	{
		$this->assign('roleList', $this->roleList);
		$this->assign('deptList', $this->deptList);
		$this->display();
	}

	/**
	 * 添加
	 */
	public function add()
	{
		$this->assign('deptList', $this->deptList);
		$this->display();
	}

	/**
	 * 编辑
	 */
	public function edit()
	{
		$id = (int)I('get.id');
		$oldData = $this->roleModel->getOne($id);
		$this->assign('oldData', $oldData);
		$this->assign('deptList', $this->deptList);
		$this->display();
	}


	/**
	 * 角色的操作
	 * 添加、修改
	 */
	public function operate()
	{
		// 获取输入内容
		$deptId = (int)I('post.department_id');
		$name = rmEmpty(I('post.name'));		// 添加操作时，去除空值
		// 表单内容检测
		if (!$this->roleModel->create())
		{
			$this->error($this->roleModel->getError());
		}
		// 组合数据
		$argv = array(
			'name' => $name,
			'pid'  => $pid
		);
		if (isset($_POST['id']))
		{	// 修改
			$id = (int)I('post.id');
			// 比对原值与用户输入值，如果名称被改变，则判断是否重复
			$oldName = $this->roleModel->getOne($id, 'name', true);
			if ($name != $oldName)
			{
				$repeatStr = $this->roleModel->isExists($name);
				if ($repeatStr){
					$this->error("保存失败，'{$repeatStr}'已存在");
				}
			}
			// 非重复，执行修改
			$this->roleModel->doUpdate($argv, $id);
			$this->success('修改成功', U('index'));
		} else {
			// 添加
			// 检测内容是否重复，如果有重复，则比对出未重复的部分，执行未重复部分的添加
			$repeatStr = $this->roleModel->isExists($name);
			if ($repeatStr)
			{
				$repeatArr = explode(',', $repeatStr);
				$name = array_diff($name, $repeatArr);
			}
			foreach ($name as $v)
			{
				$argv['name'] = $v;
				$this->roleModel->doInsert($argv);
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
		}
	}

	/**
	 * 删除角色
	 */
	public function del()
	{
		$id = (int)I('get.id');
		$this->roleModel->doDelete('id', $id);
		$this->success('删除成功', U('index'));
	}
}
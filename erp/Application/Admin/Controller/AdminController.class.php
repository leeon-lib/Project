<?php

namespace Admin\Controller;
use Common\Controller\AuthController;

/**
* 管理员管理控制器
*/
class AdminController extends AuthController
{
	private $adminModel = null;
	private $deptModel = null;
	private $roleModel = null;
	private $deptList = null;
	private $roleList = null;

	public function __construct()
	{
		parent::__construct();
		$this->adminModel = D('Admin');
		$this->deptModel = D('Department');
		$this->roleModel = D('Role');
		$this->deptList = $this->deptModel->getList();
		$this->roleList = $this->roleModel->getList();
	}

	/**
	 * 管理员搜索
	 */
	public function search()
    {
        // 获取搜索条件
        $adminId = (int)I('request.admin_id');
        $username = I('request.username');
		$realName = I('request.real_name');
		$phone = I('request.phone');
		$deptId = (int)I('request.department_id');
		$roleId = (int)I('request.role_id');
        // 拼接where语句的SQL
        $where = '';
        if (!empty($adminId))
        {
            $where .= " AND id = {$adminId}";
        }
        if (!empty($username))
        {
            $where .= " AND username = '{$username}' ";
        }
        if (!empty($realName))
        {
            $where .= " AND real_name LIKE '%{$realName}%' ";
        }
        if (!empty($phone))
        {
            $where .= " AND phone = '{$phone}' ";
        }
        if (!empty($deptId) && (-1 != $deptId))
        {
            $where .= " AND department_id = {$deptId}";
        }
        if (!empty($roleId) && (-1 != $roleId))
        {
            $where .= " AND role_id = {$roleId}";
        }
        return $where;
    }

	/**
	 * 管理员列表
	 */
	public function index()
	{
		$where = '1 ' . $this->search();
		// 获取列表信息
		$fields = [0 => 'password'];
		$argv = array(
			'field' => $fields,
			'where' => $where,
			'limit' => 20
		);
		$adminList = $this->adminModel->getList($argv);
		// 转换部门与角色信息
		if (!empty($adminList))
		{
			foreach ($adminList as $k=>$v) {
				$adminList[$k]['dept_name'] = $this->deptModel->getOne($v['department_id'], 'name', true);
				$adminList[$k]['role_name'] = $this->roleModel->getOne($v['role_id'], 'name', true);
			}
		}
		$this->assign('adminList', $adminList);
		$this->assign('deptList', $this->deptList);
		$this->assign('roleList', $this->roleList);
		$this->display();
	}
	
	/**
	 * 添加管理员
	 */
	public function add()
	{
		$this->assign('deptList', $this->deptList);
		$this->assign('roleList', $this->roleList);
		$this->display();
	}

	/**
	 * 编辑
	 */
	public function edit()
	{
		$aid = (int)I('get.id');
		$fields = [0 => 'password'];
		$oldData = $this->adminModel->getOne($aid, $fields);
		if (FALSE === $oldData)
		{
			$this->error('非法访问！');
		}
		$this->assign('oldData', $oldData);
		$this->assign('deptList', $this->deptList);
		$this->assign('roleList', $this->roleList);
		$this->display();
	}

	/**
	 * 管理员的操作
	 */
	public function operate()
	{
		// p($_POST);die;
		$username = trim(I('post.username'));
		$password = trim(I('post.password'));
		$realName = trim(I('post.real_name'));
		$mail = trim(I('post.mail'));
		$phone = trim(I('post.phone'));
		$deptId = (int)I('post.department_id');
		$roleId = (int)I('post.role_id');
		$isLock = (int)I('post.is_lock');
		// 表单数据验证
		if (!$this->adminModel->create())
		{
			$this->error($this->adminModel->getError());
		}
		// 组合数据
		$argv = array(
			'department_id' => $deptId,
			'role_id'  => $roleId,
			'real_name' => $realName,
			'mail' => $mail,
			'phone' => $phone
		);
		if (isset($_POST['id']))
		{
			// 编辑
			$id = (int)I('post.id');
			$argv['is_lock'] = $isLock;
			$this->adminModel->doUpdate($argv, $id);
			$this->success('修改成功', 'index');
		} else {
			// 添加
			$argv['username'] = $username;
			$argv['password'] = md5($password);
			$this->adminModel->doInsert($argv);
			$this->success('添加成功', 'index');
		}
	}

	/**
	 * 管理员锁定状态切换
	 */
	public function changeStatus()
	{
		$id = (int)I('get.id');
		$statusId = $this->adminModel->getOne($id, 'is_lock', true);
		if (0 == $statusId)
		{
			$this->adminModel->doUpdate(array('is_lock'=>1), $id);
		} else {
			$this->adminModel->doUpdate(array('is_lock'=>0), $id);
		}
		$this->redirect('index');
	}
}
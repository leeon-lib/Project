<?php

namespace Admin\Controller;
use Common\Controller\AuthController;

/**
* 管理员管理控制器
*/
class AdminController extends AuthController
{
	private $model = null;
	private $deptModel = null;
	private $roleModel = null;
	private $deptList = null;
	private $roleList = null;

	public function __construct()
	{
		parent::__construct();
		$this->model = D('Admin');
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
		$fields = 'id,username,mail,real_name,phone,last_login,is_lock,department_id,role_id';
		$argv = array(
			'field' => $fields,
			'where' => $where,
			'limit' => 20
		);
		$adminList = $this->model->getList($argv);
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
		$fields = 'id,username,mail,real_name,phone,is_lock,department_id,role_id';
		$oldInfo = $this->model->getOne($aid, $fields);
		if (FALSE === $oldInfo)
		{
			$this->error('非法访问！');
		}
		$this->assign('oldInfo', $oldInfo);
		$this->assign('deptList', $this->deptList);
		$this->assign('roleList', $this->roleList);
		$this->display();
	}

	/**
	 * 管理员的操作
	 */
	public function operate()
	{
		$username = I('post.username');
		$password = I('post.password');
		$realName = I('post.real_name');
		$mail = I('post.mail');
		$phone = I('post.phone');
		$deptId = (int)I('post.department_id');
		$roleId = (int)I('post.role_id');
		
		if (empty($username))
		{
			$this->error('用户名不可为空！');
		}
		if (empty($password))
		{
			$this->error('密码不可为空！');
		}
		if (-1 == $deptId)
		{
			$this->error('请选择部门！');
		}
		if (-1 == $roleId)
		{
			$this->error('请选择角色！');
		}

		// 编辑
		if (isset($_POST['id']))
		{
			$id = (int)I('post.id');
			$argv = array(
				'department_id' => $deptId,
				'role_id'  => $roleId,
				'real_name' => $realName,
				'mail' => $mail,
				'phone' => $phone
			);
			$this->model->_update($argv, $id);
			$this->success('修改成功', 'index');
		} else {//添加
			$argv = array(
				'username' => $username,
				'password' => md5($password),
				'department_id' => $deptId,
				'role_id'  => $roleId,
				'real_name' => $realName,
				'mail' => $mail,
				'phone' => $phone
			);
			$this->model->_insert($argv);
			$this->success('添加成功', 'index');
		}
	}

	/**
	 * 管理员锁定状态切换
	 */
	public function changeStatus()
	{
		$id = (int)I('get.id');
		$statusId = $this->model->getOne($id, 'is_lock', true);
		if (0 == $statusId)
		{
			$this->model->_update(array('is_lock'=>1), $id);
		} else {
			$this->model->_update(array('is_lock'=>0), $id);
		}
		go('index');
	}
}
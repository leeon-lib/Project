<?php

/**
* 用户管理控制器
*/
class UserController extends AuthController
{
	private $model = null;
	function __construct()
	{
		parent::__construct();
		$this->model = K('User');
	}

	/**
	 * 前台用户
	 */
	public function index()
	{
		$info = $this->model->where("is_admin=0")->all();
		$this->assign('info',$info);
		$this->display();
	}

	/**
	 * 后台用户
	 */
	public function admin()
	{
		$info = $this->model->where("is_admin=1")->all();
		$this->assign('info',$info);
		$this->display();
	}

	/**
	 * 改变锁定状态
	 */
	public function checkStatus()
	{
		$uid = (int)Q('get.uid');
		$lockId = $this->model->where("uid={$uid}")->getField('is_lock');
		if (0 == $lockId) {
			$this->model->where("uid={$uid}")->save(array('is_lock'=>1));
		} else {
			$this->model->where("uid={$uid}")->save(array('is_lock'=>0));
		}
		go(U('admin'));
	}
}
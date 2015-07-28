<?php

namespace Admin\Model;
use Common\Model\CommonModel;

/**
* 系统管理员模型
*/
class LoginModel extends CommonModel
{
	
	public $tableName = 'admin';

	public $_validate = [
		['username', 'require', '用户名未填写', 1],
		['password', 'require', '密码未填写', 1],
		['code', 'require', '验证码未填写', 1]
	];


	/**
	 * 用户验证
	 * @return boolean 验证结果
	 */
	public function checkIn($data=array())
	{
		$res = $this->field('id,username,password,is_lock')->where("username='{$data['username']}' ")->find();
		if (!$res || $data['password'] != $res['password'])
		{
			$this->error = '用户名或密码错误';
			return false;
		}
		if (1 == $res['is_lock'])
		{
			$this->error = '该用户已锁定';
			return false;
		}
		// 验证通过
		$this->where("id={$res['id']}")->save(array('last_login'=>time()));
		// 存session
		session('admin_id', $res['id']);
		session('admin_name', $res['username']);
		return true;
	}
	
}
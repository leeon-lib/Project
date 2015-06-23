<?php

/**
* 用户表模型
*/
class UserModel extends Model
{
	
	public $table = 'user';

	public $validate = array(
		array('username','nonull','用户名不能为空',2,3),
		array('password','nonull','密码未填写',2,3),
		array('code','nonull','验证码未填写',2,3)
	);

	public function login()
	{
		// 表单完整性验证
		if (!$this->create()) return false;
		$code = strtoupper(Q('post.code'));
		if ($code != $_SESSION['code']) {
			$this->error = '验证码错误';
			return false;
		}
		// 表单数据验证
		$username = strtolower(Q('post.username'));
		$password = md5(Q('post.password'));
		$info = $this->where("username='{$username}' ")->find();
		
		if (!$info || ($info['password'] != $password)) {
			$this->error = '用户名或者密码错误';
			return false;
		} elseif (0 == $info['is_admin']) {
			$this->error = '非管理员账户';
			return false;
		} elseif (1 == $info['is_lock']) {
			$this->error = '账户已锁定';
			return false;
		} else {
			// 验证正确，返回用户信息
			return $info;
		}
	}
	
}
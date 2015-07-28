<?php

/**
* 系统管理员模型
*/
class AdminModel extends Model
{
	
	public $table = 'admin';

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
		} elseif (1 == $info['is_lock']) {
			$this->error = '账户已锁定';
			return false;
		} else {
			// 验证正确，返回用户信息
			return $info;
		}
	}


	/**
	 * 获取多条系统管理员
	 */
	public function getList($argv = array())
	{
		if (empty($argv))
		{
			return $this->all();
		} else {
			$fields = isset($argv['field']) ? $argv['field'] : null;
			$where = isset($argv['where']) ? $argv['where'] : null;
			$limit = isset($argv['limit']) ? $argv['limit'] : 1000;
			return $this->field("{$fields}")->where("{$where}")->limit("{$limit}")->all();
		}
	}

	/**
	 * 获取一条管理员信息
	 * @param  integer $id     [主键]
	 * @param  string  $fields [字段名]
	 * @param  boolean $is_one [是否单一字段]
	 * @return [boolean]          [description]
	 */
	public function getOne($id = 0, $fields = '', $is_one = FALSE)
	{
		if (0 == $id)
		{
			return false;
		}
		if (empty($fields))
		{
			return $this->where("id={$id}")->find();
		} else {
			if (FALSE === $is_one)
			{
				return $this->field("{$fields}")->where("id={$id}")->find();
			} else {
				return $this->where("id={$id}")->getField("{$fields}");
			}
		}
	}

	/**
	 * 添加
	 * @param  array  $argv [要添加的数据]
	 * @return [boolean]    
	 */
	public function _insert($argv = array())
	{
		if (empty($argv))
		{
			return false;
		} else {
			return $this->add($argv);
		}
	}

	/**
	 * 修改
	 */
	public function _update($argv=array(), $id=0)
	{
		if (empty($argv) || (0 == $id))
		{
			return false;
		} else {
			return $this->where("id={$id}")->save($argv);
		}
	}

	
}
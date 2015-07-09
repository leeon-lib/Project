<?php

namespace Admin\Model;
use Think\Model;

/**
* 系统管理员模型
*/
class AdminModel extends Model
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
		$_SESSION['admin_id'] = $res['id'];
		$_SESSION['admin_name'] = $res['username'];
		return true;
	}


	/**
	 * 获取多条系统管理员
	 */
	public function getList($argv = array())
	{
		if (empty($argv))
		{
			return $this->select();
		} else {
			$fields = isset($argv['field']) ? $argv['field'] : null;
			$where = isset($argv['where']) ? $argv['where'] : null;
			$limit = isset($argv['limit']) ? $argv['limit'] : 1000;
			return $this->field("{$fields}")->where("{$where}")->limit("{$limit}")->select();
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
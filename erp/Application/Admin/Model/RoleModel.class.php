<?php

namespace Admin\Model;
use Think\Model;

/**
* 角色管理模型
*/
class RoleModel extends Model
{
	public $tableName = 'role';


	/**
	 * 获取角色列表
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
	 * 获取一条角色信息
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
	 * 添加角色
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
<?php

/**
* 公共模型
* 提供增删改查的共用接口
*/
class CommonModel extends Model
{

	/**
	 * 获取多条结果
	 */
	public function getList($argv = array())
	{
		if (empty($argv))
		{
			return $this->select();
		} else {
			$fields = isset($argv['field']) ? $argv['field'] : '';
			$where = isset($argv['where']) ? $argv['where'] : null;
			$limit = isset($argv['limit']) ? $argv['limit'] : 1000;
			if (is_array($fields))
			{
				return $this->field("{$fields[0]}", true)->where("{$where}")->limit("{$limit}")->select();
			} else {
				return $this->field("{$fields}")->where("{$where}")->limit("{$limit}")->select();
			}
		}
	}

	/**
	 * 获取一条结果
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
				if (is_array($fields))
				{
					return $this->field("{$fields[0]}", true)->where("id={$id}")->find();
				} else {
					return $this->field("{$fields}")->where("id={$id}")->find();
				}
			} else {
				return $this->where("id={$id}")->getField("{$fields}");
			}
		}
	}

	/**
	 * 执行插入数据
	 */
	public function doInsert($argv = array())
	{
		if (empty($argv))
		{
			return false;
		} else {
			return $this->add($argv);
		}
	}

	/**
	 * 执行修改数据
	 */
	public function doUpdate($argv=array(), $id=0)
	{
		if (empty($argv) || 0 == $id)
		{
			return false;
		} else {
			return $this->where("id={$id}")->save($argv);
		}
	}

	/**
	 * 执行删除数据
	 * @param  string $byField  条件字段
	 * @param  string $value    条件的值 
	 * @return boolean          删除结果
	 */
	public function doDelete($byField='', $value='')
	{
		if (('' == $byField) || ('' == $value))
		{
			return false;
		} else {
			$this->where("{$byField} = '{$value}' ")->delete();
			return true;
		}
	}

	/**
	 * 检测某字段内容是否存在
	 * 支持单一字符与一维数组的检测
	 * @param  string $value  需要检测的内容
	 * @param  string $field  指定检测的字段，默认字段名为name
	 * @return boolean        未重复返回false，重复了返回所有重复的内容
	 */
	public function isExists($value='', $field='name')
	{
		if (is_string($value))
		{
			$res = $this->where("{$field} = '{$value}' ")->find();
			if ($res)
			{
				return $value;
			} else {
				return false;
			}
		} elseif (is_array($value)) {
			// 先查询出所有给定的字段内容，再进行in_array判断
			$arr = $this->getField("{$field}", true);
			$str = '';
			foreach ($value as $v)
			{
				if (in_array($v, $arr))
				{
					$str .= $v . ',';	// 组合所有重复内容
				}
			}
			if ('' != $str)
			{
				return rtrim($str, ',');
			} else {
				return false;
			}
		}
	}
	
}
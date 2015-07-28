<?php

/**
* 商品管理模型
*/
class ProductModel extends Model
{
	public $table = 'product';
	public $validate = array(
		array('goods','nonull','货号不能为空',2,3),
		array('name','nonull','商品名称不能为空',2,3),
		array('marked_price','nonull','市场价不能为空',2,3)
	);

	
	/**
	 * 获取多条商品
	 * @param  array  $argv [description]
	 * @return [type]       [description]
	 */
	public function getList($argv = array())
	{
		if (empty($argv))
		{
			return $this->all();
		} else {
			$fields = isset($argv['field']) ? implode(',', $argv['field']) : null;
			$where = isset($argv['where']) ? $argv['where'] : null;
			$limit = isset($argv['limit']) ? $argv['limit'] : 1000;
			return $this->field("{$fields}")->where("{$where}")->limit("{$limit}")->all();
		}
	}

	/**
	 * 添加商品
	 * @param  array  $argv [description]
	 * @return [boolean]       [description]
	 */
	public function _insert($argv = array())
	{
		if (empty($argv))
		{
			return false;
		} else {
			if (!$this->checkName($argv['name']))
			{
				$this->error = '商品名称重复';
				return false;
			}
			if (!$this->checkGoods($argv['goods']))
			{
				$this->error = '商品货号重复';
				return false;
			}
			return $this->add($argv);
		}
	}

	/**
	 * 修改一条商品数据
	 * @return [boolean] 
	 */
	public function _update($argv=array(), $pid=0)
	{
		if ((empty($argv)) | (0 == $pid))
		{
			return false;
		} else {
			return $this->where("id = {$pid}")->save($argv);
		}
	}

	public function getAll()
	{
		$join = "__category__ c JOIN __product__ p ON p.category_id=c.cid";
		return M()->join("$join")->all();
	}

	/**
	 * 验证商品名称是否重复
	 */
	public function checkName($name)
	{
		$res = $this->where("name = '{$name}' ")->find();
		if ($res)
		{
			return false;
		} else {
			return true;
		}
	}

	/**
	 * 验证商品货号是否重复
	 * @param  [string] $goods [description]
	 * @return [boolean]        [description]
	 */
	public function checkGoods($goods)
	{
		$res = $this->where("goods = '{$goods}' ")->find();
		if ($res)
		{
			return false;
		} else {
			return true;
		}
	}
	
}
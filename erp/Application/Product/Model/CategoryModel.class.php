<?php

namespace Product\Model;
use Think\Model;

/**
* 分类管理模型
*/
class CategoryModel extends Model
{
	public $tableName = 'category';

	/**
	 * 添加、编辑分类
	 * @param  [array]  $data [需要处理的数据]
	 * @param  integer  1 [添加]
	 * @return [int]     [返回添加的数据的主键]
	 * @param  integer  2 [编辑]
	 * @return [boolean]  [true]
	 */
	public function intoCate($data,$type=1)
	{
		switch ($type) {
			case 1:
				$this->add($data);
				break;

			case 2:
				$this->where("id={$data['cid']}")->save($data);
				break;
			
			default:
				return false;
				break;
		}
	}

	/**
	 * 递归获取所有子分类id
	 */
	public function getSub($data,$cid)
	{
		static $temp = array();
		foreach($data as $v) {
			if ($v['pid'] == $cid) {
				$temp[] = $v['cid'];
				$this->getSub($data,$v['cid']);
			}
		}
		return $temp;
	}

	/**
	 * 验证添加的分类名称是否已存在
	 * @param  [string] $name
	 * @return [boolean]       [如果存在则返回假]
	 */
	public function checkName($name)
	{
		$res = $this->where("name = '{$name}' ")->find();
		if ($res)
		{
			return true;
		} else
		{
			return false;
		}
	}

	/**
	 * 生成分类id
	 * @param  [int] $pid [父级分类id，顶级分类则为0]
	 * @return [int] $cid [按规则生成的分类id]
	 */
	public function createCateId($pid)
	{
		$cidArr = $this->field("cid")->where("pid={$pid}")->order('id asc')->all();
		switch ($pid) {
			case 0:
				if (empty($cidArr)) {
					$cid = 100;
				} else {
					$lastCid = current(array_pop($cidArr));
					$cid = $lastCid + 100;
				}
				break;
			default:
				if (empty($cidArr)) {
					$cid = $pid *100 + 1;
				} else {
					$lastCid = current(array_pop($cidArr));
					$cid = $lastCid + 1;
				}
				break;
		}
		return $cid;
	}
}
<?php

namespace Storage\Model;
use Common\Model\CommonModel;

/**
* 库房管理模型
*/
class WarehouseModel extends CommonModel
{
	
	public $tableName = 'warehouse';
	
	public $_validate = [
		['city_id', '-1', '请选择库房所在地区', 1, 'notequal'],
		['name', 'require', '库房名称不能为空', 1]
	];


	/**
	 * 生成库房Key
	 */
	public function makeKey()
	{
		$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$key = '';
		for ($i=0; $i < 4; $i++) { 
			$key .= $str[mt_rand(0, 61)];
		}
		if ($this->field('1')->where("key_id='{$key}' ")->find())
		{
			$this->makeKey();
		} else {
			return $key;
		}
	}
}
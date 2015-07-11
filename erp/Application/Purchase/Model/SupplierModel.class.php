<?php

namespace Purchase\Model;
use Common\Model\CommonModel;

/**
* 供应商管理模型
*/
class SupplierModel extends CommonModel
{
	
	public $tableName = 'supplier';



	/**
	 * 生成Key
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
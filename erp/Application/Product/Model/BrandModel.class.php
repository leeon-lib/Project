<?php

namespace Product\Model;
use Common\Model\CommonModel;

/**
* 品牌管理模型
*/
class BrandModel extends CommonModel
{
	public $tableName = 'brand';

	public $validate = array(
		array('name','nonull','品牌名称不能为空',2,3),
		array('en_name','nonull','英文名称不能为空',2,3)
	);

	public function intoBrand()
	{
		if (!$this->create()) {
			return false;
		} else {
			$this->add();
			return true;
		}
	}
}
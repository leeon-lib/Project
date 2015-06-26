<?php

/**
* 品牌管理模型
*/
class BrandModel extends Model
{
	public $table = 'brand';

	public $validate = array(
		array('bname','nonull','品牌名称不能为空',2,3),
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
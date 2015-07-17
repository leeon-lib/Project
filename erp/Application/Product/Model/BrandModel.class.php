<?php

namespace Product\Model;
use Common\Model\CommonModel;

/**
* 品牌管理模型
*/
class BrandModel extends CommonModel
{
	public $tableName = 'brand';

	public $_validate = [
		['name', 'require', '品牌名称不可为空', 1]
	];


}
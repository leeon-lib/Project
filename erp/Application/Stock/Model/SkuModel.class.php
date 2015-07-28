<?php

namespace Stock\Model;
use Common\Model\CommonModel;

/**
* SKU管理模型
*/
class SkuModel extends CommonModel
{
	public $tableName = 'sku';
	public $_validate = [
		['goods', 'require', '货号不能为空', 1],
		['size', 'require', '规格不能为空', 1],
		['bar_code', 'require', '条形码不能为空', 1]
	];


}
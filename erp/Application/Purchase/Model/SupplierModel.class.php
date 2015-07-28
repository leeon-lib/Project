<?php

namespace Purchase\Model;
use Common\Model\CommonModel;

/**
* 供应商管理模型
*/
class SupplierModel extends CommonModel
{
	
	public $tableName = 'supplier';

	public $_validate = [
		['name', 'require', '供应商名称不能为空', 1],
		['brand_id', '_checkBrand', '请选择品牌', 1, 'callback'],
		['email', 'email', '邮箱格式不正确', 2]
	];

	// protected $_link = [
	// 	'Brand'			=> [
	// 		'mapping_type' => self::MANY_TO_MANY,
	// 		// 'class_name'   => 'Brand',
	// 		// 'foreign_key'  => 'supplier_id',
	// 		'mapping_fields' => 'name',
	// 		'relation_table' => 'supplier_brand'
	// 	],

	// ];

	// 表单的品牌验证
	public function _checkBrand()
	{
		$brandId = I('post.brand_id');
		if (empty($brandId) || ('-1' == $brandId))
		{
			return false;
		} else {
			return true;
		}
	}


}
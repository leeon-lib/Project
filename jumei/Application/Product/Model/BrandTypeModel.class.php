<?php


/**
* 品牌类型管理模型
*/
class BrandTypeModel extends CommonModel
{
	
	public $table = 'brand_type';

	public $validate = [
		['type_name', 'nonull', '类型名称不能为空', 2, 3]
	];
}
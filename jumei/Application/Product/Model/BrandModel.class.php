<?php

/**
* 品牌管理模型
*/
class BrandModel extends CommonModel
{
	public $table = 'brand';

	public $validate = array(
		['name','nonull','品牌名称不能为空',2,3],
		['type_id', 'num:1,99', '请选择品牌类型', 2, 3]
	);



}
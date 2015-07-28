<?php

namespace Product\Model;
use Common\Model\CommonModel;

/**
* 商品详情模型
*/
class ProductDetailsModel extends CommonModel
{
	public $tableName = 'product_details';

	/**
	 * 添加、编辑商品详情表
	 */
	public function intoDetails($data)
	{
		if (!empty($data)) {
			$this->add($data);
		}
	}
}
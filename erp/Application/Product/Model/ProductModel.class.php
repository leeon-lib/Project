<?php

namespace Product\Model;
use Common\Model\CommonModel;

/**
* 商品管理模型
*/
class ProductModel extends CommonModel
{
	public $tableName = 'product';
	public $_validate = [
		['name', 'require', '商品名称不能为空', 1],
		['goods', 'require', '货号不能为空', 1],
		['manuf_date', 'require', '上市日期不能为空'],
		['marked_price', 'require', '市场价不能为空'],
		['marked_price', 'currency', '市场价格式不正确'],
		['category_cid', '-1', '请选择所属分类', 1, 'notequal'],
		['brand_id', '-1', '请选择所属品牌', 1, 'notequal']
	];


	/**
	 * 验证商品名称是否重复
	 */
	public function checkName($name)
	{
		$res = $this->where("name = '{$name}' ")->find();
		if ($res)
		{
			return false;
		} else {
			return true;
		}
	}

	/**
	 * 验证商品货号是否重复
	 * @param  [string] $goods [description]
	 * @return [boolean]        [description]
	 */
	public function checkGoods($goods)
	{
		$res = $this->where("goods = '{$goods}' ")->find();
		if ($res)
		{
			return false;
		} else {
			return true;
		}
	}
	
}
<?php

namespace Purchase\Model;
use Common\Model\CommonModel;

/**
* 采购单管理模型
*/
class PurchaseModel extends CommonModel
{

	public $tableName = 'purchase_order';

	public $_validate = [
		['supplier_id', '-1', '供应商未选择', 1, 'notequal'],
		['warehouse_id', '-1', '库房未选择', 1, 'notequal'],
		['sale_type', '-1', '销售方式未选择', 1, 'notequal']
	];

	/**
	 * 生成采购单号
	 */
	public function createOrder()
	{
		$str = 'PI-' . date('ymd') . '-';
		$res = $this->order('id DESC')->limit(1)->find();
		$res = substr($res['purchase_sn'], -3);
		if (!$res)
		{
			$str .= '001';
			return $str;
		} else {
			$len = strlen(++$res);
			switch ($len) {
				case 1:
					$str .= sprintf("%03d", $res);
					return $str;
				case 2:
					$str .= sprintf("%01d", $res);
					return $str;
				default:
					$str .= $res;
					return $str;
			}
		}
	}
}
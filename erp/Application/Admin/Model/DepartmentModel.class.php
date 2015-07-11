<?php

namespace Admin\Model;
use Common\Model\CommonModel;

/**
* 部门管理模型
*/
class DepartmentModel extends CommonModel
{
	public $tableName = 'department';

	public $_validate = [
		['name', '_checkEmpty', '部门名称不能为空', 1, 'callback']
	];


	/**
	 * 验证表单名称是否为空
	 * @return [type] [description]
	 */
	public function _checkEmpty()
	{
		$name = rmEmpty($_POST['name']);
		if (empty($name))
		{
			return false;
		}
		return true;
	}
}
<?php

namespace Admin\Model;
use Common\Model\CommonModel;

/**
* 角色管理模型
*/
class RoleModel extends CommonModel
{
	public $tableName = 'role';

	public $_validate = [
		['name', '_checkEmpty', '角色名称不能为空', 1, 'callback']
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
<?php

namespace Admin\Model;
use Common\Model\CommonModel;

/**
* 系统管理员模型
*/
class AdminModel extends CommonModel
{
	
	public $tableName = 'admin';

	public $_validate = [
		['department_id', '-1', '请选择部门', 1, 'notequal'],
		['role_id', '-1', '请选择角色', 1, 'notequal'],
		['username', 'require', '用户名未填写'],
		['username', '/^[0-9a-z_-]*$/i', '用户名格式不正确', 0, 'regex'],
		['username', '3,20', '用户名长度请保持在3－20位字符', 0, 'length'],
		['password', 'require', '密码未填写', 0],
		['mail', 'email', '邮箱格式不正确', 2],
		['phone', 'number', '电话格式不正确', 2],
	];



	
}
<?php
/**
* 验证类
*/
class AuthController extends Controller
{
	
	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['aid']) || !isset($_SESSION['aname'])) {
			// $this->success('未登录或长时间未操作',go('http://www.baidu.com/'));
		}
	}
}
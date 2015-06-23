<?php

/**
* 启动框架的核心类
*/
class lf_action
{

	/**
	* 运行器
	*/
	public static function run()
	{
		// 创建用户文件夹
		self::createDir();
		// 自动载入类
		spl_autoload_register(array(__CLASS__,'autoload'));

		$controller = isset($_GET['c']) ? $_GET['c'] : 'Login';
		$action = isset($_GET['a']) ? $_GET['a'] : 'index';

		$obj = new $controller;
		$obj->$action();
	}

	/**
	* 创建项目文件目录
	*/
	private static function createDir()
	{
		$dirArr = array(
			APP_PATH,
			ROOT_CONFIG_PATH
		);
		foreach ($dirArr as $v) {
			file_exists($v) || mkdir($v);
		}
		
	}

	/**
	* 自动载入
	*/
	private static function autoload($fileName)
	{
		$path = APP_NAME .'/Admin/'. $fileName . '_action.php';
//		 echo $path;die;
		include $path;
	}
}
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
		//1.自动载入类
		spl_autoload_register(array(__CLASS__,'autoload'));
		//2.设置外部路径
		self::setUrl();
		
		$controller = isset($_GET['c']) ? ($_GET['c']) : 'login';
		$action = isset($_GET['a']) ? $_GET['a'] : 'index';
		$obj = new $controller;
		$obj->$action();
	}

	/**
	* 创建项目文件目录
	*/
	private static function setUrl()
	{
		$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
		$url = str_replace('\\','/',$url);
		define('__APP__', $url);
		define('__ROOT__', dirname(__APP__));
		define('__VIEW__', __ROOT__ .'/'. APP_NAME . '/View');
		define('__PUBLIC__',  __ROOT__ . '/Public');
	}

	/**
	* 自动载入
	*/
	private static function autoload($fileName)
	{
		// 应用控制路径
		$path = APP_CONTROLLER_PATH .'/'. $fileName . '_action.php';
		if (!file_exists($path)){
			echo "{$path} is not exists!";die;
		}
		include_once $path;
	}
}
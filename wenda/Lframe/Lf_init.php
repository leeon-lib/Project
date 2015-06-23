<?php

/**
 * 框架初始化类
 * 
 */
class Lf_init
{
	/**
	 * 框架运行器
	 */
	public static function run()
	{
		// 1、设置常量
		$path =  str_replace('\\', '/', __FILE__);
		// 定义框架目录
		define('LF_PATH', dirname($path) . '/');
		// 载入常量配置文件
		include_once LF_PATH . '/Config/Constant.php';
		
		// 2、创建用户文件夹
		self::_createDir();
		// 3、载入框架核心类
		self::_loadCore();
		// 4、执行应用类
		Lf_action::run();
	}
	
	/**
	 * 创建用户文件夹
	 */
	private static function _createDir()
	{
		$dirArr = array(
			APP_CONFIG_PATH,
			APP_PUBLIC_PATH,
			APP_PATH,
			APP_CONTROLLER_PATH,
			APP_VIEW_PATH,
                        APP_COMPILE_PATH,
                        APP_CACHE_PATH
		);
		foreach ($dirArr as $v) {
			is_dir($v) || mkdir($v,0777,true);
		}
	}
	
	/**
	 * 载入框架核心类
	 */
	private static function _loadCore()
	{
		$coreArr = array(
                        //载入SmartyView类
                        LIB_PATH . 'SmartyView.class.php',
			// 应用执行类
			LIB_PATH . 'Lf_action.php',
			// 总控制器类
			LIB_PATH . 'Lf_controller.php',
			// 核心函数
			FUNCTION_PATH . 'functions.php'
		);
		foreach	($coreArr as $v) {
			if (!file_exists($v)) {
				die($v . ' is not found!');
			}
			require_once $v;
		}
	}
}

<?php
/**
 * vim: et ts=4 sts=4 sw=4
 *
 * 初始化
 *
 *
 * @author	
 * @copyright 
 * @version   
 */
class lf_init{
	
	/**
	 * 框架初始化
	 */
	public static function run(){
		//1.设置常量
		header("Content-type:text/html;charset=utf-8");
		define('LF_PATH', dirname(str_replace('\\', '/', __FILE__)));
		include_once LF_PATH . '/Config/constant.config.php';
		include_once LF_PATH . '/load.php';
		//2.创建用户文件夹
		self::createDir();
		//3.载入核心类
		lf_load::include_lib('lf_action');
		lf_load::include_lib('lf_controller');
		//载入函数
		lf_load::include_lib('functions');
		self::init();
		//4.启动应用类
		lf_action::run();
	}
	
	/**
	 * 创建用户文件夹
	 */
	private static function createDir(){
		$dirArr = array(
			CONFIG_PATH,
			APP_PUBLIC,
			APP_PATH
		);
		foreach ($dirArr as $v){
			is_dir($v) || mkdir($v,0777,true);
		}
	}
	
	/**
	 * 初始化
	 */
	 private static function init(){
	 	//加载配置项
	 	$sysConfigPath = LF_CONFIG_PATH . '/Config.php';
	 	$userConfigPath = CONFIG_PATH . '/Config.php';
		$userConfig = <<<str
<?php

	return array(
		//配置项 => 配置值,
	);
	
?>
str;
		is_file($userConfigPath) || file_put_contents($userConfigPath, $userConfig);
		Conf(include $sysConfigPath);
		Conf(include $userConfigPath);
		
		// 时区、缓存
		date_default_timezone_set('PRC');
		session_id() || session_start();
	 }
}

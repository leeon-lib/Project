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

define('LF_ROOT', dirname(__FILE__));					//定义框架根目录
require_once LF_ROOT . '/Config/constant.config.php';	//载入常量配置文件
require_once LF_CONFIG_PATH . '/config.php';			//载入框架配置文件
require_once LF_ROOT . '/load.php';						//开启自动载入



//载入核心类
lf_load::include_lib('lf_action');
lf_load::include_lib('lf_controller');
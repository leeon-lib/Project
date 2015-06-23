<?php

/*
 *
 * 配置文件
 *
 * 常量配置
 *
 */
// 定义核心类库目录
if (!defined('LIB_PATH'))
{
	define('LIB_PATH' , LF_ROOT . '/lib');
}
// 定义配置文件目录
if (!defined('LF_CONFIG_PATH'))
{
	define('LF_CONFIG_PATH', LF_ROOT . '/Config');
}
// 定义项目根目录
if (!defined('ROOT_PATH'))
{
	define('ROOT_PATH', dirname(LF_ROOT));
}
// 定义项目配置文件目录
if (!defined('ROOT_CONFIG_PATH')){
	define('ROOT_CONFIG_PATH', ROOT_PATH . '/Config');
}
//  定义项目数据库目录
if (!defined('DB_PATH')){
	define('DB_PATH', ROOT_PATH . '/Database');
}
// 定义应用目录
if (!defined('APP_PATH'))
{
	define('APP_PATH', ROOT_PATH . '/' . APP_NAME);
}
// 



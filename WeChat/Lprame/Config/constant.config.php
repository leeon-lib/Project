<?php

/*
 *
 * 配置文件
 *
 * 常量配置
 *
 */
 /*********框架目录配置********/
// 定义框架配置文件目录
if (!defined('LF_CONFIG_PATH'))
{
	define('LF_CONFIG_PATH', LF_PATH . '/Config');
}
// 定义核心类库目录
if (!defined('LIB_PATH'))
{
	define('LIB_PATH' , LF_PATH . '/Lib');
}
// 定义数据库核心类库目录
if (!defined('DB_LIB_PATH')){
	define('DB_LIB_PATH',LF_PATH . '/Db_lib');
}
// 定义框架公用资源目录
if (!defined('LF_RESOURCES_PATH')){
	define('LF_RESOURCES_PATH', LF_PATH . '/Resources');
}
// 定义框架扩展文件目录
if (!defined('EXTEND_PATH')){
	define('EXTEND_PATH', LF_PATH . '/Extend');
}

 /*********项目目录配置********/
// 定义项目根目录
if (!defined('ROOT_PATH'))
{
	define('ROOT_PATH', dirname(LF_PATH));
}
// 定义项目配置文件目录
if (!defined('CONFIG_PATH')){
	define('CONFIG_PATH', ROOT_PATH . '/Config');
}
// 定义项目公用文件目录
if (!defined('APP_PUBLIC')){
	define('APP_PUBLIC', ROOT_PATH . '/Public');
}
// 定义应用目录
if (!defined('APP_PATH')){
	define('APP_PATH', ROOT_PATH .'/'. APP_NAME);
}
//// 定义应用模块目录
//if (!defined('APP_MODEL_PATH')){
//	define('APP_MODEL_PATH', APP_PATH . '/Model');
//}
//// 定义应用视图模版目录
//if (!defined('APP_VIEW_PATH')){
//	define('APP_VIEW_PATH', APP_PATH . '/View');
//}
// 定义应用控制器目录
if (!defined('APP_CONTROLLER_PATH')){
	define('APP_CONTROLLER_PATH', APP_PATH . '/Admin');
}






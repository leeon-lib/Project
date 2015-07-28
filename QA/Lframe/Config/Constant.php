<?php

/*********************
 * 配置文件
 * 常量配置
 *********************/
 
 /******框架目录配置******/
// 框架配置文件目录
defined('LF_CONFIG_PATH') or define('LF_CONFIG_PATH', LF_PATH . 'Config/');
// 核心类库目录
defined('LIB_PATH') or define('LIB_PATH' , LF_PATH . 'Library/');
// 核心函数目录
defined('FUNCTION_PATH') or define('FUNCTION_PATH' , LIB_PATH . 'Function/');
// 扩展类库
defined('EXTEND_PATH') or define('EXTEND_PATH', LF_PATH . 'Extend/');
// 工具类扩展库
defined('TOOL_PATH') or define('TOOL_PATH', EXTEND_PATH . 'Tool/');
// 第三方扩展包
defined('ORG_PATH') or define('ORG_PATH', EXTEND_PATH . 'Org/');
// 数据库核心类库目录
defined('DB_LIB_PATH') or define('DB_LIB_PATH',LF_PATH . 'Db_lib/');
// 框架公用资源目录
defined('LF_RESOURCES_PATH') or define('LF_RESOURCES_PATH', LF_PATH . 'Resources/');
// 框架扩展文件目录
defined('EXTEND_PATH') or define('EXTEND_PATH', LF_PATH . 'Extend/');

 /*********项目目录配置********/
// 项目根目录
defined('ROOT_PATH') or define('ROOT_PATH', dirname(LF_PATH) . '/');
// 项目配置文件目录
defined('APP_CONFIG_PATH') or define('APP_CONFIG_PATH', ROOT_PATH . 'Config/');
// 项目公用文件目录
defined('APP_PUBLIC_PATH') or define('APP_PUBLIC_PATH', ROOT_PATH . 'Public/');
// 应用目录
defined('APP_PATH') or define('APP_PATH', ROOT_PATH . APP_NAME . '/');
// 应用视图模版目录
defined('APP_VIEW_PATH') or define('APP_VIEW_PATH', APP_PATH . 'View/');
// 应用控制器目录
defined('APP_CONTROLLER_PATH') or define('APP_CONTROLLER_PATH', APP_PATH . 'Controller/');
// Smarty临时目录
defined('APP_TEMP_PATH') or define('APP_TEMP_PATH', APP_PATH . 'Temp/');
// Smarty编译目录
defined('APP_COMPILE_PATH') or define('APP_COMPILE_PATH', APP_TEMP_PATH . 'Compile/');
// Smarty缓存目录
defined('APP_CACHE_PATH') or define('APP_CACHE_PATH', APP_TEMP_PATH . 'Cache/');






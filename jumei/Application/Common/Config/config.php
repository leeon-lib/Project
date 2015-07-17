<?php
if (!defined("HDPHP_PATH"))exit('No direct script access allowed');
//更多配置请查看hdphp/Config/config.php
return array(
    /********************************基本参数********************************/
    'AUTO_LOAD_FILE'                => array(),     //自动加载文件
    /********************************数据库********************************/
    'DB_DRIVER'                     => 'mysqli',    //驱动
    'DB_CHARSET'                    => 'utf8',      //字符集
    'DB_HOST'                       => '127.0.0.1', //主机
    'DB_PORT'                       => 3306,        //端口
    'DB_USER'                       => 'root',      //帐号
    'DB_PASSWORD'                   => 'root',      //密码
    'DB_DATABASE'                   => 'b2c',       //数据库
    'DB_PREFIX'                     => '',          //表前缀
    /********************************模板参数********************************/
    'TPL_PATH'                      => 'View',      //目录
    'TPL_FIX'                       => '.html',     //文件扩展名
    'TPL_TAGS'                      => array(),     //标签类
    /********************************URL路由********************************/
    'ROUTE'                         => array(),     //路由配置

    /********************************自定义配置********************************/
    'DEFAULT_MODULE'                => 'Admin',     //默认模块
    'DEFAULT_CONTROLLER'            => 'Index',     //默认控制器
    'DEFAULT_ACTION'                => 'index',     //默认方法
    'CODE_LEN'                      => 1,           //验证码长度
    'UPLOAD_ALLOW_TYPE'             => array('jpg','jpeg','gif','png','zip','rar','doc','txt','csv'),//允许上传类型
    'CITY_LIST'                     => array(
                1 => '北京',
                2 => '上海',
                3 => '深圳',
                4 => '厦门',
                5 => '青岛',
                6 => '杭州',
                7 => '沈阳',
                8 => '成都',
                9 => '武汉',
                10 => '郑州',
        ),
    'SALE_TYPE'                     => array(
                1 => '经销',
                2 => '实库代销',
                3 => '虚库代销',
                4 => '虚库买断'
        ),
);
?>
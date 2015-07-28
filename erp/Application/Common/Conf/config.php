<?php
return array(
	/* 应用配置 */
	'DEFAULT_MODULE'        =>  'Admin',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Login', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'erp',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '111',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  '',    // 数据库表前缀
    'DB_PARAMS'          	=>  array(), // 数据库连接参数    
    'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
    'DB_DEPLOY_TYPE'        =>  0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'DB_RW_SEPARATE'        =>  false,       // 数据库读写是否分离 主从式有效
    'DB_MASTER_NUM'         =>  1, // 读写分离后 主服务器数量
    'DB_SLAVE_NO'           =>  '', // 指定从服务器序号
    /* 模板配置 */
    'TMPL_L_DELIM'          =>  '-{',            // 模板引擎普通标签开始标记
    'TMPL_R_DELIM'          =>  '}-',            // 模板引擎普通标签结束标记
    /* 文件上传 */
    'UPLOAD_PATH'           =>  './Attached/',
    'THUMB_W'               =>  50,
    'THUMB_H'               =>  50,

    /* 自定义常量 */
    'CITY_LIST'             => [
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
    ],
    'SALE_TYPE'             => [
            1 => '经销',
            2 => '实库代销',
            3 => '虚库代销',
            4 => '虚库买断'
    ],
    'PURCHASE_STATUS'       => [
        1   => '采购中',
        2   => '已到货',
        3   => '部分入库',
        4   => '全部入库',
        5   => '采购完成'
    ],
);
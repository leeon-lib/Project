<?php

/**
 * 启动框架的核心类
 */
class Lf_action {

    /**
     * 运行器
     */
    public static function run() {
        //1.自动载入类
        spl_autoload_register(array(__CLASS__, 'autoload'));
        //2.设置外部路径
        self::_setUrl();
        //3.参数配置
        $sysConfPath = include_once LF_CONFIG_PATH . 'config.php';
        C($sysConfPath);

        //设置时区
        date_default_timezone_set('PRC');
        //如果有了session_id证明已经开启了session
        session_id() || session_start();

        $controller = isset($_GET['c']) ? ucfirst($_GET['c']) : 'Index';
        define('CONTROLLER', $controller);
        $controller .= '_action';
        $action = isset($_GET['a']) ? $_GET['a'] : 'index';
        define('ACTION', $action);
        $obj = new $controller;
        $obj->$action();
    }

    /**
     * 创建项目文件目录
     */
    private static function _setUrl() {
        $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];
        $url = str_replace('\\', '/', $url);
        define('__APP__', $url . '/');
        define('__ROOT__', dirname(__APP__) . '/');
        define('__VIEW__', __ROOT__ . '/' . APP_NAME . '/View/');
        define('__PUBLIC__', __ROOT__ . 'Public/');
    }

    /**
     * 自动载入
     */
    private static function autoload($fileName) {
        // 应用控制路径
        $path = APP_CONTROLLER_PATH . $fileName . '.php';
        if (!file_exists($path)) {
            $path = TOOL_PATH . $fileName . '.class.php';
            if (!file_exists($path)) {
                die($path . ' is not exists!');
            }
        }
        include_once $path;
    }

}

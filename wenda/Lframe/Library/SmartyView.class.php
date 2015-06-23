<?php

//载入Smarty
require ORG_PATH . "Smarty/Smarty.class.php";

/**
 * 框架与Smarty建议连接
 */
class SmartyView {

    private static $smarty = NULL;

    /**
     * 构造函数
     */
    public function __construct()
    {
        if (!is_null(self::$smarty)) {
            return;
        }
        $smarty = new Smarty;                                       //配置Smarty
        $smarty->template_dir = APP_VIEW_PATH . CONTROLLER . '/';   //模版目录
        $smarty->compile_dir = APP_COMPILE_PATH;                    //编译目录
        $smarty->cache_dir = APP_CACHE_PATH;                        //缓存目录
        $smarty->caching = C('CACHE_ON');                           //是否缓存
        $smarty->cache_lifetime = C('CACHE_TIME');                  //缓存时间
        $smarty->register_block("nocache", "nocache", false);       //注册不缓存块
        $smarty->left_delimiter = C("LEFT_DELIMITER");              //开始定界
        $smarty->right_delimiter = C("RIGHT_DELIMITER");            //结束定界符
        self::$smarty = $smarty;
    }

    /**
     * 载入模板
     */
    protected function display() {
        //var_dump(self::$smarty);
        //组合模板路径
        $file = APP_VIEW_PATH . CONTROLLER . '/' . ACTION . '.tpl.html';
        if (!file_exists($file)) {
            halt("{$file} 模板不存在! ");
        }
        //调用smarty载入模板
        self::$smarty->display($file);
    }

    /**
     * 分配变量
     */
    protected function assign($var, $value) {
        //调用smarty分配变量
        self::$smarty->assign($var, $value);
    }

    /**
     * 检测缓存是否失效
     */
    protected function is_cached() {
        //组合模板路径
        $file = APP_VIEW_PATH . CONTROLLER . '/' . ACTION . '.tpl.html';
        if (!is_file($file))
            halt("{$file} 模板不存在 ): ");
        //调用Smarty的is_cached，判断缓存是否失效
        return self::$smarty->is_cached($file);
    }

}

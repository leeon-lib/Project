<?php
/**
 * 后台主页控制器类
 */
class IndexController extends AuthController{
    /**
     * 后台首页
     * @return [type] [description]
     */
    public function index(){




        //显示视图
        $this->display();
    }

    /**
     * 后台欢迎页面
     */
    public function welcome()
    {
    	$this->display();
    }


	
}

<?php
// 前台控制器类
class IndexController extends Controller
{
    // 首页
    public function read()
    {

        $this->display();
    }

    /**
     * 列表页
     */
    public function read_list()
    {
    	$this->display();
    }
}

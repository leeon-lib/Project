<?php

/**
* 分类管理控制器
*/
class CategoryController extends AuthController
{
    /**
     * 分类列表
     */
    public function index()
    {
        
        $this->display();
    }

    /**
     * 添加分类
     */
    public function add()
    {
    	$this->display();
    }
}


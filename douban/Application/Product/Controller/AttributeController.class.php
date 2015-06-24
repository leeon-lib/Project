<?php

/**
* 属性管理控制器
*/
class AttributeController extends AuthController
{
	
	/**
     * 属性列表
     */
    public function index()
    {
        
        $this->display();
    }

    /**
     * 添加属性
     */
    public function add()
    {
        if (IS_POST) {
            echo '1';
        }
    	$this->display();
    }

    /**
     * 批量导入
     */
    public function implode()
    {
        echo 'hi';
    }
}
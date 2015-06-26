<?php

/**
* 
*/
class ProductController extends AuthController
{
	
	/**
     * 商品列表
     */
    public function index()
    {
    	$this->display();
    }

    /**
     * 添加商品
     */
    public function add()
    {
    	$this->display();
    }
}
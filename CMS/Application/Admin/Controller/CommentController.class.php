<?php

/**
* 评论管理控制权
*/
class CommentController extends AuthController
{
	private $model;	
	function __construct()
	{
		parent::__construct();
		$this->model = K('Comment');
	}

	public function index()
	{
		$info = $this->model->all();
		$this->assign('info',$info);
		$this->display();
	}
}
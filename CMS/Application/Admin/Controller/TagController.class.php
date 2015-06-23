<?php

/**
* 标签控制器
*/
class TagController extends AuthController
{
	private $model;

	public function __construct()
	{
		parent::__construct();
		$this->model = K('Tag');
	}

	/**
	 * 标签主页
	 */
	public function index()
	{
		$info = $this->model->all();

		$this->assign('info',$info);
		$this->display();
	}

	/**
	 * 添加标签
	 */
	public function add()
	{
		if (IS_POST) {
			// 将以回车符分界的连续字符串转为数组，以便添加
			$tagArr = explode("\r",Q('post.tagname'));
			$arr = array();
			foreach ($tagArr as $v) {
				$v = trim($v);
				if (strlen($v)) {
					$arr[] = $v;
				}
			}
			// 执行添加
			if (!$this->model->addTag($arr)) {
				$this->error($this->model->error);
			}
			$this->success('添加成功','index');
		}

		$this->display();
	}

	/**
	 * 编辑
	 */
	public function edit()
	{
		$tid = (int)Q('post.tid');

		$this->display();
	}

	/**
	 * 删除
	 */
	public function del()
	{
		$tid = (int)Q('get.tid');
		$this->model->where("tid={$tid}")->delete();
		$this->success('删除成功');
	}
	
}
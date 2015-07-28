<?php

/**
* 友情链接控制权
*/
class FlinkController extends AuthController
{
	private $model;

	public function __construct()
	{
		parent::__construct();
		$this->model = K('Flink');
	}
	
	/**
	 * 首页
	 */
	public function index()
	{
		$info = $this->model->all();
		foreach ($info as $k => $v) {
			$info[$k]['_url'] = substr($v['url'], 7,-1);
		}
		// p($info);die;
		$this->assign('info',$info);
		$this->display();
	}

	/**
	 * 添加友链
	 */
	public function add()
	{
		if (IS_POST) {
			if (!$this->model->intoFlink()) {
				$this->error($this->model->error);
			}
			$this->success('添加成功',U('index'));
		}
		
		$this->display();
	}

	/**
	 * 编辑
	 */
	public function edit()
	{
		if (IS_POST) {
			if (false == $this->model->intoFlink()) {
				$this->error($this->model->error);
			} else {
				$this->success('修改成功',U('index'));
			}
		}
		// 获取原始信息
		$fid = (int)Q('get.fid');
		$oldData = $this->model->where("fid={$fid}")->find();
		$oldData['url'] = substr($oldData['url'], 7,-1);
		$this->assign('oldData',$oldData);
		$this->display();
	}

	/**
	 * 删除
	 */
	public function del()
	{
		$fid = (int)Q('get.fid');
		$this->model->where("fid={$fid}")->delete();
		$this->success('删除成功');
	}
}
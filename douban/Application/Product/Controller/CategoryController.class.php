<?php

/**
* 分类控制器
*/
class CategoryController extends AuthController
{
	private $model;
	private $cateInfo;		//树形结构的分类信息

	public function __construct()
	{
		parent::__construct();
		$this->model = K('Category');
		$this->cateInfo = Data::tree($this->model->all(),'cname');
	}
	/**
	 * 分类首页
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->assign('cateInfo',$this->cateInfo);
		// p($this->cateInfo);die;
		$this->display();
	}

	/**
	 * 添加分类
	 */
	public function add()
	{
		if (IS_POST) {
			if (Q('post.pid') == -1) {
				$this->error('请选择分类');
			}
			// 如果验证失败，则提示错误
			if (!$this->model->intoCate()) {
				$this->error($this->model->error);
			}
			$this->success('添加成功',U('index'));
		}
		// p($this->cateInfo);die;
		$this->assign('cateInfo',$this->cateInfo);
		$this->display();
	}

	/**
	 * 添加子分类
	 */
	public function addSub()
	{
		// 所属分类处理
		$cid = (int)Q('get.cid');
		$info = $this->model->field('cid,cname')->where("cid = {$cid}")->find();
		if (!$info) {
			$this->success('暂无此分类',U('index'));
		}

		$this->assign('info',$info);
		$this->display();
	}

	/**
	 * 编辑
	 */
	public function edit()
	{
		if (IS_POST) {
			if (!$this->model->intoCate()) {
				$this->error($this->model->error);
			}
			$this->success('修改成功',U('index'));
		}

		$cid = (int)Q('get.cid');
		// 显示原始信息
		$oldInfo = $this->model->where("cid = {$cid}")->find();
		if (!$oldInfo) {
			$this->success('暂无此分类',U('index'));
		}
		// 处理所属分类不能选择自己与自己的子集
		$selfSub = $this->model->getSub($this->cateInfo,$cid);
		$selfSub[] = $cid;
		
		$this->assign('selfSub',$selfSub);
		$this->assign('cateInfo',$this->cateInfo);
		$this->assign('oldInfo',$oldInfo);
		$this->display();
	}

	/**
	 * 删除
	 */
	public function del()
	{
		$cid = (int)Q('get.cid');
		$res = $this->model->where("pid={$cid}")->find();
		if ($res) {
			$this->success('无法删除存在子分类的分类');
		}
		$this->model->where("cid={$cid}")->delete();
		$this->success('删除成功',U('index'));
	}

	/**
	 * Ajax获取子分类信息，用于页面显示
	 */
	public function ajax_getSubInfo()
	{
		$cid = (int)Q('post.cid');
		$subInfo = $this->model->where("pid={$cid}")->all();
		$this->ajax($subInfo);
	}

	/**
	 * Ajax获取子分类id，用于收缩分类
	 */
	public function ajax_getSubCid()
	{
		$cid = (int)Q('post.cid');
		$data = $this->model->all();
		$info = $this->model->getSub($data,$cid);
		$this->ajax($info);
	}
}
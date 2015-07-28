<?php

/**
* 文章管理控制器
*/
class ArticleController extends AuthController
{
	private $model;
	private $tagModel;
	private $cateInfo;
	function __construct()
	{
		parent::__construct();
		$this->model = K('Article');	//文章表
		$this->tagModel = K('tag');		//标签表
		$this->cateInfo = Data::tree(K('Category')->all(),'cname');
	}

	/**
	 * 文章管理首页
	 */
	public function index()
	{
		// 获取所有文章的信息
		$info = M()->join("__article__ a JOIN __category__ c ON a.category_cid=c.cid")->where("is_recycle=0")->order("sendtime ASC")->all();
		$this->assign('info',$info);
		$this->display();
	}

	/**
	 * 添加文章
	 */
	public function add()
	{
		if (IS_POST) {
			// 执行文章发布，如果产生错误则终止执行并提示错误
			if (!$this->model->intoArticle()) {
				$this->error($this->model->error);
			} else {
				$this->success('发布成功',U('Admin/Article/index'));
			}
		}
		// 所属分类的处理
		$this->assign('cateInfo',$this->cateInfo);
		// 标签处理
		$tagInfo = $this->tagModel->all();
		$this->assign('tagInfo',$tagInfo);
		$this->display();
	}

	/**
	 * 编辑文章
	 */
	public function edit()
	{
		if (IS_POST) {
			if (!$this->model->intoArticle()) {
				$this->error($this->model->error);
			}else {
				$this->success('修改成功','index');
			}
		}
		$aid = (int)Q('get.aid');
		// 获取文章原信息
		$oldData = M()->join("__article__ a JOIN __article_data__ ad ON a.aid=ad.article_aid")->where("aid={$aid}")->find();
		$oldData['attr'] = explode(',', $oldData['attr']);
		// p($oldData);die;
		$arcTagModel = K('ArcTag');
		$arcTagInfo = $arcTagModel->where("article_aid={$aid}")->getField('tag_tid',true);
		// 所有标签
		$tagInfo = $this->tagModel->all();

		$this->assign('oldData',$oldData);
		$this->assign('cateInfo',$this->cateInfo);
		$this->assign('arcTagInfo',$arcTagInfo);
		$this->assign('tagInfo',$tagInfo);
		$this->display();
	}

	/**
	 * 删除文章到回收站
	 */
	public function del()
	{
		$data = array(
			'aid' => (int)Q('get.aid'),
			'is_recycle' => 1
		);
		$this->model->save($data);
		go(U('Admin/Article/index'));
	}

	/**
	 * 文章回收站
	 */
	public function recycle()
	{
		$info = M()->join("__article__ a JOIN __category__ c ON a.category_cid=c.cid")->where("is_recycle=1")->order("updatetime ASC")->all();

		$this->assign('info',$info);
		$this->display();
	}

	/**
	 * 恢复文章
	 */
	public function recovery()
	{
		$data = array(
			'aid' => (int)Q('get.aid'),
			'is_recycle' => 0
		);
		$this->model->save($data);
		go(U('Admin/Article/recycle'));
	}

	/**
	 * 彻底删除文章
	 */
	public function real_del()
	{
		$aid = (int)Q('get.aid');
		// 删除文章表、文章数据表，文章标签关联表
		$this->model->delArticle($aid);
		$this->success('删除成功');
	}
}
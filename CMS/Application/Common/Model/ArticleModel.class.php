<?php

/**
* 文章管理模型
*/
class ArticleModel extends Model
{
	public $table = 'article';

	public $validate = array(
		array('title','nonull','标题不能为空',2,3),
		array('category_cid','regexp:/^[1-9]\d*$/','请选择分类',2,3),
		
	);

	public $auto = array(
		array('sendtime','time','function',2,1),	//发布时间
		array('thumb','_thumb','method',2,3),		//缩略图
		array('attr','_attr','method',2,3),			//文章属性
		array('user_uid','_user','method',2,1)		//用户id
	);

	/**
	 * 发布文章时的图片上传与缩略
	 */
	public function _thumb()
	{
		if ((isset($_FILES['thumb'])) && ($_FILES['thumb']['error'] != 4)) {
			// 1、上传文件
			$upload = new Upload();
			$files = $upload->upload();
			// 如果上传不成功
			if (!$files) {
				$this->error = $upload->error;
			}else {
				// 2、执行缩略
				$image = new Image();
				$path = $image->thumb($files[0]['path']);
				return $path;
			}
		}
	}

	/**
	 * 发布文章时的属性处理
	 */
	public function _attr()
	{
		if (isset($_POST['attr'])) {
			$attr = Q('post.attr');
			$attr = implode(',',$attr);
			return $attr;
		}
		return;
	}

	/**
	 * 发布文章时的属性处理
	 */
	public function _user()
	{
		return session('aid');
	}

	/**
	 * 添加、编辑文章(三张表的操作)
	 */
	public function intoArticle()
	{
		// 执行自动检测与自动完成
		if (!$this->create()) return false;
		// 如果产生了错误，则终止
		if ($this->error) return false;

		if (!isset($_POST['aid'])) {
		//***添加***
			$aid = $this->add();
			$this->toArcData($aid);
			$this->toArcTag($aid);
		} else {
		//***编辑***
			$aid = (int)Q('post.aid');
			$this->where("aid={$aid}")->save();
			$this->toArcData($aid);
			$this->toArcTag($aid);
		}
		return true;
	}

	/**
	 * 删除文章
	 */
	public function delArticle($aid)
	{
		// 删除文章表
		$this->where("aid={$aid}")->delete();
		// 删除文章数据表
		K('ArcData')->where("article_aid={$aid}")->delete();
		// 删除文章标签关联表
		K('ArcTag')->where("article_aid={$aid}")->delete();
		// 删除评论表
		return true;
	}

	/**
	 * 文章内容表的添加与更新
	 */
	private function toArcData($aid)
	{
		$arcDataModel = K('ArcData');
		$data = array(
			'keywords' => Q('post.keywords'),
			'description' => Q('post.description'),
			'content' => $_POST['content'],
			'article_aid' => $aid
		);

		// 文章内容表的添加
		if (!isset($_POST['aid'])) {
			$arcDataModel->add($data);
		}else {// 文章内容表的修改
			$arcDataModel->where("article_aid={$aid}")->save($data);
		}
		return true;
	}

	/**
	 * 文章标签关联表的添加与更新
	 */
	private function toArcTag($aid)
	{
		$arcTagModel = K('ArcTag');
		// 用户所选的标签
		$tagArr = isset($_POST['tag']) ? Q('post.tag') : array();
		$category_cid = Q('post.category_cid');

		if (isset($_POST['aid'])) {
		//修改
			if ($tagArr) {
			//如果用户有选择标签
				$arcTagModel->where("article_aid={$aid}")->delete();
				foreach ($tagArr as $v) {
					$data = array(
						'article_aid' => $aid,
						'tag_tid' => $v,
						'category_cid' => $category_cid
					);
					$arcTagModel->add($data);
				}
				return true;
			} else {
			// 如果用户没有选择标签
				$arcTagModel->where("article_aid={$aid}")->delete();
				return false;
			}
		} else {
		//添加
			if ($tagArr) {
				foreach ($tagArr as $v) {
					$data = array(
						'article_aid' => $aid,
						'tag_tid' => $v,
						'category_cid' => $category_cid
					);
					$arcTagModel->add($data);
				}
				return true;
			} else {
				return false;
			}
		}
	}
	
}
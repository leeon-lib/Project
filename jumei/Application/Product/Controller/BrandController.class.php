<?php

/**
* 品牌管理控制器
*/
class BrandController extends AuthController
{
	private $model = null;
	private $brandTypeModel = null;

	public function __construct()
	{
		parent::__construct();
		$this->model = K('Brand');
		$this->brandTypeModel = K('BrandType');
	}

	/**
	 * 品牌列表
	 */
	public function index()
	{
		$info = $this->model->getList();
		$this->assign('info',$info);
		$this->display();
	}

	/**
	 * 添加品牌
	 */
	public function add()
	{
		$cateList = K('Category')->getList(['where'=>'pid=0','field'=>'cid,name']);
		$typeList = $this->brandTypeModel->getList();
		$this->assign('typeList', $typeList);
		$this->assign('cateList', $cateList);
		$this->display();
	}

	/**
	 * 编辑
	 */
	public function edit()
	{
		$bid = (int)$_GET['id'];
		$info = $this->model->where("id={$bid}")->find();
		// p($info);die;
		$this->assign('info',$info);
		$this->display();
	}

	/**
	 * 添加、修改操作
	 */
	public function operate()
	{
		$id = Q('post.id', 0, 'intval');
		$name = trim(Q('post.name'));
		$enName = trim(Q('post.en_name'));
		$typeId = trim(Q('post.type_id'));

		if (!$this->model->create())
		{
			$this->error($this->model->error);
		}
		if (!isset($_POST['cid']))
		{
			$this->error('请选择经营类别');
		}
		$argv = [
			'name' => $name,
			'en_name' => $enName,
			'type_id' => $typeId
		];

		if (isset($_FILES['logo']) && (4 != $_FILES['logo']['error']))
		{
			// 执行上传
			$argv['logo'] = $this->upload(C('UPLOAD_PATH') . 'Brand/');
		}

		// 添加与修改操作
		if (0 == $id)
		{
			if ($this->model->isExists($name))
			{
				$this->error('添加失败，该类型名称已存在');
			} else {
				$this->model->doInsert($argv);
				$this->success('添加成功', 'index');
			}
		} else {
			// 获取旧数据
			$oldName = $this->model->getOne($id, 'name', true);
			if (($typeName != $oldName) && ($this->model->isExists($typeName)))
			{
				$this->error('修改失败，该类型名称已存在');
			} else {
				$this->model->doInsert($argv);
				$this->success('修改成功', 'index');
			}
		}
	}

    /**
     * 图片上传与缩略
     * @return [type] [description]
     */
    private function upload($path = '')
    {
        $upload = new Upload($path);
        $info = $upload->upload();
        if (empty($info)) {
            $this->error($upload->error);
        } else {
            //缩略图片，并删除原始图片
            $image = new Image();
            $thumbPath = $info[0]['dir'] . 'thumb_' . $info[0]['basename'];
            $path = $image->thumb($info[0]['path'],$thumbPath,80,80);
            unlink($info[0]['path']);
            return basename($path);
        }
    }


}
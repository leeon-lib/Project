<?php

/**
* 分类控制器
*/
class CategoryController extends AuthController
{
	private $model = null;
	private $attrModel = null;
	private $cateAttrModel = null;
	private $cateInfo;		//树形结构的分类信息

	public function __construct()
	{
		parent::__construct();
		$this->model = K('Category');
		$this->attrModel = K('Attribute');
		$this->cateAttrModel = K('CategoryAttr');
		$this->cateInfo = Data::tree($this->model->all(),'name');
	}
	/**
	 * 分类首页
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->assign('cateInfo',$this->cateInfo);
		$this->display();
	}

	/**
	 * 添加分类
	 */
	public function add()
	{
		if (IS_POST) 
		{
			$pid = (int)Q('post.pid');
			$name = $this->rmEmpty(Q('post.name'));
			// 一般性验证
			if (-1 == $pid)
			{
				$this->error('请选择分类');
			}
			if (empty($name))
			{
				$this->error('分类名称不可为空');
			}
			
			$error = null;	//存放重复名称
			// 组合数据，提交模型处理
			foreach ($name as $v)
			{
				if ($this->model->checkName($v))
				{
					$error .= $v . '，';
					continue;
				}
				$data = array(
					'cid'  => $this->model->createCateId($pid),
					'name' => $v,
					'pid'  => $pid
				);
				$this->model->intoCate($data);
			}

			if (is_null($error))
			{
				$this->success('添加成功',U('index'));
			} else {
				$error = rtrim($error,'，');
				echo '部分添加失败，' , $error , '分类名称重复！';
				die;
			}
			
		}

		$this->assign('cateInfo',$this->cateInfo);
		$this->display();
	}

	/**
	 * 添加子分类
	 */
	public function addSub()
	{
		$cid = (int)Q('get.cid');

		// GET参数的分类id合法性检查
		$info = $this->model->field('cid,name')->where("cid = {$cid}")->find();
		if (!$info)
		{
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
		$cid = (int)Q('get.cid');
		// 显示原始信息
		$oldInfo = $this->model->where("cid = {$cid}")->find();
		// GET参数的分类id合法性检查
		if (!$oldInfo) 
		{
			$this->error('暂无此分类',U('index'));
		}
		// 提交编辑
		if (IS_POST) 
		{
			$pid = (int)Q('post.pid');
			$name = Q('post.name');
			if ($name != $oldInfo['name'])
			{
				if ($this->model->checkName($name))
				{
					$this->error('分类名称重复，保存失败！' );
				}
			} else {
				if ($pid == $oldInfo['pid'])
				{
					$this->success('您未作任何修改');
				}
			}
			// 组合数据提交模型修改
			$argv = array(
				'cid'  => $cid,
				'name' => $name,
				'pid'  => $pid
			);
			$this->model->intoCate($argv,2);
			$this->success('修改成功',U('index'));
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
		$cid = (int)Q('post.cid');
		$res = $this->model->where("pid={$cid}")->find();
		if ($res)
		{
			$this->error('无法删除存在子分类的分类');
		}
		$this->model->where("cid={$cid}")->delete();
		$this->success('删除成功',U('index'));
	}

	/**
	 * 设置分类属性
	 */
	public function setAttr()
	{
		// 获得当前分类已设置的属性
		$cid = isset($_POST['cid']) ? (int)Q('post.cid') : (int)Q('get.cid');
		$attrInfo['selected'] = $this->attrModel->getByCid($cid);
		// 获得当前分类除已设置外的其它属性
		$seleAttrId = array();
		if (!empty($attrInfo['selected']))
		{
			foreach ($attrInfo['selected'] as $v) {
				$seleAttrId[] = $v['attribute_id'];
			}
		}
		$attrInfo['no-selected'] = $this->attrModel->getAttr('id,name,kind_id',$seleAttrId);
		
		// 设置属性表单处理
		if (IS_POST)
		{
			$seleArr = isset($_POST['attr']['sele']) ? $_POST['attr']['sele'] : array();
			$noseleArr = isset($_POST['attr']['nosele']) ? $_POST['attr']['nosele'] : array();
			// 比对当前已选项和初始已选项
			$diff = array_diff($seleAttrId,$seleArr);
			if (!empty($diff))
			{
				foreach ($diff as $v) {
					$this->cateAttrModel->where("category_cid={$cid} AND attribute_id={$v}")->del();
				}
			}
			if (!empty($noseleArr))
			{
				foreach ($noseleArr as $v) {
					$this->cateAttrModel->add(array('category_cid'=>$cid,'attribute_id'=>$v));
				}
				if (empty($diff))
				{
					$this->success('设置成功',U('setAttr',array('cid'=>$cid)));
				}
			} else {
				if (!empty($diff))
				{
					$this->success('修改成功',U('setAttr',array('cid'=>$cid)));
				} else {
					$this->success('您未作任何修改或设置',U('setAttr',array('cid'=>$cid)));
				}
			}
		}
		
		
		$cateName = $this->model->where("cid = {$cid}")->getField('name');
		// GET参数合法性检查
		if (empty($cateName))
		{
			$this->success('暂无此分类',U('index'));
		}

		$this->assign('attrInfo',$attrInfo);
		$this->assign('cateName',$cateName);
		$this->display();
	}

	/**
	 * ajax删除
	 */
	public function ajax_del()
	{
		$cid = (int)Q('post.cid');
		$res = $this->model->where("pid={$cid}")->find();
		if (true == $res) 
		{
			$this->ajax(false);
		} else {
			$this->model->where("cid={$cid}")->delete();
			$this->ajax(true);
		}
	}

	/**
	 * Ajax获取子分类信息，用于展开子分类
	 */
	public function ajax_getSubInfo()
	{
		$cid = (int)Q('post.cid');
		$subInfo = $this->model->where("pid={$cid}")->all();
		$this->ajax($subInfo);
	}

	/**
	 * Ajax获取子分类id，用于收缩子分类
	 */
	public function ajax_getSubCid()
	{
		$cid = (int)Q('post.cid');
		$data = $this->model->all();
		$info = $this->model->getSub($data,$cid);
		$this->ajax($info);
	}
	
	/**
	 * 去除数组空值
	 * @param  [array] $arr [description]
	 * @return [array]      [description]
	 */
	public function rmEmpty($arr)
	{
		foreach ($arr as $key => $val)
		{
			if (!is_array($val))
			{
				if (empty(trim($val)))
				{
					unset($arr[$key]);
				} else {
					$arr[$key] = $val;
				}
			} else {
				$arr[$key] = $this->rmEmpty($val);
			}
		}
		return $arr;
	}

	/**
	 * 验证分类名称是否为空或重复
	 * @param  [array] $name [分类名称]
	 * @return [error]       [错误提示并终止]
	 */
	public function checkName($name)
	{
		if (empty($name)) {
			$this->error('请输入分类名称');
		}
		if (is_array($name)) {
			foreach ($name as $v) {
				if (!$this->model->checkName($v)) {
					$repeat[] = $v;
				}
			}
			if (!empty($repeat)) {
				$this->error(implode(',', $repeat) . '分类已存在');
			}
		} else {
			if (!$this->model->checkName($name)) {
				$this->error($name . '分类已存在');
			}
		}
		
	}
}

<?php

namespace Product\Controller;
use Common\Controller\AuthController;

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
		$this->model = D('Category');
		$this->attrModel = D('Attribute');
		$this->cateAttrModel = D('CategoryAttr');
		$this->cateInfo = $this->model->select();
	}
	/**
	 * 分类列表
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
			$pid = (int)I('post.pid');
			$name = $this->rmEmpty(I('post.name'));
			// 一般性验证
			if (-1 == $pid)
			{
				$this->error('请选择分类');
			}
			if (empty($name))
			{
				$this->error('分类名称不可为空');
			}
			//存放重复名称
			$error = null;
			// 组合数据，提交模型处理
			foreach ($name as $v)
			{
				if ($this->model->checkName($v))
				{
					$error .= $v . '，';
					continue;
				}
				$data = array(
					'name' => $v,
					'pid'  => $pid
				);
				$this->model->intoCate($data);
			}

			if (is_null($error))
			{
				$this->success('添加成功',U('index'));die;
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
		$cid = (int)I('get.cid');

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
		$cid = (int)I('get.cid');
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
			$pid = (int)I('post.pid');
			$name = I('post.name');
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
		$cid = (int)I('post.cid');
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
		$cid = isset($_POST['cid']) ? (int)I('post.cid') : (int)I('get.cid');
		$selected = $this->attrModel->getByCid($cid);
		p($selected);die;
		// 按属性与规格重组已设置的属性
		$seleIdArr = array();
		if (!empty($selected))
		{
			foreach ($selected as $v)
			{
				// 获取已设置的属性的id，用于在获取未设置的属性时排除已设置的属性
				$seleIdArr[] = $v['attribute_id'];
				if (1 == $v['kind_id'])
				{
					$attrInfo['sele']['attr'][] = $v;
				} else {
					$attrInfo['sele']['spec'][] = $v;
				}
			}
		}
		// 获得当前分类除已设置外的其它属性
		$noSelected = $this->attrModel->getAttr('id,name,kind_id',$seleIdArr);
		if (!empty($noSelected))
		{
			foreach ($noSelected as $v)
			{
				if (1 == $v['kind_id'])
				{
					$attrInfo['nosele']['attr'][] = $v;
				} else {
					$attrInfo['nosele']['spec'][] = $v;
				}
			}
		}
		// 设置属性表单处理
		if (IS_POST)
		{
			// 获取已选和未选的值
			$sele = isset($_POST['attr']['sele']) ? $_POST['attr']['sele'] : array();
			$nosele = isset($_POST['attr']['nosele']) ? $_POST['attr']['nosele'] : array();
			// 如果原始有已设置的值，则比对原始与提交值的差异
			if (!empty($seleIdArr))
			{
				$diff = array_diff($seleIdArr, $sele);
			}
			// 如果产生了差异，则差异部分即为前台被取消设置的部分，删除差异
			if (!empty($diff))
			{
				foreach ($diff as $v)
				{
					$this->cateAttrModel->where("category_cid={$cid} AND attribute_id={$v}")->del();
				}
			}
			if (!empty($nosele))
			{
			// 如果之前未设置的属性或规格被勾选，且已设置的部分比对后无差异，则为设置
				foreach ($nosele as $v)
				{
					$this->cateAttrModel->add(array('category_cid'=>$cid,'attribute_id'=>$v));
				}
				if (empty($diff))
				{
					$this->success('设置成功',U('setAttr',array('cid'=>$cid)));
				}
			} else {
			// 如果未勾选之前本未设置的，但已设置的部分比对后有差异，则为修改
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
		$cid = (int)I('post.cid');
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
		$cid = (int)I('post.cid');
		$subInfo = $this->model->where("pid={$cid}")->select();
		$this->ajax($subInfo);
	}

	/**
	 * Ajax获取子分类id，用于收缩子分类
	 */
	public function ajax_getSubCid()
	{
		$cid = (int)I('post.cid');
		$data = $this->model->select();
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
		if (empty($name))
		{
			$this->error('请输入分类名称');
		}
		if (is_array($name))
		{
			foreach ($name as $v)
			{
				if (!$this->model->checkName($v))
				{
					$repeat[] = $v;
				}
			}
			if (!empty($repeat))
			{
				$this->error(implode(',', $repeat) . '分类已存在');
			}
		} else {
			if (!$this->model->checkName($name))
			{
				$this->error($name . '分类已存在');
			}
		}
		
	}
}

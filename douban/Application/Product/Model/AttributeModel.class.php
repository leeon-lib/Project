<?php

/**
* 类别属性管理模型
*/
class AttributeModel extends Model
{
	public $table = 'attribute';

	public $validate = array(
		array('name','nonull','属性名称不能为空',2,3),
		array('value','nonull','属性值不能为空',2,3)
	);

	/**
	 * 添加属性
	 */
	public function intoAttr()
	{
		if (!$this->create()) return false;
		if (!$this->checkName()) return false;

		$attrid = $this->add();
		$cid = (int)$_POST['cid'];
		// 如果有选择分类，则在中间表中添加一条关系纪录
		if (-1 != $cid) {
			$data = array(
				'category_id'  => $cid,
				'attribute_id' => $attrid
			);
			M('category_attr')->add($data);
		}
		return true;
	}

	/**
	 * 验证名称是否已存在
	 */
	public function checkName()
	{
		$name = Q('post.name');
		$res = $this->where("name = '{$name}' ")->find();
		if ($res) {
			$this->error = '该属性已存在！';
			return false;
		}
		return true;
	}
}
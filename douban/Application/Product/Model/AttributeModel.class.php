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
		// 数据完整性验证
		if (!$this->create())
		{
			return false;
		}
		$this->add();
		return true;
	}

	/**
	 * 验证名称是否已存在
	 */
	public function checkName($name)
	{
		$res = $this->where("name = '{$name}' ")->find();
		if ($res)
		{
			return true;
		} else
		{
			return false;
		}
	}

	public function getByCid($cid)
	{
		$join = '__attribute__ attr JOIN __category_attr__ cate_attr ON attr.id = cate_attr.attribute_id';
		return M()->join("{$join}")->field('attribute_id,name,kind_id,key_char')->where("cate_attr.category_cid={$cid}")->all();
	}

	/**
	 * 获取属性
	 */
	public function getAttr($fields='',$seleAttrId=array())
	{
		if (empty($seleAttrId))
		{
			return $this->field("{$fields}")->all();
		} else {
			$seleAttrId = implode(',', $seleAttrId);
			return $this->field("{$fields}")->where("id not in ({$seleAttrId})")->all();
		}
	}
}
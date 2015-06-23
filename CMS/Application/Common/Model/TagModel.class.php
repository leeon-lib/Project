<?php

/**
* 标签管理模型
*/
class TagModel extends Model
{
	public $table = 'tag';

	public $validate = array(
		array('tagname','nonull','内容不能为空',2,3)
	);

	/**
	 * 添加标签
	 * @param [type] $arr [description]
	 * @return [type] bool [<description>]
	 */
	public function addTag($arr)
	{
		if (!$this->create()) return false;
		if (!$this->checkName($arr)) return false;
		foreach ($arr as $v) {
			$data = array(
				'tagname' => $v
			);
			$this->add($data);
		}
		return true;
	}

	/**
	 * 检测标签名是否有重复
	 * @param  [type] $arr 标签名数组
	 * @return [type] boolean  有重复：重复标签名存入model的error属性中，并返回false
	 */
	public function checkName($arr)
	{
		$allTag = $this->getField('tagname',true);
		// 用于存放重复的标签名
		$errArr = array();
		foreach ($arr as $v) {
			if (in_array($v, $allTag)) {
				$errArr[] = $v;
			}
		}
		// 如果有重复的标签名
		if ($errArr) {
			$err = implode(',', $errArr);
			$this->error = $err . '标签重复';
			return false;
		}
		return true;
	}
}
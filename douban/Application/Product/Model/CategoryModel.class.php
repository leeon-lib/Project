<?php

/**
* 分类管理模型
*/
class CategoryModel extends Model
{
	public $table = 'category';

	public $validate = array(
		array('cname','nonull','分类名称不能为空',2,3)
	);

	/**
	 * 添加、修改分类
	 */
	public function intoCate()
	{
		// 表单完整性验证
		if (!$this->create()) return false;
		// 验证分类名称
		if (!$this->checkName()) return false;

		// 如果不存在隐藏域cid，则添加分类，否则执行修改
		if (!array_key_exists('cid', $_POST)) {
			// 根据所选的分类，生成对应规则的分类id
			$pid = (int)$_POST['pid'];
			$cidArr = $this->field("cid")->where("pid={$pid}")->all();
			switch ($pid) {
				case 0:
					if (empty($cidArr)) {
						$cid = 100;
					} else {
						$lastCid = current(array_pop($cidArr));
						// p($lastCid);die;
						$cid = $lastCid + 100;
					}
					break;
				
				default:
					if (empty($cidArr)) {
						$cid = $pid *100 + 1;
					} else {
						$lastCid = current(array_pop($cidArr));
						$cid = $lastCid + 1;
					}
					break;
			}
			$info = array(
				'cid' 	=> $cid,
				'cname' => Q('post.cname'),
				'pid' 	=> $pid
			);
			// 插入数据
			return $this->add($info);
		} else {
			// 更新（修改）
			$cid = (int)Q('post.cid');
			$this->where("cid={$cid}")->update();
			return true;
		}
	}

	/**
	 * 递归获取所有子分类id
	 */
	public function getSub($data,$cid)
	{
		static $temp = array();
		foreach($data as $v) {
			if ($v['pid'] == $cid) {
				$temp[] = $v['cid'];
				$this->getSub($data,$v['cid']);
			}
		}
		return $temp;
	}

	/**
	 * 验证添加的分类名称是否已存在
	 */
	public function checkName()
	{
		$cname = Q('post.cname');
		$res = $this->where("cname = '{$cname}' ")->find();
		if ($res) {
			$this->error = '该分类已存在！';
			return false;
		}
		return true;
	}
}
<?php

/**
* 商品管理模型
*/
class ProductModel extends Model
{
	public $table = 'product';
	public $validate = array(
		array('goods','nonull','货号不能为空',2,3),
		array('name','nonull','商品名称不能为空',2,3),
		array('marked_price','nonull','市场价不能为空',2,3)
	);

	/**
	 * 添加、编辑商品主表的基本信息
	 * @return [boolean] 
	 */
	public function intoProduct()
	{
		if (!$this->create()) return false;
		if (!$this->checkName()) return false;

		// 生产日期处理
        $date = Q('post.manuf_date');
        $_POST['manuf_date'] = strtotime($date);
        // 添加日期处理，此处有bug，每次修改都会覆盖时间
        $_POST['add_date'] = time();
		return $this->add();
	}

	public function getAll()
	{
		$join = "__category__ c JOIN __product__ p ON p.category_id=c.cid";
		return M()->join("$join")->all();
	}

	/**
	 * 验证商品是否已存在
	 */
	public function checkName()
	{
		$goods = Q('post.goods');
		$res = $this->where("goods = '{$goods}' ")->find();
		if ($res) {
			$this->error = '该货号已存在！';
			return false;
		}
		return true;
	}
	
}
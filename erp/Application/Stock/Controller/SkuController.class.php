<?php

namespace Stock\Controller;
use Common\Controller\AuthController;

/**
* SKU管理控制器
*/
class SkuController extends AuthController
{
	private $skuModel = null;

	public function __construct()
	{
		parent::__construct();
		$this->skuModel = D('Sku');
	}

	/**
     * SKU搜索
     */
    public function search()
    {
        // 获取搜索条件
        $id = (int)trim(I('request.sku_id'));
        $goods = trim(I('request.goods'));
        $size = trim(I('request.size'));
        $barCode = trim(I('request.bar_code'));
        
        $where = '';
        if (!empty($id))
        {
            $where .= " AND id = {$id}";
        }
        if (!empty($goods))
        {
            $where .= " AND goods = '{$goods}' ";
        }
        if (!empty($size))
        {
            $where .= " AND size = '{$size}' ";
        }
        if (!empty($barCode))
        {
            $where .= " AND bar_code = '{$barCode}' ";
        }
        return $where;
    }

	/**
	 * sku列表
	 */
	public function index()
	{
		$where = '1 ' . $this->search();
        // 获取商品列表
        $argv = array(
            'where' => $where,
            'limit' => 20
        );
		$skuList = $this->skuModel->getList($argv);
		$this->assign('skuList', $skuList);
		$this->display();
	}

	/**
	 * 添加sku
	 */
	public function add()
	{
		$cityList = C('CITY_LIST');
		$this->assign('cityList', $cityList);
		$this->display();
	}

	/**
	 * 修改sku信息
	 */
	public function edit()
	{
		$id = (int)I('get.id');
		$oldDate = $this->skuModel->getOne($id);
		$this->assign('oldDate', $oldDate);
		$this->display();
	}


	/**
	 * 操作
	 */
	public function operate()
	{
		$goods = trim(I('post.goods'));
		$size = trim(I('post.size'));
		$barCode = trim(I('post.bar_code'));
		$skuId = I('post.id', 'intval', 0);
		//  表单数据模型验证
		if (!$this->skuModel->create())
		{
			$this->error($this->skuModel->getError());
		}
		// 组合数据
		$argv = array(
			'goods' => $goods,
			'size' => $size,
			'bar_code' => $barCode
		);
		if (0 == $skuId)
		{ // 添加
			if ($this->skuModel->isExists($barCode, 'bar_code'))
			{
				$this->error('添加失败，该条形码已存在');
			} else {
				$argv['add_date'] = time();
				$argv['admin_name'] = session('admin_name');
				$this->skuModel->doInsert($argv);
				$this->success('添加成功', 'index');
			}
		} else { //编辑
			$oldDate = $this->skuModel->getOne($skuId, 'goods,size,bar_code');
			if (!array_diff($oldDate, $argv))
			{
				$this->success('您未作任何更改');
			} else {
				if (($barCode != $oldDate['bar_code']) && $this->skuModel->isExists($barCode, 'bar_code'))
				{
					$this->error('修改失败，该条形码已存在');
				} else {
					$argv['admin_name'] = session('admin_name');
					$this->skuModel->doUpdate($argv, $skuId);
					$this->success('修改成功', 'index');
				}
			}
		}
	}



}
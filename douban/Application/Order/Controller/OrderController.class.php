<?php

/**
* 订单管理控制器
*/
class OrderController extends AuthController
{
	
	public function index()
	{
		$this->display();
	}

	public function make()
	{
		$this->display();
	}


	/**
	 * 订单搜索
	 * @return [string] 组合的搜索条件
	 */
	public function search()
    {
        // 获取搜索条件
        $id = (int)Q('request.product_id');
        $goods = Q('request.goods');
        $categoryCid = Q('request.category_cid');
        $brandId = Q('request.brand_id');
        $manufDateS = Q('request.manuf_date_start');
        $manufDateE = Q('request.manuf_date_end');
        $addDateS = Q('request.add_date_start');
        $addDateE = Q('request.add_date_end');
        $name = Q('request.name');
        
        $where = '';
        if (!empty($id))
        {
            $where .= " AND id = {$id}";
        }
        if (!empty($goods))
        {
            $where .= " AND goods = '{$goods}' ";
        }
        if (!empty($categoryCid) && (-1 != $categoryCid))
        {
            $where .= " AND category_cid = {$categoryCid}";
        }
        if (!empty($brandId) && (-1 != $brandId))
        {
            $where .= " AND brand_id = {$brandId}";
        }
        // 上市日期
        if (!empty($manufDateS))
        {
            $manufDateS = strtotime($manufDateS);
            $where .= " AND manuf_date >= {$manufDateS}";
        }
        if (!empty($manufDateE))
        {
            $manufDateE = strtotime($manufDateE);
            $where .= " AND manuf_date <= {$manufDateE}";
        }
        // 添加时间
        if (!empty($addDateS))
        {
            $addDateS = strtotime($addDateS);
            $where .= " AND add_date >= {$addDateS}";
        }
        if (!empty($addDateE))
        {
            $addDateE = strtotime($addDateE);
            $where .= " AND add_date <= {$addDateE}";
        }
        if (!empty($name))
        {
            $where .= " AND name LIKE '%{$name}%' ";
        }
        return $where;
    }
}
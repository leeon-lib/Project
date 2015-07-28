<?php

namespace Product\Controller;
use Common\Controller\AuthController;

/**
* 
*/
class ProductController extends AuthController
{
    private $productModel = null;   // 商品模型
    private $pdModel = null;        // 商品详情模型
    private $cateModel = null;      // 分类模型
    private $brandModel = null;     // 品牌模型
    private $cateData = null;       // 全部分类
    private $brandData = null;      // 全部品牌

    public function __construct()
    {
        parent::__construct();
        $this->productModel = D('product');
        $this->pdModel = D('ProductDetails');
		$this->cateModel = D('Category');
        $this->brandModel = D('brand');
        $this->cateData = $this->cateModel->getList();
        $this->brandData = $this->brandModel->getList(array('field'=>'id,name'));
    }

    /**
     * 商品搜索
     */
    public function search()
    {
        // 获取搜索条件
        $id = (int)I('request.product_id');
        $goods = I('request.goods');
        $categoryCid = I('request.category_cid');
        $brandId = I('request.brand_id');
        $manufDateS = I('request.manuf_date_start');
        $manufDateE = I('request.manuf_date_end');
        $addDateS = I('request.add_date_start');
        $addDateE = I('request.add_date_end');
        $name = I('request.name');
        
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

	/**
     * 商品列表
     */
    public function index()
    {
        $where = '1 ' . $this->search();
        // 获取商品列表
        $argv = array(
            'where' => $where,
            'limit' => 20
        );
        $productList = $this->productModel->getList($argv);
        foreach ($productList as &$v)
        {
            $v['category_name'] = $this->cateModel->where("cid={$v['category_cid']}")->getField('name');
            $v['brand_name'] = $this->brandModel->where("id={$v['brand_id']}")->getField('name');
            $v['pic'] = $this->pdModel->where("product_id={$v['id']}")->getField('small');
        }
        $this->assign('brandData', $this->brandData);
        $this->assign('cateData', $this->cateData);
        $this->assign('productList',$productList);
    	$this->display();
    }

    /**
     * 添加商品
     */
    public function add()
    {
        // 品牌及分类信息的显示处理
        $this->assign('brandData',$this->brandData);
        $this->assign('cateData',$this->cateData);
    	$this->display();
    }

    /**
     * 编辑商品
     */
    public function edit()
    {
        $id = (int)I('get.id');
        // 获取原信息
        $oldInfo = $this->productModel->where("id={$id}")->find();
        if (empty($oldInfo))
        {
            $this->error('非法访问','index');
        }
        // 获取商品图片
        $oldInfo['pic'] = $this->pdModel->where("product_id={$id}")->getField('small');
        $this->assign('oldInfo',$oldInfo);
        $this->assign('brandData',$this->brandData);
        $this->assign('cateData',$this->cateData);
        $this->display();
    }

    /**
     * 删除商品
     */
    public function del()
    {

    }

    /**
     * 操作商品信息
     */
    public function operate()
    {
        // 获取输入数据
        $name = trim(I('post.name'));
        $goods = I('post.goods');
        $brandId = (int)I('post.brand_id');
        $categoryCid = (int)I('post.category_cid');
        $manufDate = I('post.manuf_date');
        $markedPrice = (int)I('post.marked_price');
        $productId = (int)I('post.product_id', 'intval', 0);
        // 表单数据验证
        if (!$this->productModel->create())
        {
            $this->error($this->productModel->getError());
        }
        // 组合数据
        // 请勿改变数组内容顺序，修改分支下需要按顺序进行数组比对
        $argv = array(
            'name'  => $name,
            'goods' => $goods,
            'manuf_date' => strtotime($manufDate),
            'marked_price' => sprintf("%.3f", $markedPrice),
            'brand_id' => $brandId,
            'category_cid' => $categoryCid
        );
        
        if (0 == $productId)
        {//添加
            // 验证数据是否重复
            if ($this->productModel->isExists($name))
            {
                $this->error('操作失败，该商品名称已存在');
            } else {
                $argv['add_date'] = time();
                $keyPid = $this->productModel->doInsert($argv);
                if (false == $keyPid)
                {
                    $this->error($this->productModel->error);
                }
                // 如果有上传文件，则执行图片上传与缩略
                // if (4 != $_FILES['pics']['error'])
                // {
                //     $this->upload($keyPid);
                // }
                // 属性设置
                if (isset($_POST['attr']))
                {
                    $this->setAttr($keyPid);
                }
                $this->success('添加成功','index');
            }
        } else {//修改
            // 获取旧数据，用于与用户提交的数据进行比对，给予不同提示
            $oldData = $this->productModel->getOne($productId, ['id,add_date']);
            if (!array_diff($oldData, $argv))
            {
                $this->success('您未作任何修改', U('index'));
            } else {
                $this->productModel->doUpdate($argv, $productId);
                // 如果有上传文件，则执行图片上传与缩略
                if (isset($_FILES['pics']) && (4 != $_FILES['pics']['error']))
                {
                    $this->upload($productId);
                }
                if (isset($_POST['attr']))
                {
                    $this->setAttr($productId);
                }
                $this->success('修改成功','index');
            }
        }
    }

    /**
     * 批量导入商品
     */
    public function import()
    {
        $this->display();
    }

    /**
     * 设置商品属性
     */
    private function setAttr($pid)
    {
        $productAttrModel = K('ProductAttr');
        // 获取规格与属性
        $specArr = $_POST['attr']['spec'];
        $attrArr = $_POST['attr']['attr'];
        if (!empty($specArr))
        {
            foreach ($specArr as $v)
            {
                $specData = array(
                    'attr_id'    => $v,
                    'product_id' => $pid,
                    'kind_id'    => 2
                );
                $productAttrModel->doInsert($specData);
            }
        }
        if (!empty($attrArr))
        {
            foreach ($attrArr as $v)
            {
                $attrData = array(
                    'attr_id'    => $v,
                    'product_id' => $pid,
                    'kind_id'    => 1
                );
                $productAttrModel->doInsert($attrData);
            }
        }
    }

    /**
     * ajax获取商品属性
     * @return [type] [description]
     */
    public function ajax_getAttr()
    {
        $cid = (int)I('post.cid');
        
        // 获取所有属性值
        $attrArr = D('Attribute')->getByCid($cid);
        if (!empty($attrArr))
        {
            foreach ($attrArr as $k => $v)
            {
                if (1 == $v['kind_id']) 
                {
                    $attrList['attr'][] = $v;
                } else {
                    $attrList['spec'][] = $v;
                }
            }
            $this->ajax($attrList);
        } else {
            $this->ajax(false);
        }
    }

    /**
     * 图片上传与缩略
     * @return [type] [description]
     */
    private function upload($pid)
    {
        $upload = new Upload();
        $info = $upload->upload();
        if (empty($info)) {
            $this->error($upload->error);
        } else {
            //缩略为小、中、大三种不同尺寸的图片，并删除原始图片
            $image = new Image();
            $thumbPath_s = $info[0]['dir'] . 'thumb_s_' . $info[0]['basename'];
            $thumbPath_m = $info[0]['dir'] . 'thumb_m_' . $info[0]['basename'];
            $thumbPath_b = $info[0]['dir'] . 'thumb_b_' . $info[0]['basename'];
            $image->thumb($info[0]['path'],$thumbPath_s,80,80);
            $image->thumb($info[0]['path'],$thumbPath_m,300,300);
            $image->thumb($info[0]['path'],$thumbPath_b,800,800);
            unlink($info[0]['path']);
            // 整理缩略图路径数据，提交模型处理
            $data = array(
                'small'  => basename($thumbPath_s),
                'medium' => basename($thumbPath_m),
                'big'    => basename($thumbPath_b),
                'product_id' => $pid
            );
            $this->pdModel->intoDetails($data);
        }
    }



}

<?php

/**
* 
*/
class ProductController extends AuthController
{
    private $model = null;          // 商品模型
    private $pdModel = null;        // 商品详情模型
    private $cateModel = null;      // 分类模型
    private $brandModel = null;     // 品牌模型
    private $cateInfo = null;       // 全部分类
    private $brandInfo = null;      // 全部品牌

    public function __construct()
    {
        parent::__construct();
        $this->model = K('product');
        $this->pdModel = K('ProductDetails');
		$this->cateModel = K('Category');
        $this->brandModel = K('brand');
        $this->cateInfo = Data::tree($this->cateModel->all(),'name');
        $this->brandInfo = $this->brandModel->all();
    }

	/**
     * 商品列表
     */
    public function index()
    {
        $info = $this->model->limit(10)->all();
        foreach ($info as &$v) {
            $v['category_name'] = $this->cateModel->where("cid={$v['category_cid']}")->getField('name');
            $v['brand_name'] = $this->brandModel->where("id={$v['brand_id']}")->getField('name');
            $v['pic'] = $this->pdModel->where("product_id={$v['id']}")->getField('small');
        }
        $this->assign('info',$info);
    	$this->display();
    }

    /**
     * 添加商品
     */
    public function add()
    {
        if (IS_POST) 
        {
            // p($_POST);die;
            $this->check();
            // 执行商品主表模型，操作商品添加、编辑
            $product_id = $this->model->intoProduct();
            if (FALSE == $product_id) {
                $this->error($this->model->error);
            }
            // 如果有上传文件，则执行图片上传与缩略
            if (4 != $_FILES['pics']['error']) {
                $this->upload($product_id);
            }
            // 如果有选择商品属性，则执行商品属性的设置
            if (isset($_POST['attr'])) {
                $this->setAttr($product_id);
            }
            $this->success('添加成功',U('index'));
        }
        // 品牌及分类信息的显示处理
        $brandInfo = $this->brandModel->field('id,name')->select();
        $this->assign('brandInfo',$brandInfo);
        $this->assign('cateInfo',$this->cateInfo);
    	$this->display();
    }

    /**
     * 编辑商品
     */
    public function edit()
    {
        $id = (int)Q('get.id');
        // 获取原信息
        $oldInfo = $this->model->where("id={$id}")->find();
        // p($oldInfo);die;
        if (empty($oldInfo)) {
            $this->error('非法访问','index');
        }
        // 获取商品图片
        $oldInfo['pic'] = $this->pdModel->where("product_id={$id}")->getField('small');
        $this->assign('oldInfo',$oldInfo);
        $this->assign('brandInfo',$this->brandInfo);
        $this->assign('cateInfo',$this->cateInfo);
        $this->display();
    }

    /**
     * 批量导入商品
     */
    public function import()
    {
        $this->display();
    }

    /**
     * 设置、修改商品属性
     */
    private function setAttr($pid)
    {
        $productAttrModel = K('ProductAttr');
        // 获取规格与属性
        $specArr = $_POST['attr']['spec'];
        $attrArr = $_POST['attr']['attr'];
        if (!empty($specArr)) {
            foreach ($specArr as $v) {
                $specData = array(
                    'attr_id'    => $v,
                    'product_id' => $pid,
                    'kind_id'    => 2
                );
                $productAttrModel->add($specData);
            }
        }
        if (!empty($attrArr)) {
            foreach ($attrArr as $v) {
                $attrData = array(
                    'attr_id'    => $v,
                    'product_id' => $pid,
                    'kind_id'    => 1
                );
                $productAttrModel->add($attrData);
            }
        }
    }

    /**
     * 设置、编辑商品详情
     */
    public function details()
    {
        $this->display();
    }

    /**
     * ajax获取商品属性
     * @return [type] [description]
     */
    public function ajax_setAttr()
    {
        $cid = (int)Q('post.cid');
        
        // 获取所有属性值
        $attrArr = K('Attribute')->getByCid($cid);
        if (!empty($attrArr))
        {
            foreach ($attrArr as $k => $v) {
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
     * 验证
     */
    private function check()
    {
        // 分类、品牌完整性限制
        if (Q('post.category_id') == -1) {
            $this->error('请选择分类');
        }
        if (Q('post.brand_id') == -1) {
            $this->error('请选择品牌');
        }
        // 市场价格式限制
        $price = Q('post.marked_price');
        if (!preg_match('/^[0-9\.]*$/', $price)) {
            $this->error('填写的市场价非数字');
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

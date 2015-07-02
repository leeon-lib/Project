<?php

/**
* 
*/
class ProductController extends AuthController
{
    private $model = null;
    private $cateInfo = null;

    public function __construct()
    {
        parent::__construct();
        $this->model = K('product');
        $this->cateInfo = Data::tree(K('category')->all(),'name');
    }

	/**
     * 商品列表
     */
    public function index()
    {
        $data = $this->model->all();
        // p($data);
        foreach ($data as $key => &$value) {
            $value['manuf_date'] = date("Y-m-d",$value['manuf_date']);
            $value['add_date'] = date("Y-m-d",$value['add_date']);
        }
        $this->assign('data',$data);
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
            // 分类、品牌完整性限制
            if (Q('post.category_id') == -1) {
                $this->error('请选择分类');
            }
            if (Q('post.brand_id') == -1) {
                $this->error('请选择品牌');
            }
            // 市场价处理，格式限制
            $price = Q('post.marked_price');
            if (!preg_match('/^[0-9]*$/', $price)) {
                $this->error('填写的市场价非数字');
            }
            // 执行商品主表模型，操作商品添加、编辑
            $product_id = $this->model->intoProduct();
            if (!$product_id) {
                $this->error($this->model->error);
            }
            // 如果有上传文件，则执行图片上传与缩略
            if (4 != $_FILES['pics']['error']) 
            {
                $upload = new Upload(C('UPLOAD_PRODUCT_PATH'),array('jpg','jpeg','png'));
                $info = $upload->upload();
                if (empty($info))
                {
                    $this->error($upload->error);
                } else {
                    //缩略为小、中、大三种不同尺寸的图片，并删除原始图片
                    $image = new Image();
                    $thumbPath_s = 'thumb_s_' . $info[0]['basename'];
                    $thumbPath_m = 'thumb_m_' . $info[0]['basename'];
                    $thumbPath_b = 'thumb_b_' . $info[0]['basename'];
                    $image->thumb($info[0]['path'],$thumbPath_s,80,80);
                    $image->thumb($info[0]['path'],$thumbPath_m,300,300);
                    $image->thumb($info[0]['path'],$thumbPath_b,800,800);
                    unlink($info[0]['path']);

                    // 整理缩略图路径数据，提交模型处理
                    $data = array(
                        'small'  => basename($thumbPath_s),
                        'medium' => basename($thumbPath_m),
                        'big'    => basename($thumbPath_b),
                        'product_id' => $product_id
                    );
                    K('ProductDetails')->intoDetails($data);
                }
            }

            // 如果有选择商品属性，则执行商品属性的设置
            if (isset($_POST['attr']))
            {
                $productAttrModel = K('ProductAttr');
                // 获取规格与属性
                $specArr = $_POST['attr']['spec'];
                $attrArr = $_POST['attr']['attr'];
                if (!empty($specArr))
                {
                    foreach ($specArr as $v) {
                        $specData = array(
                            'attr_id'    => $v,
                            'product_id' => $product_id,
                            'kind_id'    => 2
                        );
                        $productAttrModel->add($specData);
                    }
                }
                if (!empty($attrArr))
                {
                    foreach ($attrArr as $v) {
                        $attrData = array(
                            'attr_id'    => $v,
                            'product_id' => $product_id,
                            'kind_id'    => 1
                        );
                        $productAttrModel->add($attrData);
                    }
                }
            }

            $this->success('添加成功',U('index'));
        }
        // 品牌及分类信息的显示处理
        $brandInfo = K('brand')->field('id,name')->select();
        $this->assign('brandInfo',$brandInfo);
        $this->assign('cateInfo',$this->cateInfo);
    	$this->display();
    }


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

}

<?php

namespace Product\Controller;
use Common\Controller\AuthController;

/**
* 属性管理控制器
*/
class AttributeController extends AuthController
{
	private $model = null;
    private $cateAttrModel = null;

    public function __construct()
    {
        parent::__construct();
        $this->model = D('Attribute');
        $this->cateAttrModel = D('CategoryAttr');
    }

	/**
     * 属性列表
     */
    public function index()
    {
        $data = $this->model->select();

        $this->assign('data',$data);
        $this->display();
    }

    /**
     * 添加属性
     */
    public function add()
    {
        if (IS_POST) 
        {
            $name = I('post.name');
            $value = I('post.value');
            // 一般性检测
            if (empty($name)) 
            {
                $this->error('属性名称不可为空');
            }
            if (empty($value))
            {
                $this->error('属性值不可为空');
            }
            if ($this->model->checkName($name))
            {
                $this->error('属性重复，该属性名称已存在！');
            }

            // 将以回车符分隔的多行分割为数组
            // 如果单行内有以'，'分隔的多个字符，便再以逗号分拆为子数组
            $value = explode("\r", $value);
            foreach ($value as $k => $v) {
                if (empty(trim($v))) {
                    unset($value[$k]);
                    continue;
                }
                if (false !== strpos($v, '，')) {
                    $value[$k] = explode('，', $v);
                    foreach ($value[$k] as $key => $val) {
                        $val = trim($val);
                        if (empty($val)) {
                            unset($value[$k][$key]);
                            continue;
                        }
                    }
                }
            }
            // 将整理好的属性值的多维数组分解为以英文逗号分隔的字符串
            $str = '';
            foreach ($value as $k => $v) {
                if (!is_array($v)) {
                    $str .= $v . ',';
                } else {
                    $str .= implode(',', $v) . ',';
                }
            }
            // 将整理好的属性值字符串压入POST替换原值，用于模型的操作
            $_POST['value'] = rtrim($str,',');

            if (!$this->model->intoAttr())
            {
                $this->error($this->model->error);
            }
            $this->success('添加成功',U('index'));
        }
    	$this->display();
    }

    /**
     * 批量导入
     */
    public function implode()
    {
        echo 'hi';
    }

    /**
     * 编辑
     */
    public function edit()
    {

    }

    /**
     * 删除
     */
    public function del()
    {
        
    }
}
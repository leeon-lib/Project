<?php

/**
* 属性管理控制器
*/
class AttributeController extends AuthController
{
	private $model = null;

    public function __construct()
    {
        parent::__construct();
        $this->model = K('Attribute');
    }

	/**
     * 属性列表
     */
    public function index()
    {


        $this->display();
    }

    /**
     * 添加属性
     */
    public function add()
    {
        if (IS_POST) 
        {
            // 将以回车符分隔的多行分割为数组
            // 如果单行内有以'，'分隔的多个字符，便再以逗号分拆为子数组
            $value = explode("\r", $_POST['value']);
            foreach ($value as $k => $v) {
                $v = trim($v);
                if (empty($v)) {
                    unset($value[$k]);
                    continue;
                }
                if (strpos($v, '，') !== false) {
                    $value[$k] = explode('，', $v);
                    foreach ($value[$k] as $key => $val) {
                        $val = trim($val);
                        if (empty($val)) {
                            unset($value[$k][$key]);
                            continue;
                        }
                    }
                } else {
                    $value[$k] = $v;
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
            $str = rtrim($str,',');
            // 将整理好的属性值字符串压入POST替换原值，用于模型的操作
            $_POST['value'] = $str;
            if (!$this->model->intoAttr()) {
                $this->error($this->model->error);
            } else {
                $this->success('添加成功');
            }
        }

        $cateInfo = Data::tree(K('category')->all(),'cname');
        $this->assign('cateInfo',$cateInfo);
    	$this->display();
    }

    /**
     * 批量导入
     */
    public function implode()
    {
        echo 'hi';
    }
}
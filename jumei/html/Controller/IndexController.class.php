<?php
//首页控制器
class IndexController extends CommonController{
    //动作方法
    public function index(){
    	// 菜单部分推荐品牌
    	$brandsData = K('Brands')->where("is_hot=1")->limit(8)->all();
    	$this->assign('brandsData',$brandsData);

        // 获得全部品牌
        $allbrands = K('Brands')->where("is_show=1")->all();
        // p($allbrands);
        $this->assign('allbrands',$allbrands);

        // 获得所有的品牌分类
        $bandsCate = K("BrandsCate")->all();
        // p($bandsCate);
        $this->assign('bandsCate',$bandsCate);

    	// 获得所有分类
    	$cateData = K('Category')->all(); 
        // p($cateData);

        // 获得顶级分类
    	$topCata = K('Category')->where('pid=0')->all();
    	// p($topCata);

        $cate = K('Category')->where('pid=0')->all();
        // 获得顶级分类的子分类
        foreach ($cate as $k => $v) {
           $cate[$k]['son'] = K('Category')->where('pid=' . $v['cid'])->all();
           foreach ($cate[$k]['son'] as $key => $value) {
              $cate[$k]['son'][$key]['son'] = K('Category')->where('pid=' . $value['cid'])->all();
           }
        }
        // p($cate);
    	$this->assign('cate',$cate);

        //显示视图
        $this->display();
    }




}
?>

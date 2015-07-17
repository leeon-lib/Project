<?php 
/**
* 生成静态页控制器
*/
class HtmlController extends CommonController{
	public function __init(){
		parent::__init();
		//检测后台是否登陆
		if(!isset($_SESSION['aid']) || !isset($_SESSION['adminname'])){
			go(U('Admin/Login/index'));
		}
	}
	/**
	 * 生成首页静态
	 */
	public function index(){
		$this->createHtml('Index', './index.html');
		$this->success('生成成功',U('Admin/Index/welcome'));
	}

	// 列表页生成静态
	public function _list(){
		// 获得分类表中的数据
		$cateData = K('Category')->where('is_listhtml=1')->all();
		// 循环数组
		foreach ($cateData as $v) {
			// 获得点击的分类id
			$_GET['cid'] = $v['cid'];
			// 组合路径
			$path ='Static/' . C('INDEX_TPL_STYLE') . '/' . $v['htmldir'] . '/index.html';
			// 改变分页的地址
			//{page}.html 只需要这么写，自动替换成1.html或者2.html
			Page::$staticUrl = __ROOT__ . '/Static/' . C('INDEX_TPL_STYLE') . '/' . $v['htmldir'] . '/{page}.html';
			// 生成静态
			$this->createHtml('Newslist',$path);
			// 生成分页的静态
			for ($i=1; $i <=Page::$staticTotalPage ; $i++) { 
				// 获得地址栏的分页值
				$_GET['page'] = $i; 
				// 组织分页存放的路径
				$path = "Static/" . C('INDEX_TPL_STYLE') . "/" . $v['htmldir'] . "/{$i}.html";
				$this->createHtml('Newslist', $path);
			}
		}
		$this->success('生成成功',U('Admin/Index/welcome'));
	}

	// 内容页生成静态
	public function content(){
		$arcData = M()->join("__article__ a JOIN __category__ c ON a.category_cid=c.cid")->where("is_archtml=1")->all();
		foreach ($arcData as $v) {
			$_GET['aid'] = $v['aid'];
			$path = 'Static/' . C('INDEX_TPL_STYLE') . '/' . $v['htmldir'] . "/arc/{$v['aid']}.html";
			$this->createHtml('New',$path);
		}
		$this->success('生成成功',U('Admin/Index/welcome'));
	}

	public function createHtml($controller,$path){
		ob_start();
	   //执行访问
	   A('Index/'.$controller.'/index');
	   $data = ob_get_contents();
	   ob_clean();
	   //创建目录
	   $dir = dirname($path);
	   is_dir($dir) || mkdir($dir, 0777,true);
	   //写成静态文件
	   file_put_contents($path, $data);
	   
	}

}
 ?>
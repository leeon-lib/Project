<?php 
/**
* 公共控制器
*/
class CommonController extends Controller{
	public function __init(){
		parent::__init();
		$this->ifLogin();
		header('Content-type: text/html;charset=utf-8');
	}


	public function ifLogin(){
		if(!isset($_SESSION['uid']) && !isset($_SESSION['uname'])){
			session('url',__URL__);
			// 这里一定要两种情况都赋值，否则静态页判断不了
			$this->assign('ifLogin','0');
			return 0;
		}else{
			$this->assign('ifLogin','1');
			return 1;
		}
	}
	
	// 验证码
	public function code(){
		$code = new Code();
		$code->show();
	}


	//	退出登录
	public function out(){
//		清除session
		// session_unset();
		// session_destroy();
		unset($_SESSION['uid']);
		unset($_SESSION['uname']);
		$this->success('退出成功', U('Index/Index/index'));
	}

    // 面包屑导航获得父级分类
    public function getFather($data,$cid){
        $temp = array();
        foreach ($data as $v) {
            if($v['cid']==$cid){
                $temp[] = $v;
                $temp = array_merge($temp,$this->getFather($data, $v['pid']));
            }
        }
        return $temp;
    }



}
 ?>
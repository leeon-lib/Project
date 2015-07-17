<?php 
class LoginController extends CommonController{

	/**
	 * 验证码
	 */
	public function code(){
		$code = new Code();
		$code->show();
	}


	// 检测用户名是否存在
	public function checkUser(){
		if(!IS_AJAX) $this->error('非法请求');
		//用户名
		$username = Q('post.username');
		//如果有数据，证明用户名存在
		if(K('User')->where("username='{$username}'")->find()){
			$this->ajax(array('message'=>'用户名已存在','status'=>false));
		}else{
			$this->ajax(array('message'=>'可以注册','status'=>true));
		}
	}

	//验证码验证
	public function checkCode() {
		if(!IS_AJAX) $this->error('非法请求');
		$code = Q('post.regcode');
	    if(strtoupper($code) != $_SESSION['code']){
			$this->ajax(array('message'=>'验证码错误','status'=>false));
		}else{
			$this->ajax(array('message'=>'ok','status'=>true));
		}
	} 

	// 注册
	public function regist(){
		if(IS_POST){
			$data = K('User')->all();
			if(!Q('post.username' ) || !Q('post.password') || !Q('post.regcode')){
				$this->error('有必填项未填');
			}
			foreach ($data as $v) {
				if(Q('post.username')==$v){
					$this->error('用户名已经存在,不能重复注册');
				}
			}
			// 获得用户提交的数据
			$password = md5($_POST['password']);
			$data = array(
				'username'=>Q('post.username'),
				'password'=>$password,
				'nickname'=>Q('post.nickname')
			);
			K('User')->add($data);
			$this->success('注册成功',U('Index/Index/index'));		
		}
		$this->display();
	}


// 登录
	public function index(){
		// 判断是否登录
		if(isset($_SESSION['uname'])){
			$this->success('您已经登录，不能重复登录', U('Index/Index/index'));
		}
		if(IS_POST){
			// p(Q('post.'));die;	
			//验证码比对查询
			if (strtoupper(Q('post.code')) != $_SESSION['code']) {
				$this->error('验证码不正确！');
				die;
			}

			//接收用户数据
			$username = Q('post.username');
			$password = md5(Q('post.password'));
			// $code = Q('post.code');
			//判断用户输入的用户名和密码和数据库中的是不是一样
			$data = K('User')->where("username='{$username}'")->find();
			// p($data);die;
			//判断，如果查询有结果，取反那就是没有这个结果，
			if (!$data) {
			    $this->error('用户不存在！');
			    die;
			}
			//密码比对查询
			if ($password != $data['password']) {
				$this->error('密码不正确！');
				die;
			}
			
			//用户名密码和验证码都正确
			if($data['username']==$username && $data['password']==$password){
				//将用户名存入session里
				$_SESSION['uname'] = $username;
				$_SESSION['uid'] = $data['uid'];
				//判断是否为自动登录
				if(isset($_POST['auto'])){
					setcookie(session_name(),session_id(),time()+3600*24*7,'/');
				}else{
					setcookie(session_name(),session_id(),0,'/');
				}
				$this->success('登录成功', U('Index/Index/index'));
				
			}

			$this->error('登录失败');
		}
		$this->display();
	}

	



}
 ?>
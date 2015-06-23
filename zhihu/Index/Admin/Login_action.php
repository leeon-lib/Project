<?php

/**
* 登陆注册类
*/
class Login extends lf_Controller
{
	private $db;

	function __construct()
	{
//		$this->db = lf_load::include_db('user');
	}

	/**
	* 默认首页
	*/
	public function index() {

		$this->view('signup');
	}


	/**
	* 登陆
	*/
	public function signin() {
		
		// 判断填写的内容是否完整
		if (!empty($_POST)){
			// 判断用户名与密码是否正确
			$usermail = md5($_POST['mail']);
			$password = md5($_POST['password']);
			$checkcode = strtolower($_POST['checkcode']);
			// 判断验证码
			if ($checkcode != strtolower($_SESSION['checkcode'])){
				$this->message('验证码错误！','./index.php?c=Login&a=signin');
				die;
			}
			foreach ($this->db as $v) {
				if ($v['mail'] == $usermail && $v['password'] == $password){
					$this->message('登录成功','http://zhihu.com');
					break;
				}
			}
			if (isset($_POST['rememberme'])) {
				setcookie(session_name(),session_id(),time()+3600*24*3,'/');
			}else{
				setcookie(session_name(),session_id(),0,'/');
			}
			// 错误提示
			$this->message('用户名或者密码错误','./index.php?c=Login&a=signin');
		}
		
		// 载入模版
		$this->view('signin');;
	}

	/**
	* 用户注册
	*/
	public function signup() {
		
		// 判断填写的内容是否完整
		foreach ($_POST as $v) {
			if ($v == ""){
				die("请填写完整内容！");
			}
		}
		// 判断注册邮箱是否已存在
		$usermail = md5($_POST['mail']);
		foreach ($this->db as $v) {
			if ($v['mail'] == $usermail){
				die("该邮箱已注册！");
			}
		}
		// 判断验证码是否正确
		$checkcode = strtolower($_POST['checkcode']);
		if ($checkcode != strtolower($_SESSION['checkcode'])){
			$this->message('验证码错误','./index.php');
		}

		// 写入注册信息
		$_POST['mail'] 		= $usermail;
		$_POST['password']	= md5($_POST['password']);
		$_POST['signup_time'] = time();
		$_POST['signup_date'] = date('Y-m-d H:i:s');
		// 删除POST中的验证码
		unset($_POST['checkcode']);
		$this->db[] = $_POST;
		$phpCode = var_export($this->db,true);
		file_put_contents('./database.php', "<?php return $phpCode; ?>");
		// 提示
		$this->message("注册成功",'./index.php?c=login&a=signin');
	}


	/**
	* 显示验证码
	*/
	public function showCheckCode(){
		$checkCode = new lf_checkCode(204,35,'#E7F1F8');
		$checkCode->createCheckCode();
		// 将生成的验证码session存储
		$_SESSION['checkcode'] = $checkCode->getCode();
	}


}
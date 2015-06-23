<?php

/**
* 登陆注册类
*/
class Login extends lf_Controller
{
	private $db;

	function __construct()
	{
		// 加载用户信息数据库
		$this->db = lf_load::include_db('user');
	}


	/**
	* 登陆页
	*/
	public function index() {
//		if (session_id()){
//			$this->view('friendsCircle');
//			die;
//		}
		
		// 判断填写的内容是否完整
		if (!empty($_POST)){
			// 判断用户名与密码是否正确
			$usermail = md5($_POST['mail']);
			$password = md5($_POST['psw']);
			$checkcode = strtolower($_POST['checkcode']);
			// 判断验证码
			if ($checkcode != strtolower($_SESSION['checkcode'])){
				$this->message('验证码错误！','./test.php?c=login');
				die;
			}
			foreach ($this->db as $v) {
				if ($v['usermail'] == $usermail && $v['password'] == $password){
					$_SESSION['usermail'] = $usermail;
					$this->message('登录成功',__APP__ . "?c=friendsCircle");
					break;
				}
			}
			if (isset($_POST['rememberme'])) {
				setcookie(session_name(),session_id(),time()+3600*24*3,'/');
			}else{
				setcookie(session_name(),session_id(),0,'/');
			}
			// 错误提示
			$this->message('用户名或者密码错误','./test.php?c=login');
		}
		
		// 载入模版
		$this->view('index');
	}

	/**
	* 用户注册
	*/
	public function sign() {
		
		if(!empty($_POST)){
			// 判断验证码是否正确
			$checkcode = strtolower($_POST['checkcode']);
			if ($checkcode != strtolower($_SESSION['checkcode'])){
				$this->message('验证码错误','./test.php?a=sign');
			}
			
			$infoArr = array();
			$infoArr['username'] = $_POST['username'];
			$infoArr['usermail'] = md5($_POST['usermail']);
			$infoArr['password'] = md5($_POST['password']);
			$infoArr['signup_time'] = time();
			$infoArr['signup_date'] = date('Y-m-d H:i:s');
			
			$this->db[] = $infoArr;
			
			dataToFile(DB_PATH . '/user_db.php', $this->db);
			// 提示
			$this->message("注册成功",'./test.php?c=login&a=index');
		}
		$this->view('sign');
	}
	
	/**
	 * 异步验证
	 */
	public function ajax_check()
	{
		
		$name = $_POST['name'];
		$value = $_POST['cont'];
		// 邮箱验证
		if('usermail' == $name){
			$value = md5($value);
			foreach ($this->db as $v){
				if ($v['usermail'] == $value){
					echo '1';
					return;
				}
			}
			echo '0';
		}
		
		// 验证码
		if ('checkcode' == $name){
			$value = strtolower($value);
			if ($value != strtolower($_SESSION['checkcode'])){
				echo 0;
			}
		}
	}

	/**
	* 显示验证码
	*/
	public function checkCode(){
		$checkCodeObj = lf_load::lib('lf_checkCode');
		$checkCodeObj->mkCheckCode(100,35,'#0F5B8B');
		// 将生成的验证码session存储
		$_SESSION['checkcode'] = $checkCodeObj->getCode();
	}


}
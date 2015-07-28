<?php

/**
* 后台登录控制器
*/
class LoginController extends Controller
{
	/**
	 * 后台登录页面
	 * @return [type] [description]
	 */
	public function index()
	{
		if (IS_POST) {
			$model = K('User');
			// 开始模型层验证
			$userInfo = $model->login();
			// 如果未通过验证，则提示错误
			if (!$userInfo) {
				$this->error($model->error);
			} else {
				$_SESSION['aid'] = $userInfo['uid'];
				$_SESSION['aname'] = $userInfo['username'];
				$time = time();
				$model->where("uid={$userInfo['uid']}")->save(array('login_time'=>$time));
				// $this->success('登录成功',U('Admin/Index/Index'));
				go(U('Admin/Index/Index'));
			}
		}
		$this->display();
	}

	/**
	 * 验证码
	 */
	public function code()
	{
		$code = new Code();
		$code->show();
	}

	/**
	 * 退出登录
	 */
	public function logout()
	{
		session(null);
		$this->success('退出成功',U('Admin/Login/Index'));
	}

}
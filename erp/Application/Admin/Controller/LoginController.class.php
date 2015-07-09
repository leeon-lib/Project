<?php

namespace Admin\Controller;
use Think\Controller;

/**
* 后台登录控制器
*/
class LoginController extends Controller
{
	

	/**
	 * 后台登录页
	 */
	public function index()
	{

		$this->display();
	}

	/**
	 * 登录
	 */
	public function logIn()
	{
		$adminModel = D('Admin');
		$code = I('post.code');
		$data = [
			'username' => I('post.username'),
			'password' => md5(I('post.password'))
		];
		// 表单完整性验证
		if (!$adminModel->create())
		{
			$this->error($adminModel->getError());
		}
		// 验证码验证
		if (!$this->checkCode($code))
		{
			$this->error('验证码错误');
		}
		// 用户信息验证
		if (!$adminModel->checkIn($data))
		{
			$this->error($adminModel->getError());
		} else {
			// 登录成功
			// $this->success('登录成功',U('Admin/Index/Index'));
			$this->redirect('Admin/Index/index');
		}
		
	}

	/**
	 * 退出登录
	 */
	public function logOut()
	{
		session(null);
		$this->success('退出成功',U('Admin/Login/Index'));
	}

	/**
	 * 验证码
	 */
	public function showCode()
	{
		$config = [
			'length' => 1,
			'imageW' => 150,
			// 'imageH' => 20,
			'fontSize' => 22,
			// 'useCurve' => false,
			'useNoise' => false,
			'bg' 	 => [255, 255, 250],
		];
		$verify = new \Think\Verify($config);
		$verify->entry();
	}

	/**
	 * 验证码验证
	 */
	private function checkCode($code='')
	{
		$verify = new \Think\Verify();
		return $verify->check($code);
	}

}
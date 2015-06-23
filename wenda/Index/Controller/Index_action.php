<?php

//header('Content-type:text/html;charset=utf-8');
class Index_action extends Common_action
{
    //private $mysqlObj = null;

    public function __construct() {
        parent::__construct();
        //$this->mysqlObj = @Lf_load::db_lib('mysql_class');
    }

    /**
     * 主页
     */
    public function index() {
        //判断缓存是否失效
        if (!$this->is_cached()) {
            // 公共右侧信息处理
            $this->getRightInfo();

            //左侧分类信息
            $cateData = $this->getTopCate(false);
            foreach ($cateData as $k => $v) {
                $cateData[$k]['son'] = M()->query("SELECT * FROM category WHERE pid={$v['cid']}");
            }
            $this->assign('cateData', $cateData);

            //页面头部问题库
            $this->getTopCate();

            /**---页面中部问题块---**/
            //待解决的问题,按时间排序
            $noSolve = M()->query("SELECT asid,content,answer FROM ask WHERE solve=0 order by time desc");
            $this->assign('noSolve', $noSolve);

            // 高分悬赏问题，按悬赏额高低排序
            $highReward = M()->query("SELECT asid,content,answer,reward FROM ask WHERE reward>0 AND solve=0 order by reward desc limit 5;");
            // print_r($highReward);
            $this->assign('highReward',$highReward);

            
        }
        $this->display();
    }

    /**
     * 登录
     */
    public function signin() {
//        if (IS_POST) {
            $username = $_POST['username'];
            $password = md5($_POST['pwd']);

            $sql = "SELECT * FROM user WHERE username='{$username}'";
            //查询用户
            $data = M()->query($sql);
            if (!$data) {
                $this->error('用户不存在');
            }
            //比对
            if ($password != $data[0]['passwd']) {
                $this->error('密码错误');
            }
            // 修改用户表的登录时间
            M()->exec("UPDATE user SET logintime= unix_timestamp() WHERE uid= {$data[0]['uid']};");
            //session
            $_SESSION['uname'] = $username;
            $_SESSION['uid'] = (int)$data[0]['uid'];

            //登录成功
            $this->success('登录成功', __APP__);
//        }
    }

    /**
     * 注册
     */
    public function signup() {
//		$username = $_POST['username'];
//		$sql = "SELECT uid FROM user WHERE username= '{$username}' ";
//		$res = M()->getAll($sql);
//		if ($res){
//			$this->message('用户已存在！', __APP__);
//		}
//		$psw = md5($_POST['pwded']);
//		$intoSql = "INSERT INTO user(username,passwd) value('{$username}','{$psw}')";
//		M()->exec($intoSql);
//		$this->message('注册成功', __APP__);
//                if(strtoupper($_POST['code']) != $_SESSION['code']){
//                        $this->error('验证码错误');
//                }
        //获得用户提交的数据
        $username = $_POST['username'];
        //密码
        $password = md5($_POST['pwd']);
        //注册时间
        $resTime = time();

        //组合SQL
        $sql = "INSERT INTO user SET username='{$username}',passwd='{$password}',restime={$resTime}";
        //执行插入
        M()->exec($sql);
        $this->success('注册成功', __APP__);
    }

    /**
     * 退出
     */
    public function out() {
        session_unset();
        session_destroy();
        $this->success('退出成功', __APP__);
    }

    /**
     * 验证码
     */
    public function checkCode() {
        $codeObj = lf_load::lib('lf_checkCode');
//        var_dump($codeObj);die;
        $codeObj->mkCheckCode();

        $_SESSION['checkcode'] = $codeObj->getCode();
    }

    /**
     * Ajax验证账户信息
     */
    public function ajaxCheck()
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM user WHERE username='{$username}'";
        //查询用户
        $data = M()->query($sql);
        if (!$data) {
            echo 0;     //用户不存在
            return;
        }
        //比对
        if ($password != $data[0]['passwd']) {
            echo 2;     //密码错误
            return;
        }
        // 修改用户表的登录时间
        M()->exec("UPDATE user SET logintime= unix_timestamp() WHERE uid= {$data[0]['uid']};");
        //session
        $_SESSION['uname'] = $username;
        $_SESSION['uid'] = (int)$data[0]['uid'];
        echo 1;     //正确登录
        return;
    }

}

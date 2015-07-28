<?php /* Smarty version 2.6.26, created on 2015-06-07 19:03:39
         compiled from ../../../Common/header.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'nocache', '../../../Common/header.html', 22, false),)), $this); ?>
<?php $this->_cache_serials['/Users/Liyn/Desktop/home/wenda/Index/Temp/Compile//%%5F^5F1^5F14798D%%header.html.inc'] = '7aea798b191e20d8e5eefe9908760c9d'; ?><link rel="stylesheet" href="<?php echo @__PUBLIC__; ?>
Css/common.css" />
<script type="text/javascript" src='<?php echo @__PUBLIC__; ?>
Js/jquery-1.7.2.min.js'></script>
<script type="text/javascript" src='<?php echo @__PUBLIC__; ?>
Js/top-bar.js'></script>
<script type="text/javascript">
    // 设置检测是否登录的变量
    <?php if (( isset ( $_SESSION['uname'] ) && isset ( $_SESSION['uid'] ) )): ?>
        var isLogin = <?php echo $_SESSION['uid']; ?>
;
    <?php else: ?>
        var isLogin = 0;
    <?php endif; ?>
</script>
</head>
<body>
    <!-- top -->
    <div id='top-fixed'>
        <div id='top-bar'>
            <ul class="top-bar-left fl">
                <li><a href="http://www.houdunwang.com" target='_blank'>后盾顶尖后盾PHP培训</a></li>
                <li><a href="http://www.houdunwang.com" target='_blank'>后盾论坛</a></li>
            </ul>
            <ul class='top-bar-right fr'>
                <?php if ($this->caching && !$this->_cache_including): echo '{nocache:7aea798b191e20d8e5eefe9908760c9d#0}'; endif;$this->_tag_stack[] = array('nocache', array()); $_block_repeat=true;nocache($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                <?php if (( isset ( $_SESSION['uname'] ) && isset ( $_SESSION['uid'] ) )): ?>
                    <li class='userinfo'>
                        <a href="" class='uname'><?php echo $_SESSION['uname']; ?>
</a>
                    </li>
                    <li style='color:#eaeaf1'>|</li>
                    <li><a href="<?php echo @__APP__; ?>
?c=Index&a=out">退出</a></li> 
                <?php else: ?>
                    <li><a href="" class='login'>登录</a></li>
                    <li style='color:#eaeaf1'>|</li>
                    <li><a href="" class='register'>注册</a></li>	
                <?php endif; ?>
                <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo nocache($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including): echo '{/nocache:7aea798b191e20d8e5eefe9908760c9d#0}'; endif;?>
            </ul>
        </div>
        <!-- 提问搜索框 -->
        <div id='search'>
            <div class='logo'><a href="<?php echo @__APP__; ?>
" class='logo'></a></div>
            <form action="" method=''>
                <input type="text" name='' class='sech-cons'/>
                <input type="submit" class='sech-btn'/>
            </form>
            <a href="<?php echo @__APP__; ?>
?c=Ask" class='ask-btn'></a>
        </div>
        <!-- 提问搜索框结束 -->
        </script>
    </div>
    <div style='height:110px'></div>
    <!----------导航条---------->
    <div id='nav'>
        <ul class='list'>
            <li class='nav-sel'><a href="<?php echo @__APP__; ?>
" class='home'>问答首页</a></li>
            <li class='nav-sel ask-cate'>
                <a href="" class='ask-list'><span>问题库</span><i></i></a>
                <ul class='hidden'>
                    <?php $_from = $this->_tpl_vars['topCate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
                    <li>
                        <a href="<?php echo @__APP__; ?>
?c=List&cid=<?php echo $this->_tpl_vars['v']['cid']; ?>
"><?php echo $this->_tpl_vars['v']['title']; ?>
</a>
                    </li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            </li>
        </ul>
        <p class='total'>累计提问：1123211</p>
    </div>

    <!----------注册框---------->
    <div id='register' class='hidden'>
        <div class='reg-title'>
            <p>欢迎注册后盾问答</p>
            <a href="" title='关闭' class='close-window'></a>
        </div>
        <div id='reg-wrap'>
            <div class='reg-left'>
                <ul>
                    <li><span>账号注册</span></li>
                </ul>
                <div class='reg-l-bottom'>
                    已有账号，<a href="" id='login-now'>马上登录</a>
                </div>
            </div>
            <div class='reg-right'>
                <form action="<?php echo @__APP__; ?>
?c=Index&a=signup" method='post' name='register'>
                    <ul>
                        <li>
                            <label for="reg-uname">用户名</label>
                            <input type="text" name='username' id='reg-uname'/>
                            <span>2-14个字符：字母、数字或中文</span>
                        </li>
                        <li>
                            <label for="reg-pwd">密码</label>
                            <input type="password" name='pwd' id='reg-pwd'/>
                            <span>6-20个字符:字母、数字或下划线 _</span>
                        </li>
                        <li>
                            <label for="reg-pwded">确认密码</label>
                            <input type="password" name='pwded' id='reg-pwded'/>
                            <span>请再次输入密码</span>
                        </li>
                        <li>
                            <label for="reg-verify">验证码</label>
                            <input type="text" name='code' id='reg-verify'/>
                            <img src="<?php echo @__APP__; ?>
?c=Index&a=checkCode" width='99' height='35' alt="验证码" id='verify-img'/>
                            <span>请输入图中的字母或数字，不区分大小写</span>
                        </li>
                        <li class='submit'>
                            <input type="submit" value='立即注册'/>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>

    <!----------登录框---------->	
    <div id='login' class='hidden'>
        <div class='login-title'>
            <p>欢迎您登录后盾问答</p>
            <a href="" title='关闭' class='close-window'></a>
        </div>
        <div class='login-form'>
            <span id='login-msg'></span>
            <!-- 登录FORM -->
            <form action="<?php echo @__APP__; ?>
?c=Index&a=signin" method='post' name='login'>
                <ul>
                    <li>
                        <label for="login-acc">账号</label>
                        <input type="text" name='username' class='input' id='login-acc'/>
                    </li>
                    <li>
                        <label for="login-pwd">密码</label>
                        <input type="password" name='pwd' class='input' id='login-pwd'/>
                    </li>
                    <li class='login-auto'>
                        <label for="auto-login">
                            <input type="checkbox" checked='checked' name='auto'  id='auto-login'/>&nbsp;下一次自动登录
                        </label>
                        <a href="" id='regis-now'>注册新账号</a>
                    </li>
                    <li>
                        <input type="submit" value='' id='login-btn'/>
                    </li>
                </ul>
            </form>
        </div>
    </div>

    <!--背景遮罩--><div id='background' class='hidden'></div>
    <!-- top -->

<script type="text/javascript">
    $('#login-btn').click(function(){
        var username = $('#login-acc').val();
        var password = $('#login-pwd').val();
        if ((username.length == 0) || (password.length == 0)) {
            alert('请填写完整内容');
            return false;
        }

        $.ajax({
            type : "post",
            url  : "<?php echo @__APP__; ?>
?a=ajaxCheck",
            data : {username:username,password:password},
            async: false,
            success:function(id){
                if (0 == id) {
                    alert('用户不存在');
                    return;
                }else if (2 == id){
                    alert('密码错误');
                    return;
                }else {
                    $('.close-window').click();
                    var str = "<li class='userinfo'><a href="" class='uname'><?php echo $_SESSION['uname']; ?>
</a></li><li style='color:#eaeaf1'>|</li><li><a href="+<?php echo @__APP__; ?>
?c=Index&a=out+">退出</a></li>";
                    $('.top-bar-right fr').replaceWith(str);
                    return;
                }
            }
        });
        return false;
    })
</script>
<?php /* Smarty version 2.6.26, created on 2015-06-07 16:14:17
         compiled from ../../../Common/right.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'nocache', '../../../Common/right.html', 2, false),)), $this); ?>
<?php $this->_cache_serials['/Users/Liyn/Desktop/home/wenda/Index/Temp/Compile//%%BB^BBC^BBC1433A%%right.html.inc'] = '570801c47689415232955956edb77eec'; ?><div id='right'>
    <?php if ($this->caching && !$this->_cache_including): echo '{nocache:570801c47689415232955956edb77eec#0}'; endif;$this->_tag_stack[] = array('nocache', array()); $_block_repeat=true;nocache($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php if (( isset ( $_SESSION['uname'] ) && isset ( $_SESSION['uid'] ) )): ?>
    <div class='userinfo'>
        <dl>
            <dt>
            <a href=""><img src="" width='48' height='48' alt="占位符"/></a>
            </dt>
            <dd class='username'>
                <a href="">
                    <b><?php echo $this->_tpl_vars['argsR']['user']['username']; ?>
</b>
                </a>
                <a href="">
                    <i class='level lv1' title='Level 1'></i>
                </a>
            </dd>
            <dd>金币：<a href="" style="color: #888888;"><?php echo $this->_tpl_vars['argsR']['user']['point']; ?>
<b class='point'></b></a></dd>
            <dd>经验值：<?php echo $this->_tpl_vars['argsR']['user']['exp']; ?>
</dd>
        </dl>
        <table>
            <tr>
                <td>回答数</td>
                <td>采纳率</td>
                <td class='last'>提问数</td>
            </tr>
            <tr>
                <td><a href=""><?php echo $this->_tpl_vars['argsR']['user']['answer']; ?>
</a></td>
                <td><a href=""><?php echo $this->_tpl_vars['argsR']['user']['accept']; ?>
%</a></td>
                <td class='last'><a href=""><?php echo $this->_tpl_vars['argsR']['user']['ask']; ?>
</a></td>
            </tr>
        </table>
        <ul>
            <li><a href="">我提问的</a></li>
            <li><a href="">我回答的</a></li>
        </ul>
    </div>
    <?php else: ?>
    <div class='r-login'>
        <span class='login'><i></i>&nbsp;登录</span>
        <span class='register'><i></i>&nbsp;注册</span>
    </div>
    <?php endif; ?>
    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo nocache($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); if ($this->caching && !$this->_cache_including): echo '{/nocache:570801c47689415232955956edb77eec#0}'; endif;?>

    <div class='clear'></div>
    <div class='star'>
        <p class='title'>后盾问答之星</p>
        <span class='star-name'>本日回答问题最多的人</span>
        <div class='star-info'>
            <?php if (( ! isset ( $this->_tpl_vars['argsR']['today'] ) )): ?>
                <div>
                    <a href="" class='star-face'>
                        <img src="" width='48px' height='48px' alt="头像站位"/>
                    </a>
                    <ul>
                        <li><a href="">暂无</a></li>
                        <i class='level lv1' title='Level 1'></i>
                    </ul>
                </div>
                <ul class='star-count'>
                    <li>回答数：<span>暂无</span></li>
                    <li>采纳率：<span>暂无</span></li>
                </ul>
            <?php else: ?>
                <div>
                    <a href="" class='star-face'>
                        <img src="" width='48px' height='48px' alt="头像站位"/>
                    </a>
                    <ul>
                        <li><a href=""><?php echo $this->_tpl_vars['argsR']['today']['username']; ?>
</a></li>
                        <i class='level lv1' title='Level 1'></i>
                    </ul>
                </div>
                <ul class='star-count'>
                    <li>回答数：<span><?php echo $this->_tpl_vars['argsR']['today']['answer']; ?>
</span></li>
                    <li>采纳率：<span><?php echo $this->_tpl_vars['argsR']['today']['accept']; ?>
%</span></li>
                </ul>
            <?php endif; ?>
        </div>
        <span class='star-name'>历史回答问题最多的人</span>
        <div class='star-info'>
            <?php if (( ! isset ( $this->_tpl_vars['argsR']['history'] ) )): ?>
                <div>
                    <a href="" class='star-face'>
                        <img src="" width='48px' height='48px' alt="头像站位"/>
                    </a>
                    <ul>
                        <li><a href="">暂无</a></li>
                        <i class='level lv1' title='Level 1'></i>
                    </ul>
                </div>
                <ul class='star-count'>
                    <li>回答数：<span>暂无</span></li>
                    <li>采纳率：<span>暂无</span></li>
                </ul>
            <?php else: ?>
                <div>
                    <a href="" class='star-face'>
                        <img src="" width='48px' height='48px' alt="头像站位"/>
                    </a>
                    <ul>
                        <li><a href=""><?php echo $this->_tpl_vars['argsR']['history']['username']; ?>
</a></li>
                        <i class='level lv1' title='Level 1'></i>
                    </ul>
                </div>
                <ul class='star-count'>
                    <li>回答数：<span><?php echo $this->_tpl_vars['argsR']['history']['answer']; ?>
</span></li>
                    <li>采纳率：<span><?php echo $this->_tpl_vars['argsR']['history']['accept']; ?>
%</span></li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <div class='star-list'>
        <p class='title'>后盾问答助人光荣榜</p>
        <div>
            <ul class='ul-title'>
                <li>用户名</li>
                <li style='text-align:right;'>帮助过的人数</li>
            </ul>
            <?php if (( ! isset ( $this->_tpl_vars['argsR']['help'] ) )): ?>
                <ul class='ul-list'>
                    <li>
                        <a href=""><i class='rank r1'></i>暂无</a>
                        <span>未知</span>
                    </li>
                </ul>
            <?php else: ?>
                <ul class='ul-list'>
                    <li>
                        <a href=""><i class='rank r1'></i><?php echo $this->_tpl_vars['argsR']['help']['username']; ?>
</a>
                        <span><?php echo $this->_tpl_vars['argsR']['help']['accept']; ?>
</span>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
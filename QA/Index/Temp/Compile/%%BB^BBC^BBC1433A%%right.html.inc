<?php /* Smarty version 2.6.26, created on 2015-06-07 16:14:17
         compiled from ../../../Common/right.html */

$this->_cache_serials['/Users/Liyn/Desktop/home/wenda/Index/Temp/Compile//%%BB^BBC^BBC1433A%%right.html.inc'] = '570801c47689415232955956edb77eec';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'nocache', '../../../Common/right.html', 2, false),)), $this); ?>
<?php
function _smarty_tplfunc_570801c47689415232955956edb77eec_0(&$_smarty)
{
$_smarty->_tag_stack[] = array('nocache', array()); $_block_repeat=true;nocache($_smarty->_tag_stack[count($_smarty->_tag_stack)-1][1], null, $_smarty, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php if (( isset ( $_SESSION['uname'] ) && isset ( $_SESSION['uid'] ) )): ?>
    <div class='userinfo'>
        <dl>
            <dt>
            <a href=""><img src="" width='48' height='48' alt="占位符"/></a>
            </dt>
            <dd class='username'>
                <a href="">
                    <b><?php echo $_smarty->_tpl_vars['argsR']['user']['username']; ?>
</b>
                </a>
                <a href="">
                    <i class='level lv1' title='Level 1'></i>
                </a>
            </dd>
            <dd>金币：<a href="" style="color: #888888;"><?php echo $_smarty->_tpl_vars['argsR']['user']['point']; ?>
<b class='point'></b></a></dd>
            <dd>经验值：<?php echo $_smarty->_tpl_vars['argsR']['user']['exp']; ?>
</dd>
        </dl>
        <table>
            <tr>
                <td>回答数</td>
                <td>采纳率</td>
                <td class='last'>提问数</td>
            </tr>
            <tr>
                <td><a href=""><?php echo $_smarty->_tpl_vars['argsR']['user']['answer']; ?>
</a></td>
                <td><a href=""><?php echo $_smarty->_tpl_vars['argsR']['user']['accept']; ?>
%</a></td>
                <td class='last'><a href=""><?php echo $_smarty->_tpl_vars['argsR']['user']['ask']; ?>
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
    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo nocache($_smarty->_tag_stack[count($_smarty->_tag_stack)-1][1], $_block_content, $_smarty, $_block_repeat); }  array_pop($_smarty->_tag_stack); 
}



?>

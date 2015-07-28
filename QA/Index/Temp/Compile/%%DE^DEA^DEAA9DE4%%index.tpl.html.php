<?php /* Smarty version 2.6.26, created on 2015-06-06 17:26:57
         compiled from /Users/Liyn/Desktop/home/wenda/Index/View/List/index.tpl.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
            <title>后盾问答</title>
            <meta name="keywords" content="后盾问答"/>
            <meta name="description" content="后盾问答"/>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../../Common/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <link rel="stylesheet" href="<?php echo @__PUBLIC__; ?>
Css/list.css" />


            <div id='location'>
                <a href="<?php echo @__APP__; ?>
?c=list&pid=0">全部分类</a>
                <!-- 如果导航链存在(pid不为0) -->
                <?php if (( isset ( $this->_tpl_vars['argv']['cateLink'] ) )): ?>
                    <?php unset($this->_sections['v']);
$this->_sections['v']['loop'] = is_array($_loop=$this->_tpl_vars['argv']['cateLink']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['v']['name'] = 'v';
$this->_sections['v']['show'] = true;
$this->_sections['v']['max'] = $this->_sections['v']['loop'];
$this->_sections['v']['step'] = 1;
$this->_sections['v']['start'] = $this->_sections['v']['step'] > 0 ? 0 : $this->_sections['v']['loop']-1;
if ($this->_sections['v']['show']) {
    $this->_sections['v']['total'] = $this->_sections['v']['loop'];
    if ($this->_sections['v']['total'] == 0)
        $this->_sections['v']['show'] = false;
} else
    $this->_sections['v']['total'] = 0;
if ($this->_sections['v']['show']):

            for ($this->_sections['v']['index'] = $this->_sections['v']['start'], $this->_sections['v']['iteration'] = 1;
                 $this->_sections['v']['iteration'] <= $this->_sections['v']['total'];
                 $this->_sections['v']['index'] += $this->_sections['v']['step'], $this->_sections['v']['iteration']++):
$this->_sections['v']['rownum'] = $this->_sections['v']['iteration'];
$this->_sections['v']['index_prev'] = $this->_sections['v']['index'] - $this->_sections['v']['step'];
$this->_sections['v']['index_next'] = $this->_sections['v']['index'] + $this->_sections['v']['step'];
$this->_sections['v']['first']      = ($this->_sections['v']['iteration'] == 1);
$this->_sections['v']['last']       = ($this->_sections['v']['iteration'] == $this->_sections['v']['total']);
?>
                        <!-- 如果是链的末端，则不设置链接 -->
                        <?php if (( $this->_sections['v']['last'] )): ?>
                            &gt;&nbsp;<?php echo $this->_tpl_vars['argv']['cateLink'][$this->_sections['v']['index']]['title']; ?>
&nbsp;&nbsp;
                        <?php else: ?>
                            &gt;&nbsp;<a href="<?php echo @__APP__; ?>
?c=list&pid=<?php echo $this->_tpl_vars['argv']['cateLink'][$this->_sections['v']['index']]['cid']; ?>
"><?php echo $this->_tpl_vars['argv']['cateLink'][$this->_sections['v']['index']]['title']; ?>
</a>&nbsp;&nbsp;
                        <?php endif; ?>
                    <?php endfor; endif; ?>
                <?php endif; ?>
            </div>

            <!--------------------中部-------------------->
            <div id='center'>
                <div id='left'>
                    <div id='cate-list'>
                        <p class='title'>按分类查找</p>
                        <ul>
                            <?php $_from = $this->_tpl_vars['argv']['subCate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
                    </div>
                    <div id='answer-list'>
                        <ul class='ans-sel'>
                            <li class='on'>
                                <a href="<?php echo @__APP__; ?>
?c=List&cid=<?php echo $this->_tpl_vars['argv']['cateLink']['cid']; ?>
&s=0">待解决问题</a>
                            </li>
                            <li >
                                <a href="<?php echo @__APP__; ?>
?c=List&s=1">已解决</a>
                            </li>
                            <li >
                                <a href="<?php echo @__APP__; ?>
?c=List&s=2">高悬赏</a>
                            </li>
                            <li >
                                <a href="<?php echo @__APP__; ?>
?c=List&s=3">零回答</a>
                            </li>
                        </ul>
                        <!-- 待解决问题 -->
                        <table>
                            <tr>
                                <th class='t1'>标题</th>
                                <th>回答数</th>
                                <th>时间</th>
                            </tr>

                            <tr>
                                <td class='t1 cons'>
                                    <a href="">
                                        <b>20</b>后盾顶尖PHP培训</a>&nbsp;&nbsp;[培训]
                                </td>
                                <td>20</td>
                                <td>1900.1.1</td>
                            </tr>

                            <tr>
                                <td class='t1 cons'>
                                    <a href="">
                                        <b>20</b>后盾顶尖PHP培训</a>&nbsp;&nbsp;[培训]
                                </td>
                                <td>20</td>
                                <td>1900.1.1</td>
                            </tr>
                            <tr>
                                <td class='t1 cons'>
                                    <a href="">
                                        <b>20</b>后盾顶尖PHP培训</a>&nbsp;&nbsp;[培训]
                                </td>
                                <td>20</td>
                                <td>1900.1.1</td>
                            </tr>
                            <tr>
                                <td class='t1 cons'>
                                    <a href="">
                                        <b>20</b>后盾顶尖PHP培训</a>&nbsp;&nbsp;[培训]
                                </td>
                                <td>20</td>
                                <td>1900.1.1</td>
                            </tr>

                            <tr class='page'>
                                <td colspan='3'>
                                    <a href="">1</a>
                                    <a href="">2</a>
                                    <a href="">3</a>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>

                <!-- -- 右侧 ---->
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '../../../Common/right.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <!-- ---右侧结束-- -->
            </div>
            <!--------------------中部结束-------------------->

            <!-- 底部 -->
            <div id='bottom'>
                <p>Copyright © 2013 Qihoo.Com All Rights Reserved 后盾网</p>
                <p>京公安网备xxxxxxxxxxxx</p>
            </div>
            <!--[if IE 6]>
                <script type="text/javascript" src="<?php echo @__PUBLIC__; ?>
Js/iepng.js"></script>
                <script type="text/javascript">
                    DD_belatedPNG.fix('.logo','background');
                    DD_belatedPNG.fix('.nav-sel a','background');
                    DD_belatedPNG.fix('.ask-cate i','background');
                </script>
            <![endif]-->
            </body>
            </html>
            <!-- 底部结束 -->
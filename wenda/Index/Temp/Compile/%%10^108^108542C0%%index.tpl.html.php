<?php /* Smarty version 2.6.26, created on 2015-06-05 21:30:21
         compiled from /Users/Liyn/Desktop/home/wenda/Index/View/Ask/index.tpl.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>后盾问答</title>
    <meta name="keywords" content="后盾问答"/>
    <meta name="description" content="后盾问答"/>
    <link rel="stylesheet" href="<?php echo @__PUBLIC__; ?>
Css/ask.css" />
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../../../Common/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <div id='location'>
        <a href="">后盾问答</a>&nbsp;>&nbsp;提问
    </div>

    <!--------------------中部-------------------->
    <div id='center'>
        <div class='send'>
            <div class='title'>
                <p class='left'>向亿万网友们提问</p>
                <p class='right'>您还可以输入<span id='num'>50</span>个字</p>
            </div>
            <form action="<?php echo @__APP__; ?>
?c=Ask&a=setAsk" method='post'>
                <div class='cons'>
                    <textarea name="content"></textarea>
                </div>
                <div class='reward'>
                    <span id='sel-cate' class='cate-btn'>选择分类</span>
                    <ul>
                        <li>
                            我的金币：<span>20</span>
                        </li>
                        <li>
                            悬赏：
                            <select name="reward">
                                <option value="0">0</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="80">80</option>
                                <option value="100">100</option>
                            </select>金币
                        </li>
                    </ul>
                </div>
                <input type='hidden' name='cid' value='0'/>
                <input type="submit" value='提交问题' class='send-btn'/>
            </form>
        </div>
    </div>
    <div id='category'>
        <p class='title'>
            <span>请选择分类</span>
            <a href="" class='close-window'></a>
        </p>
        <div class='sel'>

            <p>为您的问题选择一个合适的分类：</p>
            <select name="cate-one" size='16'>
                <?php $_from = $this->_tpl_vars['topCate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
                <option value="<?php echo $this->_tpl_vars['v']['cid']; ?>
"><?php echo $this->_tpl_vars['v']['title']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
            <select name="cate-one" size='16' class='hidden'></select>
            <select name="cate-one" size='16' class='hidden'></select>
        </div>
        <p class='bottom'>
            <span id='ok'>确定</span>
        </p>
    </div>
    <!--------------------中部结束-------------------->
<!-- 提交问题时的js验证 -->
<script type="text/javascript">
    $('.send-btn').click(function(){
        // 验证是否已登录
        if (!isLogin){
            // 如果没有登录，
            $('.login').click();
            return false;
        }
        // 验证内容是否为空
        var text = $('textarea[name=content]').val();
        if (text.length == 0) {
            alert('你倒是问啊');
            return false;
        }
        // 验证是否已选择分类
        var cid = $('input[name=cid]').val();
        if (0 == cid) {
            alert('未选择分类');
            return false;
        }
    })
</script>
<!-- 提交问题时的分类选择js处理 -->
<script type="text/javascript">
    $(function () {
        $('select[name=cate-one]').click(function () {
            //获得当前点击分类的cid
            var cid = $(this).val();
            //给隐藏域赋值
            $('input[name=cid]').val(cid);
            //如果是前两个select表单才需要发异步
            if ($(this).index() > 3)
                return;
            //让下一个select表单显示
            var nextSelect = $(this).next()
            nextSelect.show();
            //点击让下一个select的下一个select消失
            nextSelect.next().hide();

            //发送异步
            $.ajax({
                type: "post",
                url: "<?php echo @__APP__; ?>
?c=Ask&a=getSubCate",
                data: {id: cid},
                dataType: 'json',
                success: function (phpData) {
                    var option = '';
                    //循环json
                    $.each(phpData, function (k, v) {
                        option += '<option value="' + v.cid + '">' + v.title + '</option>'
                    });
                    //插入到下一个select表单中
                    nextSelect.html(option);
                }
            });
        })

        //点击确定，关闭窗口
        $('#ok').click(function () {
            //触发close-window单击事件
            $('.close-window').click();
        })
    })
</script>

<!-- --公共底部-- -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '../../../Common/footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
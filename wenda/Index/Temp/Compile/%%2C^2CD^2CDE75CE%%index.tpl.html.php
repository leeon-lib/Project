<?php /* Smarty version 2.6.26, created on 2015-06-08 16:44:21
         compiled from /Users/Liyn/Desktop/home/wenda/Index/View/ShowAsk/index.tpl.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>后盾问答</title>
	<meta name="keywords" content="后盾问答"/>
	<meta name="description" content="后盾问答"/>
	<!-- 公共头部 -->
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '../../../Common/header.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<link rel="stylesheet" href="<?php echo @__PUBLIC__; ?>
Css/question.css" />
	<script type="text/javascript" src="<?php echo @__PUBLIC__; ?>
Js/question.js"></script>

	<!-- top 结束-->
	<div id='location'>
		<a href="">全部分类</a>
		&gt;&nbsp;电脑&nbsp;&nbsp;
		&gt;&nbsp;<a href="">硬件</a>&nbsp;&nbsp;
	</div>

	<!----------------------中部-------------------->
	<div id='center-wrap'>
		<div id='center'>
			<div id='left'>
				<div id='answer-info'>
					<!-- 如果没有解决用wait -->
					<div class='ans-state wait'></div>
					<div class='answer'>
						<p class='ans-title'><?php echo $this->_tpl_vars['args']['ask']['content']; ?>

							<b class='point'><?php echo $this->_tpl_vars['args']['ask']['reward']; ?>
</b>
						</p>
					</div>
					<ul>
						<li><a href=""><?php echo $this->_tpl_vars['args']['ask']['username']; ?>
</a></li>
						<li><i class='level lv1' title='Level 1'></i></li>
						<li><?php echo $this->_tpl_vars['args']['ask']['time']; ?>
</li>

					</ul>
					<div class='ianswer'>
						<form action="<?php echo @__APP__; ?>
?c=showAsk&a=answerAsk" method='POST'>
							<p>我来回答</p>
							<textarea name="text"></textarea>
							<input type="hidden" name='qid' value='<?php echo $this->_tpl_vars['args']['ask']['asid']; ?>
'>
							<input type="submit" value='提交回答' id='anw-sub'/>
						</form>
					</div>
					<!---- 满意回答 ---->
					<?php if (( isset ( $this->_tpl_vars['args']['trueAnswer'] ) )): ?>
						<div class='ans-right'>
							<p class='title'><i></i>满意回答<span></span></p>
							<p class='ans-cons'><?php echo $this->_tpl_vars['args']['trueAnswer']['content']; ?>
</p>
							<dl>
								<dt>
									<a href=""><img src="<?php echo @__PUBLIC__; ?>
Images/noface.gif" width='48' height='48'/></a>
								</dt>
								<dd>
									<a href=""><?php echo $this->_tpl_vars['args']['trueAnswer']['username']; ?>
</a>
								</dd>
								<dd><i class='level lv1'></i></dd>
								<dd>20%</dd>
							</dl>
						</div>
					<?php endif; ?>
					<!---- 满意回答 ---->
				</div>

				<div id='all-answer'>
					<div class='ans-icon'></div>
					<?php if (( $this->_tpl_vars['args']['answerNum'] != 0 )): ?>
						<p class='title'>共 <strong><?php echo $this->_tpl_vars['args']['answerNum']; ?>
</strong> 条回答</p>
					<?php else: ?>
						<p class='title'><strong>暂无回答</strong></p>
					<?php endif; ?>
					<ul>
						<?php $_from = $this->_tpl_vars['args']['answer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
						<li>
							<div class='face'>
								<a href="">
									<img src="./Images/noface.gif" width='48' height='48'/>
								</a>
							</div>
							<div class='cons blue'>
								<p><?php echo $this->_tpl_vars['v']['content']; ?>
<span style='color:#888;font-size:12px'>&nbsp;&nbsp;(<?php echo $this->_tpl_vars['v']['time']; ?>
)</span></p>
							</div>
							<button class='adopt-btn' anid="<?php echo $this->_tpl_vars['v']['anid']; ?>
">采纳</button>
						</li>
						<?php endforeach; endif; unset($_from); ?>
					</ul>
					<div class='page'>
						<a href="">1</a>
						<a href="">2</a>
						<a href="">3</a>
						<a href="">4</a>
					</div>
				</div>
				<div id='other-ask'>
					<p class='title'>待解决的相关问题</p>
					<table>
						<tr>
							<td class='t1'><a href="">什么牌子电脑好？</a></td>
							<td>20&nbsp;回答</td>
							<td>1900.1.1</td>
						</tr>
					</table>
				</div>
			</div>
			<!---- 公共右侧 ---->
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '../../../Common/right.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>

	</div>
	
	<!--------------------中部结束-------------------->
<!-- 回答问题的内容验证 -->
<script type="text/javascript">
	$('#anw-sub').click(function(){
		// 验证是否已登录
        if (!isLogin){
            // 如果没有登录，
            $('.login').click();
            return false;
        }
		var text = $('.ianswer textarea').val();
		if (text.length == 0) {
			alert('回答问题也得说点啥吧？！');
			return false;
		}
	})
</script>

<!-- 问题采纳的显示与确认处理 -->
<script type="text/javascript">
	// 如果用户已登录，且登录用户与当前问题的提问用户匹配，且问题仍未解决，则显示采纳按钮
	<?php if (( isLogin > 0 ) && ( $_SESSION['uid'] == $this->_tpl_vars['args']['ask']['uid'] ) && $this->_tpl_vars['args']['ask']['solve'] == 0): ?>
		$('.adopt-btn').show();
	<?php else: ?>
		$('.adopt-btn').hide();
	<?php endif; ?>

	// 点击采纳的确认处理
	$('.adopt-btn').click(function(){
		if (confirm('确认采纳？')) {
			var anid = $(this).attr('anid');
			$.ajax({
				type:"post",
				url:"<?php echo @__APP__; ?>
?c=showAsk&a=toAccept",
				data:{asid:"<?php echo $this->_tpl_vars['args']['ask']['asid']; ?>
",point:"<?php echo $this->_tpl_vars['args']['ask']['reward']; ?>
",uid:"<?php echo $_SESSION['uid']; ?>
",anid:anid},
				success:function(phpdata){

				}
			});
		}
	})
</script>
	<!---- 公共底部 ---->
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '../../../Common/footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加子分类</title>
	<link rel="stylesheet" href="/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/erp/web/Public/Css/content.css">
	<script type="text/javascript" src="/erp/web/Public/Org/jquery-1.7.2.min.js"></script>
</head>
<body>
	<div class="warp">
		<div class="submenu">
			<div class="left">
				<a href="<?php echo U('Product/Category/index');?>">分类列表</a>
				<span>|</span>
				<a href="<?php echo U('Product/Category/add');?>">添加分类</a>
			</div>
			<div class="right">
				<a href="">后退</a>
				<span>|</span>
				<a href="">刷新</a>
			</div>
		</div>
		<div class="content">
			<form action="<?php echo U('Product/Category/add');?>" method="post">
				<table class="content-table">
					<tbody>
						<tr>
							<td width="10%">所属分类：</td>
							<td>
								<?php echo ($info["name"]); ?>
								<input type="hidden" name="pid" value="<?php echo ($info["cid"]); ?>">
							</td>
							<td width="70%"></td>
						</tr>
						<tr>
							<td>分类名称：</td>
							<td><input type="text" name="name[]"></td>
							<td><a href="javascript:;" class="glyphicon glyphicon-plus"></a></td>
						</tr>
						<tr class="btn">
							<td><input type="submit" value="添加"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</body>
<script type="text/javascript">
	$('.glyphicon-plus').click(function(){
		var str  = '<tr><td></td>';
			str += '<td><input type="text" name="name[]"></td>';
			str += '<td><a href="javascript:;" class="glyphicon glyphicon-minus"></a></td></tr>';
		$('.btn').before(str);
	});
	$('tr .glyphicon-minus').live("click",function(){
		$(this).parents('tr').empty();
	})
</script>
</html>
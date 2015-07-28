<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改</title>
	<link rel="stylesheet" href="/Project/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/content.css">
</head>
<body>
	<div class="warp">
		<div class="submenu">
			<div class="left">
				<a href="<?php echo U('Product/Brand/index');?>">品牌列表</a>
				<span>|</span>
				<a href="<?php echo U('Product/Brand/add');?>">添加品牌</a>
			</div>
			<div class="right">
				<a href="">后退</a>
				<span>|</span>
				<a href="">刷新</a>
			</div>
		</div>
		<div class="content">
			<form action="<?php echo U('Product/Brand/operate');?>" method="post" enctype="multipart/form-data">
				<table class="content-table">
					<tbody>
						<tr class="title">
							<td colspan="10">直接录入：</td>
						</tr>
						<tr>
							<td width="10%">品牌名称：</td>
							<td><input type="text" name="name" value="<?php echo ($oldData["name"]); ?>"></td>
						</tr>
						<tr>
							<td width="10%">英文名称：</td>
							<td><input type="text" name="en_name" value="<?php echo ($oldData["en_name"]); ?>"></td>
						</tr>
						<tr>
							<td>品牌Logo：</td>
							<td><input type="file" name="logo" value="<?php echo ($oldData["logo"]); ?>"></td>
						</tr>
						<tr class="btn">
							<input type="hidden" name="id" value="<?php echo ($oldData["id"]); ?>">
							<td><input type="submit" value="添加"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
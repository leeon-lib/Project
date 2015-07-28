<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加SKU</title>
	<link rel="stylesheet" href="/Project/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/content.css">
</head>
<body>
	<div class="warp">
		<div class="submenu">
			<div class="left">
				<a href="<?php echo U('Stock/Sku/index');?>">SKU列表</a>
				<span>|</span>
				<a href="<?php echo U('Stock/Sku/add');?>">添加SKU</a>
			</div>
			<div class="right">
				<a href="">后退</a>
				<span>|</span>
				<a href="">刷新</a>
			</div>
		</div>
		<div class="content">
			<form action="<?php echo U('Stock/Sku/operate');?>" method="post">
				<table class="content-table">
					<tbody>
						<tr class="title">
							<td colspan="10">添加SKU：</td>
						</tr>
						<tr>
							<td width="10%">货号：</td>
							<td><input type="text" name="goods"></td>
						</tr>
						<tr>
							<td width="10%">尺码：</td>
							<td>
								<input type="text" name="size">
							</td>
						</tr>
						<tr>
							<td>条形码：</td>
							<td>
								<input type="text" name="bar_code">
							</td>
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
</html>
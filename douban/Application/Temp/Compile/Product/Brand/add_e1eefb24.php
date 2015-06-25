<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加品牌</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
</head>
<body>
	<div class="warp">
		<div class="content-menu">
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
		<div class="content-text">
			<form action="<?php echo U('Product/Category/add');?>" method="post">
				<table>
					<tbody>
						<tr class="ways">
							<td colspan="10">直接录入：</td>
						</tr>
						<tr>
							<td width="10%">品牌名称：</td>
							<td><input type="text" name="bname"></td>
						</tr>
						<tr>
							<td width="10%">英文名称：</td>
							<td><input type="text" name="en_name"></td>
						</tr>
						<tr>
							<td>品牌Logo：</td>
							<td><input type="file" name="logo"></td>
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
<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>编辑品牌类型</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/jumei/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/jumei/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/jumei/Static/Css/content.css">
</head>
<body>
	<div class="warp">
		<div class="submenu">
			<div class="left">
				<a href="<?php echo U('Product/BrandType/index');?>">品牌类型列表</a>
				<span>|</span>
				<a href="<?php echo U('Product/BrandType/add');?>">添加品牌类型</a>
			</div>
			<div class="right">
				<a href="">后退</a>
				<span>|</span>
				<a href="">刷新</a>
			</div>
		</div>
		<div class="content">
			<form action="<?php echo U('Product/BrandType/operate');?>" method="post">
				<table class="content-table">
					<tbody>
						<tr class="title">
							<td colspan="10">编辑信息：</td>
						</tr>
						<tr>
							<td width="10%">类型名称：</td>
							<td><input type="text" name="type_name" value="<?php echo $oldData['type_name'];?>"></td>
						</tr>
						<tr class="btn">
							<input type="hidden" name="id" value="<?php echo $oldData['id'];?>">
							<td><input type="submit" value="修改"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
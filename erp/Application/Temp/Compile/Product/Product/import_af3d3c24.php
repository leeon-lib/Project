<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>导入商品</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
</head>
<body>
	<div class="warp">
		<div class="submenu">
			<div class="left">
				<a href="<?php echo U('Product/Product/index');?>">商品列表</a>
				<span>|</span>
				<a href="<?php echo U('Product/Product/add');?>">添加商品</a>
			</div>
			<div class="right">
				<a href="">后退</a>
				<span>|</span>
				<a href="">刷新</a>
			</div>
		</div>
		<div class="content">
			<form action="<?php echo U('Product/Attribute/implode');?>" method="post">
				<table class="content-table">
					<tbody>
						<tr class="title">
							<td colspan="10">表格导入：</td>
						</tr>
						<tr>
							<td>模板：</td>
							<td><a href="">下载批量导入模板表</a></td>
						</tr>
						<tr>
							<td width="10%">文件：</td>
							<td><input type="file"></td>
						</tr>
						<tr class="note">
							<td>备注：</td>
							<td>
								<p>只允许csv的文件格式。</p>
							</td>
						</tr>
						<tr class="btn">
							<td><input type="submit" value="导入"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
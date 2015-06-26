<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加商品</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
</head>
<body>
	<div class="warp">
		<div class="content-menu">
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
		<div class="content-text">
			<form action="<?php echo U('Product/Product/add');?>" method="post">
				<table>
					<tbody>
						<tr class="ways">
							<td colspan="10">直接录入：</td>
						</tr>
						<tr>
							<td width="10%">商品货号：</td>
							<td><input type="text" name="goods"></td>
						</tr>
						<tr>
							<td>商品名称：</td>
							<td><input type="text" name="name"></td>
						</tr>
						<tr>
							<td>所属分类</td>
							<td>
								<select name="category">
									<option value="-1">必选</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>所属品牌</td>
							<td>
								<select name="brand">
									<option value="-1">必选</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>上市日期：</td>
							<td><input type="text" name="manuf_date"></td>
						</tr>
						<tr>
							<td>市场价：</td>
							<td><input type="text" name="marked_price"></td>
						</tr>
						<tr>
							<td>商品图片：</td>
							<td><input type="file" name="pics"></td>
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
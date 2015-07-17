<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>手动下单</title>
	<link rel="stylesheet" href="/Project/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/content.css">
	<script src="/Project/erp/web/Public/Org/jquery-1.7.2.min.js"></script>
	<script src="/Project/erp/web/Public/Org/cal/lhgcalendar.min.js"></script>
</head>
<body>
	<div class="warp">
		<div class="submenu">
			<div class="left">
				<a href="<?php echo U('Order/Order/index');?>">订单列表</a>
				<span>|</span>
				<a href="<?php echo U('Order/Order/make');?>">手动下单</a>
			</div>
			<div class="right">
				<a href="">后退</a>
				<span>|</span>
				<a href="">刷新</a>
			</div>
		</div>
		<div class="content">
			<form action="<?php echo U('Order/Order/add');?>" method="post" enctype="multipart/form-data">
				<table class="content-table">
					<tbody>
						<tr class="title" align="left">
							<td colspan="10">手动下单：</td>
						</tr>
						<tr>
							<td>商品货号：</td>
							<td><input type="text" name="name"></td>
							<td width="72%"><input type="button" value="查询"></td>
						</tr>
						<tr>
							<td>收货人姓名：</td>
							<td><input type="text"></td>
							<td></td>
						</tr>
						<tr>
							<td>收货人电话：</td>
							<td><input type="text"></td>
							<td></td>
						</tr>
						<tr>
							<td>省：</td>
							<td>
								<select name="category_cid">
									<option value="-1" selected="selected">必选</option>
									<?php if(is_array($cateInfo)): foreach($cateInfo as $key=>$v): ?><option value="<?php echo ($v["cid"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>市：</td>
							<td>
								<select name="brand_id">
									<option value="-1">必选</option>
									<?php if(is_array($brandInfo)): foreach($brandInfo as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>区/县：</td>
							<td>
								<select name="brand_id">
									<option value="-1">必选</option>
									<?php if(is_array($brandInfo)): foreach($brandInfo as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>详细地址：</td>
							<td><textarea name=""></textarea></td>
							<td></td>
						</tr>
						<tr>
							<td>上市日期：</td>
							<td>
								<input type="text" readonly="readonly" id="updatetime" name="manuf_date" class="hd-w150">
							</td>
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
							<td><input type="submit" value="确认下单"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
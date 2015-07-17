<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SKU列表</title>
	<link rel="stylesheet" href="/Project/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/content.css">
	<script src="/Project/erp/web/Public/Org/jquery-1.7.2.min.js"></script>
	<script src="/Project/erp/web/Public/Org/cal/lhgcalendar.min.js"></script>
</head>
<body>
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
		<div class="search">
			<form action="<?php echo U('Stock/Sku/index');?>" method="post">
				<table class="search-table">
					<tr>
						<td width="5%">SKU ID：</td>
						<td width="10%"><input type="text" name="sku_id"></td>
						<td width="5%">货号：</td>
						<td width="10%"><input type="text" name="goods"></td>
						<td width="5%">尺码：</td>
						<td width="10%"><input type="text" name="size"></td>
					</tr>
					<tr>
						<td width="5%">条形码：</td>
						<td width="10%"><input type="text" name="bar_code"></td>
						<td>所属品牌：</td>
						<td>
							<select name="brand_id">
								<option value="">--不限--</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="5%"><input type="submit" value="搜索"></td>
					</tr>
				</table>
			</form>
		</div>
		<table class="content-table">
			<thead>
				<tr>
					<td width="5%" align="center">SKU ID</td>
					<td width="15%" align="center">货号</td>
					<td width="15%" align="center">尺码</td>
					<td width="15%" align="center">条形码</td>
					<td width="10%" align="center">添加时间</td>
					<td width="10%" align="center">修改时间</td>
					<td width="10%" align="center">操作人</td>
					<td width="10%" align="center">管理操作</td>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($skuList)): foreach($skuList as $key=>$v): ?><tr>
						<td align="center"><?php echo ($v["id"]); ?></td>
						<td align="center"><?php echo ($v["goods"]); ?></td>
						<td align="center"><?php echo ($v["size"]); ?></td>
						<td align="center"><?php echo ($v["bar_code"]); ?></td>
						<td align="center">
							<?php if(($v["add_date"]) == "0"): ?>－－－
							<?php else: ?>
								<?php echo (date('Y-m-d H:i:s',$v["add_date"])); endif; ?>
						</td>
						<td align="center"><?php echo ($v["update_date"]); ?></td>
						<td align="center"><?php echo ($v["admin_name"]); ?></td>
						<td align="center">
							<a href="<?php echo U('Stock/Sku/edit',array('id'=>$v['id']));?>">编辑</a>
							<a href="<?php echo U('Stock/Sku/del',array('id'=>$v['id']));?>">删除</a>
						</td>
					</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</body>
</html>
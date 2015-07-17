<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>库房管理</title>
	<link rel="stylesheet" href="/Project/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/content.css">
</head>
<body>
	<div class="submenu">
		<div class="left">
			<a href="<?php echo U('Storage/Warehouse/index');?>">库房列表</a>
			<span>|</span>
			<a href="<?php echo U('Storage/Warehouse/add');?>">添加库房</a>
		</div>
		<div class="right">
			<a href="">后退</a>
			<span>|</span>
			<a href="">刷新</a>
		</div>
	</div>
	<div class="content">
		<table class="content-table">
			<thead>
				<tr>
					<td width="5%" align="center">库房ID</td>
					<td width="10%" align="center">库房名称</td>
					<td width="10%" align="center">联系人</td>
					<td width="10%" align="center">联系电话</td>
					<td width="10%" align="center">Key</td>
					<td width="10%" align="center">所属地区</td>
					<td width="20%" align="center">详细地址</td>
					<td width="10%" align="center">操作</td>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($warehouseList)): foreach($warehouseList as $key=>$v): ?><tr>
						<td align="center"><?php echo ($v["id"]); ?></td>
						<td align="center"><?php echo ($v["name"]); ?></td>
						<td align="center"><?php echo ($v["manager"]); ?></td>
						<td align="center"><?php echo ($v["mobile"]); ?></td>
						<td align="center"><?php echo ($v["key_id"]); ?></td>
						<td align="center"><?php echo ($v["city_id"]); ?></td>
						<td align="center"><?php echo ($v["address"]); ?></td>
						<td align="center">
							<a href="<?php echo U('Storage/Warehouse/edit',array('id'=>$v['id']));?>">编辑</a>
							<a href="<?php echo U('Storage/Warehouse/del',array('id'=>$v['id']));?>">删除</a>
						</td>
					</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</body>
</html>
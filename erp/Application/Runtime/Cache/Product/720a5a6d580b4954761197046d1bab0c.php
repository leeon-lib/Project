<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>属性管理</title>
	<link rel="stylesheet" href="/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/erp/web/Public/Css/content.css">
</head>
<body>
	<div class="submenu">
		<div class="left">
			<a href="<?php echo U('Product/Attribute/index');?>">属性列表</a>
			<span>|</span>
			<a href="<?php echo U('Product/Attribute/add');?>">添加属性</a>
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
					<td width="5%" align="center">ID</td>
					<td width="10%" align="center">属性名称</td>
					<td width="30%" align="left">属性值</td>
					<td width="10%" align="center">属性类别</td>
					<td width="10%" align="center">操作</td>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
						<td align="center"><?php echo ($v["id"]); ?></td>
						<td align="center"><?php echo ($v["name"]); ?></td>
						<td align="left"><?php echo ($v["value"]); ?></td>
						<?php if(($v['kind_id']) == "1"): ?><td align="center">属性</td>
						<?php else: ?>
							<td align="center">规格</td><?php endif; ?>
						<td align="center">
							<a href="<?php echo U('Product/Attribute/edit');?>">编辑</a>
							<a href="<?php echo U('Product/Attribute/del');?>">删除</a>
						</td>
					</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</body>
</html>
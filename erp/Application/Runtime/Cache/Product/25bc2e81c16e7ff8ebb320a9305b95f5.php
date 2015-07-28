<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>品牌管理</title>
	<link rel="stylesheet" href="/Project/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/content.css">
</head>
<body>
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
		<table class="content-table">
			<thead>
				<tr>
					<td width="5%" align="center">ID</td>
					<td width="10%" align="center">Logo</td>
					<td width="20%" align="left">品牌名称</td>
					<td width="20%" align="left">英文名称</td>
					<td width="10%" align="center">操作</td>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($brandList)): foreach($brandList as $key=>$v): ?><tr>
						<td align="center"><?php echo ($v["id"]); ?></td>
						<td align="center">
							<img src="/Project/erp/web/Attached/<?php echo ($v["logo"]); ?>" alt="">
						</td>
						<td align="left"><?php echo ($v["name"]); ?></td>
						<td align="left"><?php echo ($v["en_name"]); ?></td>
						<td align="center">
							<a href="<?php echo U('Product/Brand/edit',array('id'=>$v['id']));?>">
								<i class="glyphicon glyphicon-pencil"></i>
							</a>&nbsp;
							<a href="<?php echo U('Product/Brand/del',array('id'=>$v['id']));?>">
								<i class="glyphicon glyphicon-trash"></i>
							</a>
						</td>
					</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</body>
</html>
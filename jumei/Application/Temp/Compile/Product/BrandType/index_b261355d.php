<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>品牌类型管理</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/jumei/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/jumei/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/jumei/Static/Css/content.css">
</head>
<body>
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
		<table class="content-table">
			<thead>
				<tr>
					<td width="5%" align="center">ID</td>
					<td width="30%" align="center">品牌类型名称</td>
					<td width="10%" align="center">操作</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($typeList as $k=>$v){?>
					<tr>
						<td align="center"><?php echo $v['id'];?></td>
						<td align="center"><?php echo $v['type_name'];?></td>
						<td align="center">
							<a href="<?php echo U('Product/BrandType/edit',array('id'=>$v['id']));?>">编辑</a>
							<a href="<?php echo U('Product/BrandType/del',array('id'=>$v['id']));?>">删除</a>
						</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</body>
</html>
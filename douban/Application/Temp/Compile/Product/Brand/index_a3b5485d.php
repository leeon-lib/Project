<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>品牌管理</title>
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
			<table>
				<thead>
					<tr>
						<td width="10%" align="center">ID</td>
						<td width="20%" align="center">品牌名称</td>
						<td width="20%" align="center">英文名称</td>
						<td width="20%" align="center">品牌Logo</td>
						<td width="15%" align="center">操作</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($info as $k=>$v){?>
						<tr>
							<td align="center"><?php echo $v['id'];?></td>
							<td align="center"><?php echo $v['name'];?></td>
							<td align="center"><?php echo $v['en_name'];?></td>
							<td align="center">
								<img src="<?php echo $v['logo'];?>" alt="">
							</td>
							<td align="center">
								<a href="<?php echo U('Product/Brand/edit',array('id'=>$v['id']));?>">编辑</a>
								<a href="<?php echo U('Product/Brand/del',array('id'=>$v['id']));?>">删除</a>
							</td>
						</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>
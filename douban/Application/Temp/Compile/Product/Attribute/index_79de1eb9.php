<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>属性管理</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
</head>
<body>
	<div class="warp">
		<div class="content-menu">
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
		<div class="content-text">
			<table>
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
					<?php foreach ($data as $k=>$v){?>
						<tr>
							<td align="center"><?php echo $v['id'];?></td>
							<td align="center"><?php echo $v['name'];?></td>
							<td align="left"><?php echo $v['value'];?></td>
							    <?php if($v['kind_id'] == 1){ ?>
								<td align="center">属性</td>
							<?php }else{ ?>
								<td align="center">规格</td>
							<?php } ?>
							<td align="center">
								<a href="<?php echo U('Product/Attribute/edit');?>">编辑</a>
								<a href="<?php echo U('Product/Attribute/del');?>">删除</a>
							</td>
						</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>
<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>系统用户管理</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
</head>
<body>
	<div class="submenu">
		<div class="left">
			<a href="<?php echo U('Settings/User/index');?>">管理员列表</a>
			<span>|</span>
			<a href="<?php echo U('Settings/User/add');?>">添加管理员</a>
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
					<td width="5%" align="center">用户ID</td>
					<td width="10%" align="center">用户名</td>
					<td width="10%" align="center">真实姓名</td>
					<td width="10%" align="center">邮箱</td>
					<td width="10%" align="center">手机号</td>
					<td width="10%" align="center">所属部门</td>
					<td width="10%" align="center">所属角色</td>
					<td width="8%" align="center">状态</td>
					<td width="10%" align="center">上次登录时间</td>
					<td width="10%" align="center">管理操作</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($productList as $k=>$v){?>
					<tr>
						<td align="center"><?php echo $v['id'];?></td>
						<td align="center">
							<?php if (empty($v['pic'])){ ?>
								<img src="http://127.0.0.1/Project/douban/Static/Images/default_s.gif" alt="" width="60px">
							<?php }else{ ?>
								<img src="http://127.0.0.1/Project/douban/Upload/Product/<?php echo $v['pic'];?>" alt="" width="60px">
							<?php } ?>
						</td>
						<td align="center"><?php echo $v['goods'];?></td>
						<td align="center"><?php echo $v['name'];?></td>
						<td align="center"><?php echo $v['category_name'];?></td>
						<td align="center"><?php echo $v['brand_name'];?></td>
						<td align="center"><?php echo $v['marked_price'];?></td>
						<td align="center"><?php echo date('Y-m-d',$v['manuf_date']);?></td>
						<td align="center"><?php echo date('Y-m-d',$v['add_date']);?></td>
						<td align="center">
							<a href="<?php echo U('Product/Product/edit',array('id'=>$v['id']));?>">编辑</a>
							<a href="<?php echo U('Product/Product/del',array('id'=>$v['id']));?>">删除</a>
						</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</body>
</html>

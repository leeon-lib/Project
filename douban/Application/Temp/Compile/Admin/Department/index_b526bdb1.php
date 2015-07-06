<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>部门管理</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
</head>
<body>
	<div class="submenu">
		<div class="left">
			<a href="<?php echo U('Admin/Department/index');?>">部门列表</a>
			<span>|</span>
			<a href="<?php echo U('Admin/Department/add');?>">添加部门</a>
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
					<td width="5%" align="center">部门ID</td>
					<td width="20%" align="center">部门名称</td>
					<td width="20%" align="center">上级部门</td>
					<td width="10%" align="center">操作</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($deptList as $k=>$v){?>
					<tr>
						<td align="center"><?php echo $v['id'];?></td>
						<td align="center"><?php echo $v['name'];?></td>
						<td align="center">
							    <?php if(0==$v['pid']){ ?>
								一级部门
							<?php }else{ ?>
								<?php foreach ($deptList as $key=>$val){?>
									    <?php if($v['pid']==$val['id']){ ?>
										<?php echo $val['name'];?>
									<?php } ?>
								<?php }?>
							<?php } ?>
						</td>
						<td align="center">
							<a href="<?php echo U('Admin/Department/edit',array('id'=>$v['id']));?>">编辑</a>
							<a href="<?php echo U('Admin/Department/del',array('id'=>$v['id']));?>">删除</a>
						</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</body>
</html>
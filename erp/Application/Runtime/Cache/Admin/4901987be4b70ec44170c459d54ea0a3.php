<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>角色管理</title>
	<link rel="stylesheet" href="/Project/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/content.css">
</head>
<body>
	<div class="submenu">
		<div class="left">
			<a href="<?php echo U('Admin/Role/index');?>">角色列表</a>
			<span>|</span>
			<a href="<?php echo U('Admin/Role/add');?>">添加角色</a>
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
					<td width="5%" align="center">角色ID</td>
					<td width="20%" align="center">角色名称</td>
					<td width="20%" align="center">所属部门</td>
					<td width="10%" align="center">操作</td>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($roleList)): foreach($roleList as $key=>$v): ?><tr>
						<td align="center"><?php echo ($v["id"]); ?></td>
						<td align="center"><?php echo ($v["name"]); ?></td>
						<td align="center">
							<?php if(($v['department_id']) == "0"): ?>－－－
							<?php else: ?>
								<?php if(is_array($deptList)): foreach($deptList as $key=>$val): if($val['id'] == $v['department_id']): echo ($val["name"]); endif; endforeach; endif; endif; ?>
						</td>
						<td align="center">
							<a href="<?php echo U('Admin/Role/edit',array('id'=>$v['id']));?>">编辑</a>
							<a href="<?php echo U('Admin/Role/del',array('id'=>$v['id']));?>">删除</a>
						</td>
					</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
</body>
</html>
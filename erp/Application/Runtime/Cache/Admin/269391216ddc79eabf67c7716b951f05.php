<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加管理员</title>
	<link rel="stylesheet" href="/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/erp/web/Public/Css/content.css">
</head>
<body>
	<div class="warp">
		<div class="submenu">
			<div class="left">
				<a href="<?php echo U('Admin/Admin/index');?>">管理员列表</a>
				<span>|</span>
				<a href="<?php echo U('Admin/Admin/add');?>">添加管理员</a>
			</div>
			<div class="right">
				<a href="">后退</a>
				<span>|</span>
				<a href="">刷新</a>
			</div>
		</div>
		<div class="content">
			<form action="<?php echo U('Admin/Admin/operate');?>" method="post">
				<table class="content-table">
					<tbody>
						<tr class="title">
							<td colspan="10">添加管理员：</td>
						</tr>
						<tr>
							<td>所属部门：</td>
							<td>
								<select name="department_id">
									<option value="-1">必选</option>
									<?php if(is_array($deptList)): foreach($deptList as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>所属角色：</td>
							<td>
								<select name="role_id">
									<option value="-1">必选</option>
									<?php if(is_array($roleList)): foreach($roleList as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="10%">用户名：</td>
							<td><input type="text" name="username"></td>
						</tr>
						<tr>
							<td width="10%">密码：</td>
							<td><input type="password" name="password"></td>
						</tr>
						<tr>
							<td width="10%">姓名：</td>
							<td><input type="text" name="real_name" value="<?php echo ($oldInfo["real_name"]); ?>"></td>
						</tr>
						<tr>
							<td width="10%">邮箱：</td>
							<td><input type="text" name="mail" value="<?php echo ($oldInfo["mail"]); ?>"></td>
						</tr>
						<tr>
							<td width="10%">电话：</td>
							<td><input type="text" name="phone" value="<?php echo ($oldInfo["phone"]); ?>"></td>
						</tr>
						<tr class="btn">
							<td><input type="submit" value="添加"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
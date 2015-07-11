<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>编辑管理员信息</title>
	<link rel="stylesheet" href="/Project/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/content.css">
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
							<td colspan="10">编辑管理员信息：</td>
						</tr>
						<tr>
							<td width="10%">用户名：</td>
							<td><?php echo ($oldData["username"]); ?></td>
						</tr>
						<tr>
							<td>所属部门：</td>
							<td>
								<select name="department_id">
									<?php if(is_array($deptList)): foreach($deptList as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($v['id'] == $oldData['department_id']): ?>selected="selected"<?php endif; ?> >
											<?php echo ($v["name"]); ?>
										</option><?php endforeach; endif; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>所属角色：</td>
							<td>
								<select name="role_id">
									<?php if(is_array($roleList)): foreach($roleList as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>" <?php if($v['id'] == $oldData['role_id']): ?>selected="selected"<?php endif; ?> >
											<?php echo ($v["name"]); ?>
										</option><?php endforeach; endif; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="10%">姓名：</td>
							<td><input type="text" name="real_name" value="<?php echo ($oldData["real_name"]); ?>"></td>
						</tr>
						<tr>
							<td width="10%">邮箱：</td>
							<td><input type="text" name="mail" value="<?php echo ($oldData["mail"]); ?>"></td>
						</tr>
						<tr>
							<td width="10%">电话：</td>
							<td><input type="text" name="phone" value="<?php echo ($oldData["phone"]); ?>"></td>
						</tr>
						<tr>
							<td width="10%">是否锁定：</td>
							<td>
								否<input type="radio" name="is_lock" value="0" <?php if(($oldData["is_lock"]) == "0"): ?>checked="checked"<?php endif; ?> >
								是<input type="radio" name="is_lock" value="1" <?php if(($oldData["is_lock"]) == "1"): ?>checked="checked"<?php endif; ?> >
							</td>
						</tr>
						<tr class="btn">
							<input type="hidden" name="id" value="<?php echo ($oldData["id"]); ?>">
							<td><input type="submit" value="修改"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
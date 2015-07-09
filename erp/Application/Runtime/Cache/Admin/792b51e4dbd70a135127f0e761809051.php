<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改部门信息</title>
	<link rel="stylesheet" href="/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/erp/web/Public/Css/content.css">
	<script type="text/javascript" src="/erp/web/Public/Org/jquery-1.7.2.min.js"></script>
</head>
<body>
	<div class="warp">
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
			<form action="<?php echo U('Admin/Department/operate');?>" method="post">
				<table class="content-table">
					<tbody>
						<tr class="title">
							<td colspan="10">修改部门信息：</td>
						</tr>
						<tr>
							<td width="10%">上级部门：</td>
							<td>
								<select name="pid">
									<?php if(($oldInfo['pid']) == "0"): ?><option value="0" selected="selected">一级部门</option>
										<?php if(is_array($deptList)): foreach($deptList as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
									<?php else: ?>
										<option value="0">一级部门</option>
										<?php if(is_array($deptList)): foreach($deptList as $key=>$v): if(($v['id']) == "oldInfo['pid']"): ?><option value="<?php echo ($v["id"]); ?>" selected="selected"><?php echo ($v["_name"]); ?></option><?php endif; ?>
											<option value="<?php echo ($v["id"]); ?>"><?php echo ($v["_name"]); ?></option><?php endforeach; endif; endif; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>部门名称：</td>
							<td><input type="text" name="name" value="<?php echo ($oldInfo["name"]); ?>"></td>
						</tr>
						<tr class="btn">
							<input type="hidden" name="id" value="<?php echo ($oldInfo["id"]); ?>">
							<td><input type="submit" value="修改"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
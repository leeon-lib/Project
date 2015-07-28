<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>设置</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/aside.css">
</head>
<body>
	<ul>
		<li>
			<h4>个人设置</h4>
			<a href="<?php echo U('Settings/Personal/password');?>" target="content">修改密码</a>
			<a href="<?php echo U('Settings/Personal/info');?>" target="content">修改个人信息</a>
		</li>
		<li>
			<h4>系统用户</h4>
			<a href="<?php echo U('Settings/Group/index');?>" target="content">部门管理</a>
			<a href="<?php echo U('Settings/Role/index');?>" target="content">角色管理</a>
			<a href="<?php echo U('Settings/User/index');?>" target="content">管理员管理</a>
		</li>
		<li>
			<h4>系统配置</h4>
			<a href="<?php echo U('Settings/Config/system');?>" target="content">常规设置</a>
		</li>
	</ul>	
</body>
</html>
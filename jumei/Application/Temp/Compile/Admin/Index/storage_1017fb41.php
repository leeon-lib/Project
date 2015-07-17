<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>仓储管理</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/jumei/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/jumei/Static/Css/aside.css">
</head>
<body>
	<ul>
		<li>
			<h4>仓储库房</h4>
			<a href="<?php echo U('Storage/Warehouse/index');?>" target="content">库房管理</a>
		</li>
		<li>
			<h4>规则设置</h4>
			<a href="<?php echo U('Storage/Rule/index');?>" target="content">规则管理</a>
		</li>
		<li>
			<h4>快递管理</h4>
			<a href="<?php echo U('Storage/Express/index');?>" target="content">快递管理</a>
		</li>
	</ul>
</body>
</html>
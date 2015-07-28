<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商城管理</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/aside.css">
</head>
<body>
	<ul>
		<li>
			<h4>信息管理</h4>
			<a href="<?php echo U('Product/Product/index');?>" target="content">公告管理</a>
		</li>
		<li>
			<h4>轮播图</h4>
			<a href="<?php echo U('Product/Product/index');?>" target="content">轮播图管理</a>
		</li>
	</ul>
</body>
</html>
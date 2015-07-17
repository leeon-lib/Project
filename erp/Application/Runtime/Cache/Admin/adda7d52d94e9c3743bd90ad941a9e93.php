<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>订单管理</title>
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/aside.css">
</head>
<body>
	<ul>
		<li>
			<h4>销售管理</h4>
			<a href="<?php echo U('Order/Order/index');?>" target="content">订单列表</a>
			<a href="<?php echo U('Order/Order/make');?>" target="content">手动下单</a>
		</li>
		<li>
			<h4>异常监控</h4>
			<a href="<?php echo U('Order/Attribute/index');?>" target="content">订单缺货</a>
			<a href="<?php echo U('Order/Category/index');?>" target="content">超时未发货</a>
			<a href="<?php echo U('Order/Attribute/index');?>" target="content"></a>
		</li>
	</ul>
</body>
</html>
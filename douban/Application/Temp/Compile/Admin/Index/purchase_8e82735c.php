<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>采购管理</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/aside.css">
</head>
<body>
	<ul>
		<li>
			<h4>采购管理</h4>
			<a href="<?php echo U('Purchase/Purchase/index');?>" target="content">采购单管理</a>
			<!-- <a href="<?php echo U('Stock/Stock/details');?>" target="content"></a> -->
		</li>
		<li>
			<h4>折扣管理</h4>
			<a href="<?php echo U('Purchase/Sku/index');?>" target="content">SKU列表</a>
			<a href="<?php echo U('Purchase/Sku/import');?>" target="content">批量导入</a>
		</li>
		<li>
			<h4>供应商</h4>
			<a href="<?php echo U('Purchase/Supplier/index');?>" target="content">供应商管理</a>
		</li>
		<li>
			<h4>虚库管理</h4>
			<a href="<?php echo U('Purchase/Attribute/index');?>" target="content">采购单</a>
			<a href="<?php echo U('Purchase/Attribute/index');?>" target="content">调拨单</a>
			<a href="<?php echo U('Purchase/Attribute/index');?>" target="content">借货单</a>
		</li>
	</ul>
</body>
</html>
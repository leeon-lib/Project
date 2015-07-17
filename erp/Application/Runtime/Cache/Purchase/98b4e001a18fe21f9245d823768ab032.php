<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加采购单</title>
	<link rel="stylesheet" href="/Project/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/content.css">
	<script src="/Project/erp/web/Public/Org/jquery-1.7.2.min.js"></script>
	<script src="/Project/erp/web/Public/Org/cal/lhgcalendar.min.js"></script>
</head>
<body>
	<div class="warp">
		<div class="submenu">
			<div class="left">
				<a href="<?php echo U('Purchase/Purchase/index');?>">采购单列表</a>
				<span>|</span>
				<a href="<?php echo U('Purchase/Purchase/add');?>">添加采购单</a>
			</div>
			<div class="right">
				<a href="">后退</a>
				<span>|</span>
				<a href="">刷新</a>
			</div>
		</div>
		<div class="content">
			<form action="<?php echo U('Purchase/Purchase/insert');?>" method="post" enctype="multipart/form-data">
				<table class="content-table">
					<tbody>
						<tr class="title">
							<td colspan="10">直接录入：</td>
						</tr>
						<tr>
							<td>模板：</td>
							<td><a href="<?php echo U('Purchase/Purchase/downCsv');?>"><u>下载模板表格</u></a></td>
						</tr>
						<tr>
							<td width="10%">供应商：</td>
							<td>
								<select name="supplier_id">
									<option value="-1">必选</option>
									<?php if(is_array($supplierList)): foreach($supplierList as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>库房：</td>
							<td>
								<select name="warehouse_id">
									<option value="-1">必选</option>
									<?php if(is_array($warehouseList)): foreach($warehouseList as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>销售方式：</td>
							<td>
								<select name="sale_type">
									<option value="-1">必选</option>
									<?php if(is_array($saleType)): foreach($saleType as $key=>$v): ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>文件：</td>
							<td><input type="file" name="csv"></td>
						</tr>
						<tr>
							<td>预计到货日期：</td>
							<td><input type="text" readonly="readonly" id="expect_date" name="expect_date" class="hd-w150"></td>
						</tr>
						<tr>
							<td>备注：</td>
							<td><input type="text" name="note"></td>
						</tr>
						<tr class="btn">
							<td><input type="submit" value="添加"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
<script type="text/javascript">
	$(function() {
        $('#expect_date').calendar({format: 'yyyy/MM/dd'});
    })
</script>
</body>
</html>
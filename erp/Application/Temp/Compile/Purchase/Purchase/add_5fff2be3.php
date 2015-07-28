<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加采购单</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
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
			<form action="<?php echo U('Purchase/Purchase/operate');?>" method="post" enctype="multipart/form-data">
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
									<?php foreach ($supplierList as $k=>$v){?>
										<option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
									<?php }?>
								</select>
							</td>
						</tr>
						<tr>
							<td>库房：</td>
							<td>
								<select name="warehouse_id">
									<option value="-1">必选</option>
									<?php foreach ($warehouseList as $k=>$v){?>
										<option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
									<?php }?>
								</select>
							</td>
						</tr>
						<tr>
							<td>销售方式：</td>
							<td>
								<select name="sale_type">
									<option value="-1">必选</option>
									<?php foreach ($saleType as $k=>$v){?>
										<option value="<?php echo $k;?>"><?php echo $v;?></option>
									<?php }?>
								</select>
							</td>
						</tr>
						<tr>
							<td>备注：</td>
							<td><input type="text" name="note"></td>
						</tr>
						<tr>
							<td>文件：</td>
							<td><input type="file" name="csv"></td>
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
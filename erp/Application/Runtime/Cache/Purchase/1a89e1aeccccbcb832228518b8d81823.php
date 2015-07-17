<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>采购单列表</title>
	<link rel="stylesheet" href="/Project/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/content.css">
	<script src="/Project/erp/web/Public/Org/jquery-1.7.2.min.js"></script>
	<script src="/Project/erp/web/Public/Org/cal/lhgcalendar.min.js"></script>
</head>
<body>
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
		<div class="search">
			<form action="<?php echo U('Purchase/Purchase/index');?>" method="post">
				<table class="search-table">
					<tr>
						<td width="8%">采购单号：</td>
						<td width="40%"><input type="text" name="product_id"></td>
						<td width="8%">销售方式：</td>
						<td width="40%">
							<select name="sale_type">
								<option value="-1">-- 不限 --</option>
								<?php if(is_array($cateInfo)): foreach($cateInfo as $key=>$v): ?><option value="<?php echo ($v["cid"]); ?>"><?php echo ($v["_name"]); ?></option><?php endforeach; endif; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>供应商：</td>
						<td>
							<select name="category_cid">
								<option value="-1">-- 不限 --</option>
								<?php if(is_array($cateInfo)): foreach($cateInfo as $key=>$v): ?><option value="<?php echo ($v["cid"]); ?>"><?php echo ($v["_name"]); ?></option><?php endforeach; endif; ?>
							</select>
						</td>
						<td>到货库房：</td>
						<td>
							<select name="brand_id">
								<option value="-1">-- 不限 --</option>
								<?php if(is_array($cateInfo)): foreach($cateInfo as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
							</select>
						</td>	
					</tr>
					<tr><td><input type="submit" value="搜索"></td></tr>
					<tr><td colspan="3"><a href="">按搜索条件导出</a></td></tr>
				</table>
			</form>
		</div>
		<table class="content-table">
			<thead>
				<tr>
					<td width="10%" align="center">采购单号</td>
					<td width="20%" align="center">供应商</td>
					<td width="10%" align="center">库房</td>
					<td width="10%" align="center">销售方式</td>
					<td width="10%" align="center">数量</td>
					<td width="10%" align="center">采购日期</td>
					<td width="10%" align="center">预计到货日期</td>
					<td width="10%" align="center">备注</td>
					<td width="10%" align="center">管理操作</td>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($purchaseList)): foreach($purchaseList as $key=>$v): ?><tr>
						<td align="center"><?php echo ($v["purchase_id"]); ?></td>
						<td align="center"><?php echo ($v["supplier_id"]); ?></td>
						<td align="center"><?php echo ($v["warehouse_id"]); ?></td>
						<td align="center"><?php echo ($v["sale_type"]); ?></td>
						<td align="center"><?php echo ($v["num"]); ?></td>
						<td align="center"><?php echo ($v["add_date"]); ?></td>
						<td align="center"><?php echo ($v["expect_date"]); ?></td>
						<td align="center"><?php echo ($v["note"]); ?></td>
						<td align="center">
							<a href="<?php echo U('Purchase/Purchase/details',array('id'=>$v['id']));?>">明细</a>
							<a href="<?php echo U('Purchase/Purchase/freeze',array('id'=>$v['id']));?>">锁定</a>
						</td>
					</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
	</div>
<script type="text/javascript">
	$(function() {
        $('#manuf_date_start').calendar({format: 'yyyy/MM/dd'});
        $('#manuf_date_end').calendar({format: 'yyyy/MM/dd'});
        $('#add_date_start').calendar({format: 'yyyy/MM/dd'});
        $('#add_date_end').calendar({format: 'yyyy/MM/dd'});
    })
</script>
</body>
</html>
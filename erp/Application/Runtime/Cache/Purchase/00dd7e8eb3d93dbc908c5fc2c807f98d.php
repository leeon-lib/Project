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
			<form action="<?php echo U('Purchase/Purchase/details');?>" method="post">
				<table class="search-table">
					<tr>
						<td width="5%">货号：</td>
						<td width="17%"><input type="text" name="goods"></td>
						<td width="5%">尺码：</td>
						<td width="17%"><input type="text" name="size"></td>
						<td width="5%">SKU ID：</td>
						<td width="17%"><input type="text" name="sku_id"></td>
						<td width="5%">条码：</td>
						<td width="17%"><input type="text" name="bar_code"></td>
						<input type="hidden" name="id" value="<?php echo ($detailsList[0]['purchase_id']); ?>">
						<td><input type="submit" value="搜索"></td>
					</tr>
				</table>
			</form>
		</div>
		<table class="content-table">
			<thead>
				<tr>
					<td width="5%" align="center">ID</td>
					<td width="10%" align="center">货号</td>
					<td width="10%" align="center">尺码</td>
					<td width="10%" align="center">SKU ID</td>
					<td width="15%" align="center">条码</td>
					<td width="10%" align="center">数量</td>
					<td width="10%" align="center">管理操作</td>
				</tr>
			</thead>
			<tbody>
				<?php if(empty($detailsList)): ?><tr><td colspan="20" align="center">暂无纪录</td></tr>
				<?php else: ?>
					<?php if(is_array($detailsList)): foreach($detailsList as $key=>$v): ?><tr>
							<td align="center"><?php echo ($key+1); ?></td>
							<td align="center"><?php echo ($v["goods"]); ?></td>
							<td align="center"><?php echo ($v["size"]); ?></td>
							<td align="center"><?php echo ($v["sku_id"]); ?></td>
							<td align="center"><?php echo ($v["bar_code"]); ?></td>
							<td align="center"><?php echo ($v["num"]); ?></td>
							<td align="center">
								<a href="<?php echo U('Purchase/Purchase/details',array('id'=>$v['id']));?>">明细</a>
								<?php if(($v["lock_status"]) == "0"): ?><a href="<?php echo U('Purchase/Purchase/freeze',array('id'=>$v['id']));?>">锁定</a>
								<?php else: ?>
									<a href="<?php echo U('Purchase/Purchase/freeze',array('id'=>$v['id']));?>">解除锁定</a><?php endif; ?>
							</td>
						</tr><?php endforeach; endif; endif; ?>
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
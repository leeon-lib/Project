<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>订单列表</title>
	<link rel="stylesheet" href="/Project/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/content.css">
	<script src="/Project/erp/web/Public/Org/jquery-1.7.2.min.js"></script>
	<script src="/Project/erp/web/Public/Org/cal/lhgcalendar.min.js"></script>
</head>
<body>
	<div class="submenu">
		<div class="left">
			<a href="<?php echo U('Order/Order/index');?>">订单列表</a>
			<span>|</span>
			<a href="<?php echo U('Order/Order/make');?>">手动下单</a>
		</div>
		<div class="right">
			<a href="">后退</a>
			<span>|</span>
			<a href="">刷新</a>
		</div>
	</div>
	<div class="content">
		<div class="search">
			<form action="<?php echo U('Order/Order/index');?>" method="post">
				<table class="search-table">
					<tr>
						<td width="6%">订单号：</td>
						<td width="15%"><input type="text" name="product_id"></td>
						<td width="6%">第三方订单号：</td>
						<td width="15%"><input type="text" name="goods"></td>
						<td width="6%">订单渠道：</td>
						<td width="15%">
							<select name="">
								<option value="">--请选择--</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>收货人：</td>
						<td><input type="text"></td>
						<td>联系电话：</td>
						<td><input type="text"></td>
						<td>收货地区：</td>
						<td>
							<select name="">
								<option value="">--请选择--</option>
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
						<td>发货库房：</td>
						<td>
							<select name="brand_id">
								<option value="-1">-- 不限 --</option>
								<?php if(is_array($brandInfo)): foreach($brandInfo as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
							</select>
						</td>	
					</tr>
					<tr class="date">
						<td>订单日期：</td>
						<td>
							<input type="text" readonly="readonly" id="manuf_date_start" name="manuf_date_start" class="hd-w150">
							&nbsp;&nbsp;&nbsp;
							<input type="text" readonly="readonly" id="manuf_date_end" name="manuf_date_end" class="hd-w150">
						</td>
						<td>发货日期：</td>
						<td>
							<input type="text" readonly="readonly" id="add_date_start" name="add_date_start" class="hd-w150">
							&nbsp;&nbsp;&nbsp;
							<input type="text" readonly="readonly" id="add_date_end" name="add_date_end" class="hd-w150">
						</td>
					</tr>
					<tr>
						<td>商品ID：</td>
						<td><input type="text" name="name"></td>
						<td>商品货号：</td>
						<td><input type="text"></td>
					</tr>
					<tr><td><input type="submit" value="搜索"></td></tr>
					<tr><td colspan="3"><a href="">按搜索条件导出</a></td></tr>
				</table>
			</form>
		</div>
		<table class="content-table">
			<thead>
				<tr>
					<td width="5%" align="center">订单号</td>
					<td width="15%" align="center">第三方订单号</td>
					<td width="5%" align="center">收货人</td>
					<td width="5%" align="center">收货电话</td>
					<td width="15%" align="center">收货地址</td>
					<td width="8%" align="center">订单金额</td>
					<td width="8%" align="center">下单时间</td>
					<td width="8%" align="center">订单状态</td>
					<td width="8%" align="center"></td>
					<td width="10%" align="center">管理操作</td>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($productList)): foreach($productList as $key=>$v): ?><tr>
						<td align="center"><?php echo ($v["id"]); ?></td>
						<td align="center"></td>
						<td align="center"><?php echo ($v["goods"]); ?></td>
						<td align="left"><?php echo ($v["name"]); ?></td>
						<td align="center"><?php echo ($v["category_name"]); ?></td>
						<td align="center"><?php echo ($v["brand_name"]); ?></td>
						<td align="center"><?php echo ($v["marked_price"]); ?></td>
						<td align="center"><?php echo (date('Y-m-d',$v["manuf_date"])); ?></td>
						<td align="center"><?php echo (date('Y-m-d',$v["add_date"])); ?></td>
						<td align="center">
							<a href="<?php echo U('Order/Order/edit',array('id'=>$v['id']));?>">编辑</a>
							<a href="<?php echo U('Order/Order/del',array('id'=>$v['id']));?>">删除</a>
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
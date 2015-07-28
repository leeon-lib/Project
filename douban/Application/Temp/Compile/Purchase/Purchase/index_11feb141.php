<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>采购单列表</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
	<script src="http://127.0.0.1/Project/douban/Static/Org/jquery-1.7.2.min.js"></script>
	<script src="http://127.0.0.1/Project/douban/Static/Org/cal/lhgcalendar.min.js"></script>
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
			<form action="<?php echo U('Purchase/Purchase/add');?>" method="post">
				<table class="search-table">
					<tr>
						<td width="8%">采购单号：</td>
						<td width="40%"><input type="text" name="product_id"></td>
						<td width="8%">销售方式：</td>
						<td width="40%">
							<select name="sale_type">
								<option value="-1">-- 不限 --</option>
								<?php foreach ($cateInfo as $k=>$v){?>
									<option value="<?php echo $v['cid'];?>"><?php echo $v['_name'];?></option>
								<?php }?>
							</select>
						</td>
					</tr>
					<tr>
						<td>供应商：</td>
						<td>
							<select name="category_cid">
								<option value="-1">-- 不限 --</option>
								<?php foreach ($cateInfo as $k=>$v){?>
									<option value="<?php echo $v['cid'];?>"><?php echo $v['_name'];?></option>
								<?php }?>
							</select>
						</td>
						<td>到货库房：</td>
						<td>
							<select name="brand_id">
								<option value="-1">-- 不限 --</option>
								<?php foreach ($brandInfo as $k=>$v){?>
									<option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
								<?php }?>
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
					<td width="10%" align="center">管理操作</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($productList as $k=>$v){?>
					<tr>
						<td align="center"><?php echo $v['id'];?></td>
						<td align="center">
							<?php if (empty($v['pic'])){ ?>
								<img src="http://127.0.0.1/Project/douban/Static/Images/default_s.gif" alt="" width="60px">
							<?php }else{ ?>
								<img src="http://127.0.0.1/Project/douban/Upload/Product/<?php echo $v['pic'];?>" alt="" width="60px">
							<?php } ?>
						</td>
						<td align="center"><?php echo $v['goods'];?></td>
						<td align="center"><?php echo $v['name'];?></td>
						<td align="center"><?php echo $v['category_name'];?></td>
						<td align="center"><?php echo $v['brand_name'];?></td>
						<td align="center"><?php echo $v['marked_price'];?></td>
						<td align="center"><?php echo date('Y-m-d',$v['manuf_date']);?></td>
						<td align="center"><?php echo date('Y-m-d',$v['add_date']);?></td>
						<td align="center">
							<a href="<?php echo U('Product/Product/edit',array('id'=>$v['id']));?>">编辑</a>
							<a href="<?php echo U('Product/Product/del',array('id'=>$v['id']));?>">删除</a>
						</td>
					</tr>
				<?php }?>
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
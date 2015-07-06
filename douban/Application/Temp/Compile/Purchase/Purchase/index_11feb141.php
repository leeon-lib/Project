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
			<a href="<?php echo U('Product/Product/index');?>">采购单列表</a>
			<span>|</span>
			<a href="<?php echo U('Product/Product/add');?>">添加采购单</a>
		</div>
		<div class="right">
			<a href="">后退</a>
			<span>|</span>
			<a href="">刷新</a>
		</div>
	</div>
	<div class="content">
		<div class="search">
			<form action="<?php echo U('Product/Product/index');?>" method="post">
				<table class="search-table">
					<tr>
						<td width="8%">商品ID：</td>
						<td width="40%"><input type="text" name="product_id"></td>
						<td width="8%">货号：</td>
						<td width="40%"><input type="text" name="goods"></td>
					</tr>
					<tr>
						<td>所属分类：</td>
						<td>
							<select name="category_cid">
								<option value="-1">-- 不限 --</option>
								<?php foreach ($cateInfo as $k=>$v){?>
									<option value="<?php echo $v['cid'];?>"><?php echo $v['_name'];?></option>
								<?php }?>
							</select>
						</td>
						<td>所属品牌：</td>
						<td>
							<select name="brand_id">
								<option value="-1">-- 不限 --</option>
								<?php foreach ($brandInfo as $k=>$v){?>
									<option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
								<?php }?>
							</select>
						</td>	
					</tr>
					<tr class="date">
						<td>上市日期：</td>
						<td>
							<input type="text" readonly="readonly" id="manuf_date_start" name="manuf_date_start" class="hd-w150">
							&nbsp;&nbsp;&nbsp;
							<input type="text" readonly="readonly" id="manuf_date_end" name="manuf_date_end" class="hd-w150">
						</td>
						<td>添加日期：</td>
						<td>
							<input type="text" readonly="readonly" id="add_date_start" name="add_date_start" class="hd-w150">
							&nbsp;&nbsp;&nbsp;
							<input type="text" readonly="readonly" id="add_date_end" name="add_date_end" class="hd-w150">
						</td>
					</tr>
					<tr class="name">
						<td>商品标题：</td>
						<td colspan="10"><input type="text" name="name"></td>	
					</tr>
					<tr><td><input type="submit" value="搜索"></td></tr>
					<tr><td colspan="3"><a href="">按搜索条件导出</a></td></tr>
				</table>
			</form>
		</div>
		<table class="content-table">
			<thead>
				<tr>
					<td width="5%" align="center">商品ID</td>
					<td width="8%" align="center">商品图片</td>
					<td width="10%" align="center">货号</td>
					<td width="30%" align="left">商品名称</td>
					<td width="6%" align="center">所属分类</td>
					<td width="6%" align="center">品牌</td>
					<td width="5%" align="center">市场价</td>
					<td width="8%" align="center">上市日期</td>
					<td width="8%" align="center">添加日期</td>
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
						<td align="left"><?php echo $v['name'];?></td>
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
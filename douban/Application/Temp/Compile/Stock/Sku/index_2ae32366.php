<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SKU列表</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
	<script src="http://127.0.0.1/Project/douban/Static/Org/jquery-1.7.2.min.js"></script>
	<script src="http://127.0.0.1/Project/douban/Static/Org/cal/lhgcalendar.min.js"></script>
</head>
<body>
	<div class="submenu">
		<div class="left">
			<a href="<?php echo U('Stock/Sku/index');?>">SKU列表</a>
			<span>|</span>
			<a href="<?php echo U('Stock/Sku/add');?>">添加SKU</a>
		</div>
		<div class="right">
			<a href="">后退</a>
			<span>|</span>
			<a href="">刷新</a>
		</div>
	</div>
	<div class="content">
		<div class="search">
			<form action="<?php echo U('Stock/Sku/index');?>" method="post">
				<table class="search-table">
					<tr>
						<td width="5%">SKU ID：</td>
						<td width="10%"><input type="text" name="sku_id"></td>
						<td width="5%">货号：</td>
						<td width="10%"><input type="text" name="goods"></td>
						<td width="5%">尺码：</td>
						<td width="10%"><input type="text" name="size"></td>
						<td width="5%">条形码：</td>
						<td width="10%"><input type="text" name="bar_code"></td>
						<td width="5%"><input type="submit" value="搜索"></td>
					</tr>
				</table>
			</form>
		</div>
		<table class="content-table">
			<thead>
				<tr>
					<td width="5%" align="center">SKU ID</td>
					<td width="15%" align="center">货号</td>
					<td width="15%" align="center">尺码</td>
					<td width="15%" align="center">条形码</td>
					<td width="10%" align="center">添加时间</td>
					<td width="10%" align="center">修改时间</td>
					<td width="10%" align="center">管理操作</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($supplierList as $k=>$v){?>
					<tr>
						<td align="center"><?php echo $v['id'];?></td>
						<td align="center"><?php echo $v['name'];?></td>
						<td align="center">
							    <?php if(1==$v['kind_id']){ ?>综合<?php } ?>
							    <?php if(2==$v['kind_id']){ ?>自有品牌<?php } ?>
						</td>
						<td align="center"><?php echo $v['brand_id'];?></td>
						<td align="center"><?php echo $v['manager'];?></td>
						<td align="center"><?php echo $v['mobile'];?></td>
						<td align="center"><?php echo $v['qq'];?></td>
						<td align="center"><?php echo $v['email'];?></td>
						<td align="center">
							<a href="<?php echo U('Purchase/Supplier/edit',array('id'=>$v['id']));?>">编辑</a>
							<a href="<?php echo U('Purchase/Supplier/del',array('id'=>$v['id']));?>">删除</a>
						</td>
					</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</body>
</html>
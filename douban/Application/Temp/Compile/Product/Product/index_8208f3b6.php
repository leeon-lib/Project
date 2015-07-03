<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品列表</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
</head>
<body>
	<div class="warp">
		<div class="content-menu">
			<div class="left">
				<a href="<?php echo U('Product/Product/index');?>">商品列表</a>
				<span>|</span>
				<a href="<?php echo U('Product/Product/add');?>">添加商品</a>
			</div>
			<div class="right">
				<a href="">后退</a>
				<span>|</span>
				<a href="">刷新</a>
			</div>
		</div>
		<div class="content-text">
			<table>
				<thead>
					<tr>
						<td width="5%" align="center">商品ID</td>
						<td width="10%" align="center">商品图片</td>
						<td width="10%" align="left">货号</td>
						<td width="20%" align="left">商品名称</td>
						<td width="10%" align="center">所属分类</td>
						<td width="10%" align="center">品牌</td>
						<td width="5%" align="center">市场价</td>
						<td width="10%" align="center">上市日期</td>
						<td width="10%" align="center">添加日期</td>
						<td width="10%" align="center">管理操作</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($info as $k=>$v){?>
						<tr>
							<td align="center"><?php echo $v['id'];?></td>
							<td align="center">
								<?php if (empty($v['pic'])){ ?>
									<img src="http://127.0.0.1/Project/douban/Static/Images/default_s.gif" alt="" width="60px">
								<?php }else{ ?>
									<img src="http://127.0.0.1/Project/douban/Upload/Product/<?php echo $v['pic'];?>" alt="" width="60px">
								<?php } ?>
							</td>
							<td align="left"><?php echo $v['goods'];?></td>
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
	</div>
</body>
</html>
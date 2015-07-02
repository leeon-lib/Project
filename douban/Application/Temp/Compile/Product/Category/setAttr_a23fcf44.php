<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>设置分类属性</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
	<script type="text/javascript" src="http://127.0.0.1/Project/douban/Static/Org/jquery-1.7.2.min.js"></script>
</head>
<body>
	<div class="warp">
		<div class="content-menu">
			<div class="left">
				<a href="<?php echo U('Product/Category/index');?>">分类列表</a>
				<span>|</span>
				<a href="<?php echo U('Product/Category/add');?>">添加分类</a>
			</div>
			<div class="right">
				<a href="">后退</a>
				<span>|</span>
				<a href="">刷新</a>
			</div>
		</div>
		<div class="content-text">
			<form action="<?php echo U('Product/Category/setAttr');?>" method="post">
				<table>
					<tbody>
						<tr>
							<td>分类名称：</td>
							<td><?php echo $cateName;?></td>
							<input type="hidden" name="cid" value="<?php echo $hd['get']['cid'];?>" />
						</tr>
						<!-- 如果有录入属性，则显示设置属性，否则提示无属性可设置 -->
						    <?php if(isset($attrInfo['no-selected'])){ ?>
							<!-- 如果有已设置定属性，则显示当前已选，否则显示所有 -->
							<?php if (empty($attrInfo['selected'])){ ?>
							<?php }else{ ?>
								<tr class="ways">
									<td colspan="10">当前已选：</td>
								</tr>
								<tr>
									<td width="10%">规格：</td>
									<td>
										<?php foreach ($attrInfo['selected'] as $k=>$v){?>
											    <?php if($v['kind_id'] == 2){ ?>
												<label><?php echo $v['name'];?><input type="checkbox" name="attr[sele][]" value="<?php echo $v['attribute_id'];?>" checked="checked"></label>&nbsp;
											<?php } ?>
										<?php }?>
									</td>
								</tr>
								<tr>
									<td width="10%">属性：</td>
									<td>
										<?php foreach ($attrInfo['selected'] as $k=>$v){?>
											    <?php if($v['kind_id'] == 1){ ?>
												<label><?php echo $v['name'];?><input type="checkbox" name="attr[sele][]" value="<?php echo $v['attribute_id'];?>" checked="checked"></label>&nbsp;
											<?php } ?>
										<?php }?>
									</td>
								</tr>
							<?php } ?>
							<tr class="ways">
								<td colspan="10">所有属性：</td>
							</tr>
							<tr>
								<td width="10%">规格：</td>
								<td>
								<?php foreach ($attrInfo['no-selected'] as $k=>$v){?>
								    <?php if(!in_array($v['id'],$attrInfo)){ ?>
									    <?php if(($v['kind_id'] == 2)){ ?>
										<label><?php echo $v['name'];?><input type="checkbox" name="attr[nosele][]" value="<?php echo $v['id'];?>"></label>&nbsp;
									<?php } ?>
								<?php } ?>
								<?php }?>
								</td>
							</tr>
							<tr>
								<td width="10%">属性：</td>
								<td>
									<?php foreach ($attrInfo['no-selected'] as $k=>$v){?>
										    <?php if($v['kind_id'] == 1){ ?>
											<label><?php echo $v['name'];?><input type="checkbox" name="attr[nosele][]" value="<?php echo $v['id'];?>"></label>&nbsp;
										<?php } ?>
									<?php }?>
								</td>
							</tr>
						<?php }else{ ?>
							<tr>
								<td colspan="10">无属性可设置，请先录入属性</td>
							</tr>
						<?php } ?>
						<tr class="btn">
							<td><input type="submit" value="设置"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
<script type="text/javascript">
	$('.glyphicon-plus').click(function(){
		var str  = '<tr><td></td>';
			str += '<td><input type="text" name="name[]"></td>';
			str += '<td><a href="javascript:;" class="glyphicon glyphicon-minus"></a></td></tr>';
		$('.btn').before(str);
	});
	$('tr .glyphicon-minus').live("click",function(){
		$(this).parents('tr').empty();
	})
</script>
</body>
</html>
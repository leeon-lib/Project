<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>编辑商品</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
	<script src="http://127.0.0.1/Project/douban/Static/Org/jquery-1.7.2.min.js"></script>
	<script src="http://127.0.0.1/Project/douban/Static/Org/cal/lhgcalendar.min.js"></script>
</head>
<body>
	<div class="warp">
		<div class="submenu">
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
		<div class="content">
			<div class="title">
				<a href="<?php echo U('Product/Product/edit');?>">基本信息</a>
				<a href="<?php echo U('Product/Product/attr');?>">商品属性</a>
				<a href="<?php echo U('Product/Product/details');?>">商品详情</a>
			</div>
			<form action="<?php echo U('Product/Product/operate');?>" method="post" enctype="multipart/form-data">
				<table class="content-table">
					<tbody>
						<tr class="title">
							<td colspan="10">商品基本信息</td>
						</tr>
						<tr>
							<td>商品名称：</td>
							<td><input type="text" name="name" value="<?php echo $oldInfo['name'];?>"></td>
						</tr>
						<tr>
							<td width="10%">商品货号：</td>
							<td><input type="text" name="goods" value="<?php echo $oldInfo['goods'];?>"></td>
						</tr>
						<tr>
							<td>所属分类</td>
							<td>
								<select name="category_cid">
									<option value="-1">必选</option>
									<?php foreach ($cateInfo as $k=>$v){?>
										    <?php if($oldInfo['category_cid']==$v['cid']){ ?>
											<option value="<?php echo $v['cid'];?>" selected="selected"><?php echo $v['_name'];?></option>
										<?php } ?>
										<option value="<?php echo $v['cid'];?>"><?php echo $v['_name'];?></option>
									<?php }?>
								</select>
							</td>
						</tr>
						<tr>
							<td>所属品牌</td>
							<td>
								<select name="brand_id">
									<option value="-1">必选</option>
									<?php foreach ($brandInfo as $k=>$v){?>
										    <?php if($oldInfo['brand_id']==$v['id']){ ?>
											<option value="<?php echo $v['id'];?>" selected="selected"><?php echo $v['name'];?></option>
										<?php } ?>
										<option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
									<?php }?>
								</select>
							</td>
						</tr>
						<tr>
							<td>上市日期：</td>
							<td>
								<input type="text" readonly="readonly" id="updatetime" name="manuf_date" class="hd-w150" value="<?php echo date('Y-m-d',$oldInfo['manuf_date']);?>">
							</td>
						</tr>
						<tr>
							<td>市场价：</td>
							<td><input type="text" name="marked_price" value="<?php echo $oldInfo['marked_price'];?>"></td>
						</tr>
						<tr>
							<td>商品图片：</td>
							<td>
								<?php if (empty($oldInfo['pic'])){ ?>
									<input type="file" name="pics">
								<?php }else{ ?>
									<img src="http://127.0.0.1/Project/douban/Upload/Product/<?php echo $oldInfo['pic'];?>" alt="">
								<?php } ?>
							</td>
						</tr>
						<tr class="title">
							<td colspan="10"><a href="javascript:;" class="setAttr">设置商品属性</a></td>
						</tr>
						<tr class="title">
							<td colspan="10"><a href="javascript:;" class="setDetails">设置商品详情</a></td>
						</tr>
						<tr class="btn">
							<td><input type="submit" value="修改"></td>
							<input type="hidden" name="product_id" value="<?php echo $oldInfo['id'];?>">
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
<script>
    $(function() {
        $('#updatetime').calendar({format: 'yyyy/MM/dd'});
    })

    // 选择分类后动态获取分类属性
    $('select[name=category_cid]').change(function(){
    	$('option').click(function(){
    		$(this).attr('selected','selected').siblings('option').removeAttr('selected');
    	});
    	// 分类选项被改变后，清除设置商品属性下的内容
    	$('.setAttr').parents('tr').siblings('.notice').empty();
    })

    // 设置商品属性
    $('.setAttr').click(function(){
    	var cid = $('select[name=category_cid] option[selected]').val();
    	var str = '';
    	if (-1 == cid) {
    		str = '<tr align="center" class="notice"><td colspan="10">请先选择商品分类！</td></tr>';
    	} else {
    		$.ajax({
                type: "post",
                url: "<?php echo U('Product/Product/ajax_getAttr');?>",
                data: {cid: cid},
                dataType: "json",
                async: false,
                success:function(info){
                	if (false != info)
                	{
                		str = '<tr><td>规格：<input type="hidden" name="attr[spec]"/></td><td>';
	                	$.each(info.spec,function(k,v){
	                        str += '<label>'+ v.name +' <input type="checkbox" name="attr[spec][]" value=" '+v.attribute_id+' "></label>&nbsp;&nbsp;&nbsp;';
	                    });
	                    str += '</td></tr>';
	                    str += '<tr><td>属性：<input type="hidden" name="attr[attr]"/></td><td>';
	                    $.each(info.attr,function(k,v){
	                        str += '<label>'+ v.name +' <input type="checkbox" name="attr[attr][]" value=" '+v.attribute_id+' "></label>&nbsp;&nbsp;&nbsp;';
	                    });
	                    str += '</td></tr>';
                	}
                	else
                	{
                		str = '<tr class="notice"><td colspan="10">您所选的分类暂未设置属性</td><td>'
                	}
                }
            });
    	}
    	$(this).parents('tr').after(str);
    })
</script>
</body>
</html>
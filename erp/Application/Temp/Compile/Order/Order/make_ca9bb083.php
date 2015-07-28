<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>手动下单</title>
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
			<form action="<?php echo U('Order/Order/add');?>" method="post" enctype="multipart/form-data">
				<table class="content-table">
					<tbody>
						<tr class="title" align="left">
							<td colspan="10">手动下单：</td>
						</tr>
						<tr>
							<td>商品货号：</td>
							<td><input type="text" name="name"></td>
							<td width="72%"><input type="button" value="查询"></td>
						</tr>
						<tr>
							<td>收货人姓名：</td>
							<td><input type="text"></td>
							<td></td>
						</tr>
						<tr>
							<td>收货人电话：</td>
							<td><input type="text"></td>
							<td></td>
						</tr>
						<tr>
							<td>省：</td>
							<td>
								<select name="category_cid">
									<option value="-1" selected="selected">必选</option>
									<?php foreach ($cateInfo as $k=>$v){?>
										<option value="<?php echo $v['cid'];?>"><?php echo $v['_name'];?></option>
									<?php }?>
								</select>
							</td>
						</tr>
						<tr>
							<td>市：</td>
							<td>
								<select name="brand_id">
									<option value="-1">必选</option>
									<?php foreach ($brandInfo as $k=>$v){?>
										<option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
									<?php }?>
								</select>
							</td>
						</tr>
						<tr>
							<td>区/县：</td>
							<td>
								<select name="brand_id">
									<option value="-1">必选</option>
									<?php foreach ($brandInfo as $k=>$v){?>
										<option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
									<?php }?>
								</select>
							</td>
						</tr>
						<tr>
							<td>详细地址：</td>
							<td><textarea name=""></textarea></td>
							<td></td>
						</tr>
						<tr>
							<td>上市日期：</td>
							<td>
								<input type="text" readonly="readonly" id="updatetime" name="manuf_date" class="hd-w150">
							</td>
						</tr>
						<tr>
							<td>市场价：</td>
							<td><input type="text" name="marked_price"></td>
						</tr>
						<tr>
							<td>商品图片：</td>
							<td><input type="file" name="pics"></td>
						</tr>
						<tr class="btn">
							<td><input type="submit" value="确认下单"></td>
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
    		str = '<tr align="left" class="notice"><td colspan="10">请先选择商品分类！</td></tr>';
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
		if ('' != str) {
			$(this).parents('tr').after(str);
		}
    })
</script>
</body>
</html>
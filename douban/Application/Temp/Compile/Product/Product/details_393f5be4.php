<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品详情</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
	<script src="http://127.0.0.1/Project/douban/Static/Org/jquery-1.7.2.min.js"></script>
	<script src="http://127.0.0.1/Project/douban/Static/Org/cal/lhgcalendar.min.js"></script>
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
			<div class="ways">
				<a href="<?php echo U('Product/Product/edit');?>">基本信息</a>
				<a href="<?php echo U('Product/Product/attr');?>">商品属性</a>
				<a href="<?php echo U('Product/Product/details');?>">商品详情</a>
			</div>
			<form action="<?php echo U('Product/Product/add');?>" method="post" enctype="multipart/form-data">
				<table>
					<tbody>
						<tr class="ways" align="center">
							<td colspan="10">商品基本信息</td>
						</tr>
						
						<tr class="btn">
							<td><input type="submit" value="添加"></td>
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
    $('select[name=category_id]').change(function(){
    	$('option').click(function(){
    		$(this).attr('selected','selected').siblings('option').removeAttr('selected');
    	});
    	// 分类选项被改变后，清除设置商品属性下的内容
    	$('.setAttr').parents('tr').siblings('.notice').empty();
    })

    // 设置商品属性
    $('.setAttr').click(function(){
    	var cid = $('select[name=category_id] option[selected]').val();
    	var str = '';
    	if (-1 == cid) {
    		str = '<tr align="center" class="notice"><td colspan="10">请先选择商品分类！</td></tr>';
    		$(this).parents('tr').after(str);
    	} else {
    		$.ajax({
                type: "post",
                url: "<?php echo U('Product/Product/ajax_setAttr');?>",
                data: {cid: cid},
                dataType: "json",
                async: false,
                success:function(info){
                	if (false != info)
                	{
                		str = '<tr><td>规格：<input type="hidden" name="attr[spec]"/></td><td>';
	                	$.each(info.spec,function(k,v){
	                        str += '<label>'+ v.name +' <input type="checkbox" name="attr[spec][]" value=" '+v.id+' "></label>&nbsp;&nbsp;&nbsp;';
	                    });
	                    str += '</td></tr>';
	                    str += '<tr><td>属性：<input type="hidden" name="attr[attr]"/></td><td>';
	                    $.each(info.attr,function(k,v){
	                        str += '<label>'+ v.name +' <input type="checkbox" name="attr[attr][]" value=" '+v.id+' "></label>&nbsp;&nbsp;&nbsp;';
	                    });
	                    str += '</td></tr>';
                	}
                	else
                	{
                		str = '<tr class="notice"><td colspan="10">您所选的分类暂未设置属性</td><td>'
                	}
                }
            });
    		$(this).parents('tr').after(str);
    	}
    })
</script>
</body>
</html>
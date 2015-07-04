<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>分类列表</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
	<script type="text/javascript" src="http://127.0.0.1/Project/douban/Static/Org/jquery-1.7.2.min.js"></script>
</head>
<body>
	<div class="submenu">
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
	<div class="content">
		<table class="content-table">
			<thead>
				<tr>
					<td width="5%" align="center"></td>
					<td width="10%" align="left">ID</td>
					<td width="30%" align="left">分类名称</td>
					<td width="15%" align="center">属性</td>
					<td width="15%" align="center">操作</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($cateInfo as $k=>$v){?>
				<tr pid="<?php echo $v['pid'];?>" cid="<?php echo $v['cid'];?>">
					<td align="center">
                        <a href="javascript:;" class="glyphicon glyphicon-plus" cid="<?php echo $v['cid'];?>"></a>
                    </td>
					<td align="left"><?php echo $v['cid'];?></td>
					<td align="left"><?php echo $v['_name'];?></td>
					<td align="center">
						<a href="<?php echo U('Product/Category/showAttr',array('cid'=>$v['cid']));?>">查看</a>
						<a href="<?php echo U('Product/Category/setAttr',array('cid'=>$v['cid']));?>">设置</a>
					</td>
					<td align="center">
						<a href="<?php echo U('addSub',array('cid'=>$v['cid']));?>">添加子分类</a>
						<a href="<?php echo U('edit',array('cid'=>$v['cid']));?>">编辑</a>
						<a href="javascript:del(<?php echo $v['id'];?>);">删除</a>
					</td>	
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</body>
<script type="text/javascript">
	// 隐藏非顶级分类
	$('tbody>tr[pid!=0]').hide();
	// 分类列表的展开与收缩
    $('.glyphicon').toggle(
    	function(){
    		// 显示被点击分类的子分类
    		var cid = $(this).attr('cid');
    		$('tbody>tr[pid='+cid+']').show();
    		// 样式变换，＋变－
            $(this).removeClass('glyphicon-plus');
            $(this).addClass('glyphicon-minus');
    	},function(){
    		$(this).removeClass('glyphicon-minus');
            $(this).addClass('glyphicon-plus');
            // 点击收起子分类
            var cid = $(this).attr('cid');
            $.ajax({
                type: "post",
                url: "<?php echo U('Product/Category/ajax_getSubCid');?>",
                data: {cid: cid},
                dataType: "json",
                success:function(info){
                    $.each(info,function(k,v){
                        $('tr[cid='+v+']').hide();
                    });
                }
            });
    	}
    );
    // 删除分类
    function del(id) {
    	if (confirm("确定删除此分类？")) {
    		$.ajax({
    			type: "post",
    			url: "<?php echo U('Product/Category/ajax_del');?>",
    			data: {cid: id},
    			success: function(info){
    				if (false == info) {
    					alert("无法删除存在子分类的分类");
    				} else {
    					$('tr[cid='+id+']').empty();
    				}
    			}
    		});
    	}
    }
    // 查看分类的属性
    
</script>
</html>
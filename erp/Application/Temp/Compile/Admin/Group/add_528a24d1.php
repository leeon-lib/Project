<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加部门</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
	<script type="text/javascript" src="http://127.0.0.1/Project/douban/Static/Org/jquery-1.7.2.min.js"></script>
</head>
<body>
	<div class="warp">
		<div class="submenu">
			<div class="left">
				<a href="<?php echo U('Admin/Group/index');?>">部门列表</a>
				<span>|</span>
				<a href="<?php echo U('Admin/Group/add');?>">添加部门</a>
			</div>
			<div class="right">
				<a href="">后退</a>
				<span>|</span>
				<a href="">刷新</a>
			</div>
		</div>
		<div class="content">
			<form action="<?php echo U('Admin/Group/operate');?>" method="post">
				<table class="content-table">
					<tbody>
						<tr class="title">
							<td colspan="10">直接录入：</td>
						</tr>
						<tr>
							<td width="10%">上级部门：</td>
							<td>
								<select name="pid">
									<option value="-1">可选</option>
									<?php foreach ($cateInfo as $k=>$v){?>
										<option value="<?php echo $v['cid'];?>"><?php echo $v['_name'];?></option>
									<?php }?>
								</select>
							</td>
							<td width="70%"></td>
						</tr>
						<tr>
							<td>部门名称：</td>
							<td><input type="text" name="name[]"></td>
							<td><a href="javascript:;" class="glyphicon glyphicon-plus"></a></td>
						</tr>
						<tr class="btn">
							<td><input type="submit" value="添加"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</body>
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
</html>
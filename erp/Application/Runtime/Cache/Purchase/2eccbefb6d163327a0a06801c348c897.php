<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加供应商</title>
	<link rel="stylesheet" href="/Project/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/Project/erp/web/Public/Css/content.css">
	<script src="/Project/erp/web/Public/Org/jquery-1.7.2.min.js"></script>
</head>
<body>
	<div class="warp">
		<div class="submenu">
			<div class="left">
				<a href="<?php echo U('Purchase/Supplier/index');?>">供应商列表</a>
				<span>|</span>
				<a href="<?php echo U('Purchase/Supplier/add');?>">添加供应商</a>
			</div>
			<div class="right">
				<a href="">后退</a>
				<span>|</span>
				<a href="">刷新</a>
			</div>
		</div>
		<div class="content">
			<form action="<?php echo U('Purchase/Supplier/operate');?>" method="post">
				<table class="content-table">
					<tbody>
						<tr class="title">
							<td colspan="10">添加供应商：</td>
						</tr>
						<tr>
							<td width="10%">供应商名称：</td>
							<td><input type="text" name="name"></td>
						</tr>
						<tr>
							<td width="10%">经营类别：</td>
							<td>
								<label>自有品牌<input type="radio" name="kind_id" value="1" checked="checked"></label>&nbsp;&nbsp;&nbsp;
								<label>综合<input type="radio" name="kind_id" value="2"></label>
							</td>
						</tr>
						<tr>
							<td>品牌：</td>
							<td id="brand">
								<select name="brand_id">
									<option value="-1">请选择</option>
									<?php if(is_array($brandList)): foreach($brandList as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="10%">联系人：</td>
							<td><input type="text" name="manager"></td>
						</tr>
						<tr>
							<td width="10%">联系人电话：</td>
							<td><input type="text" name="mobile"></td>
						</tr>
						<tr>
							<td width="10%">QQ号：</td>
							<td><input type="text" name="qq"></td>
						</tr>
						<tr>
							<td width="10%">邮箱：</td>
							<td><input type="text" name="email"></td>
						</tr>
						<tr class="btn">
							<td><input type="submit" value="添加"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>

<script type="text/javascript">
	$('input[type="radio"]').change(function(){
		// 经营类型，根据选择的类型，变更品牌的选择方式
		var kindId = $(this).val();
		// 品牌列表
		var brandList= <?php echo (json_encode($brandList)); ?>;
		var str = '';
		if (1 == kindId){
			str += '<select name="brand_id">';
			str += '<option value="-1">请选择</option>';
			for (var i in brandList){
				str += '<option value="'+brandList[i].id+'">';
				str += brandList[i].name + '</option>';
			}
		} else {
			for (var i in brandList){
				str += '<label>' + brandList[i].name ;
				str += '<input type="checkbox" name="brand_id[]" value="'+brandList[i].id+'">';
				str += '&nbsp;&nbsp;&nbsp;</label>';
			}
		}
		$('#brand').empty().append(str);
	})
</script>
</body>
</html>
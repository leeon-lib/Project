<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加品牌</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/jumei/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/jumei/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/jumei/Static/Css/content.css">
</head>
<body>
	<div class="warp">
		<div class="submenu">
			<div class="left">
				<a href="<?php echo U('Product/Brand/index');?>">品牌列表</a>
				<span>|</span>
				<a href="<?php echo U('Product/Brand/add');?>">添加品牌</a>
			</div>
			<div class="right">
				<a href="">后退</a>
				<span>|</span>
				<a href="">刷新</a>
			</div>
		</div>
		<div class="content">
			<form action="<?php echo U('Product/Brand/operate');?>" method="post" enctype="multipart/form-data">
				<table class="content-table">
					<tbody>
						<tr class="title">
							<td colspan="10">直接录入：</td>
						</tr>
						<tr>
							<td width="10%">品牌名称：</td>
							<td><input type="text" name="name"></td>
						</tr>
						<tr>
							<td>英文名称：</td>
							<td><input type="text" name="en_name"></td>
						</tr>
						<tr>
							<td>品牌类型：</td>
							<td>
								<select name="type_id">
									<option value="-1">请选择</option>
									<?php foreach ($typeList as $k=>$v){?>
										<option value="<?php echo $v['id'];?>"><?php echo $v['type_name'];?></option>
									<?php }?>
								</select>
							</td>
						</tr>
						<tr>
							<td>经营类别：</td>
							<td>
								<?php foreach ($cateList as $k=>$v){?>
									<label><?php echo $v['name'];?><input type="checkbox" name="cid[]" value="<?php echo $v['cid'];?>"></label>&nbsp;
								<?php }?>
							</td>
						</tr>
						<tr>
							<td>品牌Logo：</td>
							<td><input type="file" name="logo"></td>
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
</html>
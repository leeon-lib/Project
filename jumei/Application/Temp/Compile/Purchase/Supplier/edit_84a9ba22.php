<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>编辑供应商信息</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
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
							<td><input type="text" name="name" value="<?php echo $oldInfo['name'];?>"></td>
						</tr>
						<tr>
							<td width="10%">经营类别：</td>
							<td>
								<select name="kind_id">
									<option value="-1">请选择</option>
									<option value="1"     <?php if(1==$oldInfo['kind_id']){ ?>selected="selected"<?php } ?> >综合</option>
									<option value="2"     <?php if(2==$oldInfo['kind_id']){ ?>selected="selected"<?php } ?> >自有品牌</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>品牌：</td>
							<td>
								<select name="brand_id">
									<option value="">品牌</option>
								</select>
							</td>
						</tr>
						<tr>
							<td width="10%">联系人：</td>
							<td><input type="text" name="manager" value="<?php echo $oldInfo['manager'];?>"></td>
						</tr>
						<tr>
							<td width="10%">联系人电话：</td>
							<td><input type="text" name="mobile" value="<?php echo $oldInfo['mobile'];?>"></td>
						</tr>
						<tr>
							<td width="10%">QQ号：</td>
							<td><input type="text" name="qq" value="<?php echo $oldInfo['qq'];?>"></td>
						</tr>
						<tr>
							<td width="10%">邮箱：</td>
							<td><input type="text" name="email" value="<?php echo $oldInfo['email'];?>"></td>
						</tr>
						<tr class="btn">
							<input type="hidden" name="id" value="<?php echo $oldInfo['id'];?>">
							<td><input type="submit" value="修改"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
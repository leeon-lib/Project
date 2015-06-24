<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加属性</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
<body>
	<div class="warp">
		<div class="content-menu">
			<div class="left">
				<a href="<?php echo U('Product/Attribute/index');?>">属性列表</a>
				<span>|</span>
				<a href="<?php echo U('Product/Attribute/add');?>">添加属性</a>
			</div>
			<div class="right">
				<a href="">后退</a>
				<span>|</span>
				<a href="">刷新</a>
			</div>
		</div>
		<div class="content-text">
			<form action="<?php echo U('add');?>" method="post">
				<table>
					<tbody>
						<tr class="ways">
							<td colspan="10">直接录入：</td>
						</tr>
						<tr>
							<td width="10%">属性名称：</td>
							<td><input type="text"></td>
						</tr>
						<tr>
							<td>所属分类：</td>
							<td>
								<select name="" id="">
									<option value="－1">请选择分类</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><input type="submit" value="添加"></td>
						</tr>
					</tbody>
				</table>
			</form>
			<form action="<?php echo U('Product/Attribute/implode');?>" method="post">
				<table>
					<tbody>
						<tr class="ways">
							<td colspan="10">表格导入：</td>
						</tr>
						<tr>
							<td width="10%">文件：</td>
							<td><input type="file"></td>
						</tr>
						<tr>
							<td>所属分类：</td>
							<td>
								<select name="" id="">
									<option value="－1">请选择分类</option>
								</select>
							</td>
						</tr>
						<tr class="note">
							<td>备注：</td>
							<td>只允许csv的文件格式。</td>
						</tr>
						<tr>
							<td><input type="submit" value="添加"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>编辑分类</title>
	<link rel="stylesheet" href="/erp/web/Public/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="/erp/web/Public/Css/public.css">
	<link rel="stylesheet" href="/erp/web/Public/Css/content.css">
</head>
<body>
	<div class="warp">
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
			<form action="" method="post">
				<table class="content-table">
					<tbody>
						<tr>
							<td>所属分类：</td>
							<td>
								<select name="pid">
									<option value="0" <?php if(($oldInfo['pid']) == "0"): ?>selected<?php endif; ?> >顶级分类</option>
									<?php if(is_array($cateInfo)): foreach($cateInfo as $key=>$v): if(in_array(($v['cid']), explode(',',"selfSub)"))): ?><option value="<?php echo ($v["cid"]); ?>" <?php if(($oldInfo['pid']) == "v['cid']"): ?>selected<?php endif; ?> ><?php echo ($v["_name"]); ?></option><?php endif; endforeach; endif; ?>
								</select>
							</td>
						</tr>
						<tr>
							<input type="hidden" name="cid" value="<?php echo ($hd["get"]["cid"]); ?>" />
							<td width="10%">分类名称：</td>
							<td><input type="text" name="name" value="<?php echo ($oldInfo["name"]); ?>"></td>
						</tr>
						<tr>
							<td><input type="submit" value="修改"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
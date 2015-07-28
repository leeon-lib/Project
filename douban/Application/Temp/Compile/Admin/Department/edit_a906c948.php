<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改部门信息</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
	<script type="text/javascript" src="http://127.0.0.1/Project/douban/Static/Org/jquery-1.7.2.min.js"></script>
</head>
<body>
	<div class="warp">
		<div class="submenu">
			<div class="left">
				<a href="<?php echo U('Admin/Department/index');?>">部门列表</a>
				<span>|</span>
				<a href="<?php echo U('Admin/Department/add');?>">添加部门</a>
			</div>
			<div class="right">
				<a href="">后退</a>
				<span>|</span>
				<a href="">刷新</a>
			</div>
		</div>
		<div class="content">
			<form action="<?php echo U('Admin/Department/operate');?>" method="post">
				<table class="content-table">
					<tbody>
						<tr class="title">
							<td colspan="10">修改部门信息：</td>
						</tr>
						<tr>
							<td width="10%">上级部门：</td>
							<td>
								<select name="pid">
									    <?php if(0 == $oldInfo['pid']){ ?>
										<option value="0" selected="selected">一级部门</option>
										<?php foreach ($deptList as $k=>$v){?>
											<option value="<?php echo $v['id'];?>"><?php echo $v['_name'];?></option>
										<?php }?>
									<?php }else{ ?>
										<option value="0">一级部门</option>
										<?php foreach ($deptList as $k=>$v){?>
											    <?php if($oldInfo['pid'] == $v['id']){ ?>
												<option value="<?php echo $v['id'];?>" selected="selected"><?php echo $v['_name'];?></option>
											<?php } ?>
											<option value="<?php echo $v['id'];?>"><?php echo $v['_name'];?></option>
										<?php }?>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>部门名称：</td>
							<td><input type="text" name="name" value="<?php echo $oldInfo['name'];?>"></td>
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
<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>编辑分类</title>
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Org/Bootstrap/css/Bootstrap.min.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/public.css">
	<link rel="stylesheet" href="http://127.0.0.1/Project/douban/Static/Css/content.css">
</head>
<body>
	<div class="warp">
		<div class="content-menu">
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
		<div class="content-text">
			<form action="" method="post">
				<table>
					<tbody>
						<tr>
							<td>所属分类：</td>
							<td>
								<select name="pid">
									<option value="0"     <?php if($oldInfo['pid']==0){ ?>selected<?php } ?> >顶级分类</option>
									<?php foreach ($cateInfo as $k=>$v){?>
			                            <?php if(!in_array($v['cid'],$selfSub)){ ?>
			                            <option value="<?php echo $v['cid'];?>"     <?php if($oldInfo['pid']==$v['cid']){ ?>selected<?php } ?> ><?php echo $v['_name'];?></option>
			                        <?php } ?>
			                        <?php }?>
								</select>
							</td>
						</tr>
						<tr>
							<input type="hidden" name="cid" value="<?php echo $hd['get']['cid'];?>" />
							<td width="10%">分类名称：</td>
							<td><input type="text" name="name" value="<?php echo $oldInfo['name'];?>"></td>
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
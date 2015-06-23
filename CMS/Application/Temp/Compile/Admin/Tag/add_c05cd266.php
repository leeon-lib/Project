<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>标签管理</title>
    <script type="text/javascript" src="http://127.0.0.1/CMS/Static/Js/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://127.0.0.1/CMS/Static/hdjs/hdjs.css"/>
    <script src="http://127.0.0.1/CMS/Static/hdjs/hdjs.min.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="http://127.0.0.1/CMS/Static/Bootstrap/css/bootstrap.min.css" />
    <style type="text/css">
		table{
			color: #666;
		}
    </style>
</head>
<body>
<div class="wrap">
    <div class="hd-title-header">添加标签</div>
    <form action="<?php echo U('Admin/Tag/add');?>" method="post" class="form-inline hd-form">
        <table class="table hd-table-list">
            <tr>
                <th class="w100">标签名称</th>
                <td width="300">
                    <textarea name="tagname" style="width:280px;" cols="20" rows="8"></textarea>
                </td>
                <td>多个标签，以【逗号，空格，或者换行符分割】</td>
            </tr>
        </table>
         <input type="submit" class="hd-btn hd-btn-success" value="添加" style="margin-top:20px;margin-left:20px;"/>
    </form>
</div>
</body>
</html>
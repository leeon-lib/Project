<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>用户管理</title>
    <script type="text/javascript" src="http://127.0.0.1/CMS/Static/Js/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://127.0.0.1/CMS/Static/hdjs/hdjs.css"/>
    <script src="http://127.0.0.1/CMS/Static/hdjs/hdjs.min.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="http://127.0.0.1/CMS/Static/Bootstrap/css/bootstrap.min.css" />
</head>
<body>
<div class="wrap">
    <table class="table hd-table-list">
        <thead>
            <tr>
                <td align="center" width="10%">用户id</td>
                <td align="center" width="30%">用户名</td>
                <td align="center" width="20%">上次登录时间</td>
                <td align="center" width="10%">是否锁定</td>
                <td align="center" width="10%">状态</td>
                <td align="center" width="20%">操作</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($info as $k=>$v){?>
            <tr>
                <td align="center" width="10%"><?php echo $v['uid'];?></td>
                <td align="center" width="30%"><?php echo $v['username'];?></td>
                <td align="center" width="20%"><?php echo $v['login_time'];?></td>
                <td align="center" width="10%"><?php echo $v['is_lock'];?></td>
                <td align="center" width="10%">X</td>
                <td align="center" width="20%">
                    <a href="" class="btn btn-warning btn-xs">修改</a>
                    <a href="" class="btn btn-danger btn-xs">删除</a>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
    <div class="page_hdjob">
        
    </div>
</div>

</body>
</html>
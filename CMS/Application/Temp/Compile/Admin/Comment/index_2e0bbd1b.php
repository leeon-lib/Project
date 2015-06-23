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
        td{
        }
    </style>
</head>
<body>
<div class="wrap">
    <table class="table hd-table-list">
        <thead>
        <tr>
            <td width="10%" align="center">id</td>
            <td align="center">评论内容</td>
            <td align="center">发表时间</td>
            <td align="center">所属文章</td>
            <td align="center">提交用户</td>
            <td width="120" align="center">操作</td>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($info as $k=>$v){?>
            <tr>
                <td width="30" align="center"><?php echo $v['coid'];?></td>
                <td align="center"><?php echo $v['comcon'];?></td>
                <td align="center"><?php echo date('Y-m-d H:i:s',$v['addtime']);?></td>
                <td align="center"><?php echo $v['user'];?></td>
                <td align="center"><?php echo $v['article'];?></td>
                <td width="120" align="center">
                    <a href="javascript:del(<?php echo $v['id'];?>);" class="btn btn-danger btn-xs">删除</a>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
    <div class="page_hdjob">
        
    </div>
</div>
<script type="text/javascript">
    function del(id) {
        hd_modal({
            width: 300,//宽度
            height: 150,//高度
            title: '确认删除吗？',//标题
            content: '',//提示信息
            button: true,//显示按钮
            button_success: "确定",//确定按钮文字
            button_cancel: "取消",//关闭按钮文字
            timeout: 0,//自动关闭时间 0：不自动关闭
            shade: true,//背景遮罩
            shadeOpacity: 0.4,//背景透明度
            success: function () {//点击确定后的事件
                location.href="<?php echo U('Admin/Comment/del');?>" + "&coid=" + id;
            },
            cancel: function () {//点击关闭后的事件
                
            }
        });
    }
</script>
</body>
</html>
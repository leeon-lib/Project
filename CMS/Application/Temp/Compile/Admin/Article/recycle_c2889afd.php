<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>文章管理</title>
    <script type="text/javascript" src="http://127.0.0.1/CMS/Static/Js/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://127.0.0.1/CMS/Static/hdjs/hdjs.css"/>
    <script src="http://127.0.0.1/CMS/Static/hdjs/hdjs.min.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="http://127.0.0.1/CMS/Static/Bootstrap/css/bootstrap.min.css" />
</head>
<body>
<div class="wrap">
    <table class="table table-bordered hd-table-list">
        <thead>
        <tr>
            <td width="50" align="center">id</td>
            <td align="center">文章标题</td>
            <td width="100" align="center">属性</td>
            <td width="180" align="center">添加时间</td>
            <td width="180" align="center">修改时间</td>
            <td width="100" align="center">所属分类</td>
            <td width="50" align="center">作者</td>
            <td width="150" align="center">操作</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($info as $k=>$v){?>
            <tr>
            <td width="50" align="center"><?php echo $v['aid'];?></td>
            <td align="center"><?php echo $v['title'];?></td>
            <td width="100" align="center"><?php echo $v['attr'];?></td>
            <td width="180" align="center"><?php echo date('Y-m-s H:i:s',$v['sendtime']);?></td>
            <td width="180" align="center"><?php echo $v['updatetime'];?></td>
            <td width="100" align="center"><?php echo $v['cname'];?></td>
            <td width="50" align="center"><?php echo $v['author'];?></td>
            <td width="150" align="center">
                <a href="<?php echo U('Admin/Article/recovery',array('aid'=>$v['aid']));?>" class="btn btn-success btn-xs">恢复</a>
                <a href="javascript:del(<?php echo $v['aid'];?>)" class="btn btn-danger btn-xs">删除</a>
            </td>
        </tr>
        <?php }?>
        </tbody>
    </table>
    <div class="page_hdjob">
      
    </div>
</div>
<script type="text/javascript">
    /**删除分类方式2，模态框**/
    function del(id) {
        hd_modal({
            width: 300,//宽度
            height: 150,//高度
            title: '确定永久删除吗？',//标题
            content: '',//提示信息
            button: true,//显示按钮
            button_success: "确定",//确定按钮文字
            button_cancel: "取消",//关闭按钮文字
            timeout: 0,//自动关闭时间 0：不自动关闭
            shade: true,//背景遮罩
            shadeOpacity: 0.4,//背景透明度
            success: function () {//点击确定后的事件
                location.href="<?php echo U('Admin/Article/real_del');?>" + "&aid=" + id;
            },
            cancel: function () {//点击关闭后的事件
                
            }
        });
    }
</script>

</body>
</html>



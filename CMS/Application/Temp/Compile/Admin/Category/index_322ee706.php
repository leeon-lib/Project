<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>分类管理</title>
    <script type="text/javascript" src="http://127.0.0.1/Project/CMS/Static/Js/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://127.0.0.1/Project/CMS/Static/hdjs/hdjs.css"/>
    <script src="http://127.0.0.1/Project/CMS/Static/hdjs/hdjs.min.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="http://127.0.0.1/Project/CMS/Static/Bootstrap/css/bootstrap.min.css" />
</head>
<body>
    <div class="wrap">
        <table class="table hd-table-list">
            <thead>
                <tr pid=0>
                    <td width="50" align="center"></td>
                    <td align="center">分类id</td>
                    <td width="200">分类名称</td>
                    <td align="center">分类标题</td>
                    <td align="center">分类排序</td>
                    <td align="center">静态目录</td>
                    <td align="center">列表静态</td>
                    <td align="center">内容静态</td>
                    <td align="center">是否显示</td>
                    <td align="center">操作</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cateInfo as $k=>$v){?>
                    <tr pid="<?php echo $v['pid'];?>" cid="<?php echo $v['cid'];?>">
                        <td width="50" align="center">
                            <a href="javasrcipt:;" class="glyphicon glyphicon-plus" cid="<?php echo $v['cid'];?>"></a>
                        </td>
                        <td align="center"><?php echo $v['cid'];?></td>
                        <td width="200"><?php echo $v['_name'];?></td>
                        <td align="center"><?php echo $v['ctitle'];?></td>
                        <td align="center"><?php echo $v['csort'];?></td>
                        <td align="center"><?php echo $v['htmldir'];?></td>
                        <td align="center"><?php echo $v['listhtml'];?></td>
                        <td align="center"><?php echo $v['archtml'];?></td>
                        <td align="center"><?php echo $v['is_show'];?></td>
                        <td width="200" align="center">
                            <a href="<?php echo U('Admin/Category/addSub',array('cid'=>$v['cid']));?>" class="btn btn-primary btn-xs">添加子分类</a>
                            <a href="<?php echo U('Admin/Category/edit',array('cid'=>$v['cid']));?>" class="btn btn-warning btn-xs">编辑</a>
                            <a href="javascript:del(<?php echo $v['cid'];?>)" class="btn btn-danger btn-xs">删除</a>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
        <div class="page_hdjob">

        </div>
    </div>

    <script type="text/javascript">
        /**删除分类方式1，location直接跳转**/
        // function del(cid){
        //     if (confirm('确定删除吗？')) {
        //         location.href = "<?php echo U('Admin/Category/del');?>&cid=" + cid;
        //     }
        // }
        /**删除分类方式2，模态框**/
        function del(cid) {
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
                    location.href="<?php echo U('Admin/Category/del');?>" + "&cid=" + cid;
                },
                cancel: function () {//点击关闭后的事件
                    
                }
            });
        }
        
        $('tr[pid!=0]').hide();
        // 分类列表的展开与收缩
        $('.glyphicon').toggle(
            function(){
                // 样式变换，＋变－
                $(this).removeClass('glyphicon-plus');
                $(this).addClass('glyphicon-minus');

                // 获取子分类信息
                var cid = $(this).attr('cid');
                $('tr[pid='+cid+']').show();
                // $.ajax({
                //     type: "post",
                //     url: "<?php echo U('Admin/Category/ajax_getSub');?>",
                //     data: {cid: cid},
                //     dataType: "json",
                //     success:function(info){
                //         var obj = eval(info);
                //         var str = '<tr pid='+obj[0].cid+'><td width="30">';
                //         str += '<a href="javasrcipt:;" class="glyphicon glyphicon-plus" cid='+obj[0].cid+'></a></td>';
                //         str += '<td>'+obj[0].cid+'</td><td>'+obj[0].cname+'</td><td>'+obj[0].ctitle+'</td>';
                //         str += '<td>'+obj[0].csort+'</td><td>'+obj[0].htmldir+'</td><td>'+obj[0].listhtml+'</td>';
                //         str += '<td>'+obj[0].archtml+'</td><td>'+obj[0].is_show+'</td>';
                //         str += '<a href=" ';
                //         str += "<?php echo U('Admin/Category/ajax_getSub');?>";
                //         str += '"添加子分类</a>';
                //         str += '<a href=" ';
                //         str += "<?php echo U('Admin/Category/ajax_getSub');?>";
                //         str += '"编辑</a>';
                //         str += '<a href=" ';
                //         str += "<?php echo U('Admin/Category/ajax_getSub');?>";
                //         str += '"删除</a>';
                //         $('tr[cid='+obj[0].pid+']').after(str);
                //         // alert(str);
                //     }
                // });
            },function(){
                $(this).removeClass('glyphicon-minus');
                $(this).addClass('glyphicon-plus');

                var cid = $(this).attr('cid');
                $.ajax({
                    type: "post",
                    url: "<?php echo U('Admin/Category/ajax_getSubCid');?>",
                    data: {cid: cid},
                    dataType: "json",
                    success:function(info){
                        // alert(info);die;
                        $.each(info,function(k,v){
                            $('tr[cid='+v+']').hide();
                        });
                    }
                });
            }
        );
    </script>
</body>
</html>



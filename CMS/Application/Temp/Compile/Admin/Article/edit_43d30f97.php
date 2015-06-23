<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>添加文章</title>
    <script type="text/javascript" src="http://127.0.0.1/CMS/Static/Js/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://127.0.0.1/CMS/Static/hdjs/hdjs.css"/>
    <script src="http://127.0.0.1/CMS/Static/hdjs/hdjs.min.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="http://127.0.0.1/CMS/Static/Bootstrap/css/bootstrap.min.css" />
    <script type="text/javascript" charset="utf-8" src="http://127.0.0.1/CMS/Static/ueditor1_4_3/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="http://127.0.0.1/CMS/Static/ueditor1_4_3/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="http://127.0.0.1/CMS/Static/ueditor1_4_3/lang/zh-cn/zh-cn.js"></script>
    <style type="text/css">
        .checkbox{
             margin-left:5px;
             width:90px;
             margin-top: 10px;
        }
        textarea{
            width: 300px;
            height: 100px;
        }
    </style>
</head>
<body>
<div class="wrap">
    <div class="hd-title-header">编辑文章</div>
    <form action="<?php echo U('Admin/Article/edit');?>" method="post" class="form-inline hd-form" enctype="multipart/form-data">
        <table class="hd-table hd-table-list">
            <tr>
                <th class="w100">文章标题</th>
                <td class="w100">
                    <input type="text" name="title" class="w200" value="<?php echo $oldData['title'];?>" /> 
                </td>
                <td></td>
            </tr>
            <tr>
                <th class="w100">作者</th>
                <td>
                    <input type="text" name="author" class="w200" value="<?php echo $oldData['author'];?>"/>
                </td>
                <td></td>
            </tr>
            <tr>
                <th class="w100">所属分类</th>
                <td>
                    <select name="category_cid" class="w200">
                        <?php foreach ($cateInfo as $k=>$v){?>
                            <option value="<?php echo $v['cid'];?>"     <?php if($v['cid']==$oldData['category_cid']){ ?>selected<?php } ?> ><?php echo $v['_name'];?></option>
                        <?php }?>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr>
                <th class="w100">文章摘要</th>
                <td>
                    <textarea name="digest"><?php echo $oldData['digest'];?></textarea>
                </td>
                <td></td>
            </tr>
            <tr>
                <th class="w100">缩略图</th>
                <td>
                    <?php if (empty($oldData['thumb'])): ?>
                        <input type="file" name="thumb" />
                    <?php else: ?>
                        <img src="http://127.0.0.1/CMS/<?php echo $oldData['thumb'];?>" alt="" width="80" height="80" />
                        <span class="close">X</span>
                    <?php endif ?>
                    
                </td>
                <td></td>
            </tr>
            <tr>
                <th class="w100">文章属性</th>
                <td>
                    <label class="radio-inline">
                        热门
                        <input type="checkbox" value="热门" name="attr[]" class="check_input"     <?php if(in_array('热门',$oldData['attr'])){ ?>checked<?php } ?> >
                    </label>
                    <label class="radio-inline">
                        置顶
                        <input type="checkbox" value="置顶" name="attr[]" class="check_input"     <?php if(in_array('置顶',$oldData['attr'])){ ?>checked<?php } ?> >
                    </label>
                    <label class="radio-inline">
                        推荐
                        <input type="checkbox" value="推荐" name="attr[]" class="check_input"     <?php if(in_array('推荐',$oldData['attr'])){ ?>checked<?php } ?> >
                    </label>
                    <label class="radio-inline">
                        图文
                        <input type="checkbox" value="图文" name="attr[]" class="check_input"     <?php if(in_array('图文',$oldData['attr'])){ ?>checked<?php } ?> >
                    </label>
                </td>
                <td></td>
            </tr>
            <tr>
                <th class="w100">文章标签</th>
                <td>
                    <?php foreach ($tagInfo as $k=>$v){?>
                    <label class="radio-inline">
                        <?php echo $v['tagname'];?>
                        <input type="checkbox" value="<?php echo $v['tid'];?>" name="tag[]" class="check_input"     <?php if(in_array($v['tid'],$arcTagInfo)){ ?>checked<?php } ?> >
                    </label>
                    <?php }?>
                </td>
            </tr>
             <tr>
                <th class="w100">文章关键字</th>
                <td>
                    <textarea name="keywords" id="" rows="10"><?php echo $oldData['keywords'];?></textarea>
                </td>
            </tr>
             <tr>
                <th class="w100">文章描述</th>
                <td>
                    <textarea name="description" id="" cols="30" rows="10"><?php echo $oldData['description'];?></textarea>
                </td>
                <td></td>
            </tr>
             <tr>
                <th class="w100">文章正文</th>
                <td>
                    <script id="editor" type="text/plain" style="width:600px;height:500px;" name="content"><?php echo $oldData['content'];?></script>
                    <script>
                        var ue = UE.getEditor('editor');
                    </script>
                </td>
                <td></td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="hidden" name="aid" value="<?php echo $oldData['aid'];?>" />
            <input type="submit" class="hd-btn hd-btn-success" value="修改"/>
        </div>
    </form>
</div>
<script type="text/javascript">
    $('.close').click(function(){
        if (confirm("确认删除？")) {
            $(this).siblings('img').hide().parent('td').html("<input type='file' name='thumb' />");
        }
    })
</script>
</body>
</html>
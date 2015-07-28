<?php if(!defined('HDPHP_PATH'))exit;C('SHOW_NOTICE',FALSE);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>站点配置项</title>
    <script type="text/javascript" src="http://127.0.0.1/Project/CMS/Static/Js/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://127.0.0.1/Project/CMS/Static/hdjs/hdjs.css"/>
    <script src="http://127.0.0.1/Project/CMS/Static/hdjs/hdjs.min.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="http://127.0.0.1/Project/CMS/Static/Bootstrap/css/bootstrap.min.css" />
</head>
<body>
<div class="wrap">
    <div class="hd-title-header">站点配置</div>
    <form action="" method="post" class="form-inline hd-form">
        <table class="table hd-table-list">
            <tr>
                <td class="w100">名称</td>
                <td class="w100">值</td>
                <td class="w150">标题</td>
                <td class="w150">描述</td>
            </tr>
            <tr>
                <th colspan="100">站点信息</th>
            </tr>
            <?php foreach ($info as $k=>$v){?>
                <?php if($v['type_id']==1){ ?>
            <tr>
                <td class="w100"><?php echo $v['name'];?></td>
                <td class="w100"><input type="text" value="<?php echo $v['value'];?>"></td>
                <td class="w150"><?php echo $v['title'];?></td>
                <td class="w150"><?php echo $v['des'];?></td>
            </tr>
            <?php } ?>
            <?php }?>
            <tr>
                <th colspan="100">验证码</th>
            </tr>
            <?php foreach ($info as $k=>$v){?>
                <?php if($v['type_id']==2){ ?>
            <tr>
                <td class="w100"><?php echo $v['name'];?></td>
                <td class="w100"><input type="text" value="<?php echo $v['value'];?>"></td>
                <td class="w150"><?php echo $v['title'];?></td>
                <td class="w150"><?php echo $v['des'];?></td>
            </tr>
            <?php } ?>
            <?php }?>
        </table>
        <div class="position-bottom">
            <input type="submit" class="btn hd-btn-success" value="保存"/>
        </div>
    </form>
</div>
</body>
</html>
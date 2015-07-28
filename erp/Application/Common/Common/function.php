<?php

/**
 * 打印输出数据|show的别名
 * @param void $var
 */
function p($var)
{
    if (is_bool($var)) {
        var_dump($var);
    } else if (is_null($var)) {
        var_dump(NULL);
    } else {
        echo "<pre style='position:relative;z-index:1000;padding:10px;border-radius:5px;background:#F5F5F5;border:1px solid #aaa;font-size:14px;line-height:18px;opacity:0.9;'>" . print_r($var, true) . "</pre>";
    }
}

/**
* 去除数组空值
* @param  [array] $arr [description]
* @return [array]      [description]
*/
function rmEmpty($arr)
{
	if (is_array($arr))
	{
		foreach ($arr as $key => $val)
		{
			if (!is_array($val))
			{
				if (empty(trim($val)))
				{
					unset($arr[$key]);
				} else {
					$arr[$key] = $val;
				}
			} else {
				$arr[$key] = $this->rmEmpty($val);
			}
		}
		return $arr;
	} else {
		return $arr;
	}
}

/**
 * 文件上传
 * @param  string	项目附属目录下的子目录 
 * @return string   上传后的文件信息
 */
function upload($path, $thumb=false)
{
	$upload = new \Think\Upload();// 实例化上传类
	$upload->maxSize = 3145728 ;// 设置附件上传大小
	$upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'csv');// 设置附件上传类型

	$upload->rootPath = C('UPLOAD_PATH');
	$upload->savePath = $path;
	// 上传文件
	$info = current($upload->upload());
	if(!$info) 
	{// 上传错误提示错误信息
		die($upload->getError());
	} else {// 上传成功
		$savePath = $info['savepath'] . $info['savename'];
		// 是否缩略
		if (!$thumb)
		{
			return $savePath;
		} else {
			$image = new \Think\Image();
			$path = C('UPLOAD_PATH') . $savePath;
			$image->open($path);
			$image->thumb(C('THUMB_W'), C('THUMB_W'), \Think\Image::IMAGE_THUMB_FIXED)->save($path);
			return $savePath;
		}
	}
}
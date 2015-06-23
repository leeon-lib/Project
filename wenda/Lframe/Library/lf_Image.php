<?php

/**
* 图像处理类
*/
class lf_Image extends lf_controller
{
	// 支持的图片文件类型
	// 2:jpg/jpeg
	// 3:png
	private $type = array(2,3,15);

	function __construct()
	{
		# code...
	}

	/**
	* 添加水印
	*/
	public function waterMark($dstImg,$srcImg,$position,$pct) {
		// 如果不是图片文件，则不执行
		$dstInfo = getimagesize($dstImg);
		$srcInfo = getimagesize($srcImg);
		if (!$dstInfo || !$srcInfo) {
			return -1;
		}
		// 取得文件类型，如果类型不支持则不执行
		if (!in_array($dstInfo[2], $this->type) || !in_array($srcInfo[2], $this->type)) {
			return -2;
		}
		// 获得目标图像与源图像的资源
		$dst = $this->createImg($dstImg,$dstInfo[2]);
		$src = $this->createImg($srcImg,$srcInfo[2]);
		// 计算水印图片的位置
		switch ((int)$position) {
			case 1:	//左上
				$x = $y = 0;
				break;
			
			case 2:	//右上
				$x = $dstInfo[0] - $srcInfo[0];
				$y = 0;
				break;

			case 3:	//左下
				$x = 0;
				$y = $dstInfo[1] - $srcInfo[1];
				break;

			case 4:	//右下
				$x = $dstInfo[0] - $srcInfo[0];
				$y = $dstInfo[1] - $srcInfo[1];
				break;

			case 5: //居中
				$x = ($dstInfo[0] - $srcInfo[0]) / 2;
				$y = ($dstInfo[1] - $srcInfo[1]) / 2;
				break;

			default:
				$x = $y = 0;
				break;
		}
		// 添加水印
		imagecopymerge($dst, $src, $x, $y, 0, 0, $srcInfo[0], $srcInfo[1], $pct);
		imagejpeg($dst);
		imagedestroy($dst);
		imagedestroy($src);
	}


	/**
	* 转缩略图
	* @param $imgFile  //图片文件.
	* @param $w,$h  //缩略图宽高
	*
	* return (resource) image //图像资源
	*/
	public function thumbnail($srcImg,$w,$h) {
		// 创建画布
		$dst = $this->markGraph($w,$h);
		// 如果不是图片文件，则不执行
		$srcInfo = getimagesize($srcImg);
		if (!$srcInfo) {
			return -1;
		}
		// 取得文件类型，如果类型不支持则不执行
		if (!in_array($srcInfo[2], $this->type)) {
			return -2;
		}
		// 获得源图像的资源
		$src = $this->createImg($srcImg,$srcInfo[2]);
		// 缩略
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $srcInfo[0], $srcInfo[1]);
		imagejpeg($dst);
		imagedestroy($dst);
		imagedestroy($src);
	}


	/**
	* 构造图形
	*/
	private function markGraph($w,$h) {
		return imagecreatetruecolor($w, $h);
	}


	/**
	* 根据图片类型，执行添加水印
	*
	* @param $imgFile  //图片文件.
	* @param $imgType  //图片类型
	*
	* return (resource) image //图像资源
	*/
	private function createImg($imgFile,$imgType) {
		switch ((int)$imgType) {
			case 2:
				return imagecreatefromjpeg($imgFile);
			
			case 3:
				return imagecreatefrompng($imgFile);

			case 15:
				return imagecreatefromwbmp($imgFile);
		}
	}
}
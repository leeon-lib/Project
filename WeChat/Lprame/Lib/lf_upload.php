<?php

include_once '../load.php';

/**
 *
 * 文件处理类
 *
 * date : 		2015.05.16
 * author :		Liyn
 */
class lf_upload extends lf_controller
{
	private $path;			//保存路径目录
	private $fileType;		//上传文件类型
	public $error = NULL;	//错误描述

	public function __construct($path = './upload' , $fileType = array('png','jpg','gif'))
	{
		$this->path = $path;
		$this->fileType = $fileType;
	}
	
	/*
	 * 文件上传处理
	 *
	 * return boolean;
	 */
	public function upload()
	{
		// 重组上传文件的数组
		$arr = $this->resetArray();
		// 数组内容筛选
		foreach ($arr as $v) {
			// 如果有错误，则不执行
			if (!$this->filter($v)){
				return false;
			}
		}
		// 循环上传
		foreach ($arr as $v) {
			$this->move($v);
		}
		return true;
	}
	
	/*
	 * 移动文件
	 */
	private function move($arr)
	{
		$tmp = $arr['tmp_name'];
		$type = strrchr($arr['name'],'.');
		is_dir($this->path) || mkdir($this->path,0777,true);
		$this->path = rtrim($this->path,'/');
		// 组合新路径
		$newPath = $this->path . '/' . time() . mt_rand(0,999) . $type;
		// 移动
		move_uploaded_file($tmp, $newPath);
	}

	/*
	 * 重组上传文件
	 */
	private function resetArray()
	{
		//如果没有上传文件，则不执行
		if (empty($_FILES)){
			return false;
		}
		
		$arr = array();
		//循环文件数组
		foreach ($_FILES as $value){
			//如果是多文件上传
			if (is_array($value["name"])){
				//循环最底层数组，以循环到的键名选择上层数组对应值，压入数组
				foreach ($value["name"] as $k=>$v){
					$arr[] = array(
						'name'=>$value['name'][$k],
						'type'=>$value['type'][$k],
						'tmp_name'=>$value['tmp_name'][$k],
						'error'=>$value['error'][$k],
						'size'=>$value['size'][$k],
					);
				}
			}else{ //单文件上传
				$arr[] = $value;
			}
		}
		return $arr;
	}

	/**
	 * 上传内容过滤
	 */
	private function filter($arr)
	{
		// 取得文件类型
		$type  = ltrim(strrchr($arr['name'],'.'),'.');
		//遍历数组的值，判断error类型
		switch (true) {
			// 判断文件类型
			case !in_array($type , $this->fileType):
				$errInfo = "文件类型错误，只允许上传";
				$errInfo .= implode($this->fileType,',');
				$errInfo .= "格式的文件！";
				$this->error = $errInfo;
				return false;

			// 判断文件是否合法
			case !is_uploaded_file($arr['tmp_name']):
				$this->error = "上传文件不合法！";
				return false;

			// 判断是否超过网站的配置大小
			case $arr['size'] > 10000000:
				$this->error = "文件大小超过网站配置限制！";
				return false;

			case $arr['error'] == 4:
				$this->error = "没有文件被上传";
				return false;

			case $arr['error'] == 3:
				$this->error = "文件只有部分被上传";
				return false;

			case $arr['error'] == 2:
				$this->error = "文件大小超过了表单限定值！";
				return false;

			case $arr['error'] == 1:
				$this->error = "文件大小超过了php配置的限定值！";
				return false;

			default:
				return true;
		}
	}
	
}

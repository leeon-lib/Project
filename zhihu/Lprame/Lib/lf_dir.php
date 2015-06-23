<?php

class lf_dir extends lf_controller
{

	/*
	 * 复制文件到指定目录
	 */
	public function filesCopy($dir,$file)
	{
		//如果传参dir不是路径，则不执行
		if (!is_dir($dir)){
			return false;
		}
		//如果传参file不存在，则创建file
		is_dir($file) || mkdir($file,0777,true);
		//获取dir全局内容
		$arr = glob($dir.'/*');
		//循环dir全局内容
		foreach ($arr as $v){
			//获取每个内容的名称
			$fileName = basename($v);
			//如果dir下的内容仍是一个文件夹
			if (is_dir($v)){
				//则在file中创建该文件夹
				mkdir("$file/$fileName");
				//递归dir下的文件夹
				filesCopy($v, "$file/$fileName");
			}else{
				copy($v, "$file/$fileName");
			}	
		}
	}

	/*
	 * 递归删除目录文件
	 */
	public function filesDelete()
	{
		
	}
	
}
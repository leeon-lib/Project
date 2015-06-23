<?php

/**
* 
* 加载类，并提供实例化
*
*/
class lf_load
{


	/**
	* 加载lib类库
	*
	*/
	public static function include_lib($fileName)
	{
		$path = LIB_PATH . DIRECTORY_SEPARATOR . $fileName . '.php';
		if (!is_file($path)){
			die("lib file : {$path} is not exists!");
		}
		include_once $path;
	}

	/**
	* 加载数据库
	* 返回数据库数组
	*/
	public static function include_db($fileName){
		$path = DB_PATH . DIRECTORY_SEPARATOR . $fileName . '_db.php';
		if (!is_file($path)){
			die("db file : {$path} is not exists!");
		}
		return include_once $path;
	}


}



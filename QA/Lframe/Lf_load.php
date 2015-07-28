<?php

/**
* 
* 加载类，并提供实例化
*
*/
class Lf_load
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
	public static function include_db($fileName)
	{
		$path = DB_LIB_PATH . $fileName . '.php';
//		echo $path;die;
		if (!is_file($path)){
			die("db file : {$path} is not exists!");
		}
		return include_once $path;
	}

	/**
	* 加载lib类库并实例化对象
	*
	*/
	public static function lib($fileName)
	{
		$lib_instance = array();

		if (isset($lib_instance[$fileName])){
			return $lib_instance[$fileName];
		}

		self::include_lib($fileName);
		
		$lib_instance[$fileName] = new $fileName;
		return $lib_instance[$fileName];
	}
	
	/**
	* 加载Db_lib类库并实例化对象
	*
	*/
	public static function db_lib($fileName)
	{
		$lib_instance = array();

		if (isset($lib_instance[$fileName])){
			return $lib_instance[$fileName];
		}

		self::include_db($fileName);
		
		$lib_instance[$fileName] = new $fileName;
		return $lib_instance[$fileName];
	}
}



<?php

/**
 * 系统配置函数
 */
function C($var=NULL,$value=NULL)
{
	static $config = array();
	
	//第一参数以数组传入，则与配置数组合并
	if (is_array($var)){
		$config = array_merge($config,$var);
	}
	
	//如果第一参数以字符串传入
	if (is_string($var)){
		//且第二参数不为空
		if (!empty($value)){
			// 如果在配置项中能找到第一参数，则以第二项值覆盖配置项
			if (isset($config[$var])){
				$config[$var] = $value;
			}else{
				return false;
			}
		}else{	//如果第二参数为空，并且配置项中存在第一参数，则返出对应的值，如果不存在第一参数，则返出错误
			return isset($config[$var]) ? $config[$var] : false;
		}
	}
	
	//如果没有传值，则返出配置项数组
	if (func_num_args() == 0){
		return $config;
	}
}

/**
 * 
 */
function M()
{
	$obj = new Model();
	return $obj;
}
/**
 * 数据写入数据库
 */
 function dataToFile($path,$data)
 {
 	$phpCode = var_export($data,true);
	file_put_contents($path, "<?php return {$phpCode} ?>");
 }
 
 /**
  * 打印用户自定义常量
  */
function printConst()
{
	$const = get_defined_constants(TRUE);
	print_r($const['user']);
}

function halt($msg){
	header('Content-type:text/html;charset=utf-8');
	die($msg);
}

function nocache($params, $content, &$smarty) {
	return $content;
}
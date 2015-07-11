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
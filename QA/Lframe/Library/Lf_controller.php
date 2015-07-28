<?php

/*
 * 控制器
 * 
 */

class Lf_controller extends SmartyView {

// 	private $_tpl_vars = array();
    /*
     * * 模板引擎
     */
//	protected function view($fileName)
//	{
//		// 组合路径
//		$path = APP_PATH . '/View/' . $fileName . '.tpl.html';
//		if (!is_file($path)) {
//			die("模版：{$path} 不存在！");
//		}
//		include_once $path;
//	}

    /*
     * * 模版变量引入
     */
//	protected function assign($var,$value)
//	{
//		if (is_array($var)){
//			foreach ($var as $k => $v) {
//				$this->_tpl_vars[$k] = $v; 
//			}
//		}else{
//			if ($var != ''){
//				$this->_tpl_vars[$var] = $value;
//			}
//		}
////		$var = $value;
//	}


    /*
     * * 成功提示
     */
    protected function message($msg, $url) {
        header('Content-type:text/html;charset=utf-8');
        $str = <<<str
		<script type="text/javascript">
		alert('$msg');
		window.location.href = "$url";
		</script>
str;
        echo $str;
        die();
    }

    /**
     * 成功
     */
    protected function success($msg, $url) {
        header('Content-type:text/html;charset=utf-8');
        $str = <<<str
<script type="text/javascript">
alert('{$msg}');
location.href="{$url}";
</script>
str;
        echo $str;
        die;
    }

    /**
     * 错误
     */
    protected function error($msg) {
        header('Content-type:text/html;charset=utf-8');
        $str = <<<str
<script type="text/javascript">
alert('{$msg}');
window.history.back();
</script>
str;
        echo $str;
        die;
    }

}

<?php
header('Content-type:text/html;charset=utf-8');
class Message{
	
	public $data;
	
	function __construct($path){
		
		$this->data = include($path);
	}
	
	/**
	 * 获取数据库内容
	 * 
	 */
	private function getInfo(){
		$info = [];
		foreach($this->data as $v){
			$info[] = $v; 
		}
		return $info;
	}
	
	/**
	 * 主页
	 * 
	 */
	public function index(){
//		设置时区，取得当前时分
		date_default_timezone_set('PRC');
		$time = date('H:i');
		
		//取得数据库信息，用于前台页面输出
		$info = $this->conversionTime();
		$info = array_reverse($info);
//		print_r($info);

		
		if($_GET){
			$this->del();
		}
		
		//如果有form表单，就调用发布信息方法
		foreach($_POST as $v){
			if($v != ""){
				$this->publish();
				break;
			}
		}
		
		//引入页面模版
		require 'view/index.tpl.html';
	}
	
	/**
	 * 发布信息
	 * 
	 */
	 private function publish(){
	 	//获取post表单数据
		$arr = $_POST;
		//获取发布信息的日期与时间
		$arr["time"] = time();
		$arr["date"] = date('Y-m-d');
		//将表单数据与时间信息存入数据库
		$this->data[] = $arr;
		$phpCode = var_export($this->data,true);
		file_put_contents('./data.php', "<?php return $phpCode ?>");
		$this->msg("发布成功", './index.php');
	 }
	 
	 /**
	  * 信息删除
	  * 
	  */	
	  function del(){
	  	$id = (int)$_GET["id"];
		unset($this->data[$id]);
		$phpCode = var_export($this->data,true);
		file_put_contents('./data.php', "<?php return $phpCode ?>");
		$this->msg('删除成功', './index.php');
	  }

	 /**
	 * 信息的时间处理
	 *
	 */
	 private function conversionTime(){
	 	$info = $this->data;
	 	$nowTime = time();

	 	foreach ($info as $key => $value) {
	 		// 获取信息发布的时间与当前时间的差
	 		$time = $value["time"];
	 		$diff = $nowTime - $time;
	 		// 以差值计算距离当前时间的"天、小时、分",并替换数组中的time
	 		if ($diff<=10){
	 			$info[$key]["time"] = "刚刚";
	 		}elseif (($diff<=3600)){
	 			$info[$key]["time"] = ceil($diff/60) . "分钟前";
	 		}elseif (($diff<3600*24)){
	 			$info[$key]["time"] = ceil($diff/3600) . "小时前";
	 		}elseif (($diff>=3600*24) && ($diff<3600*48)){
	 			$info[$key]["time"] = "昨天";
	 		}elseif ($diff>=3600*48){
	 			$info[$key]["time"] = ceil($diff/(3600*24)) . "天前";
	 		}
	 	}
	 	return $info;
	 }
	 
function msg($msg,$url){
	$str =<<<str
<script type='text/javascript'>
	alert("$msg"); 
	location.href='$url';
</script>
str;
echo $str;
	die;
}
}


$obj_message = new Message('./data.php');
$obj_message->index();


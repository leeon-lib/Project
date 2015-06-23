<?php

/*
 * MySQL类
 *
 */

class mysql_class
{
	
	private $link;

	//初始化数据库信息并连接
	function __construct()
	{
		// 连接
		$this->link = $this->connect();
		// 设置字符集
		$this->setCharset('UTF8');
		// 选库
		$this->setDbName('wenda');
	}

	//连接
	private function connect()
	{
		$con = mysql_connect('127.0.0.1' , 'root' , 'root');
		if(!$con){
			die('数据库连接失败:'.mysql_error());
		}
		return $con;
	}

	//选库
	public function setDbName($dbname)
	{
		$db = mysql_select_db($dbname,$this->link);
		if(!$db){
			die('该库不存在！'.mysql_error());
		}
	}

	//设置字符集
	public function setCharset($charset)
	{
		if (!in_array($charset, array('UTF8','GBK','GB2312'))){
			die($charset . '该字符集不可用！');
		}
		$sql = "SET NAMES $charset";
		$this->query($sql);
	}

	//发送SQL语句
	private function query($sql)
	{
		$res = mysql_query($sql,$this->link);
		if (!$res) {
			echo '未能查询出结果，请检查SQL语句！<br>';
			echo 'SQL语句为：' . $sql;
			die;
		}
		return $res;
	}

	//取出多行结果集
	public function getAll($sql)
	{
		$res = $this->query($sql);

		$list = array();
		while ($row = mysql_fetch_assoc($res)) {
			$list[] = $row;
		}
		return $list;
	}
	
	public function test()
	{
		echo 1;
	}

}
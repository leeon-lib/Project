<?php

/*
 * MySQL类
 *
 */

class mysql
{
	private $host;
	private $user;
	private $password;
	private $db;
	private $tables;
	private $charset;
	private $conn;


	//初始化数据库信息并连接
	function __construct()
	{
		require 'config.php';
		$this->host = $DBCONF['hostname'];
		$this->user = $DBCONF['user'];
		$this->password = $DBCONF['password'];
		$this->conn = $this->connect();
		$this->db = $this->setDbName($DBCONF['dbname']);
		$this->charset = $this->setCharset($DBCONF['charset']);
	}

	//连接
	private function connect()
	{
		$h = $this->host;
		$u = $this->user;
		$p = $this->password;

		$con = mysql_connect($h,$u,$p);
		if(!$con){
			die('数据库连接失败:'.mysql_error());
		}
		return $con;
	}

	//选库
	public function setDbName($dbname)
	{
		$db = mysql_select_db($dbname,$this->conn);
		if(!$db){
			die('选库失败！'.mysql_error());
		}
		return $db;
	}

	//设置字符集
	public function setCharset($charset)
	{
		$sql = "SET NAMES $charset";
		$this->query($sql);
	}

	//发送SQL语句
	private function query($sql)
	{
		return mysql_query($sql,$this->conn);
	}

	//取出多行结果集
	public function getAll($sql)
	{
		$rs = $this->query($sql);
		if(!$rs){
			return false;
		}

		$list = array();
		while($res = mysql_fetch_assoc($rs)){
			$list[] = $res;
		}
		return $list;
	}

}

/**/
$obj = new mysql();
$sql = "select * from test where 1";
$list = $obj->getAll($sql);

var_dump($list);
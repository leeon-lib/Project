<?php

/**
 * 朋友圈
 */
class friendsCircle extends lf_controller
{
	private $db;
	
	public function __construct()
	{
		$this->db = lf_load::include_db('friendsInfo');
	}
	public function index()
	{
		// 反转数组，前台按时间逆序显示
		$arr = array_reverse($this->db);
		$this->assign('info', $arr);
		$this->assign('time',date('H:i'));
		$this->view('friendsCircle');
	}
	
	public function test(){
		$arr = array();
		$arr['usermail'] = $_SESSION['usermail'];
		$arr['TextContent'] = $_POST['TextContent'];
		$arr['date'] = date('Y-m-d H:i:s');
		$this->db[] = $arr;
		dataToFile(DB_PATH . '/friendsInfo_db.php', $this->db);
	}
}

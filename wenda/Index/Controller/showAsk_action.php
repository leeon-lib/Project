<?php

/**
* 问题页
*/
class showAsk_action extends Common_action
{
	/**
     * 问题页
     */
	public function index()
	{
		// 公共右侧信息处理
		$this->getRightInfo();

		$args = array();
		// BUG-1，如果没有asid则会报错
		// 显示点击问题后的问题详情
		$asid = (int)$_GET['asid'];
		$askInfo = M()->query("SELECT a.cid,a.asid,u.uid,u.username,a.content,a.solve,a.time,a.reward,a.cid FROM ask as a join user as u on a.uid=u.uid WHERE a.asid= {$asid};");
		$args['ask'] = $this->queryFormat($askInfo);
		$args['ask']['time'] = date('Y-m-d H:i:s',$args['ask']['time']);
		// print_r($args);die;

		// 如果问题已解决，获取满意答案信息
		if ($args['ask']['solve'] == 1){
			$trueInfo = M()->query("SELECT a.content,u.username,u.accept,u.face FROM answer as a JOIN user as u ON a.uid=u.uid WHERE a.accept=1 AND asid={$asid};");
			$args['trueAnswer'] = $this->queryFormat($trueInfo);
		}
		// 问题的相应回答信息
		$answerInfo = M()->query("SELECT * FROM answer WHERE asid={$asid} AND accept=0 order by time desc limit 10;");
		// 如果有回答
		if ($answerInfo) {
			foreach ($answerInfo as $key => $value) {
				$answerInfo[$key]['time'] = date('Y-m-d H:i:s',$answerInfo[$key]['time']);
			}
			$args['answer'] = $answerInfo;
			$args['answerNum'] = count($answerInfo)+1;
		}else {
			$args['answerNum'] = 0;
		}
		// print_r($args);

		$this->assign('args',$args);
		$this->display();
	}

	/**
     * 回答问题
     */
    public function answerAsk()
    {
    	// 处理用户提交的信息
    	$content = $_POST['text'];
    	$time = time();
    	$uid = (int)$_SESSION['uid'];
    	$asid = (int)$_POST['qid'];
    	// print_r($info);
    	// 写入数据库回答表
    	$insertSql = "INSERT INTO answer (content,time,uid,asid) VALUES('{$content}',{$time},{$uid},{$asid});";
    	$id = M()->exec($insertSql);
    	// 修改问题表对应问题的回答数
    	$updateAsk = "UPDATE ask SET answer = answer+1 WHERE asid = {$asid};";
    	M()->exec($updateAsk);
    	// 修改用户表的回答问题数与经验值，回答一条加5点经验
    	$updateUsr = "UPDATE user SET answer = answer+1,exp = exp+5 WHERE uid = {$uid};";
    	M()->exec($updateUsr);
    	$this->message('回答成功', __APP__ . "?c=showAsk&asid={$asid}");
    }

    /**
     * 采纳答案
     */
    public function toAccept()
    {
    	// 问题id
    	$asid = (int)$_POST['asid'];
    	// 问题悬赏额
    	$point = (int)$_POST['point'];
    	// 答案id
    	$anid = (int)$_POST['anid'];
    	// 提问用户id
    	$uid = (int)$_POST['uid'];
    	// 更新问题表，答案表，用户表
    	M()->exec("UPDATE ask SET solve = 1 WHERE asid = {$asid};");
    	M()->exec{"UPDATE answer SET accept = 1 WHERE anid = {$anid};"};
    	M()->exec("UPDATE user SET accept = accept+1,point = point+{$point},exp = exp+20 WHERE uid = {$uid};");
    	echo 1;
    }
}
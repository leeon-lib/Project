<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Ask_action extends Common_action {

    public function index() {
        $this->getTopCate();
        $this->display();
    }
    
    
    /**
     * 发布问题
     */
    public function setAsk()
    {
        // 获得用户提交信息
        $info = array();
        $info['content'] = $_POST['content'];
        $info['time'] = time();
        $info['reward'] = (int)$_POST['reward'];
        $info['uid'] = (int)$_SESSION['uid'];
        $info['cid'] = (int)$_POST['cid'];

        // 组合sql语句
        $sql = "INSERT INTO ask (content,time,reward,uid,cid) VALUES('{$info['content']}' , {$info['time']} , {$info['reward']} , {$info['uid']} , {$info['cid']});";
        $asid = M()->exec($sql);
        // 更新用户表的提问数与经验值，提交一条问题增加5点经验
        M()->exec("UPDATE user SET ask = ask+1 , exp = exp+5 WHERE uid = {$info['uid']};");
        $this->message('提问成功' , __APP__ . "?c=showAsk&asid={$asid}");
    }
    
    /**
     * 获得子集分类
     */
    public function getSubCate() {
        $cid = (int) $_POST['id'];
        //获得子集分类
        $subData = M()->query("SELECT * FROM category WHERE pid={$cid}");
        //以json的形式返回给js
        echo json_encode($subData);
    }

}

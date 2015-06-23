<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class List_action extends Common_action {
    
    /**
     * 问题列表主页
     */
    public function index()
    {
        //头部问题库、公共右侧处理
        $this->getTopCate();
        $this->getRightInfo();

        // 子分类信息处理
        if (isset($_GET['pid'])) {
            // 验证pid
            $pid = (int)$_GET['pid'];
            $id['pid'] = $pid;
            $checkPid = M()->query("SELECT cid,title FROM category WHERE pid = {$pid};");
            if (empty($checkPid)){
                $this->message('错误的访问',__APP__ . '?c=list&pid=0');
            }else {
                $argv['subCate'] = M()->query("SELECT pid,cid,title FROM category WHERE pid = {$pid};");
                //分类导航链处理
                if (0 != $pid) {
                    $argv['cateLink'] = $this->getCateLink($pid);
                }
            }
        }elseif (isset($_GET['cid'])) {
            // 验证cid
            $cid = (int)$_GET['cid'];
            $id['cid'] = $cid;
            $checkCid = M()->query("SELECT cid,title FROM category WHERE cid = {$cid};");
            if (empty($checkCid)) {
                $this->message('错误的访问',__APP__ . '?c=list&pid=0');
            }else {
                $argv['subCate'] = M()->query("SELECT cid,title FROM category WHERE pid = {$cid};");
                //分类导航链处理
                $argv['cateLink'] = $this->getCateLink($cid);
            }
        }else {  // 如果都不存在，则显示主分类
            $id['pid'] = 0;
            $argv['subCate'] = M()->query("SELECT cid,title FROM category WHERE pid = 0;");
        }

        //如果是最底级，则停止下钻，停留在当前级别分类页
        if (empty($argv['subCate'])) {
            $resPid = M()->query("SELECT pid FROM category WHERE cid = {$cid};");
            $pid = $resPid[0]['pid'];
            $argv['subCate'] = M()->query("SELECT cid,title FROM category WHERE pid = {$pid};");
        }

        // 问题状态块处理
        $statusId = isset($_GET['s']) ? (int)$_GET['s'] : 0;
        if (!in_array($statusId, array(0,1,2,3))) {
            $statusId = 0;
        }

        $statusQuesInfo = $this->getQuestion($statusId,$id);
        // print_r($statusQuesInfo);
        if (!empty($statusQuesInfo)) {
            $argv['statusQuestion'] = $statusQuesInfo;
        }

        // print_r($argv);
        $this->assign('argv',$argv);
        $this->display();
    }

    /**
     * 获取不同状态的问题
     * statusId : 0－－待解决，1-－已解决，2－－高悬赏，3-－零回答
     * num     : 条数
     * return array
     */
    private function getQuestion($statusId,$idArr,$num=10)
    {
        if ($num <= 0) {
            return false;
        }

        $k = key($idArr); 
        $v = $idArr[$k];
        if ('pid' == $k) {      // 如果传参是pid，则查询出该级别分类的所有问题
            $arr = M()->query("SELECT cid FROM category WHERE pid = {$v};");
            $cidArr = array();
            foreach ($arr as $v) {
                foreach ($v as $val) {
                    $cidArr[] = $val;
                }
            }
            $cidStr = join(',',$cidArr);
            switch ($statusId) {
                case '0':
                    $info = M()->query("SELECT reward,content,cid,answer,time FROM ask WHERE solve=0 AND cid in ({$cidStr}) limit {$num};");
                    return $info;
                case '1':
                    $info = M()->query("SELECT reward,content,cid,answer,time FROM ask WHERE solve=1 AND cid in ({$cidStr}) limit {$num};");
                    return $info;
                case '2':
                    $info = M()->query("SELECT reward,content,cid,answer,time FROM ask WHERE solve=0 AND reward>10 AND cid in ({$cidStr}) limit {$num};");
                    return $info;
                default:
                    $info = M()->query("SELECT reward,content,cid,answer,time FROM ask WHERE answer=0  AND cid in ({$cidStr}) limit {$num};");
                    return $info;
            }
        }else {
            // 检测当前cid是否是最底级分类
            // 如果不是，则以pid=cid传参调用自身查询该级别分类的所有问题
            $temp = M()->query("SELECT cid FROM category WHERE pid={$v};");
            if (!empty($temp)) {
                $tempIdArr['pid'] = $v;
                // 在这儿调用自身，自身有返回值啊，为什么不将返回值再返回啊啊。。
                // 纠结了这么长时间排错，怪不得return没反应啊。。。
                return $this->getQuestion($statusId,$tempIdArr);
            }else {     // 如果是最底级分类，则找到该最底级分类的所有问题
                switch ($statusId) {
                    case '0':
                        $info = M()->query("SELECT reward,content,cid,answer,time FROM ask WHERE solve=0 AND cid={$v} limit {$num};");
                        return $info;
                    case '1':
                        $info = M()->query("SELECT reward,content,cid,answer,time FROM ask WHERE solve=1 AND cid={$v} limit {$num};");
                        return $info;
                    case '2':
                        $info = M()->query("SELECT reward,content,cid,answer,time FROM ask WHERE solve=0 AND reward>10 AND cid={$v} limit {$num};");
                        return $info;
                    default:
                        $info = M()->query("SELECT reward,content,cid,answer,time FROM ask WHERE answer=0  AND cid={$v} limit {$num};");
                        return $info;
                }
            }
            
        }
        
    }

}
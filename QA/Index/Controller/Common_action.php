<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Common_action extends Lf_controller
{
    /**
     * 
     * @param boolean $is_assign
     * @return array
     * 获取顶级分类
     * 传参：
     * true(默认)－－在模版中设置变量
     * false    －－返回顶级分类数组
     */
    protected function getTopCate($is_assign=true)
    {
        $topCate = M()->query("SELECT * FROM category WHERE pid=0");
        
        if (true == $is_assign) {
            $this->assign('topCate', $topCate);
        }else{
            return $topCate;
        }
    }

    /**
     * 公共右侧信息处理
     *
     */
    protected function getRightInfo()
    {
        $argsR = array();
        // 用户信息
        if (isset($_SESSION['uid'])){
            $userInfo = M()->query("SELECT username,point,exp,answer,accept,ask,face FROM user WHERE uid = {$_SESSION['uid']};");
            $argsR['user'] = $this->queryFormat($userInfo);
        }

        //今日回答最多
        $strTime = strtotime(date('Y-m-d'));
        //在零点之后，暂无回答时，此条SQL语句会无结果，造成数组为空，取值失败而返出错误
        // 前台已经判断数组是否为空的情况
        $todayMaxInfo = M()->query("SELECT u.username,u.answer,u.accept,u.face FROM answer as a join user as u on a.uid=u.uid where a.time >{$strTime} group by a.uid order by count(a.uid) desc limit 1");
        //如果当日有回答
        if (!empty($todayMaxInfo)){
            $argsR['today'] = $this->queryFormat($todayMaxInfo);
        }

        //历史回答最多
        $historyInfo = M()->query("SELECT u.username,u.answer,u.accept,u.face FROM answer as a join user as u on u.uid=a.uid group by a.uid order by count(a.uid) desc limit 1;");
        if (!empty($historyInfo)){
            $argsR['history'] = $this->queryFormat($historyInfo);
        }

        // 助人光荣榜
        $helpInfo = M()->query("select u.username,count(a.accept) as acceptMax from answer as a join user as u on a.uid = u.uid where a.accept > 0 group by a.uid order by acceptMax desc limit 3;");
        if (!empty($helpInfo)){
            $argsR['help'] = $this->queryFormat($helpInfo);
        }
        $this->assign('argsR',$argsR);
    }

    /**
     * 处理SQL的query方法返回的多维数组
     *
     * 返回处理后的一位数组
     */
    protected function queryFormat($arr)
    {
        $info = array();
        foreach ($arr as $v) {
            if (is_array($v)) {
                foreach ($v as $key => $value) {
                    $info[$key] = $value;
                }
            }
        }
        return $info;
    }

    /**
     * 递归获取自身的所有父级分类
     */
    protected function getCateLink($cid)
    {
        $allCate = M()->query("SELECT * FROM category;");
        static $temp = array();
        foreach ($allCate as $v) {
            if ($v['cid'] == $cid) {
                // print_r($v);die;
                $temp[] = $v;
                $this->getCateLink($v['pid']);
            }
        }
        return array_reverse($temp);
    }
}

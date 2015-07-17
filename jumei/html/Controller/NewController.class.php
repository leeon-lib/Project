<?php
//内容页控制器
class NewController extends CommonController{
    //动作方法
    public function index(){
    	$aid = Q('get.aid',0,'intval');

		//通过文章aid获得数据
		$data = M()->join('__article__ a JOIN __category__ c ON a.category_cid=c.cid JOIN __article_data__ ad ON a.aid=ad.article_aid')->where("aid={$aid}")->find();
		$data['total'] = K('Comment')->where("article_aid={$aid}")->count();
        // p($data);
		$this->assign('xycms',$data);

        // 获取文章标签
        $tagArr = K('ArcTag')->where("article_aid={$aid}")->getField('tag_tid',true);   
        // $tagArr = implode(',', $tagArr);
        $temp = array();
        $temp1 = array();
        // 将标签重组
        foreach ($tagArr as $v) {
            $temp[] = K('Tag')->where("tid={$v}")->getField('tagname',true);
        }
        foreach ($temp as $v) {
            $temp1[] = $v[0];
        }
        $temp1 = implode(',', $temp1);
        $this->assign('tagData',$temp1);

        // 上一篇下一篇显示的文章
        $pre = K('Article')->where("is_recycle=0 AND aid<{$data['aid']} AND category_cid={$data['cid']}")->order('aid DESC')->limit(1)->find();
        $this->assign('pre',$pre);
        // 下一篇
        $next = K('Article')->where("is_recycle=0 AND aid>{$data['aid']} AND category_cid={$data['cid']}")->order('aid ASC')->limit(1)->find();
        $this->assign('next',$next);

        // 相关文章
        $same = K('Article')->where("is_recycle=0 AND category_cid={$data['cid']} AND aid!={$data['aid']}")->limit(6)->all();
        $this->assign('same',$same);

        // 面包屑导航
        $catedata = K('Category')->all();
        // 获得父级分类
        $fatherCate = $this->getFather($catedata,$data['cid']);
        // 数组反转
        $fatherCate = array_reverse($fatherCate);
        $this->assign('fatherCate',$fatherCate);

        // 把文章的点击次数加1
        M('Article')->inc('click',"aid=$aid",1);

        //显示视图
        $this->dis('new');
    }



    // 评论
    public function comment(){
        $aid = Q('get.aid',0,'intval');
        if(IS_POST){
            if(!isset($_SESSION['uid']) ||!isset($_SESSION['uname'])){
                $this->error('您还没有登录不能发表评论');
            }
            $time = time();
            $data = array(
                'comcon'=>Q('post.comcon'),
                'addtime'=>$time,
                'user_uid'=>$_SESSION['uid'],
                'article_aid'=>$aid
            );
            K('Comment')->add($data);
            $this->success('发表评论成功',U('Index/Index/index'));
        }
    }



}
?>
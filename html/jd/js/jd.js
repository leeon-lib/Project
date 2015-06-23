$(function(){

	var kinds_lis = $('#main>ul>li');
	//分类导航的鼠标移入移出事件
	kinds_lis.mouseover(function(){
		$(this).find('a').css({'color':'#C81623'});
	});
	kinds_lis.mouseout(function(){
		$(this).find('a').css({'color':'#fff'});
	})

//	给侧边栏生活服务下的内容设置图标位置
	var lifeserv_lis = $('.lifeserver li');
	var lifeserv_top = 0;
	for(var i=0;i<lifeserv_lis.length;i++){
		lifeserv_top = i*(-25);
		lifeserv_lis.eq(i).find('i').css({'backgroundPosition':'0px '+lifeserv_top+'px'});
	}

	// 给侧边栏生活服务下的内容设置移入移出事件
	$('.lifeserver li').hover(function(){
		// 获取当前移入的li序号
		var m = $(this).index();
		// 因为icon图标的宽高是等值顺序排列的，故直接以当前li的序号可计算出其垂直方向的y值
		var y = m*(-25);
		// 将计算出的y值设置在该li下i元素的背景图定位属性上，－25px为红色图标
		$(this).find('i').css({'backgroundPosition':'-25px '+y+'px'});
	},function(){
		var m = $(this).index();
		var y = m*(-25);
		// 鼠标移出后恢复为灰图标，0px为灰色图标
		$(this).find('i').css({'backgroundPosition':'0px '+y+'px'});
	})
		
/***	猜你喜欢模块***/
//	点击切换内容
	var gy_c_turn = $('.guessyou .c_turn');
	var gy_uls = $('.guessyou .contbox ul');
	var gy_i = 1;
	gy_c_turn.click(function(){
		gy_uls.eq(gy_i).show().siblings('ul').hide();
//		alert(gy_i);
		gy_i++;
		if(gy_i==gy_uls.length){
			gy_i = 0;
		}
	})
//	动态线
	$('.guessyou .contbox').mouseover(function(){
		$('.guessyou .line i').css({'left':'-360px'});
		$('.guessyou .line i').animate({'left':'845px'},500);
	});

/***楼层控制***/
//	楼层tab栏切换
	$('.floors .tab li').hover(function(){
		$(this).addClass('thisli').siblings('li').removeClass('thisli');
		
		$(this).parents('.floors').find('.innerbox').eq($(this).index()).show().siblings('.innerbox').hide();
	});
//	左侧中部内容图标
	var floors = $('.floors');
	for(var i=0;i<floors.length;i++){
		var fl_tbs = floors.eq(i).find('i');
		var sidem_top = 0;
		for(var j=0;j<fl_tbs.length;j++){
			sidem_top = j*(-26);
			fl_tbs.eq(j).css({'backgroundPosition':'0px '+sidem_top+'px'});
		}
	}
})

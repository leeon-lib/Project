$(function(){
//	页面头部的下拉菜单
	$('.default-city').hover(function() {
		$('.header-city-list').slideDown('fast');
		$('.add-city-icons').addClass('cur');
	}, function() {
		$('.header-city-list').slideUp('fast');
		$('.add-city-icons').removeClass('cur');
	});
	$('.headerTopRight li.youxiala').hover(function() {
		$(this).addClass('cur');
		$(this).find('.hide').slideDown('fast');
	}, function() {
		$(this).find('.hide').slideUp('fast');
		$(this).removeClass('cur');
	});
	// 查看分类下面的tab切换
	$('ul.pop_list li').mouseenter(function() {
		var p = $(this).index();
		// 当前的li添加current样式，兄弟结点去掉该样式
		$(this).addClass('current').siblings('li').removeClass('current');
		// 让第q个pop_list_wrap显示，其他隐藏
		$('.pop_item').eq(p).css('display', 'block').siblings('.pop_item').css('display', 'none');
	});

//	页面头部的下拉菜单

// 购物车下拉
	$('.cart_link').hover(function() {
		$(this).addClass('cur-current');
		$('#cart_content').stop().show();
	}, function() {
		$(this).removeClass('cur-current');
		$('#cart_content').stop().hide();
	});

// 左侧二级菜单
	$('.menu-list li').hover(function() {
		$(this).children('.subc_con').css('display', 'block');
	}, function() {
		$(this).children('.subc_con').css('display', 'none');
	});
// 左侧二级菜单

// banner轮播图
	$('.banner').hover(function() {
		$(this).children('.banner_pre').css('display', 'block');
		$(this).children('.banner_next').css('display', 'block');
	}, function() {
		$(this).children('.banner_pre').css('display', 'none');
		$(this).children('.banner_next').css('display', 'none');
	});


	var c = 0;
	function run(){
		c++;
		c = (c==4)?0:c;
		// 让c号图片显示其他隐藏
		$('.banner ul li').eq(c).stop().fadeIn(500).siblings('li').stop().fadeOut(500);
		// 让c号li变红，其他变灰
		$('.banner .sc_index a').eq(c).css({'background':'#d11048'}).siblings('a').css({'background':'#B3B3B5'});
	}
	// 设置定时器
	timer = setInterval(run,3000);
	$('.banner').hover(function() {
		clearInterval(timer);
	}, function() {
		timer = setInterval(run,3000);
	});
	
	// 鼠标移入事件
	$('.banner .sc_index a').mouseenter(function() {
			// 获得移入的a的序号
			c = $(this).index();
			
		// 设置定时器，200毫秒之后执行
		timer2 = setTimeout(function(){
			// 让c号图片显示其他隐藏
			$('.banner ul li').eq(c).stop().fadeIn(500).siblings('li').stop().fadeOut(500);
			// 让c号li变红，其他变灰
			$('.banner .sc_index a').eq(c).css({'background':'#d11048'}).siblings('a').css({'background':'#B3B3B5'});
		},200)
	});

	// 点击左侧按钮
	$('.banner_pre').click(function() {
		c--;
		c = (c==-1)?3:c;
		$('.banner ul li').eq(c).stop().fadeIn(500).siblings('li').stop().fadeOut(500);
		$('.banner .sc_index a').eq(c).css({'background':'#d11048'}).siblings('a').css({'background':'#B3B3B5'});
	});
	// 点击右侧按钮
	$('.banner_next').click(function() {
		c++;
		c = (c==4)?0:c;
		$('.banner ul li').eq(c).stop().fadeIn(500).siblings('li').stop().fadeOut(500);
		$('.banner .sc_index a').eq(c).css({'background':'#d11048'}).siblings('a').css({'background':'#B3B3B5'});
	});
// banner轮播图

// banner图下面的品牌管理
	var a = 0;
	$('.brand_wall_switchable .sc_index a').mouseover(function() {
		// 获得当前移入的标题序号
		var a = $(this).index();
		// 让a号的sc_container显示，其他隐藏
		$('.sc_container').eq(a).stop().show().siblings('.sc_container').stop().hide();
		// 计算下面箭头的left值
		var left = 122*a;
		$(this).parent('.sc_index').children('.arrow_line').animate({left: left+'px'}, 200);

	});
	// 右下角的切换按钮
	$('.sc_change a.sc_prev').click(function() {
		a--;
		a = (a==-1)?5:a;
		// 让a号的sc_container显示，其他隐藏
		$('.sc_container').eq(a).stop().show().siblings('.sc_container').stop().hide();
		// 计算下面箭头的left值
		var left = 122*a;
		$('.brand_wall_switchable .sc_index').children('.arrow_line').animate({left: left+'px'}, 200);
	});
	$('.sc_change a.sc_next').click(function() {
		a++;
		a = (a==6)?0:a;
		// 让a号的sc_container显示，其他隐藏
		$('.sc_container').eq(a).stop().show().siblings('.sc_container').stop().hide();
		// 计算下面箭头的left值
		var left = 122*a;
		$('.brand_wall_switchable .sc_index').children('.arrow_line').animate({left: left+'px'}, 200);
	});
// banner图下面的品牌管理

// banner图右侧的广告位
	$('.tuijianAd a img').mouseenter(function() {
		th = $(this);
		// 鼠标滑过先让图片向左移动4个像素
		th.stop().animate({'left': '-4px'}, 200);
		// 设置定时器，当向左移动的动作完成以后执行定时器里面的动作
		setTimeout(function(){
			// 让图片移到原来位置
			th.stop().animate({'left': '0px'}, 200);
		},200)
	});

// banner图右侧的广告位

})

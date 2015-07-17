$(function(){
//	列表页上面的筛选部分
	$('.zhankai').click(function() {
		$(this).css('display', 'none');
		$(this).parent('.share').children('.name').css('display', 'none');
		$(this).parent('.share').children('.shouqi').css('display', 'block');
		$(this).parent('.share').children('.hide_names').css('display', 'block');
	});
	$('.shouqi').click(function() {
		$(this).css('display', 'none');
		$(this).parent('.share').children('.name').css('display', 'block');
		$(this).parent('.share').children('.zhankai').css('display', 'block');
		$(this).parent('.share').children('.hide_names').css('display', 'none');
	});

	$('.func_zhankai').click(function() {
		$(this).css('display', 'none');
		$(this).parent('.share').children('.name').css('height', 'auto');
		$(this).parent('.share').children('.func_shouqi').css('display', 'block');
	});
	$('.func_shouqi').click(function() {
		$(this).css('display', 'none');
		$(this).parent('.share').children('.name').css({'height': '70px','display': 'block'});
		$(this).parent('.share').children('.func_zhankai').css('display', 'block');
	});

	// 品牌选择框
	$('.hide_names .hide_names_tit .multi_letters a').click(function() {
		$(this).addClass('selected').siblings('a').removeClass('selected');
	});
	
//	列表页上面的筛选部分
	
	// 列表页hover效果
	$('.pro').hover(function() {
		$(this).children('.search_list_tags').css('display', 'block');
	}, function() {
		$(this).children('.search_list_tags').css('display', 'none');
	});
	// 列表页hover效果

	// 内容页小图切换
	var c=0;
	$('.smlpic .pre').click(function() {
		c++;
		// 第一次点击以后右侧的按钮就可以点击了
		$(this).parents('.smlpic').find('.next ').removeClass('disabled');

		// 如果c的值等于li长度减4按钮就不让点击了，不会一直往左走
		var len = $('.pic_ul ul li').length;
		if(c>=(len-4)){
			$(this).addClass('disabled');
			$(this).parents('.pic_ul').find('.next ').removeClass('disabled');
			c=len-4;
		}
		// 计算left值
		var left = -83*c;
		$('.pic_ul ul').animate({'left':left+'px'}, 400);
	});

	$('.smlpic .next').click(function() {
		c--;
		// 第一次点击以后左侧的按钮就可以点击了
		$(this).parents('.smlpic').find('.pre').removeClass('disabled');

		// 如果c的值等于0按钮就不让点击了，不会一直往右走
		var len = $('.pic_ul ul li').length;
		if(c<=0){
			$(this).addClass('disabled');
			$(this).parents('.pic_ul').find('.pre ').removeClass('disabled');
			c=0;
		}
		// 计算left值
		var left = -83*c;
		$('.pic_ul ul').animate({'left':left+'px'}, 400);
	});

	$('.cs_list li').mouseenter(function() {
		$(this).addClass('active').siblings('li').removeClass('active');
	});
	// 内容页小图切换

	// 鼠标移动到小图上面，切换上面的大图
	$('.pic_ul ul li').mouseenter(function() {
		// var src = $(this).children('img').attr('src');
		var i = $(this).index();
		// alert(i);
		$('.big_pic_list li').eq(i).show().siblings('li').hide();
		$('.biggest_pic ul li').eq(i).show().siblings('li').hide();
	});

	// 内容页放大镜
	$('#cover').mousemove(function(event) {
		$('.biggest_pic').show();
		$('.fangkuai').show();
		var L = event.pageX;
		var l = $(this).offset().left;
		var left = L - l - 50;

        var T = event.pageY;
		var t = $(this).offset().top;
		var top = T - t - 50;
		// alert(T);alert(L);
		left = left < 0 ? 0 : left;
		left = left > 175 ? 175 : left;
		top = top < 0 ? 0 : top;
		top = top > 175 ? 175 : top;

		$('.fangkuai').css({left : left,top : top});

		var imgLeft = -left * 2;
		var imgTop = -top * 2;
		imgLeft = imgLeft < -400 ? -400 : imgLeft;
		imgTop = imgTop < -400 ? -400 : imgTop;

		$('.biggest_pic ul').css({left : imgLeft, top : imgTop});
	});
	$('#cover').mouseout(function(event) {
		$('.biggest_pic').hide();
		$('.fangkuai').hide();
	});
	
})



/*******************	/  
点击按钮提交内容   
/*******************/
$('.btn').click(function(){
	var content = $('.content').text();
	if (content == ''){
		alert('什么都没写啊');
	}else{
		$('.btn').hide();
		$.post(APP_URL + "?c=friendsCircle&a=test",{TextContent:content},function(d){
//			$('.content').text('');
			var str  = '<li class="items">';
				str += 		'<div class="photo">';
				str += 			'<img src=" ' +PUBLIC+ '/images/image.png" alt="" />';
				str += 		'</div>';
				str += 		'<div class="infobox">';
				str += 			'<div class="nickname"></div>';
				str += 			'<div class="text">' +content+'</div>';
				str += 			'<div class="btmbox">';
				str += 				'<span class="infotime"></span>';
				str += 				'<a href="javascript:void(0)" class="edit">编辑</a>';
				str += 				'<a href="javascript:del();" class="del">删除</a>';
				str += 			'</div>';
				str += 		'</div>';
				str += 	'</li>';
			
			$('.content').animate({'width':'466px','height':'60px','top':'146px','left':'36px'},1000);
			
			setTimeout(function(){
				$('.cont>ul').prepend(str);
				$('.content').hide();
//				$('.box').hide();
				$('.addBtn').show();
			},1000);
		});
	}
})

$('.addBtn').click(function(){
	$(this).hide();
	$('.box').show();
	$('.content').animate({'width':'520px','height':'60px','padding':'10px'},800);
//	setTimeout(function(){
//		$('.btn').show();
//	},900);
})

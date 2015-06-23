var ajax_bool = null;
// submit提交按钮的开关
var mail_bool = false;
var psw_bool = false;
var check_bool = false ;
	
function ajaxCheck(inputName,inputText){
	$.ajax({
		url : APP_URL + "?c=login&a=ajax_check",
		type : "post",
		async: false,
		data : {name:inputName,cont:inputText},
		success: function(res){
			getAjax(res);
		}
	})
}

function getAjax(res){
	if (res == '0'){
		ajax_bool = false;
	}else{
		ajax_bool = true;
	}
}

$('.ck').blur(function(){
	var name = $(this).attr('name');
	var cont = $(this).val();
	
	switch(name){
			
		case 'mail':
			if (cont == ''){
				$('.s1').css({'height':'0px','display':'block'}).animate({'height':'20px'},300);
				$('.exp_mail').text('邮箱未填写');
			}else{
				var mailReg = /^([\w-]+)@([0-9a-zA-Z]{1,10})\.(com|cn|net|org|com\.cn)$/;
				if (!mailReg.test(cont)){
					$('.s1').css({'height':'0px','display':'block'}).animate({'height':'20px'},300);
					$('.exp_mail').text('邮箱格式不正确');
				}else{
					$('.s1').animate({'height':'0px'},300);
					setTimeout(function(){
						$('.s1').css({'display':'none'});
					},280);
					$('.exp_mail').text();
					mail_bool = true;
				}
			}
			break;
			
		case 'psw':
			if (cont == ''){
				$('.s2').css({'height':'0px','display':'block'}).animate({'height':'20px'},300);
				$('.exp_psw').text('密码未填写');
			}else{
				$('.s2').animate({'height':'0px'},300);
					setTimeout(function(){
						$('.s2').css({'display':'none'});
					},280);
				$('.exp_psw').text();
				psw_bool = true;
			}
			break;
			
		case 'checkcode':
			if (cont == ''){
				$('.s3').css({'height':'0px','display':'block'}).animate({'height':'20px'},300);
				$('.exp_cc').text('验证码未填写');
			}else{
				ajaxCheck(name,cont);
				if (ajax_bool == false){
					$('.s3').css({'height':'0px','display':'block'}).animate({'height':'20px'},300);
					$('.exp_cc').text('验证码不匹配');
				}else{
					$('.s3').animate({'height':'0px'},300);
					setTimeout(function(){
						$('.s3').css({'display':'none'});
					},280);
					$('.exp_cc').text();
					check_bool = true;
				}
			}
			break;
	}
	
	
	
	

})


$('input[name=checkcode]').bind('propertychange input', function () {  
    
    var bian = $(this).attr('name');
	var zhi = $(this).val();

	ajaxCheck(bian,zhi);
	if (ajax_bool == true){
		$('.s3').animate({'height':'0px'},300);
		setTimeout(function(){
			$('.s3').css({'display':'none'});
		},280);
		$('.exp_cc').text();
		check_bool = true;
	}
			

	
	// 提交按钮的开启事件
	if (mail_bool==true && psw_bool==true && check_bool==true){
		$('.btn').css({'backgroundColor':'#3EA2E1'}).attr("disabled",false);
		$('.btn').hover(function(){
			$(this).css({'backgroundColor':'#4B88AF'});
		},function(){
			$(this).css({'backgroundColor':'#3EA2E1'});
		});
	}
         
});


// 验证账号密码是否正确
//$('form').submit(function(){
//	var usermail = $('input[name=mail]').val();
//	var passw = $('input[name=psw]').val();
//	
//	return false;
//})
		


var ajax_bool = null;
// submit提交按钮的开关
var usr_bool = false;
var mail_bool = false;
var psw_bool = false;
var psw_c_bool = false;
var check_bool = false;


// Ajax验证方法
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
// Ajax验证开关
function getAjax(res){
	if (res == '0'){
		ajax_bool = false;
	}else{
		ajax_bool = true;
	}
}

// form表单中input的失去焦点事件
$('.ck').blur(function(){
	// 获得当前input的标签及内容，进行条件判断
	var name = $(this).attr('name');
	var cont = $(this).val();
	
	switch(name){
		case 'username':
			if (cont == ''){
				$('.s1').css({'height':'0px','display':'block'}).animate({'height':'20px'},300);
				$('.exp_usr').text('用户名未填写');
			}else{
				$('.s1').animate({'height':'0px'},300);
				setTimeout(function(){
					$('.s1').css({'display':'none'});
				},280);
				$('.exp_usr').text();
				usr_bool = true;
			}
			break;
			
		case 'usermail':
			if (cont == ''){
				$('.s2').css({'height':'0px','display':'block'}).animate({'height':'20px'},300);
				$('.exp_mail').text('邮箱未填写');
			}else{
				var mailReg = /^([\w-]+)@([0-9a-zA-Z]{1,10})\.(com|cn|net|org|com\.cn)$/;
				if (!mailReg.test(cont)){
					$('.s2').css({'height':'0px','display':'block'}).animate({'height':'20px'},300);
					$('.exp_mail').text('邮箱格式不正确');
				}else{
					ajaxCheck(name,cont);
					if (ajax_bool == true){
						$('.s2').css({'height':'0px','display':'block'}).animate({'height':'20px'},300);
						$('.exp_mail').text('该邮箱已被注册');
					}else{
						$('.s2').animate({'height':'0px'},300);
						setTimeout(function(){
							$('.s2').css({'display':'none'});
						},280);
						$('.exp_mail').text();
						mail_bool = true;
					}
				}
			}
			break;
			
		case 'password':
			if (cont == ''){
				$('.s3').css({'height':'0px','display':'block'}).animate({'height':'20px'},300);
				$('.exp_psw').text('密码未填写');
			}else{
				var pswReg = /^(\d+)|([a-zA-Z]+)$/;
				if (pswReg.test(cont)){
					$('.s3').css({'height':'0px','display':'block'}).animate({'height':'20px'},300);
					$('.exp_psw').text('密码过于简单,建议字母+数字的组合');
				}else{
					$('.s3').animate({'height':'0px'},300);
					setTimeout(function(){
						$('.s3').css({'display':'none'});
					},280);
					$('.exp_psw').text();
					psw_bool = true;
				}
				
			}
			break;

		case 'password_check':
			if (cont == ''){
				$('.s4').css({'height':'0px','display':'block'}).animate({'height':'20px'},300);
				$('.exp_psw_c').text('请输入确认密码');
			}else{
				var psw = $('input[name=password]').val();
				var psw_c = $('input[name=password_check]').val();
				if (psw_c != psw){
					$('.s4').css({'height':'0px','display':'block'}).animate({'height':'20px'},300);
					$('.exp_psw_c').text('确认密码与原密码不符');
				}else{
					setTimeout(function(){
						$('.s4').css({'display':'none'});
					},280);
					$('.exp_psw_c').text();
					psw_c_bool = true;
				}
			}
			break;
			
		case 'checkcode':
			if (cont == ''){
				$('.s5').css({'height':'0px','display':'block'}).animate({'height':'20px'},300);
				$('.exp_cc').text('验证码未填写');
			}else{
				ajaxCheck(name,cont);
				if (ajax_bool == false){
					$('.s5').css({'height':'0px','display':'block'}).animate({'height':'20px'},300);
					$('.exp_cc').text('验证码不匹配');
				}else{
					$('.s5').animate({'height':'0px'},300);
					setTimeout(function(){
						$('.s5').css({'display':'none'});
					},280);
					$('.exp_cc').text();
					check_bool = true;
				}
			}
			break;
	}
	
	// 所有input内容已通过验证后，开启submit提交按钮
	if (usr_bool==true && mail_bool==true && psw_bool==true && check_bool==true){
		$('.btn').css({'backgroundColor':'#3EA2E1'}).attr("disabled",false);
		$('.btn').hover(function(){
			$(this).css({'backgroundColor':'#4B88AF'});
		},function(){
			$(this).css({'backgroundColor':'#3EA2E1'});
		});
	}

})

// 验证码输入框的完整值监听
$('input[name=checkcode]').bind('propertychange input', function () {  
    
    var bian = $(this).attr('name');
	var zhi = $(this).val();

	ajaxCheck(bian,zhi);
	if (ajax_bool == true){
		$('.s4').animate({'height':'0px'},300);
		setTimeout(function(){
			$('.s4').css({'display':'none'});
		},280);
		$('.exp_cc').text();
		check_bool = true;
	}
			

	
	// 提交按钮的开启事件
	if (usr_bool==true && mail_bool==true && psw_bool==true && check_bool==true){
		$('.btn').css({'backgroundColor':'#3EA2E1'}).attr("disabled",false);
		$('.btn').hover(function(){
			$(this).css({'backgroundColor':'#4B88AF'});
		},function(){
			$(this).css({'backgroundColor':'#3EA2E1'});
		});
	}
         
});


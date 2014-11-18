$(function () {
	
	//登录页背景随机
	var rand = Math.floor(Math.random() * 5) + 1;
/*
	$('body')
	.css('background','url(' + ThinkPHP['IMG'] + '/login_bg' + rand + '.jpg) no-repeat')
	.css('background-size', '100%');
*/
	
	//登录页的按钮
	$('#login input[type="submit"]').button();
	
	$('#login').validate({
		submitHandler : function (form) {
			$('#verify_register').attr('form-click', 'login');
			$('#verify_register').dialog('open');
		},
		rules : {
			username : {
				required : true,
				minlength : 2,
				maxlength : 50,
			},
			password : {
				required : true,
				minlength : 6,
				maxlength : 30,
			},
		},
		messages : {
			username : {
				required : '必填',
				minlength : $.format('需大于{0}位'),
				maxlength : $.format('需小于{0}位！'),
			},
			password : {
				required : '必填',
				minlength : $.format('需大于{0}位'),
				maxlength : $.format('需小于{0}位'),
			},
		},
	});
	
	//创建注册对话框
	$('#register').dialog({
		width : 430,
		height : 385,
		title : '注册新用户',
		modal : true,
		resizable : false,
		autoOpen : false,
		closeText : '关闭',
		buttons : [{
			text : '提交',
			click : function (e) {
				$(this).submit();
			}
		}],
	}).validate({
		submitHandler : function (form) {
			$('#register').dialog('widget').find('button').eq(1).button('disable');
			$('#verify_register').attr('form-click', 'register');
			$('#verify_register').dialog('open');
			/*

			*/
		},
		errorLabelContainer : 'ol.register_errors',
		wrapper : 'li',
		showErrors : function (errorMap, errorList) {
			var errors = this.numberOfInvalids();
			if (errors > 0) {
				$('#register').dialog('option', 'height', errors * 20 + 385);
			} else {
				$('#register').dialog('option', 'height', 385);
			}
			this.defaultShowErrors();
		},
		highlight : function (element, errorClass) {
			$(element).css('border', '1px solid red');
			$(element).parent().find('span').html('*').removeClass('succ');
		},
		unhighlight : function (element, errorClass) {
			$(element).css('border', '1px solid #ccc');
			$(element).parent().find('span').html('&nbsp;').addClass('succ');
		},
		rules : {
			username : {
				required : true,
				minlength : 2,
				maxlength : 20,
				inAt : true,
				remote : {
					url : ThinkPHP['MODULE'] + '/User/checkUserName',
					type : 'POST',
					beforeSend : function () {
						$('#username').next().html('&nbsp;').removeClass('succ').addClass('loading');
					},
					complete : function (jqXHR) {
						if (jqXHR.responseText == 'true') {
							$('#username').next().html('&nbsp;').removeClass('loading').addClass('succ');
						} else {
							$('#username').next().html('*').removeClass('succ').removeClass('loading');
						}
					}
				},
			},
			password : {
				required : true,
				minlength : 6,
				maxlength : 30,
			},
			repassword : {
				required : true,
				equalTo : '#password',
			},
			email : {
				required : true,
				email : true,
				remote : {
					url : ThinkPHP['MODULE'] + '/User/checkEmail',
					type : 'POST',
					beforeSend : function () {
						$('#email').next().html('&nbsp;').removeClass('succ').addClass('loading');
					},
					complete : function (jqXHR) {
						if (jqXHR.responseText == 'true') {
							$('#email').next().html('&nbsp;').removeClass('loading').addClass('succ');
						} else {
							$('#email').next().html('*').removeClass('succ').removeClass('loading');
						}
					}
				},
			}
		},
		messages : {
			username : {
				required : '帐号不得为空！',
				minlength : $.format('帐号不得小于{0}位！'),
				maxlength : $.format('帐号不得大于{0}位！'),
				inAt : '帐号不得包含@符号！',
				remote : '帐号被占用！',
			},
			password : {
				required : '密码不得为空！',
				minlength : $.format('密码不得小于{0}位！'),
				maxlength : $.format('密码不得大于{0}位！'),
			},
			repassword : {
				required : '密码确认不得为空！',
				equalTo : '密码和密码确认必须一致！',
			},
			email : {
				required : '邮箱不得为空！',
				email : '邮箱格式不正确！',
				remote : '邮箱被占用！',
			}
		},
	});
	
	//点击注册
	$('#reg_link').click(function () {
		$('#register').dialog('open');
	});
	
	//邮箱补全功能
	$('#email').autocomplete({
		delay : 0,
		autoFocus : true,
		source : function (request, response) {
			//获取用户输入的内容
			//alert(request.term);
			//绑定数据源的
			//response(['aa', 'aaaa', 'aaaaaa', 'bb']);
			
			var hosts = ['qq.com', '163.com', '263.com', 'sina.com.cn','gmail.com', 'hotmail.com'],
				term = request.term,		//获取用户输入的内容
				name = term,				//邮箱的用户名
				host = '',					//邮箱的域名
				ix = term.indexOf('@'),		//@的位置
				result = [];				//最终呈现的邮箱列表
				
				
			result.push(term);
			
			//当有@的时候，重新分别用户名和域名
			if (ix > -1) {
				name = term.slice(0, ix);
				host = term.slice(ix + 1);
			}
			
			if (name) {
				//如果用户已经输入@和后面的域名，
				//那么就找到相关的域名提示，比如bnbbs@1，就提示bnbbs@163.com
				//如果用户还没有输入@或后面的域名，
				//那么就把所有的域名都提示出来
				
				var findedHosts = (host ? $.grep(hosts, function (value, index) {
						return value.indexOf(host) > -1
					}) : hosts),
					findedResult = $.map(findedHosts, function (value, index) {
					return name + '@' + value;
				});
				
				result = result.concat(findedResult);
			}
			
			response(result);
		},	
	});
	
	
	//验证码对话框
	$('#verify_register').dialog({
		width : 290,
		height : 300,
		title : '请输入验证码',
		modal : true,
		resizable : false,
		autoOpen : false,
		closeText : '关闭',
		buttons : [{
			text : '完成',
			click : function (e) {
				$(this).submit();
			},
			style : 'right:85px',
		}],
		close : function (e) {
			if ($('#verify_register').attr('form-click') == 'register') {
				$('#register').dialog('widget').find('button').eq(1).button('enable');
			}
		},
	}).validate({
		submitHandler : function(form){
			if ($('#verify_register').attr('form-click') == 'register') {
				$('#register').ajaxSubmit({
					url: ThinkPHP['MODULE'] + '/User/register',
					type: 'POST',
					data: {
						verify: $('#verify').val(),
					},
					beforeSubmit: function(){
						$('#loading').dialog('open');
						$('#register').dialog('widget').find('button').eq(1).button('disable');
						$('#verify_register').dialog('widget').find('button').eq(1).button('disable');
					},
					success: function(responseText){
						if (responseText) {
							$('#register').dialog('widget').find('button').eq(1).button('enable');
							$('#verify_register').dialog('widget').find('button').eq(1).button('enable');
							$('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif) no-repeat 20px center').html('数据新增成功...');
							setTimeout(function(){
								if (verifyimg.indexOf('?') > 0) {
									$('.verifyimg').attr('src', verifyimg + '&random=' + Math.random());
								}
								else {
									$('.verifyimg').attr('src', verifyimg + '?random=' + Math.random());
								}
								$('#register').dialog('close');
								$('#verify_register').dialog('close');
								$('#loading').dialog('close');
								$('#register').resetForm();
								$('#verify_register').resetForm();
								$('span.star').html('*').removeClass('succ');
								$('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px center').html('数据交互中...');
							}, 1000);
							
						}
					}
				});
			} else if ($('#verify_register').attr('form-click') == 'login') {
				$('#login').ajaxSubmit({
					url : ThinkPHP['MODULE'] + '/User/login',
					type : 'POST',
					beforeSubmit : function () {
						$('#loading').dialog('open');
					},
					success : function (responseText) {
						if (responseText == -9) {
							$('#loading').dialog('option', 'width', 210).css('background', 'url(' + ThinkPHP['IMG'] + '/error.png) no-repeat 20px center').html('帐号或密码不正确...');
							setTimeout(function () {
								$('#loading').dialog('close');
								$('#loading').dialog('option', 'width', 180).css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px center').html('数据交互中...');
							}, 2000);
						} else {
							$('#loading').dialog('option', 'width', 240).css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif) no-repeat 20px center').html('登录成功，正在跳转中...');
							setTimeout(function () {
								location.href = ThinkPHP['INDEX'];
							}, 1000);
						}
					}
				});
			}
		},
		errorLabelContainer : 'ol.ver_error',
		wrapper : 'li',
		showErrors : function (errorMap, errorList) {
			var errors = this.numberOfInvalids();
			if (errors > 0) {
				$('#verify_register').dialog('option', 'height', errors * 20 + 300);
			} else {
				$('#verify_register').dialog('option', 'height', 300);
			}
			this.defaultShowErrors();
		},
		highlight : function (element, errorClass) {
			$(element).css('border', '1px solid red');
			$(element).parent().find('span').html('*').removeClass('succ');
		},
		unhighlight : function (element, errorClass) {
			$(element).css('border', '1px solid #ccc');
			$(element).parent().find('span').html('&nbsp;').addClass('succ');
		},
		rules : {
			verify : {
				required : true,
				remote : {
					url : ThinkPHP['MODULE'] + '/User/checkVerify',
					type : 'POST',
				}
			},
		},
		messages : {
			verify : {
				required : '验证码不得为空！',
				remote : '验证码不正确！',
			},
		},
	});
	
	//点击更换验证码
	var verifyimg = $('.verifyimg').attr('src');
	$('.changeimg').click(function () {
		if (verifyimg.indexOf('?') > 0) {
			$('.verifyimg').attr('src', verifyimg + '&random=' + Math.random());
		}
		else {
			$('.verifyimg').attr('src', verifyimg + '?random=' + Math.random());
		}
	});
	
	
	//自定义验证，不包含@
	$.validator.addMethod('inAt', function (value, element) {
		var text = /^[^@]+$/i;
		return this.optional(element) || (text.test(value));
	}, '存在@符号');
	
	
	//loading
	$('#loading').dialog({
		width : 180,
		height : 40,
		closeOnEscape : false,
		modal : true,
		resizable : false,
		draggable : false,
		autoOpen : false,
	}).parent().find('.ui-widget-header').hide();
	
	
	
	
	
	
	
	
	
	
});
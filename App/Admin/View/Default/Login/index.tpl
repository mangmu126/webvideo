<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>微博系统--登录</title>
<script type="text/javascript" src="__JS__/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__JS__/jquery.ui.js"></script>
<script type="text/javascript" src="__JS__/jquery.validate.js"></script>
<script type="text/javascript" src="__JS__/jquery.form.js"></script>
<script type="text/javascript" src="__JS__/login.js"></script>
<link rel="stylesheet" href="__CSS__/jquery.ui.css">
<link rel="stylesheet" href="__CSS__/login.css">
<script type="text/javascript">
var ThinkPHP = {
	'MODULE' : '__MODULE__',
	'IMG' : '__PUBLIC__/{:MODULE_NAME}/img',
	'INDEX' : '{:U("Index/index")}',
};
</script>
</head>
<body>



<div id="header"></div>

<div id="main">
	<form id="login">
		<div class="top">
			<span class="username">
				<input type="text" name="username" placeholder="帐号/邮箱">
			</span>
			<span class="password">
				<input type="password" name="password" placeholder="密码">
				<label class="auto" for="auto"><input type="checkbox" name="auto" id="auto">自动登录</label>
			</span>
			<input type="submit" name="submit" value="登录">
		</div>
		<div class="bottom">
		
			<a href="javascript:void(0)">忘记密码？</a>
		</div>
	</form>
</div>

<div id="footer"></div>
<p class="footer_text">暂不填写</p>


<form id="verify_register" form-click="">
	<ol class="ver_error"></ol>
	<p>
		<label for="verify">验证码：</label>
		<input type="text" name="verify" class="text" id="verify">
		<span class="star">*</span>
		<a href="javascript:void(0)" class="changeimg">换一换</a>
	</p>
	<p><img src="{:U('Admin/Login/verify')}?a=b" class="changeimg verifyimg"></p>
</form>

<div id="loading">数据交互中...</div>



</body>
</html>
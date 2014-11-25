<!DOCTYPE html>
<html>
<head>
	<title>添加角色</title>
	<link rel="stylesheet" type="text/css" href="__HD_CSS__/hdui.css">

</head>
<body>
<form  id="test"> 
<table class="table2 hd-form">
	<tr class="title-header">
		<th colspan="2">添加角色</th>
	</tr>
	<tr>
		<td align="right" width="45%">角色名称</td>
		<td>
			<input type="text" name='name'/>
		</td>

	</tr>
	<tr>
		<td align="right">角色描述</td>
		<td>
			<input type="text" name="remark"/>
		</td>
	</tr>
	<tr>
		<td align="right">是否开启</td>
		<td>
			<input type="radio" name="status" value="1"checked="checked"/>&nbsp;开启&nbsp;<input type="radio" name="status" value="0">&nbsp;关闭&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"align="center">
			<a  id="ajax" class="btn1 btn-primary" >保存添加</a>
		</td>
	</tr>
</table>
</form>
</body>
<script type="text/javascript" src="__JS__/jquery-1.7.2.min.js"></script>
	<script src="__HD_SLIDEJS__/hdslide.js"></script>
	<script type="text/javascript" src="__HD_JS__/hdui.js"></script>
	<script type="text/javascript" src="__HD_VAl_JS__/hdvalidate.js"></script>
	<link rel="stylesheet" type="text/css" href="__HD_VAl_CSS__/hdvalidate.css">

	<script type="text/javascript">
	var ThinkPHP={
			'index':'{:U("Admin/Rbac/role")}',
			'addRole':'{:U("Admin/Rbac/addRole")}'
		};
	$(function(){
		$('#ajax').on('click',function(){
			if ($('form').is_validate()) {
					$.ajax({
						type:'post',
						url:ThinkPHP['addRole'],
						data:$('form').serialize(),
						success:function(response, status, xhr){
							if(response=='0'){
								$.dialog({'message':" 添加失败! ",type:"error"});
							}else{
								$.dialog({'message':" 添加成功~ ",type:"success"});	
								setTimeout(function(){
									var url = ThinkPHP['index'];
									window.location.href=url;	
								},1000);
							}
						},
					})
					
				
			}else{
				return false;
			}
		});
		$("#test").validate({
		  // 验证规则
		  name: {
		 	 rule: {
		 	 		user:"6,20",
		 			 required: true
		 			 },
		 	error:
		 		{
		 			user:"不能小于6个字符",
		 			required:"用户名不能为空呢"
		 		},
		 		message: " 用户名长度 6 到 20 位 ",
			 	 success: ' 操作成功 '
				  },
		 remark:
		 		{
		 			rule:
		 				{
		 					required:true
		 				},
		 			error:
		 				{
		 					required:"中文描述不能为空",
		 				},
		 			message:"请填写中文名字",
		 			success:"操作成功",

		 		}		  
			  });
		
	});
	</script>

</html>
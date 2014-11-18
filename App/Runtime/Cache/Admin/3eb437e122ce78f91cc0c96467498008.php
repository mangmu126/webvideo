<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>添加用户</title>
	<link rel="stylesheet" type="text/css" href="/webvideo/Public/hdjs/hdui/css/hdui.css">

</head>
<body>
<form action="<?php echo U('Admin/Rbac/addUserHandle');?>" method="post" > 
<table class="table2 hd-form">
	<tr class="title-header">
		<th colspan="2">添加用户</th>
	</tr>
	<tr>
		<td align="right" width="40%">用户账号</td>
		<td>
			<input type="text" name='username'/>
		</td>

	</tr>
	<tr>
		<td align="right">密码</td>
		<td>
			<input type="password" name="password"/>
		</td>
	</tr>
	<tr>
		<td align="right">所属角色</td>
		<td>
			<select name="role_id[]">
				<option value="">请选择角色</option>
				<?php if(is_array($role)): foreach($role as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v["name"]); ?>(<?php echo ($v["remark"]); ?>)</option><?php endforeach; endif; ?>
			</select>
			<span class="add-role hd-success">添加一个角色</span>
			</td>
	</tr>
	
	<tr id="last">
		<td colspan="2"align="center">
			
			<input type="submit" value="保存添加" class="btn1">
		</td>
	</tr>
</table>
</form>
</body>
<script type="text/javascript" src="/webvideo/Public/Admin/Js/jquery-1.7.2.min.js"></script>
	<srcipt src="/webvideo/Public/hdjs/hdslide/js/hdslide.js"/>
	<script type="text/javascript" src="/webvideo/Public/hdjs/hdui/js/hdui.js"></script>
	<script type="text/javascript">
		$(function(){
			$('.add-role').on('click',function(){
				var obj = $(this).parents('tr').clone();
				obj.find('.add-role').remove();
				$('#last').before(obj);
			});

		});
	</script>
</html>
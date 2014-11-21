<!DOCTYPE html>
<html>
<head>
	<title>添加用户</title>
	<link rel="stylesheet" type="text/css" href="__HD_CSS__/hdui.css">

</head>
<body>
<form action="{:U('Admin/Rbac/addUserHandle')}" method="post" > 
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
				<foreach name='role' item='v'>
				<option value="{$v['id']}">{$v.name}({$v.remark})</option>
				</foreach>
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
<script type="text/javascript" src="__JS__/jquery-1.7.2.min.js"></script>
	<srcipt src="__HD_SLIDEJS__/hdslide.js"/>
	<script type="text/javascript" src="__HD_JS__/hdui.js"></script>
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
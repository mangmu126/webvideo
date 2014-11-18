<!DOCTYPE html>
<html>
<head>
	<title>Rbac</title>
	<link rel="stylesheet" type="text/css" href="__HD_CSS__/hdui.css">

</head>
<body>
<form action="{:U('Admin/Rbac/addRoleHandle')}" method="post" > 
<table class="table2 hd-form">
	<tr class="title-header">
		<th colspan="2">添加角色</th>
	</tr>
	<tr>
		<td align="right">角色名称：</td>
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
			<input type="submit" value="保存添加" class="btn1">
		</td>
	</tr>
</table>
</form>
</body>
<script type="text/javascript" src="__JS__/jquery-1.7.2.min.js"></script>
	<srcipt src="__HD_SLIDEJS__/hdslide.js"/>
	<script type="text/javascript" src="__HD_JS__/hdui.js"></script>
</html>
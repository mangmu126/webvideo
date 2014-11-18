<!DOCTYPE html>
<html>
<head>
	<title>用户列表</title>
	<link rel="stylesheet" type="text/css" href="__HD_CSS__/hdui.css">
	<link rel="stylesheet" type="text/css" href="__CSS__/node.css">
</head>
<body>
	<table class="table1">
		<tr>
			<th>ID</th>
			<th>用户名称</th>
			<th>所属组别</th>
			<th>操作</th>
		</tr>
		<foreach name='user' item='v'>
		<tr>
			<td>{$v.id}</td>
			<td>{$v.username}</td>
			<td>
				<if condition='$v["username"] eq C("RBAC_SUPERADMIN")'>
				超级管理员
				<else/>
					<ul>
					<foreach name='v.role' item='value'>
						<li>{$value.name}({$value.remark})</li>
					</foreach>
				</ul>
				</if>
				
			</td>
			<td>删除</td>
		</tr>
		</foreach>
	</table>
	
</body>
<script type="text/javascript" src="__JS__/jquery-1.7.2.min.js"></script>
	<srcipt src="__HD_SLIDEJS__/hdslide.js"/>
	<script type="text/javascript" src="__HD_JS__/hdui.js"></script>
</html>
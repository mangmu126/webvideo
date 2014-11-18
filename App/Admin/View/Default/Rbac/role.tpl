<!DOCTYPE html>
<html>
<head>
	<title>角色列表</title>
	<link rel="stylesheet" type="text/css" href="__HD_CSS__/hdui.css">
</head>
<body>
	<table class="table1 hd-form">
		<tr>
			<th>ID</th>
			<th>角色名称</th>
			<th>角色描述</th>
			<th>开启状态</th>
			<th>操作</th>
		</tr>
		<foreach name='role' item='v'>
			<tr>
				<td>{$v.id}</td>
				<td>{$v.name}</td>
				<td>{$v.remark}</td>
				<td>
					<if condition='$v["status"]'>
						开启
					<else/>
						关闭
					</if>
				</td>
				<td>
					<a href="{:U('Admin/Rbac/access',array('rid'=>$v['id']))}">配置权限</a>
				</td>
			</tr>
		</foreach>
	</table>

</body>
<script type="text/javascript" src="__JS__/jquery-1.7.2.min.js"></script>
	<srcipt src="__HD_SLIDEJS__/hdslide.js"/>
	<script type="text/javascript" src="__HD_JS__/hdui.js"></script>
</html>
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
					<a href="javascript:hd_confirm(' 确定删除吗？ ',function(){delRole(<?php echo $v['id']; ?>)})"  >删除</a>
				</td>
			</tr>
		</foreach>
	</table>

</body>
<script type="text/javascript" src="__JS__/jquery-1.7.2.min.js"></script>
	<srcipt src="__HD_SLIDEJS__/hdslide.js"/>
	<script type="text/javascript" src="__HD_JS__/hdui.js"></script>
	<script type="text/javascript">
	var ThinkPHP = {
	'index':'{:U("Admin/Rbac/role")}',
	'Role' : '{:U("Admin/Rbac/delRole")}'
	};
	
	function  delRole(id){
			$.ajax({
				type:'POST',
				url:ThinkPHP['Role'],
				data:{
					id:id
				},
				success:function(response, status, xhr){
					var url = ThinkPHP['index'];
					window.location.href=url;
				}
			});
		};
	</script>
</html>
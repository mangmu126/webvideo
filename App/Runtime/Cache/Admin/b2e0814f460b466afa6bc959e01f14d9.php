<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>角色列表</title>
	<link rel="stylesheet" type="text/css" href="/webvideo/Public/hdjs/hdui/css/hdui.css">
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
		<?php if(is_array($role)): foreach($role as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["name"]); ?></td>
				<td><?php echo ($v["remark"]); ?></td>
				<td>
					<?php if($v["status"]): ?>开启
					<?php else: ?>
						关闭<?php endif; ?>
				</td>
				<td>
					<a href="<?php echo U('Admin/Rbac/access',array('rid'=>$v['id']));?>">配置权限</a>
					<a href="javascript:hd_confirm(' 确定删除吗？ ',function(){delRole(<?php echo $v['id']; ?>)})"  >删除</a>
				</td>
			</tr><?php endforeach; endif; ?>
	</table>

</body>
<script type="text/javascript" src="/webvideo/Public/Admin/Js/jquery-1.7.2.min.js"></script>
	<srcipt src="/webvideo/Public/hdjs/hdslide/js/hdslide.js"/>
	<script type="text/javascript" src="/webvideo/Public/hdjs/hdui/js/hdui.js"></script>
	<script type="text/javascript">
	var ThinkPHP = {
	'index':'<?php echo U("Admin/Rbac/role");?>',
	'Role' : '<?php echo U("Admin/Rbac/delRole");?>'
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
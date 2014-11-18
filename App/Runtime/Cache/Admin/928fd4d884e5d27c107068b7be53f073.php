<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>用户列表</title>
	<link rel="stylesheet" type="text/css" href="/webvideo/Public/hdjs/hdui/css/hdui.css">
	<link rel="stylesheet" type="text/css" href="/webvideo/Public/Admin/Css/node.css">
</head>
<body>
	<table class="table1">
		<tr>
			<th>ID</th>
			<th>用户名称</th>
			<th>所属组别</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($user)): foreach($user as $key=>$v): ?><tr>
			<td><?php echo ($v["id"]); ?></td>
			<td><?php echo ($v["username"]); ?></td>
			<td>
				<?php if($v["username"] == C("RBAC_SUPERADMIN")): ?>超级管理员
				<?php else: ?>
					<ul>
					<?php if(is_array($v["role"])): foreach($v["role"] as $key=>$value): ?><li><?php echo ($value["name"]); ?>(<?php echo ($value["remark"]); ?>)</li><?php endforeach; endif; ?>
				</ul><?php endif; ?>
				
			</td>
			<td>删除</td>
		</tr><?php endforeach; endif; ?>
	</table>
	
</body>
<script type="text/javascript" src="/webvideo/Public/Admin/Js/jquery-1.7.2.min.js"></script>
	<srcipt src="/webvideo/Public/hdjs/hdslide/js/hdslide.js"/>
	<script type="text/javascript" src="/webvideo/Public/hdjs/hdui/js/hdui.js"></script>
</html>
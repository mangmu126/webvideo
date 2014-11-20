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
			
			<td >
			<a href="javascript:void(0);" onclick="editpass(<?php echo $v['id']; ?>)">修改密码</a>
			<a href="<?php echo U('Admin/Rbac/editUser',array('id'=>$v['id']));?>">修改权限</a>	
			<a href="javascript:hd_confirm(' 确定删除吗？ ',function(){delUser(<?php echo $v['id']; ?>)})"  >删除</a>
			</td>
		</tr><?php endforeach; endif; ?>
	</table>
	<script type="text/javascript" src="/webvideo/Public/Admin/Js/jquery-1.7.2.min.js"></script>
	<srcipt src="/webvideo/Public/hdjs/hdslide/js/hdslide.js"/>
	<script type="text/javascript" src="/webvideo/Public/hdjs/hdui/js/hdui.js"></script>
	<script type="text/javascript">
	var ThinkPHP = {
	'index':'<?php echo U("Admin/Rbac/index");?>',
	'User' : '<?php echo U("Admin/User/delUser");?>'
	};
	
	function  delUser(id){
			$.ajax({
				type:'POST',
				url:ThinkPHP['User'],
				data:{
					id:id
				},
				success:function(response, status, xhr){
					var url = ThinkPHP['index'];
					window.location.href=url;
				}
			});
		};
		function cl_k(){
			$('input[name="id"]').attr('id');
			alert($('input[name="password"]').val());
		}
			function editpass(id){
			$.modal({
				  width: 400,
				  height: 160,
				  title:"超级管理员修改密码",
				  button: true,
				 
				  success: function () {
				  	alert($('.hd-form').serialize());
				  },
				  content: '<from action="reg.php" method="post" class="hd-form" id="editPass">'+'<table class="table1">'+'<tr><td> 新密码 : </td><td><input type="password"name="password"/></td><input type="hidden" name="id" id='+id+'>'+'<tr ><td></td><td  align="left" ><a href="javascript:void(0);" onclick="cl_k()" class="hd-success" >提交</a></td></tr></table></from>',
				  });
			}
	
	</script>
</body>

</html>
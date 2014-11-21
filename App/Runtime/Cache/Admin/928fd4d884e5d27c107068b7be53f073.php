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
			
			
			<?php if($v["username"] == C("RBAC_SUPERADMIN")): ?><td></td>
			<?php else: ?>
			<td >
			<a href="javascript:void(0);" onclick="editpass(<?php echo $v['id']; ?>)">修改密码</a>
			<a href="javascript:void(0);" onclick="editJurisdiction(<?php echo $v['id']; ?>)">修改权限</a>	
			<a href="javascript:hd_confirm(' 确定删除吗？ ',function(){delUser(<?php echo $v['id']; ?>)})"  >删除</a>
			</td><?php endif; ?>
		</tr><?php endforeach; endif; ?>
	</table>
	<script type="text/javascript" src="/webvideo/Public/Admin/Js/jquery-1.7.2.min.js"></script>
	<srcipt src="/webvideo/Public/hdjs/hdslide/js/hdslide.js"/>
	<script type="text/javascript" src="/webvideo/Public/hdjs/hdui/js/hdui.js"></script>
	<script type="text/javascript">
	var ThinkPHP = {
	'index':'<?php echo U("Admin/Rbac/index");?>',
	'User' : '<?php echo U("Admin/User/delUser");?>',
	'editpass' : '<?php echo U("Admin/User/editPass");?>',
	'editJurisdiction':'<?php echo U("Admin/Rbac/editJurisdiction");?>'
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
		//修改权限
		function editJurisdiction(id){
			$.modal({
				  width: 400,
				  height: 160,
				  title:"超级管理员权限",
				  button: true,
				 
				  success: function () {
				  $.removeModal();
				  },
				  content: '<from action="reg.php" method="post" class="hd-form" id="editJurisdictio">'+'<table class="table1">'+'<tr><td> 权限 : </td><td><select name="role_id"><?php if(is_array($role)): foreach($role as $key=>$r): ?><option value="<?php echo ($r['id']); ?>"><?php echo ($r["name"]); ?>(<?php echo ($r["remark"]); ?>)</option><?php endforeach; endif; ?></select></td><input type="hidden" name="id" uid='+id+'>'+'<tr ><td></td><td  align="left" ><a href="javascript:void(0);" onclick="cl_k1()" class="hd-success" >提交</a></td></tr></table></from>',
				  });
		}
		function cl_k1(){
			$.ajax({
				type:'post',
				url:ThinkPHP['editJurisdiction'],
				data:{
					role_id:$('select[name="role_id"]').val(),
					user_id:$('input[name="id"]').attr('uid')
				},
				success:function(response,status,xhr)
				{
					if(response=='0'){
						$.dialog({'message':" 修改失败! ",type:"error"});
					}else{
						$.dialog({'message':" 修改成功~ ",type:"success"});	
						setTimeout(function(){
						var url = ThinkPHP['index'];
							window.location.href=url;	
						},1000);
						
					}
				},

			});
		}
		function cl_k(){
			
			
			$.ajax({
				type:'post',
				url:ThinkPHP['editpass'],
				data:{
					id:$('input[name="id"]').attr('id'),
					password:$('input[name="password"]').val()
				},
				success:function(response,status,xhr)
				{
					if(response=='0'){
						$.dialog({'message':" 修改失败! ",type:"error"});
					}else{
						$.dialog({'message':" 修改成功~ ",type:"success"});	
						setTimeout(function(){
							var url = ThinkPHP['index'];
							window.location.href=url;	
						},1000);
						
					}
				},

			});
		}
			function editpass(id){
			$.modal({
				  width: 400,
				  height: 160,
				  title:"超级管理员修改密码",
				  button: true,
				 
				  success: function () {
				  	$.removeModal();
				  },
				  content: '<from action="reg.php" method="post" class="hd-form" id="editPass">'+'<table class="table1">'+'<tr><td> 新密码 : </td><td><input type="password"name="password"/></td><input type="hidden" name="id" id='+id+'>'+'<tr ><td></td><td  align="left" ><a href="javascript:void(0);" onclick="cl_k()" class="hd-success" >提交</a></td></tr></table></from>',
				  });
			}
	
	</script>
</body>

</html>
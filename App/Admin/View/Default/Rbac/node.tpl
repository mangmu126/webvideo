<!DOCTYPE html>
<html>
<head>
	<title>节点列表</title>
	<link rel="stylesheet" type="text/css" href="__HD_CSS__/hdui.css">
	<link rel="stylesheet" type="text/css" href="__CSS__/node.css">
</head>
<body>
	<div id="wrap">
		<a href="{:U('Admin/Rbac/addNode')}" class="btn1">添加应用</a>
		<foreach name="node" item='app'>
		<div class="app">
			<p>
				<strong>{$app.title}</strong>
				[<a href="{:U('Admin/Rbac/addNode',array('pid'=>$app['id'],'level'=>2))}">添加控制器</a>]
				<?php if(empty($app['child'])){ ?> 
				[<a href="javascript:hd_confirm(' 确定删除吗？ ',function(){delNode(<?php echo $app['id']; ?>)})">删除</a>]
				<?php } ?>
			</p>
			<foreach name='app.child' item='action'>
				<dl>
					<dt>
						<strong>{$action.title}</strong>
						[<a href="{:U('Admin/Rbac/addNode',array('pid'=>$action['id'],'level'=>3))}">添加方法</a>]
						<?php if(empty($action['child'])){ ?> 
						[<a href="javascript:hd_confirm(' 确定删除吗？ ',function(){delNode(<?php echo $action['id']; ?>)})">删除</a>]
						<?php } ?>
					</dt>
					<foreach name='action.child' item='method'>
						<dd>
							<span>{$method.title}</span>
							
							[<a href="javascript:hd_confirm(' 确定删除吗？ ',function(){delNode(<?php echo $method['id']; ?>)})">删除</a>]
						</dd>
					</foreach>
				</dl>
			</foreach>
		</div>
		</foreach>
	</div>
	
</body>
<script type="text/javascript" src="__JS__/jquery-1.7.2.min.js"></script>
	<srcipt src="__HD_SLIDEJS__/hdslide.js"/>
	<script type="text/javascript" src="__HD_JS__/hdui.js"></script>
	<script type="text/javascript">
	var ThinkPHP = {
	'index':'{:U("Admin/Rbac/node")}',
	'Node' : '{:U("Admin/Rbac/delNode")}'
	};
	
	function  delNode(id){
			$.ajax({
				type:'POST',
				url:ThinkPHP['Node'],
				data:{
					id:id
				},
				success:function(response, status, xhr){
					//var url = ThinkPHP['index'];
					//window.location.href=url;
					
					if(response=='0'){
						$.dialog({'message':" 删除失败! ",type:"error"});
					}else{
						$.dialog({'message':" 删除成功~ ",type:"success"});	
						setTimeout(function(){
							var url = ThinkPHP['index'];
							window.location.href=url;	
						},1000);
						
					}



				}
			});
		};
	</script>
</html>
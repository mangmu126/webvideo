<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>节点列表</title>
	<link rel="stylesheet" type="text/css" href="/webvideo/Public/hdjs/hdui/css/hdui.css">
	<link rel="stylesheet" type="text/css" href="/webvideo/Public/Admin/Css/node.css">
</head>
<body>
	<div id="wrap">
		<a href="<?php echo U('Admin/Rbac/addNode');?>" class="btn1">添加应用</a>
		<?php if(is_array($node)): foreach($node as $key=>$app): ?><div class="app">
			<p>
				<strong><?php echo ($app["title"]); ?></strong>
				[<a href="<?php echo U('Admin/Rbac/addNode',array('pid'=>$app['id'],'level'=>2));?>">添加控制器</a>]
				<?php if(empty($app['child'])){ ?> 
				[<a href="javascript:hd_confirm(' 确定删除吗？ ',function(){delNode(<?php echo $app['id']; ?>)})">删除</a>]
				<?php } ?>
			</p>
			<?php if(is_array($app["child"])): foreach($app["child"] as $key=>$action): ?><dl>
					<dt>
						<strong><?php echo ($action["title"]); ?></strong>
						[<a href="<?php echo U('Admin/Rbac/addNode',array('pid'=>$action['id'],'level'=>3));?>">添加方法</a>]
						<?php if(empty($action['child'])){ ?> 
						[<a href="javascript:hd_confirm(' 确定删除吗？ ',function(){delNode(<?php echo $action['id']; ?>)})">删除</a>]
						<?php } ?>
					</dt>
					<?php if(is_array($action["child"])): foreach($action["child"] as $key=>$method): ?><dd>
							<span><?php echo ($method["title"]); ?></span>
							
							[<a href="javascript:hd_confirm(' 确定删除吗？ ',function(){delNode(<?php echo $method['id']; ?>)})">删除</a>]
						</dd><?php endforeach; endif; ?>
				</dl><?php endforeach; endif; ?>
		</div><?php endforeach; endif; ?>
	</div>
	
</body>
<script type="text/javascript" src="/webvideo/Public/Admin/Js/jquery-1.7.2.min.js"></script>
	<srcipt src="/webvideo/Public/hdjs/hdslide/js/hdslide.js"/>
	<script type="text/javascript" src="/webvideo/Public/hdjs/hdui/js/hdui.js"></script>
	<script type="text/javascript">
	var ThinkPHP = {
	'index':'<?php echo U("Admin/Rbac/node");?>',
	'Node' : '<?php echo U("Admin/Rbac/delNode");?>'
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
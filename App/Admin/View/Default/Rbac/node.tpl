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
				[<a href="{:U('Admin/Rbac/addNode',array('pid'=>$app['id'],'level'=>2))}">添加控制器</a>][<a href="">修改</a>][<a href="">删除</a>]
			</p>
			<foreach name='app.child' item='action'>
				<dl>
					<dt>
						<strong>{$action.title}</strong>
						[<a href="{:U('Admin/Rbac/addNode',array('pid'=>$action['id'],'level'=>3))}">添加方法</a>]
					</dt>
					<foreach name='action.child' item='method'>
						<dd>
							<span>{$method.title}</span>
							[<a href="">修改</a>]
							[<a href="">删除</a>]
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
</html>
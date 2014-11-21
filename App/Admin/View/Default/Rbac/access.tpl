<!DOCTYPE html>
<html>
<head>
	<title>权限配置</title>
	<link rel="stylesheet" type="text/css" href="__HD_CSS__/hdui.css">
	<link rel="stylesheet" type="text/css" href="__CSS__/node.css">
</head>
<body>

		<form action="{:U('Admin/Rbac/setAccess')}" method="post">
	<div id="wrap">
		<a href="{:U('Admin/Rbac/role')}" class="btn1">返回</a>
		<foreach name="node" item='app'>
		<div class="app">
			<p>
				<strong>{$app.title}</strong>
				<input type="checkbox" name="access[]" value="{$app.id}_1" level='1' <if condition='$app["access"]'>checked='checked'</if>/>
			</p>
			<foreach name='app.child' item='action'>
				<dl>
					<dt>
						<strong>{$action.title}</strong>
						<input type="checkbox" name="access[]" value="{$action.id}_2" level='2' <if condition='$action["access"]'>checked='checked'</if>/>
						
					</dt>
					<foreach name='action.child' item='method'>
						<dd>
							<span>{$method.title}</span>
							<input type="checkbox" name="access[]" value="{$method.id}_3" level='3' <if condition='$method["access"]'>checked='checked'</if>/>
						</dd>
					</foreach>
				</dl>
			</foreach>
		</div>
		</foreach>
		
	</div>
	<div class="position-bottom">
	<input type="hidden" value="{$rid}" name="rid" />
	<input type="submit" value="保存修改" class="hd-success" />
	</div>
		</form>
</body>
<script type="text/javascript" src="__JS__/jquery-1.7.2.min.js"></script>
	<script src="__HD_SLIDEJS__/hdslide.js"/>
	<script type="text/javascript" src="__HD_JS__/hdui.js"></script>
	<script type="text/javascript">
	$(function(){
		$('input[level=1]').click(function(){
			var inputs =$(this).parents('.app').find('input');
			$(this).attr('checked')?inputs.attr('checked','checked') : inputs.removeAttr('checked');
		});
		$('input[level=2]').on('click',function(){
			var inputs = $(this).parents('dl').find('input');
			$(this).attr('checked')?inputs.attr('checked','checked') :inputs.removeAttr('checked');
		});
	});
	</script>
</html>
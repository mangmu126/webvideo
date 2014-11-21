<!DOCTYPE html>
<html>
<head>
	<title>添加节点</title>
	<link rel="stylesheet" type="text/css" href="__HD_CSS__/hdui.css">

</head>
<body>
<form action="{:U('Admin/Rbac/addNodeHandle')}" method="post" > 
<table class="table2 hd-form">
	<tr class="title-header">
		<th colspan="2">添加节点</th>
	</tr>
	<tr>
		<td align="right" width="50%">{$type}名称</td>
		<td>
			<input type="text" name='name'/>
		</td>

	</tr>
	<tr>
		<td align="right">{$type}描述</td>
		<td>
			<input type="text" name="title"/>
		</td>
	</tr>
	<tr>
		<td align="right">是否开启</td>
		<td>
			<input type="radio" name="status" value="1"checked="checked"/>&nbsp;开启&nbsp;<input type="radio" name="status" value="0">&nbsp;关闭&nbsp;</td>
	</tr>
	<tr>
		<td align="right">排序</td>
		<td>
		<input type="text" name="sort" value="1"/>
		</td>
	</tr>
	<tr>
		<td colspan="2"align="center">
			<input type="hidden" name="pid" value="{$pid}"/>
			<input type="hidden" name="level" value="{$level}"/>
			
			
		</td>
	</tr>
</table>
<div class="position-bottom">
	<a href="javascript:void(0)" id="ajax" class="btn1">保存添加</a>
  </div>
</form>

</body>
<script type="text/javascript" src="__JS__/jquery-1.7.2.min.js"></script>
	<script src="__HD_SLIDEJS__/hdslide.js"/>
	<script type="text/javascript" src="__HD_JS__/hdui.js"></script>
	<script type="text/javascript">
	$(function(){
		$('#ajax').on('click',function(){
			alert('dsadas');
		});
	});
	</script>
</html>
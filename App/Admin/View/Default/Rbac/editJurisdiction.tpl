<!DOCTYPE html>
<html>
<head>
    <title>添加用户</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="__BTP_CSS__/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="__BTP_CSS__/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="__BTP_CSS__/style.css" />
    <link rel="stylesheet" type="text/css" href="__HD_CSS__/hdui.css">
    <script type="text/javascript" src="__JS__/jquery-1.7.2.min.js"></script>
	
    <script type="text/javascript" src="__BTP_JS__/bootstrap.js"></script>
    <script type="text/javascript" src="__BTP_JS__/ckform.js"></script>
    <script type="text/javascript" src="__BTP_JS__/common.js"></script>
    <script src="__HD_SLIDEJS__/hdslide.js"></script>
	<script type="text/javascript" src="__HD_JS__/hdui.js"></script>
	<script type="text/javascript" src="__HD_VAl_JS__/hdvalidate.js"></script>
	<link rel="stylesheet" type="text/css" href="__HD_VAl_CSS__/hdvalidate.css">

    <script>
var ThinkPHP = {
	'index':'{:U("Admin/Rbac/index")}',
	'User' : '{:U("Admin/Rbac/addUser")}'
	};
    $(function () {       
		$('#backid').click(function(){
				window.location.href=ThinkPHP['index'];
		 });
		$('.add-role').on('click',function(){
				var obj = $(this).parents('tr').clone();
				obj.find('.add-role').remove();
				$('#last').before(obj);
			//alert(obj);
			});
		//异步
		$('#ajax').on('click',function(){
			if ($('form').is_validate()) {
					$.ajax({
						type:'post',
						url:ThinkPHP['User'],
						data:$('form').serialize(),
						success:function(response, status, xhr){
							if(response=='0'){
								$.dialog({'message':" 添加失败! ",type:"error"});
							}else{
								$.dialog({'message':" 添加成功~ ",type:"success"});	
								setTimeout(function(){
									var url = ThinkPHP['index'];
									window.location.href=url;	
								},1000);
								
							}
						},
					});
			}else{
				return false;
			}
		});

		$("#test").validate({
		  // 验证规则
		  username: {
		 	 rule: {
		 	 		user:"6,20",
		 			 required: true
		 			 },
		 	error:
		 		{
		 			user:"不能小于6个字符",
		 			required:"用户名不能为空呢"
		 		},
		 		message: " 不能以数字开头6-15位 ",
			 	 success: ' 操作成功 '
				  },
		 password:
		 		{
		 			rule:
		 				{
		 					user:"6,15",
		 					required:true
		 				},
		 			error:
		 				{
		 					user:'不能小于6个字符',
		 					required:"密码不能为空",
		 				},
		 			message:"不能以数字开头6-15位",
		 			success:"操作成功",

		 		}		  
			  });


    });

</script>
    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }


    </style>
</head>
<form id="test">
<table class="table table-bordered table-hover definewidth m10">
	<tr class="title-header">
		<th colspan="2">修改{$username}的权限</th>
	</tr>
	<?php $i=0;?>
   <foreach name='data' item='v'>
   <?php $i++;?>
   <tr>
		<td class="tableleft">所属角色</td>
		<td>
		<select name="role_id[]"><option value="{$v['id']}">{$v.name}({$v.remark})</option><foreach name='role' item='r'><?php if($r['id'] !=$v['id']){?><option value="{$r['id']}">{$r.name}({$r.remark})</option><?php } ?></foreach></select>
			<?php if($i=='1'){ ?>
			<span class="add-role hd-success">添加一个角色</span>
			<?php } ?>
			<?php if($i !='1'){?>
			<span class="del-role btn">删除角色</span>
			<?php } ?>
			</td>
	</tr>
   </foreach>
    <tr id="last">
        <td class="tableleft"></td>
        <td>
            <a  id="ajax" class="btn btn-primary" >保存</a></button>&nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
        </td>
    </tr>
</table>
</form>
</body>
</html>

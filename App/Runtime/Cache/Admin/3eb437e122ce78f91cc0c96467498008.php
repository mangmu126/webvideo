<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>添加用户</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/webvideo/Public/bootstrap/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/webvideo/Public/bootstrap/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/webvideo/Public/bootstrap/Css/style.css" />
    <link rel="stylesheet" type="text/css" href="/webvideo/Public/hdjs/hdui/css/hdui.css">
    <script type="text/javascript" src="/webvideo/Public/Admin/Js/jquery-1.7.2.min.js"></script>
	
    <script type="text/javascript" src="/webvideo/Public/bootstrap/Js/bootstrap.js"></script>
    <script type="text/javascript" src="/webvideo/Public/bootstrap/Js/ckform.js"></script>
    <script type="text/javascript" src="/webvideo/Public/bootstrap/Js/common.js"></script>
    <script src="/webvideo/Public/hdjs/hdslide/js/hdslide.js"></script>
	<script type="text/javascript" src="/webvideo/Public/hdjs/hdui/js/hdui.js"></script>
	<script type="text/javascript" src="/webvideo/Public/hdjs/hdvalidate/js/hdvalidate.js"></script>
	<link rel="stylesheet" type="text/css" href="/webvideo/Public/hdjs/hdvalidate/css/hdvalidate.css">

    <script>
var ThinkPHP = {
	'index':'<?php echo U("Admin/Rbac/index");?>',
	'User' : '<?php echo U("Admin/Rbac/addUser");?>'
	};
    $(function () {       
		$('#backid').click(function(){
				window.location.href=ThinkPHP['index'];
		 });
		/*
		$('.add-role').on('click',function(){
				var obj = $(this).parents('tr').clone();
				obj.find('.add-role').remove();
				$('#last').before(obj);
			//alert(obj);
			});
		*/
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
		<th colspan="2">添加用户</th>
	</tr>
    <tr>
        <td width="10%" class="tableleft">用户账号</td>
        <td><input type="text" name="username"/></td>
    </tr>
    <tr>
        <td class="tableleft">密码</td>
        <td><input type="password" name="password"/></td>
    </tr>   
   <tr>
		<td class="tableleft">所属角色</td>
		<td>
			<select name="role_id[]">
				<option value="">请选择角色</option>
				<?php if(is_array($role)): foreach($role as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v["name"]); ?>(<?php echo ($v["remark"]); ?>)</option><?php endforeach; endif; ?>
			</select>
		
			</td>
	</tr>
   
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
<!DOCTYPE html>
<html>
<head>
    <title>添加节点</title>
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
	'index':'{:U("Admin/Rbac/node")}',
	'Node' : '{:U("Admin/Rbac/addNode")}'
	};
    $(function () {       
		$('#backid').click(function(){
				window.location.href="index.html";
		 });
		$('#ajax').on('click',function(){
            if ($('form').is_validate()) {
    			$.ajax({
    				type:'post',
    				url:ThinkPHP['Node'],
    				data:{
    					name:$('input[name="name"]').val(),
    					title:$('input[name="title"]').val(),
    					status:$('input[name="status"]').val(),
    					sort:$('input[name="sort"]').val(),
    					pid:$('input[name="pid"]').val(),
    					level:$('input[name="level"]').val()
    				},
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
          name: {
             rule: {
                    
                     required: true
                     },
            error:
                {
                    
                    required:"英文"
                },
                
                 success: ' 操作成功 '
                  },
         title:
                {
                    rule:
                        {
                           
                            required:true
                        },
                    error:
                        {
                          
                            required:"中文",
                        },
                    
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
		<th colspan="2">添加节点</th>
	</tr>
    <tr>
        <td width="10%" class="tableleft">{$type}名称</td>
        <td><input type="text" name="name"/></td>
    </tr>
    <tr>
        <td class="tableleft">{$type}描述</td>
        <td><input type="text" name="title"/></td>
    </tr>   
    <tr>
        <td class="tableleft">状态</td>
        <td>
            <input type="radio" name="status" value="1" checked/> 启用
            <input type="radio" name="status" value="0"/> 禁用
        </td>
    </tr>
    <tr >
		<td class="tableleft">排序</td>
		<td>
		<input type="text" name="sort" value="1"/>
		<input type="hidden" name="pid" value="{$pid}"/>
			<input type="hidden" name="level" value="{$level}"/>
		</td>
	</tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <a  id="ajax" class="btn btn-primary" >保存</a></button>&nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
        </td>
    </tr>
</table>
</form>
</body>
</html>

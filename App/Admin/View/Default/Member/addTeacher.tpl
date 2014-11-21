<!DOCTYPE html>
<html>
<head>
    <title>添加老师</title>
    <meta charset="UTF-8">
   
    <link rel="stylesheet" type="text/css" href="__BTP_CSS__/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="__BTP_CSS__/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="__BTP_CSS__/style.css" />
    <link rel="stylesheet" type="text/css" href="__HD_CSS__/hdui.css">

    <script type="text/javascript" src="__BTP_JS__/jquery.js"></script>

    <script type="text/javascript" src="__BTP_JS__/bootstrap.js"></script>
    <script type="text/javascript" src="__BTP_JS__/ckform.js"></script>
    <script type="text/javascript" src="__BTP_JS__/common.js"></script>
    <script src="__HD_SLIDEJS__/hdslide.js"></script>
    <script type="text/javascript" src="__HD_JS__/hdui.js"></script>
    <script type="text/javascript" src="__HD_VAl_JS__/hdvalidate.js"></script>
    <link rel="stylesheet" type="text/css" href="__HD_VAl_CSS__/hdvalidate.css">
    <script src="http://open.web.meitu.com/sources/xiuxiu.js" type="text/javascript"></script>
    <script type="text/javascript">
    var ThinkPHP={
        'pic':'{:U("Admin/Mumber/pic")}'
    };
    window.onload=function(){
           /*第1个参数是加载编辑器div容器，第2个参数是编辑器类型，第3个参数是div容器宽，第4个参数是div容器高*/
        xiuxiu.embedSWF("altContent",1,"100%","90%");
           //修改为您自己的图片上传接口
        xiuxiu.setUploadURL("http://location/webvideo/"+ThinkPHP['pic']);
            xiuxiu.setUploadType(2);
            xiuxiu.setUploadDataFieldName("upload_file");
        xiuxiu.onInit = function ()
        {
            xiuxiu.loadPhoto();
        }   
        xiuxiu.onUploadResponse = function (data)
        {
            //alert("上传响应" + data);  可以开启调试
        }
    }
    </script>
    <style type="text/css">
        html, body { height:100%; overflow:hidden; }
        body { margin:0; }
    </style>
    </head>


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
<body>

<ul class="nav nav-tabs" id="myTab" style="margin:2% 3% 0 3% ">
<li><a href="#profile" id="pp" data-toggle="tab">修改头像</a></li>
  <li class="active"><a href="#home" data-toggle="tab">基本资料</a></li>
  

</ul>

<div class="tab-content" style="margin:0 3% 0 3% ">
  <div class="tab-pane active" id="home">
     <table class="table table-bordered table-hover definewidth m10" style="margin-top:35px;" >
   
         <tr>
            <td align="right" class="tableleft" >头像</td>
            <td><img src="__IMG__/23-012515_559.jpg" style="width:140px;height:140px;cursor:pointer" id="pic" /></td>
            
        </tr>
        <tr>
            <td class="tableleft">老师名字:</td>
            <td><input type="text" name="m_name"></td>
        </tr>
        <tr>
            <td class="tableleft">帐号:</td>
            <td><input type="text" name="username"></td>
        </tr>
         <tr>
            <td class="tableleft">密码:</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
        <td class="tableleft">状态</td>
        <td>
            <input type="radio" name="lock" value="1" checked/> 启用
           <input type="radio" name="lock" value="0"/> 禁用
        </td>
         </tr>
          <tr>
        <td class="tableleft"></td>
        <td>
          <a href="javascript:void(0);" class="btn btn-primary" id="submit">提交</a>
          <a href="{:U('Admin/Member/index')}" class="btn btn-success ret" >返回列表</a>
        </td>
         </tr>
        </table>
  </div>
  <div class="tab-pane" id="profile" style="height:100%;">
      
<div id="altContent">
    <h1>大猫</h1>
</div>
  </div>

</div>
</body>
</html>
<script>
var ThinkPHP={
    'index':'{:U("Admin/Member/index")}',
    'addTeacher':'{:U("Admin/Member/addTeacher")}'
};
  $(function () {
    $('#myTab a:last').tab('show');
    $('#pic').on('click',function(){
       $('#pp').click();
    });
    //提交
    $('#submit').on('click',function(){
        $.ajax({
            type:'post',
            url:ThinkPHP['addTeacher'],
            data:{
                m_name:$('input[name="m_name"]').val(),
                username:$('input[name="username"]').val(),
                password:$('input[name="password"]').val(),
                pic:$('#pic').attr('url'),
                lock:$('input[name="lock"]').val(),
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
    });
  })
</script>
<script>
    $(function () {
        
		$('#addnew').click(function(){

				window.location.href="add.html";
		 });


    });

	function del(id)
	{
		
		
		if(confirm("确定要删除吗？"))
		{
		
			var url = "index.html";
			
			window.location.href=url;		
		
		}
	
	
	
	
	}
</script>
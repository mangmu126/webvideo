<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/webvideo/Public/hdjs/hdui/css/hdui.css">
    <link rel="stylesheet" type="text/css" href="/webvideo/Public/bootstrap/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/webvideo/Public/bootstrap/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/webvideo/Public/bootstrap/Css/style.css" />
    <script type="text/javascript" src="/webvideo/Public/bootstrap/Js/jquery.js"></script>
    <script src="/webvideo/Public/hdjs/hdslide/js/hdslide.js"></script>
    <script type="text/javascript" src="/webvideo/Public/hdjs/hdui/js/hdui.js"></script>
    <script type="text/javascript" src="/webvideo/Public/bootstrap/Js/bootstrap.js"></script>
    <script type="text/javascript" src="/webvideo/Public/bootstrap/Js/ckform.js"></script>
    <script type="text/javascript" src="/webvideo/Public/bootstrap/Js/common.js"></script>

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
<form class="form-inline definewidth m20" action="index.html" method="get">  
    老师名称：
    <input type="text" name="rolename" id="rolename"class="abc input-default" placeholder="" value="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp; <button type="button" class="btn btn-success" id="addnew">添加老师</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>老师id</th>
        <th>老师名字</th>
       
        <th>状态</th>
         <th>注册时间</th>
        <th>管理操作</th>
    </tr>
    </thead>
        <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
            <td><?php echo ($v["m_id"]); ?></td>
            <td><?php echo ($v["m_name"]); ?></td>
            <td><?php if($v['lock'] == '1'): ?>开启<?php else: ?>锁定<?php endif; ?></td>
            <td><?php echo (date("Y-m-d",$v["reg_date"])); ?></td>
            <td>
                  <a href="javascript:void(0);" onclick="editMpass(<?php echo $v['m_id']; ?>)">修改密码</a>
                <?php if($v['lock'] == '1'): ?><a href="javascript:hd_confirm(' 锁定后老师将无法登录！ ',function(){editLock(<?php echo $v['m_id']; ?>)})">锁定</a>
                  <?php else: ?>
                   <a href="javascript:hd_confirm(' 锁定后老师将无法登录！ ',function(){deblocking(<?php echo $v['m_id']; ?>)})">解锁</a><?php endif; ?>
            </td>
        </tr><?php endforeach; endif; ?>
        </table>
<div class="inline pull-right page">
        <?php echo ($page); ?></div>
</body>
</html>
<script>
var ThinkPHP={
    'index':'<?php echo U("Admin/Member/index");?>',
    'editMpass':'<?php echo U("Admin/Member/editMpass");?>',
    'editLock':'<?php echo U("Admin/Member/editLock");?>',
    'deblocking':'<?php echo U("Admin/Member/deblocking");?>',
    'addTeacher':'<?php echo U("Admin/Member/addTeacher");?>'
};

 function cl_k1(id){
        $.ajax({
            type:'post',
            url:ThinkPHP['editMpass'],
            data:{
                    m_id:$('input[name="m_id"]').attr('id'),
                    password:$('input[name="password"]').val()
                },
            success:function(response,status,xhr){
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
    //解锁
     function deblocking(id){
        $.ajax({
            type:'post',
            url:ThinkPHP['deblocking'],
            data:{
                m_id:id,
            },
            success:function(response,status,xhr){
                if (response=='0') 
                {
                    $.dialog({'message':"解锁失败!",type:"error"});
                }else
                {
                    $.dialog({'message':"解锁成功！",type:"success"});
                    setTimeout(function(){
                        var url = ThinkPHP['index'];
                        window.location.href=url;
                    },1000);
                }
            },
        });
    }
    //枷锁
    function editLock(id){
        $.ajax({
            type:'post',
            url:ThinkPHP['editLock'],
            data:{
                m_id:id,
            },
            success:function(response,status,xhr){
                if (response=='0') 
                {
                    $.dialog({'message':"锁定失败!",type:"error"});
                }else
                {
                    $.dialog({'message':"锁定成功！",type:"success"});
                    setTimeout(function(){
                        var url = ThinkPHP['index'];
                        window.location.href=url;
                    },1000);
                }
            },
        });
    }
    function editMpass(id){
        $.modal({
                  width: 400,
                  height: 160,
                  title:"超级管理员修改老师密码",
                  button: true,
                 
                  success: function () {
                  $.removeModal();
                  },
                  content: '<from action="reg.php" method="post" class="hd-form" id="editpassword">'+'<table class="table1">'+'<tr><td> 新密码 : </td><td><input type="text" name="password"></td><input type="hidden" name="m_id" id='+id+'>'+'<tr ><td></td><td  align="left" ><a href="javascript:void(0);" onclick="cl_k1()" class="hd-success" >提交</a></td></tr></table></from>',
                  });
    }
    
    $(function () {
        
		$('#addnew').click(function(){

				window.location.href=ThinkPHP['addTeacher'];
		 });


    });

	
</script>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="__HD_CSS__/hdui.css">
    <link rel="stylesheet" type="text/css" href="__BTP_CSS__/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="__BTP_CSS__/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="__BTP_CSS__/style.css" />
    <script type="text/javascript" src="__BTP_JS__/jquery.js"></script>
    <script src="__HD_SLIDEJS__/hdslide.js"></script>
    <script type="text/javascript" src="__HD_JS__/hdui.js"></script>
    <script type="text/javascript" src="__BTP_JS__/bootstrap.js"></script>
    <script type="text/javascript" src="__BTP_JS__/ckform.js"></script>
    <script type="text/javascript" src="__BTP_JS__/common.js"></script>

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
    <a  class="btn btn-primary" onclick="findTheacher()">查询</a>&nbsp;&nbsp; <button type="button" class="btn btn-success" id="addnew">添加老师</button>
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
        <foreach name='list' item='v'>
	     <tr>
            <td>{$v.m_id}</td>
            <td>{$v.m_name}</td>
            <td><if condition="$v['lock'] eq '1'">开启<else/>锁定</if></td>
            <td>{$v.reg_date|date="Y-m-d",###}</td>
            <td>
                  <a href="javascript:void(0);" onclick="editMpass(<?php echo $v['m_id']; ?>)">修改密码</a>
                <if condition="$v['lock'] eq '1'"> 
                  <a href="javascript:hd_confirm(' 锁定后老师将无法登录！ ',function(){editLock(<?php echo $v['m_id']; ?>)})">锁定</a>
                  <else/>
                   <a href="javascript:hd_confirm(' 解锁后老师将可以正常操作！ ',function(){deblocking(<?php echo $v['m_id']; ?>)})">解锁</a>
                  </if>
            </td>
        </tr>
        </foreach>
        </table>
<div class="inline pull-right page">
        {$page}</div>
</body>
</html>
<script>
var ThinkPHP={
    'index':'{:U("Admin/Member/index")}',
    'editMpass':'{:U("Admin/Member/editMpass")}',
    'editLock':'{:U("Admin/Member/editLock")}',
    'deblocking':'{:U("Admin/Member/deblocking")}',
    'addTeacher':'{:U("Admin/Member/addTeacher")}',
    'findTheacher':'{:U("Admin/Member/findTheacher")}'
};
//查找老师
    function findTheacher(){
        if($('#rolename').val() !='')
        {
            $.ajax({
                type:'post',
                url:ThinkPHP['findTheacher'],
                data:{
                    m_name:$('#rolename').val()
                },
                success:function(response,status,xhr){
                        $.modal({
                          width: 500,
                          height: 300,
                          title:"超级管理员修改老师密码",
                          button: true,
                         
                          success: function () {
                            
                          },
                          content: response,
                          });
                },
            });
        }
        else
        {
            $.dialog({'message':" 请填写老师名字! ",type:"error"});
        }
    }
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
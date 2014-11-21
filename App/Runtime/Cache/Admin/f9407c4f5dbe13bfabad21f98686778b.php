<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
 <head>
  <title>后台管理系统</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="/webvideo/Public/bootstrap/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
  <link href="/webvideo/Public/bootstrap/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
   <link href="/webvideo/Public/bootstrap/assets/css/main-min.css" rel="stylesheet" type="text/css" />
 </head>
 <body>

  <div class="header">
    
      <div class="dl-title">
       <!--<img src="/chinapost/Public/assets/img/top.png">-->
      </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user"><?php echo ($username); ?></span><a href="<?php echo U('Admin/User/logout');?>" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
  </div>
   <div class="content">
    <div class="dl-main-nav">
      <div class="dl-inform"><div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div></div>
      <ul id="J_Nav"  class="nav-list ks-clear">
        		<li class="nav-item dl-selected"><div class="nav-item-inner nav-home">系统管理</div></li>		<li class="nav-item"><div class="nav-item-inner nav-order">业务管理</div></li>      <li class="nav-item dl-selected"><div class="nav-item-inner nav-order">RBAC</div></li>   <li class="nav-item dl-selected"><div class="nav-item-inner nav-order">老师管理</div></li> 

      </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
   </div>
  <script type="text/javascript" src="/webvideo/Public/bootstrap/assets/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="/webvideo/Public/bootstrap/assets/js/bui-min.js"></script>
  <script type="text/javascript" src="/webvideo/Public/bootstrap/assets/js/common/main-min.js"></script>
  <script type="text/javascript" src="/webvideo/Public/bootstrap/assets/js/config-min.js"></script>
  <script>
    BUI.use('common/main',function(){
      var config = [{id:'1',menu:[{text:'系统管理',items:[{id:'12',text:'机构管理',href:'Node/index.html'},
      {id:'13',text:'角色管理',href:'Role/index.html'},
      {id:'14',text:'用户管理',href:'User/index.html'},
      {id:'15',text:'菜单管理',href:'Menu/index.html'}]}]},
      {id:'21',homePage : '22',menu:[{text:'业务管理',items:[{id:'22',text:'查询业务',href:'Node/index.html'}]}]},
      {id:'31',homePage : '32',menu:[{text:'RBAC',items:[{id:'32',text:'用户列表',href:"<?php echo U('Admin/Rbac/index'); ?>"},
      {id:'33',text:'角色列表',href:"<?php echo U('Admin/Rbac/role'); ?>"},
      {id:'34',text:'节点列表',href:"<?php echo U('Admin/Rbac/node'); ?>"},
      {id:'35',text:'添加用户',href:"<?php echo U('Admin/Rbac/addUser'); ?>"},
      {id:'36',text:'添加角色',href:"<?php echo U('Admin/Rbac/addRole'); ?>"},
      {id:'37',text:'添加节点',href:"<?php echo U('Admin/Rbac/addNode'); ?>"},
      ]}]},
      {id:'41',homePage : '42',menu:[{text:'老师管理',items:[{id:'42',text:'老师列表',href:"<?php echo U('Admin/Member/index'); ?>"},
      {id:'43',text:'添加老师',href:"<?php echo U('Admin/Member/addTeacher'); ?>"},
  
      ]}]},
      ];
      new PageUtil.MainPage({
        modulesConfig : config
      });
    });
  </script>
 </body>
</html>
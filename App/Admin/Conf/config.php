<?php
return array(
	//设置模版替换变量
	'RBAC_SUPERADMIN'=>'admin',//超级管理员
	'ADMIN_AUTH_KEY'=>'superadmin',//超级管理员识别号
	'USER_AUTH_ON'=>true,//是否开启验证
	'USER_AUTH_TYPE'=>1,  //验证类型（1.登陆验证，2：时时生效）
	'USER_AUTH_KEY'=>'uid',//用户识别号
	'NOT_AUTH_MODULE'=>'',//无需验证的控制器
	'NOT_AUTH_ACTION'=>'',//无需验证的动作方法
	'RBAC_ROLE_TABLE'=>'think_role',//角色表名称
	'RBAC_USER_TABLE'=>'think_role_user',//角色与用户的中间表名称
	'RBAC_ACCESS_TABLE'=>'think_access',//权限表
	'RBAC_NODE_TABLE'=>'think_node',//节点表名称
	'TMPL_PARSE_STRING' => array(
		'__EASYUI__'=>__ROOT__.'/Public/'.MODULE_NAME.'/easyui',
		'__CSS__'=>__ROOT__.'/Public/'.MODULE_NAME.'/Css',
		'__JS__'=>__ROOT__.'/Public/'.MODULE_NAME.'/Js',
		'__IMG__'=>__ROOT__.'/Public'.MODULE_NAME.'/Img',
		'__HD_SLIDEJS__'=>__ROOT__.'/Public/hdjs/hdslide/js',
			'__HD_JS__'=>__ROOT__.'/Public/hdjs/hdui/js',
			'__HD_CSS__'=>__ROOT__.'/Public/hdjs/hdui/css',
			'__HD_IMG__'=>__ROOT__.'/Public/hdjs/hdui/img',
	),
	//设置默认主题目录
	'DEFAULT_THEME'=>'Default',
	'URL_MODEL'=>2,
	'SHOW_PAGE_TRACE'=>true,
);
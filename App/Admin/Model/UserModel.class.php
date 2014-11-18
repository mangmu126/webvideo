<?php
namespace Admin\Model;
use  Think\Model\RelationModel;
Class UserModel extends RelationModel{

	

	//定义关联关系
	Protected $_link =array(
			'role'=>array(
					'mapping_type'=>self::MANY_TO_MANY,//以多对多关系关联
					'class_name'=>'role',
					'foreign_key'=>'user_id',//主表的外健
					'relation_foreign_key'=>'role_id',//副表的外键
					'relation_table'=>'think_role_user',//指定中间表
					'mapping_fields'=>'id,name,remark',
				)
		);
}
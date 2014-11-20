<?php
namespace Admin\Model;
use Think\Model;

Class RoleModel extends Model {
	//角色删除操作数据库
	public function delRole($id){
		if($this->delete($id)){
			return 1;
		}else{
			return 0;
		}
	}
	//添加角色操作数据库
	public function daaRole($data){
		if ($this->add($data)) {
			return 1;
		}else{
			return 0;
		}
	}
}
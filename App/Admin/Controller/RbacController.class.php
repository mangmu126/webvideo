<?php

namespace Admin\Controller;
use  Think\Controller;
class RbacController extends Controller{
	//用户列表
	public function index(){
		$this->user=D('User')->field(array('id','username'))->relation(true)->select();
		//print_r($user);
		$this->display();
	}
	//角色列表
	public function role(){
		//print_r($_POST);
		$this->role=M('role')->select();
		//print_r($role);
		$this->display();
	}
	//节点列表
	public function node(){
		$field=array('id','name','title','pid');
		$node=M('node')->field($field)->order('sort')->select();
		$this->node=node_merge($node);	
		//print_r($node);
		$this->display();
	}
	//添加用户
	public function addUser(){
		$this->role=M('role')->select();
		$this->display();
	}
	//添加用户表单处理
	public function addUserHandle(){
		//用户信息
		$user=array(
			'username'=>I('username'),
			'password'=>I('password','','md5')
			);

		//所属角色
		$role=array();
		if ($uid=M('user')->add($user)) {
			foreach($_POST['role_id'] as $v){
				$role[]=array(
					'role_id'=>$v,
					'user_id'=>$uid
					);
			}
			
			//添加角色
			M('role_user')->addAll($role);
			$this->success('添加成功！',U('Admin/Rbac/index'));
		}else{
			$this->error('添加失败');
		}
	}
	//添加角色
	public function addRole(){
		$this->display();
		//echo '22';
	}
	//添加角色表单处理
	public function addRoleHandle(){
		if (M('role')->add($_POST)) {
			$this->success('添加成功',U('Admin/Rbac/role'));
		}else{
			$this->error('添加失败');
		}
	}
	//添加节点
	public function addNode(){
		$this->pid=I('pid',0,'intval');
		$this->level=I('level',1,'intval');//等级

		switch ($this->level) {
			case 1:
				$this->type='应用';
				break;
			case 2:
				$this->type='控制器';
				break;
			case 3:
				$this->type='动作方法';
				break;
		}
		$this->display();
	}
	//添加节点表单处理
	public function addNodeHandle(){
		if (M('node')->add($_POST)) {
			$this->success('添加成功',U('Admin/Rbac/node'));
		}else{
			$this->error('添加失败');
		}
	}
	//配置权限
	public function access(){
		$this->rid=I('rid',0,'intval');
		$field = array('id','name','title','pid');

		$node=M('node')->order('sort')->field($field)->select();
		//原有权限
		$access = M('access')->where(array('role_id'=>I('rid',0,'intval')))->getField('node_id',true);
		//print_r($access);exit;
		$this->node=node_merge($node,$access);
		//print_r($node);
		$this->display();
	}
	public function setAccess(){
		//print_r($_POST);
		$rid=I('rid',0,'intval');
		$db= M('access');
		//清空原权限
		$db->where(array('role_id'=>$rid))->delete();
		//组合新权限
		$data=  array();
		foreach ($_POST['access'] as $v) {
			$tmp=explode('_', $v);
			$data[]=array(
				'role_id'=>$rid,
				'node_id'=>$tmp[0],
				'level'=>$tmp[1]
				);
		}
		//插入新权限
		//print_r($data);exit();
		if ($db->addAll($data)) {
			$this->success('修改成功',U('Admin/Rbac/role'));
		}else{
			$this->error('修改失败！');
		}
	}
}

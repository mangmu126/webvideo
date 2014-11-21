<?php
namespace Admin\Controller;
use Think\Controller;
Class MemberController extends HomeController
{
		public function index(){
			if($this->login()){
				//总数
				$pagesize=$_GET['p']?$_GET['p']:0;
				$User=M('member');
				$list = $User->field(array('m_id','m_name','reg_date','lock'))->where(array('m_type'=>2))->page($pagesize.',2')->select();
				$this->assign('list',$list);// 赋值数据集
				$count = $User->where(array('m_type'=>2))->count();// 查询满足要求的总记录数
				$Page  = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数
				$show  = $Page->show();// 分页显示输出
				$this->assign('page',$show);// 赋值分页输出
				$this->display();
			}else{
				$this->redirect('Index/index');
			}
		}
		public function addTeacher(){
			if (IS_AJAX) 
			{
				$data['m_name']=I('m_name');
				$data['username']=I('username');
				$data['password']=I('password','','sha1');
				$data['m_type']='2';
				$data['reg_date']=time();
				$data['lock']=I('lock');
				$mid=D('member')->addTeacher($data);
				echo $mid;
			}
			else
			{
				$this->display();
			}
		}
		public function editMpass(){
			if (IS_AJAX) {
					$m_id=D('member')->editMpass(I('m_id','','intval'),I('password','','sha1'));
					echo $m_id;
			}else
			{
				$this->redirect('Index/index');
			}
		}
		//老师锁定
		public function editLock(){
			if (IS_AJAX) {
				$d=D('member')->editLock(I('m_id','','intval'));
				echo $d;
			}else
			{
				$this->redirect('Index/index');
			}
		}
		//老师解锁
		public function deblocking(){
			if (IS_AJAX) {
				$d=D('member')->deblocking(I('m_id','','intval'));
				echo $d;
			}else
			{
				$this->redirect('Index/index');
			}
		}
		//图片、
		public function pic(){
			print_r($_FILES);
		}
}
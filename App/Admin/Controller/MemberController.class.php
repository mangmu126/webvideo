<?php
namespace Admin\Controller;
use Think\Controller;
Class MemberController extends HomeController
{
		public function index(){
			if(true){//$this->login()
				//总数
				$pagesize=$_GET['p']?$_GET['p']:0;
				$User=M('member');
				$list = $User->field(array('m_id','m_name','reg_date','lock'))->where(array('m_type'=>2))->page($pagesize.',10')->select();
				$this->assign('list',$list);// 赋值数据集
				$count = $User->where(array('m_type'=>10))->count();// 查询满足要求的总记录数
				$Page  = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
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
		//查找老师
		public function findTheacher(){
			if (IS_AJAX) {
				$rel=D('member')->findTheacher(I('post.m_name'));
				if($rel)
				{
					$con ='<form><table class="table1"><thead><tr><th>老师id</th><th>老师名字</th><th>状态</th><th>注册时间</th><th>管理操作</th></tr></thead>';
					foreach ($rel as  $v) {
						$con .='<tr><td>'.$v['m_id'].'</td><td>'.$v['m_name'].'</td>';
						if ($v['lock']=='1') {
							$con .='<td>开启</td>';
						}else
						{
							$con .='<td>锁定</td>';
						}

						$con .='<td>'.date('Y-m-d',$v['reg_date']).'</td>';
						$con .='<td><a href="javascript:void(0);" onclick="editMpass('.$v['m_id'].')">修改密码&nbsp</a>';
						if ($v['lock']=='1') {
							$con .='<a href="javascript:hd_confirm('."'锁定后老师将无法登录！'".',function(){editLock('.$v['m_id'].')})">锁定</a>';
						}else
						{
							$con .='<a href="javascript:hd_confirm('."'解锁后老师将可以正常操作！'".',function(){deblocking('.$v['m_id'].')})">解锁</a>';
						}
					}
					$con .='</td></tr></table></form>';
					echo $con;
				}
				else
				{
					echo 0;
				}
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
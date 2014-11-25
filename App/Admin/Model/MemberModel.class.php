<?php
namespace Admin\Model;
use Think\Model;
Class MemberModel extends Model
{
		public function addTeacher($data){
			if($this->add($data)){
				return 1;
			}else
			{
				return 0;
			}
		}
		public function editMpass($id,$password)
		{
			$data['password']=$password;
			if($this->where(array('m_id'=>$id))->save($data))
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		//锁
		public function editLock($m_id)
		{
			$data['lock']='0';
			if($this->where(array('m_id'=>$m_id))->save($data))
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		//解锁
		public function deblocking($m_id)
		{
			$data['lock']='1';
			if($this->where(array('m_id'=>$m_id))->save($data))
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		//查找老师
		public function checkTeacher($name)
		{
			$where['m_name']=array('like',"%$name");
			if($rel=$this->where($where)->limit(10)->select())
			{
				return $rel;
			}
			else
			{
				return 0;
			}
		}
		//ajax验证
		public function ajaxTeacher($_data){
			if ($_data['type']=='m_name') {
				$data['m_name']=$_data['m_name'];
				if($rel=$this->where($data)->select())
				{
					return $rel;
				}
				else
				{
					return '0';
				}
			}
			elseif ($_data['type']=='username') 
			{
				$data['username']=$_data['username'];
				if($rel=$this->where($data)->select())
				{
					return $rel;
				}
				else
				{
					return '0';
				}
			}elseif ($_data['type']=='email') {
				$data['email']=$_data['email'];
				if ($rel=$this->where($data)->select())
				 {
					return $rel;
				}
				else
				{
					return '0';
				}
			}
			

		}
}
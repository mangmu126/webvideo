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
		public function findTheacher($m_name)
		{	
			$map['m_name']=array('like',"%$m_name%");
			$map['m_type']=2;
			if ($rel=$this->where($map)->limit(10)->select()) {
				return $rel;
			}else{
				return 0;
			}

		}
}
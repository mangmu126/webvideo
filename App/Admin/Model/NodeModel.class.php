<?php
namespace Admin\Model;
use Think\Model;
Class NodeModel extends Model{
	//删除节点
	public function delNode($id){
		if($this->where(array('pid'=>$id))->select()){
			return 0;
		}else{
			if($this->delete($id)){
				return 1;
			}else{
				return 0;
			}
		}
		

	}
	public function addNode($data){
		if($this->add($data)){
			return 1;
		}else{
			return 0;
		}
	}
}
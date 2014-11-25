<?php
namespace Admin\Controller;

Class CourseController extends HomeController
{
	//添加分类
	public function addClass(){
		$this->login();
		if (IS_AJAX) {
			
		}else{
			$this->display();
		}
	}
}
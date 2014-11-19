<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;

class IndexController extends HomeController {
	public function _initialize(){
		$this->login();
	}
    public function index(){
    	$this->name=get_cookie_name();
		$this->display();
    }
}
<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;

class IndexController extends HomeController {
	public function _initialize(){
		//$this->login();
	}
    public function index(){

    	$name=get_cookie_name();
		$this->username=$name['username'];
		$this->display();
    }
}
<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Verify;
class LoginController extends Controller{
	public function index(){
		$this->display();
	}
	public function verify() {
		$Verify = new Verify();
		$Verify->entry(1);
	}
}
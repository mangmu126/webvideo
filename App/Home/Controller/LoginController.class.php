<?php
namespace Home\Controller;
use Think\Verify;

class LoginController extends HomeController {
	public function index() {
			$this->login();
		if (!session('?user_auth')) {
			$this->display();
		} else {
			$this->redirect('Index/index');
		}
	}
	public function verify() {
		$Verify = new Verify();
		$Verify->entry(1);
	}
}
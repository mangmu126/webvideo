<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Verify;
class LoginController extends Controller{
	public function index(){
		if (!session('?user_auth')) {
			$this->display();
		 }else {
			$this->redirect('Index/index');
		}
	}
	public function verify() {
		$Verify = new Verify();
		$Verify->entry(1);
	}
}
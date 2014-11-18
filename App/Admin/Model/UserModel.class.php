<?php
namespace Admin\Model;
use  Think\Model\RelationModel;
Class UserModel extends RelationModel{

	

	//定义关联关系
	Protected $_link =array(
			'role'=>array(
					'mapping_type'=>self::MANY_TO_MANY,//以多对多关系关联
					'class_name'=>'role',
					'foreign_key'=>'user_id',//主表的外健
					'relation_foreign_key'=>'role_id',//副表的外键
					'relation_table'=>'think_role_user',//指定中间表
					'mapping_fields'=>'id,name,remark',
				)
		);



	
	//批量验证
	//protected $patchValidate = true;
	
	//用户表自动验证
	protected $_validate = array(
		//-1,'帐号长度不合法！'
		array('username', '/^[^@]{2,20}$/i', -1, self::EXISTS_VALIDATE),
		//-2,'密码长度不合法！'
		array('password', '6,30', -2, self::EXISTS_VALIDATE,'length'),
		//-3,'密码和密码确认不一致！'
		array('repassword', 'password', -3, self::EXISTS_VALIDATE,'confirm'),
		//-4,'邮箱格式不正确！'
		array('email', 'email', -4, self::EXISTS_VALIDATE),
	
		//-5,'帐号被占用！'
		array('username', '', -5, self::EXISTS_VALIDATE, 'unique', self::MODEL_INSERT),
		//-6,'邮箱被占用！'
		array('email', '', -6, self::EXISTS_VALIDATE, 'unique', self::MODEL_INSERT),
	
		//-7,'验证码错误'
		array('verify', 'check_verify', -7, self::EXISTS_VALIDATE, 'function'),
	
		//-8,登录用户名长度不合法
		array('login_username', '2,50', -8, self::EXISTS_VALIDATE,'length'),
		//noemail,判断登录用户名是否是邮箱
		array('login_username', 'email', 'noemail', self::EXISTS_VALIDATE),
	);
	
	//用户表自动完成
	protected $_auto = array(
		array('password', 'sha1', self::MODEL_BOTH, 'function'),
		array('create', 'time', self::MODEL_INSERT, 'function'),
	);
	
	//验证占用字段
	public function checkField($field, $type) {
		$data = array();
		switch ($type) {
			case 'username' : 
				$data['username'] = $field;
				break;
			case 'email' : 
				$data['email'] = $field;
				break;
			case 'verify' : 
				$data['verify'] = $field;
				break;
			default:
				return 0;
		}
		return $this->create($data) ? 1 : $this->getError();
	}
	
	//注册一条用户
	public function register($username, $password, $repassword, $email, $verify) {
		$data = array(
			'username'=>$username,
			'password'=>$password,
			'repassword'=>$repassword,
			'email'=>$email,
			'verify'=>$verify,
		);
		
		if ($this->create($data)) {
			$uid = $this->add();
			return $uid ? $uid : 0;
		} else {
			return $this->getError();
		}
	}
	
	//登录用户
	public function login($username, $password, $auto) {
		$data = array(
			'login_username'=>$username,
			'password'=>$password,
		);
		
		//where条件
		$map = array();
		
		
		if ($this->create($data)) {
			//这里采用邮箱登录方式
			$map['email'] = $username;
		} else {
			if ($this->getError() == 'noemail') {
				//这里采用帐号登录方式
				$map['username'] = $username;
			} else {
				return $this->getError();
			}
		}
		
		//验证密码
		$user = $this->field('id,username,password')->where($map)->find();
		if ($user['password'] == sha1($password)) {
			
			//登录验证后写入登录信息
			$update = array(
				'id'=>$user['id'],
				'last_login'=>NOW_TIME,
				'last_ip'=>get_client_ip(1),
			);
			$this->save($update);
			
			//将记录写入到cookie和session中去
			$auth = array(
				'id'=>$user['id'],
				'username'=>$user['username'],
				'last_login'=>NOW_TIME,
			);
			
			//写入到session
			session('user_auth', $auth);
			
			//将用户名加密写入cookie
			if ($auto == 'on') {
				cookie('auto', encryption($user['username'].'|'.get_client_ip()), 3600 * 24 * 30);
			}
			
			
			return $user['id'];
		} else {
			return -9;		//密码不正确
		}
	}
	
	
	
	
	
	
	
	
	


	
}
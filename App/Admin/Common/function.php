<?php
//递归重组节点信息为多维数组
function node_merge($node,$access=null,$pid=0){
	$arr=array();
	foreach ($node as $v) {
		if (is_array($access)) {
				$v['access']=in_array($v['id'],$access)?1:0;//in_array数组比较
		}
		if ($v['pid']==$pid) {
			$v['child']=node_merge($node,$access,$v['id']);
			$arr[]=$v;
		}
	}
	return $arr;
}
function check_verify($code, $id = 1) {
	$Verify = new \Think\Verify();
	$Verify->reset = false;
	return $Verify->check($code, $id);
}

//cookie加密
function encryption($username, $type = 0) {
	$key = sha1(C('COOKIE_key'));
	
	if (!$type) {
		return base64_encode($username ^ $key);
	}
	
	$username = base64_decode($username);
	return $username ^ $key;
}
//获取cookie返回name
function get_cookie_name(){
	$value = explode('|', encryption(cookie('auto'), 1));
		list($username, $ip) = $value;
		return $username;
}
<?php

require_once('../inc/user.class.php');

$verify = trim($_POST['token']);
$uid = trim($_POST['uid']);
$time = trim($_POST['time']);
//获取新密码和姓名验证
$passwd = $_POST['password'];

if(empty($passwd) || empty($uid) || empty($time)) {
	$seq = array("status"=>"false","data"=>"密码填写错误!");
	$com = json_encode($seq);
	echo $com;
	exit;
}


//再次确认是否已修改密码
$user = new User();
$tag = 'uid';
$result = $user->getinfo_x($uid,$tag);

$str = md5($result[0]['uid'].$result[0]['password'].$time);
if($verify == $str){
	$com = $user->user_changepassword($passwd,$uid);
	if(false !== $com){
		$seq = array("status"=>"true");
		$seq = json_encode($seq);
		echo $seq;
		exit;
	}
}
else {
	$seq = array("status"=>"false","data"=>"此链接已失效!");
	$com = json_encode($seq);
	echo $com;
}
?>

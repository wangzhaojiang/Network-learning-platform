<?php
	require('../inc/user.class.php');

if(ISSET($_POST['name']))
	$name = $_POST['name'];
else {
	echo 'NOT SET NAME!';
	exit;
}
if(ISSET($_POST['password']))
	$password = $_POST['password'];
else {
	echo 'NOT SET password';
	exit;
}
if(ISSET($_POST['mail']))
	$mail = $_POST['mail'];
else {
	echo 'NOT SET mail';
	exit;
}	

if(empty($name) || empty($password) || empty($mail)) {
	echo false;
	exit;
}

$user = new User();

$tag = 'name';
$search = $user->getinfo_x($name,$tag);

if( $search != 'nothing') {
	$com = array("status"=>"false","data"=>"此昵称已存在！");
	$seq = json_encode($com);
	echo $seq;
	exit;
}
unset($tag);
$tag = 'mail';
$search = $user->getinfo_x($mail,$tag);

if( $search != 'nothing') {
	$com = array("status"=>"false","data"=>"此邮箱已存在！");
	$seq = json_encode($com);
	echo $seq;
	exit;
}

$result = $user->user_signup($name,$password,$mail);
if($result){

	$com = array("status"=>"true","data"=>"恭喜！注册成功！");
	$seq = json_encode($com);
	echo $seq;
}
else { 
	$com = array("status"=>"false","data"=>"注册失败！");
	$seq = json_encode($com);
	echo $seq;
}
?>

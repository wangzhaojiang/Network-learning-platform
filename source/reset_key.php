<?php
require('inc/user.class.php');
require('init.php');

#$tpl = new Smarty();
#$tpl->template_dir = './templates/';
#$tpl->compile_dir = './templates_c/';
#$tpl->config_dir = './configs/';
#$tpl->cache_dir = './cache/';
#$tpl->left_delimiter = '<{';
#$tpl->right_delimiter = '}>';
#


$token = trim($_GET['token']);
$uid = trim($_GET['uid']);
$time = trim($_GET['time']);
if(empty($token) || empty($uid) || empty($time)){
	print 'false1';
	exit;
}

$user = new User();
$tag = 'uid';
$result = $user->getinfo_x($uid,$tag);
$userinfo = $result[0];
$str = $userinfo['uid'].$userinfo['password'].$time;
$verify  = md5($str);
if($token == $verify){
	$nowtime = time();
	if($nowtime < $time){
		$tpl->assign('token',$token);
		$tpl->assign('time',$time);
		$tpl->assign('uid',$uid);
		$tpl->display('reset_key.tpl');
	} else {
		echo 'false2';
		exit;
	}
}else {
	echo '<meta charset="utf-8">连接无效,校验不匹配!';
	exit;
}


?>

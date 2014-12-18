<?php

require('inc/user.class.php');
require_once('init.php');
$uid = $_SESSION['uid'];
if(!$uid) {
	echo '无法获取用户信息';
	exit;
}
$user = new User();
$result = $user->user_getinfo($uid);
if($result == 'nothing' || $result == false) {
	echo '查找失败';
	exit;
}
else {
	
	$my_profile = $result[0];
	while($key = key($my_profile)){
		if($key == 'sex'){
			if($my_profile[$key] == 0)
				$my_profile[$key] = '男';
			else if($my_profile[$key] == 1)
				$my_profile[$key] = '女';
			else 
				$my_profile[$key] = '未知';
		}
		else if($my_profile[$key] == null){
		
			$my_profile[$key] = '未知';
		}
		
		next($my_profile);
	}
	$tpl->assign('my_profile',$my_profile);
	$tpl->display('user_profile.tpl');
}
?>

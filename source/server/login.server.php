<?php
require_once('../inc/user.class.php');
session_start();

/*if ( !isset($_POST['action']) ) {
    return;
}
 */
//$action = $_POST['action'];

$action = 'login';
if ( $action == 'logout' ) {
	if ( isset($_SESSION['uid']) ) {
		unset($_SESSION['uid']);
	}
}
if ( $action == 'login' ) {
	$mail = $_POST['mail'];
	$password = $_POST['password'];
	if( empty($mail) || empty($password) ){
		$conseq = array("status"=>"false","data"=>"邮箱或密码为空!");
		$com = json_encode($conseq);
		echo $com;
		exit;
	}

	$user = new User();
	$tag = 'mail';
	$result = $user->getinfo_x($mail,$tag);
	if( !$result ){
		$conseq = array("status"=>"false","data"=>"邮箱不存在!");
		$com = json_encode($conseq);
		echo $com;
		exit;
	}

	$row = $result[0];
	if($password == $row['password']){
		$_SESSION['identity'] = crypt($row['uid'],'Nlp_2014');
		$_SESSION['uid'] = $row['uid'];
		$conseq = array("status"=>"true","uid"=>$row['uid']);
		$com = json_encode($conseq);
		
		echo $com;
	}else{
		$conseq = array("status"=>"false","data"=>"密码错误");
		$com = json_encode($conseq);
		echo $com;
    }
}
?>

<?php
require_once("init.php");
require_once("inc/relation.class.php");
#session_start();
#
#if( !isset($_SESSION['uid']) ){
#	$tpl->display("sign_in.php");
#}
#
#$fromuid = $_SESSION['uid'];

#$relation = new Relation($fromuid);
$relation = new Relation(1004);

$result = $relation->cat_relation(0);


if( $result['status'] == false && $result['status'] == 'nothing' ){
	$tpl->assign('user_follow', array());
}
else {
	$tpl->assign('user_follow', $result['content']);
}


$tpl->display('user_follow.tpl');


?>

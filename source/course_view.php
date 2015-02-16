<?php
require_once("inc/vedio.class.php");
require_once("user.class.php");
require_once("smarty.php");
session_start();
$vedio = new Vedio();

if( !isset($_GET['vid']) ){
    //error; 404notfound
}


$vid = $_GET['vid'];

if( isset($_SESSION['uid']) ){
    $result1 = $vedio->watch_vedio($vid,$_SESSION['uid']);
    $tpl->assign(...) //登陆状态字段;
}
else
    $result1 = $vedio->watch_vedio($vid);

if( $result1['status'] == false  ){
    //404notfound;
}
else{
    $tpl->assign(....);
}

$result2 = $vedio->watch_people($vid);

if( !$result2['status'] ){
    echo "watch_people_list error";
    ...
}
else{
    //uid -> user_info;
    $user = new User();

}
?>

<?php
require_once("../inc/relation.class.php");
#session_start()

if( !isset($_POST['action']) || !isset($_POST['uid']) ){
    echo 'error';
    exit();
}

#$relation = new Relation($_SESSION['uid'])
$relation = new Relation(1004);

switch( $_POST['action'] ){
    case "add_relation":
        $result = $relation->add_relation($_POST['uid']);
        echo json_encode(array('status'=>$result['status']));
        break;
    case "delete_relation":
        $result = $relation->delete_relation($_POST['uid']);
        echo json_encode(array('status'=>$result['status']));
        break;
}
?>

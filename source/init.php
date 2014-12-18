<?php
session_start();

require_once("inc/get_conf.class.php");

$conf = new Get_conf();

$param = $conf->get_content();

require_once($param["Smarty_path"]);

$tpl = new Smarty();
$tpl->template_dir = './templates/';
$tpl->compile_dir = './templates_c/';
$tpl->config_dir = './configs/';
$tpl->cache_dir = './cache/';
$tpl->left_delimiter = '<{';
$tpl->right_delimiter = '}>';

if( !isset($_SESSION['uid']) ){
    $tpl->display('tpl_sign_in.html');
}
?>

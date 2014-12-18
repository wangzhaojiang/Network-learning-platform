<?php
session_start();

require_once("inc/get_conf.class.php");

$conf = new Get_conf();

$param = $conf->get_content();

require_once($param["Smarty_path"]);

$tpl = new Smarty();
$tpl->template_dir = $param['template_dir'];
$tpl->compile_dir = $param['compile_dir'];
$tpl->config_dir = $param['config_dir'];
$tpl->cache_dir = $param['cache_dir'];
$tpl->left_delimiter = $param['left_delimiter'];
$tpl->right_delimiter = $param['right_delimiter'];

if( !isset($_SESSION['uid']) ){
    $tpl->display('tpl_sign_in.html');
}
?>
